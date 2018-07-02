<?php
/**
 * WordPress Link Template Functions
 *
 * @package WordPress
 * @subpackage Template
 */

/**
 * Display the permalink for the current post.
 *
 * @since 1.2.0
 */
function the_permalink() {
	/**
	 * Filter the display of the permalink for the current post.
	 *
	 * @since 1.5.0
	 *
	 * @param string $permalink The permalink for the current post.
	 */
	echo esc_url( apply_filters( 'the_permalink', get_permalink() ) );
}

/**
 * Retrieve trailing slash string, if blog set for adding trailing slashes.
 *
 * Conditionally adds a trailing slash if the permalink structure has a trailing
 * slash, strips the trailing slash if not. The string is passed through the
 * 'user_trailingslashit' filter. Will remove trailing slash from string, if
 * blog is not set to have them.
 *
 * @since 2.2.0
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $string URL with or without a trailing slash.
 * @param string $type_of_url The type of URL being considered (e.g. single, category, etc) for use in the filter.
 * @return string The URL with the trailing slash appended or stripped.
 */
function user_trailingslashit($string, $type_of_url = '') {
	global $wp_rewrite;
	if ( $wp_rewrite->use_trailing_slashes )
		$string = trailingslashit($string);
	else
		$string = untrailingslashit($string);

	/**
	 * Filter the trailing slashed string, depending on whether the site is set
	 * to use training slashes.
	 *
	 * @since 2.2.0
	 *
	 * @param string $string      URL with or without a trailing slash.
	 * @param string $type_of_url The type of URL being considered. Accepts 'single', 'single_trackback',
	 *                            'single_feed', 'single_paged', 'feed', 'category', 'page', 'year',
	 *                            'month', 'day', 'paged', 'post_type_archive'.
	 */
	return apply_filters( 'user_trailingslashit', $string, $type_of_url );
}

/**
 * Display permalink anchor for current post.
 *
 * The permalink mode title will use the post title for the 'a' element 'id'
 * attribute. The id mode uses 'post-' with the post ID for the 'id' attribute.
 *
 * @since 0.71
 *
 * @param string $mode Permalink mode can be either 'title', 'id', or default, which is 'id'.
 */
function permalink_anchor( $mode = 'id' ) {
	$post = get_post();
	switch ( strtolower( $mode ) ) {
		case 'title':
			$title = sanitize_title( $post->post_title ) . '-' . $post->ID;
			echo '<a id="'.$title.'"></a>';
			break;
		case 'id':
		default:
			echo '<a id="post-' . $post->ID . '"></a>';
			break;
	}
}

/**
 * Retrieve full permalink for current post or post ID.
 *
 * This function is an alias for get_permalink().
 *
 * @since 3.9.0
 *
 * @see get_permalink()
 *
 * @param int|WP_Post $id        Optional. Post ID or post object. Default is the current post.
 * @param bool        $leavename Optional. Whether to keep post name or page name. Default false.
 * @return string|false The permalink URL or false if post does not exist.
 */
function get_the_permalink( $id = 0, $leavename = false ) {
	return get_permalink( $id, $leavename );
}

/**
 * Retrieve full permalink for current post or post ID.
 *
 * @since 1.0.0
 *
 * @param int|WP_Post $id        Optional. Post ID or post object. Default current post.
 * @param bool        $leavename Optional. Whether to keep post name or page name. Default false.
 * @return string|false The permalink URL or false if post does not exist.
 */
function get_permalink( $id = 0, $leavename = false ) {
	$rewritecode = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		$leavename? '' : '%postname%',
		'%post_id%',
		'%category%',
		'%author%',
		$leavename? '' : '%pagename%',
	);

	if ( is_object($id) && isset($id->filter) && 'sample' == $id->filter ) {
		$post = $id;
		$sample = true;
	} else {
		$post = get_post($id);
		$sample = false;
	}

	if ( empty($post->ID) )
		return false;

	if ( $post->post_type == 'page' )
		return get_page_link($post, $leavename, $sample);
	elseif ( $post->post_type == 'attachment' )
		return get_attachment_link( $post, $leavename );
	elseif ( in_array($post->post_type, get_post_types( array('_builtin' => false) ) ) )
		return get_post_permalink($post, $leavename, $sample);

	$permalink = get_option('permalink_structure');

	/**
	 * Filter the permalink structure for a post before token replacement occurs.
	 *
	 * Only applies to posts with post_type of 'post'.
	 *
	 * @since 3.0.0
	 *
	 * @param string  $permalink The site's permalink structure.
	 * @param WP_Post $post      The post in question.
	 * @param bool    $leavename Whether to keep the post name.
	 */
	$permalink = apply_filters( 'pre_post_link', $permalink, $post, $leavename );

	if ( '' != $permalink && !in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft', 'future' ) ) ) {
		$unixtime = strtotime($post->post_date);

		$category = '';
		if ( strpos($permalink, '%category%') !== false ) {
			$cats = get_the_category($post->ID);
			if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); // order by ID

				/**
				 * Filter the category that gets used in the %category% permalink token.
				 *
				 * @since 3.5.0
				 *
				 * @param stdClass $cat  The category to use in the permalink.
				 * @param array    $cats Array of all categories associated with the post.
				 * @param WP_Post  $post The post in question.
				 */
				$category_object = apply_filters( 'post_link_category', $cats[0], $cats, $post );

				$category_object = get_term( $category_object, 'category' );
				$category = $category_object->slug;
				if ( $parent = $category_object->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$default_category = get_term( get_option( 'default_category' ), 'category' );
				$category = is_wp_error( $default_category ) ? '' : $default_category->slug;
			}
		}

		$author = '';
		if ( strpos($permalink, '%author%') !== false ) {
			$authordata = get_userdata($post->post_author);
			$author = $authordata->user_nicename;
		}

		$date = explode(" ",date('Y m d H i s', $unixtime));
		$rewritereplace =
		array(
			$date[0],
			$date[1],
			$date[2],
			$date[3],
			$date[4],
			$date[5],
			$post->post_name,
			$post->ID,
			$category,
			$author,
			$post->post_name,
		);
		$permalink = home_url( str_replace($rewritecode, $rewritereplace, $permalink) );
		$permalink = user_trailingslashit($permalink, 'single');
	} else { // if they're not using the fancy permalink option
		$permalink = home_url('?p=' . $post->ID);
	}

	/**
	 * Filter the permalink for a post.
	 *
	 * Only applies to posts with post_type of 'post'.
	 *
	 * @since 1.5.0
	 *
	 * @param string  $permalink The post's permalink.
	 * @param WP_Post $post      The post in question.
	 * @param bool    $leavename Whether to keep the post name.
	 */
	return apply_filters( 'post_link', $permalink, $post, $leavename );
}

/**
 * Retrieve the permalink for a post with a custom post type.
 *
 * @since 3.0.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int $id         Optional. Post ID.
 * @param bool $leavename Optional, defaults to false. Whether to keep post name.
 * @param bool $sample    Optional, defaults to false. Is it a sample permalink.
 * @return string|WP_Error The post permalink.
 */
function get_post_permalink( $id = 0, $leavename = false, $sample = false ) {
	global $wp_rewrite;

	$post = get_post($id);

	if ( is_wp_error( $post ) )
		return $post;

	$post_link = $wp_rewrite->get_extra_permastruct($post->post_type);

	$slug = $post->post_name;

	$draft_or_pending = isset( $post->post_status ) && in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft', 'future' ) );

	$post_type = get_post_type_object($post->post_type);

	if ( $post_type->hierarchical ) {
		$slug = get_page_uri( $id );
	}

	if ( !empty($post_link) && ( !$draft_or_pending || $sample ) ) {
		if ( ! $leavename ) {
			$post_link = str_replace("%$post->post_type%", $slug, $post_link);
		}
		$post_link = home_url( user_trailingslashit($post_link) );
	} else {
		if ( $post_type->query_var && ( isset($post->post_status) && !$draft_or_pending ) )
			$post_link = add_query_arg($post_type->query_var, $slug, '');
		else
			$post_link = add_query_arg(array('post_type' => $post->post_type, 'p' => $post->ID), '');
		$post_link = home_url($post_link);
	}

	/**
	 * Filter the permalink for a post with a custom post type.
	 *
	 * @since 3.0.0
	 *
	 * @param string  $post_link The post's permalink.
	 * @param WP_Post $post      The post in question.
	 * @param bool    $leavename Whether to keep the post name.
	 * @param bool    $sample    Is it a sample permalink.
	 */
	return apply_filters( 'post_type_link', $post_link, $post, $leavename, $sample );
}

/**
 * Retrieve permalink from post ID.
 *
 * @since 1.0.0
 *
 * @param int|WP_Post $post_id    Optional. Post ID or WP_Post object. Default is global $post.
 * @param mixed       $deprecated Not used.
 * @return string|false
 */
function post_permalink( $post_id = 0, $deprecated = '' ) {
	if ( !empty( $deprecated ) )
		_deprecated_argument( __FUNCTION__, '1.3' );

	return get_permalink($post_id);
}

/**
 * Retrieve the permalink for current page or page ID.
 *
 * Respects page_on_front. Use this one.
 *
 * @since 1.5.0
 *
 * @param int|object $post      Optional. Post ID or object.
 * @param bool       $leavename Optional, defaults to false. Whether to keep page name.
 * @param bool       $sample    Optional, defaults to false. Is it a sample permalink.
 * @return string The page permalink.
 */
function get_page_link( $post = false, $leavename = false, $sample = false ) {
	$post = get_post( $post );

	if ( 'page' == get_option( 'show_on_front' ) && $post->ID == get_option( 'page_on_front' ) )
		$link = home_url('/');
	else
		$link = _get_page_link( $post, $leavename, $sample );

	/**
	 * Filter the permalink for a page.
	 *
	 * @since 1.5.0
	 *
	 * @param string $link    The page's permalink.
	 * @param int    $post_id The ID of the page.
	 * @param bool   $sample  Is it a sample permalink.
	 */
	return apply_filters( 'page_link', $link, $post->ID, $sample );
}

/**
 * Retrieve the page permalink.
 *
 * Ignores page_on_front. Internal use only.
 *
 * @since 2.1.0
 * @access private
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int|object $post      Optional. Post ID or object.
 * @param bool       $leavename Optional. Leave name.
 * @param bool       $sample    Optional. Sample permalink.
 * @return string The page permalink.
 */
function _get_page_link( $post = false, $leavename = false, $sample = false ) {
	global $wp_rewrite;

	$post = get_post( $post );

	$draft_or_pending = in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft' ) );

	$link = $wp_rewrite->get_page_permastruct();

	if ( !empty($link) && ( ( isset($post->post_status) && !$draft_or_pending ) || $sample ) ) {
		if ( ! $leavename ) {
			$link = str_replace('%pagename%', get_page_uri( $post ), $link);
		}

		$link = home_url($link);
		$link = user_trailingslashit($link, 'page');
	} else {
		$link = home_url( '?page_id=' . $post->ID );
	}

	/**
	 * Filter the permalink for a non-page_on_front page.
	 *
	 * @since 2.1.0
	 *
	 * @param string $link    The page's permalink.
	 * @param int    $post_id The ID of the page.
	 */
	return apply_filters( '_get_page_link', $link, $post->ID );
}

/**
 * Retrieve permalink for attachment.
 *
 * This can be used in the WordPress Loop or outside of it.
 *
 * @since 2.0.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int|object $post      Optional. Post ID or object.
 * @param bool       $leavename Optional. Leave name.
 * @return string The attachment permalink.
 */
function get_attachment_link( $post = null, $leavename = false ) {
	global $wp_rewrite;

	$link = false;

	$post = get_post( $post );
	$parent = ( $post->post_parent > 0 && $post->post_parent != $post->ID ) ? get_post( $post->post_parent ) : false;

	if ( $wp_rewrite->using_permalinks() && $parent ) {
		if ( 'page' == $parent->post_type )
			$parentlink = _get_page_link( $post->post_parent ); // Ignores page_on_front
		else
			$parentlink = get_permalink( $post->post_parent );

		if ( is_numeric($post->post_name) || false !== strpos(get_option('permalink_structure'), '%category%') )
			$name = 'attachment/' . $post->post_name; // <permalink>/<int>/ is paged so we use the explicit attachment marker
		else
			$name = $post->post_name;

		if ( strpos($parentlink, '?') === false )
			$link = user_trailingslashit( trailingslashit($parentlink) . '%postname%' );

		if ( ! $leavename )
			$link = str_replace( '%postname%', $name, $link );
	}

	if ( ! $link )
		$link = home_url( '/?attachment_id=' . $post->ID );

	/**
	 * Filter the permalink for an attachment.
	 *
	 * @since 2.0.0
	 *
	 * @param string $link    The attachment's permalink.
	 * @param int    $post_id Attachment ID.
	 */
	return apply_filters( 'attachment_link', $link, $post->ID );
}

/**
 * Retrieve the permalink for the year archives.
 *
 * @since 1.5.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int|bool $year False for current year or year for permalink.
 * @return string The permalink for the specified year archive.
 */
function get_year_link($year) {
	global $wp_rewrite;
	if ( !$year )
		$year = gmdate('Y', current_time('timestamp'));
	$yearlink = $wp_rewrite->get_year_permastruct();
	if ( !empty($yearlink) ) {
		$yearlink = str_replace('%year%', $year, $yearlink);
		$yearlink = home_url( user_trailingslashit( $yearlink, 'year' ) );
	} else {
		$yearlink = home_url( '?m=' . $year );
	}

	/**
	 * Filter the year archive permalink.
	 *
	 * @since 1.5.0
	 *
	 * @param string $yearlink Permalink for the year archive.
	 * @param int    $year     Year for the archive.
	 */
	return apply_filters( 'year_link', $yearlink, $year );
}

/**
 * Retrieve the permalink for the month archives with year.
 *
 * @since 1.0.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param bool|int $year  False for current year. Integer of year.
 * @param bool|int $month False for current month. Integer of month.
 * @return string The permalink for the specified month and year archive.
 */
function get_month_link($year, $month) {
	global $wp_rewrite;
	if ( !$year )
		$year = gmdate('Y', current_time('timestamp'));
	if ( !$month )
		$month = gmdate('m', current_time('timestamp'));
	$monthlink = $wp_rewrite->get_month_permastruct();
	if ( !empty($monthlink) ) {
		$monthlink = str_replace('%year%', $year, $monthlink);
		$monthlink = str_replace('%monthnum%', zeroise(intval($month), 2), $monthlink);
		$monthlink = home_url( user_trailingslashit( $monthlink, 'month' ) );
	} else {
		$monthlink = home_url( '?m=' . $year . zeroise( $month, 2 ) );
	}

	/**
	 * Filter the month archive permalink.
	 *
	 * @since 1.5.0
	 *
	 * @param string $monthlink Permalink for the month archive.
	 * @param int    $year      Year for the archive.
	 * @param int    $month     The month for the archive.
	 */
	return apply_filters( 'month_link', $monthlink, $year, $month );
}

/**
 * Retrieve the permalink for the day archives with year and month.
 *
 * @since 1.0.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param bool|int $year  False for current year. Integer of year.
 * @param bool|int $month False for current month. Integer of month.
 * @param bool|int $day   False for current day. Integer of day.
 * @return string The permalink for the specified day, month, and year archive.
 */
function get_day_link($year, $month, $day) {
	global $wp_rewrite;
	if ( !$year )
		$year = gmdate('Y', current_time('timestamp'));
	if ( !$month )
		$month = gmdate('m', current_time('timestamp'));
	if ( !$day )
		$day = gmdate('j', current_time('timestamp'));

	$daylink = $wp_rewrite->get_day_permastruct();
	if ( !empty($daylink) ) {
		$daylink = str_replace('%year%', $year, $daylink);
		$daylink = str_replace('%monthnum%', zeroise(intval($month), 2), $daylink);
		$daylink = str_replace('%day%', zeroise(intval($day), 2), $daylink);
		$daylink = home_url( user_trailingslashit( $daylink, 'day' ) );
	} else {
		$daylink = home_url( '?m=' . $year . zeroise( $month, 2 ) . zeroise( $day, 2 ) );
	}

	/**
	 * Filter the day archive permalink.
	 *
	 * @since 1.5.0
	 *
	 * @param string $daylink Permalink for the day archive.
	 * @param int    $year    Year for the archive.
	 * @param int    $month   Month for the archive.
	 * @param int    $day     The day for the archive.
	 */
	return apply_filters( 'day_link', $daylink, $year, $month, $day );
}

/**
 * Display the permalink for the feed type.
 *
 * @since 3.0.0
 *
 * @param string $anchor The link's anchor text.
 * @param string $feed   Optional, defaults to default feed. Feed type.
 */
function the_feed_link( $anchor, $feed = '' ) {
	$link = '<a href="' . esc_url( get_feed_link( $feed ) ) . '">' . $anchor . '</a>';

	/**
	 * Filter the feed link anchor tag.
	 *
	 * @since 3.0.0
	 *
	 * @param string $link The complete anchor tag for a feed link.
	 * @param string $feed The feed type, or an empty string for the
	 *                     default feed type.
	 */
	echo apply_filters( 'the_feed_link', $link, $feed );
}

/**
 * Retrieve the permalink for the feed type.
 *
 * @since 1.5.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $feed Optional, defaults to default feed. Feed type.
 * @return string The feed permalink.
 */
function get_feed_link($feed = '') {
	global $wp_rewrite;

	$permalink = $wp_rewrite->get_feed_permastruct();
	if ( '' != $permalink ) {
		if ( false !== strpos($feed, 'comments_') ) {
			$feed = str_replace('comments_', '', $feed);
			$permalink = $wp_rewrite->get_comment_feed_permastruct();
		}

		if ( get_default_feed() == $feed )
			$feed = '';

		$permalink = str_replace('%feed%', $feed, $permalink);
		$permalink = preg_replace('#/+#', '/', "/$permalink");
		$output =  home_url( user_trailingslashit($permalink, 'feed') );
	} else {
		if ( empty($feed) )
			$feed = get_default_feed();

		if ( false !== strpos($feed, 'comments_') )
			$feed = str_replace('comments_', 'comments-', $feed);

		$output = home_url("?feed={$feed}");
	}

	/**
	 * Filter the feed type permalink.
	 *
	 * @since 1.5.0
	 *
	 * @param string $output The feed permalink.
	 * @param string $feed   Feed type.
	 */
	return apply_filters( 'feed_link', $output, $feed );
}

/**
 * Retrieve the permalink for the post comments feed.
 *
 * @since 2.2.0
 *
 * @param int    $post_id Optional. Post ID.
 * @param string $feed    Optional. Feed type.
 * @return string The permalink for the comments feed for the given post.
 */
function get_post_comments_feed_link($post_id = 0, $feed = '') {
	$post_id = absint( $post_id );

	if ( ! $post_id )
		$post_id = get_the_ID();

	if ( empty( $feed ) )
		$feed = get_default_feed();

	if ( '' != get_option('permalink_structure') ) {
		if ( 'page' == get_option('show_on_front') && $post_id == get_option('page_on_front') )
			$url = _get_page_link( $post_id );
		else
			$url = get_permalink($post_id);

		$url = trailingslashit($url) . 'feed';
		if ( $feed != get_default_feed() )
			$url .= "/$feed";
		$url = user_trailingslashit($url, 'single_feed');
	} else {
		$type = get_post_field('post_type', $post_id);
		if ( 'page' == $type )
			$url = add_query_arg( array( 'feed' => $feed, 'page_id' => $post_id ), home_url( '/' ) );
		else
			$url = add_query_arg( array( 'feed' => $feed, 'p' => $post_id ), home_url( '/' ) );
	}

	/**
	 * Filter the post comments feed permalink.
	 *
	 * @since 1.5.1
	 *
	 * @param string $url Post comments feed permalink.
	 */
	return apply_filters( 'post_comments_feed_link', $url );
}

/**
 * Display the comment feed link for a post.
 *
 * Prints out the comment feed link for a post. Link text is placed in the
 * anchor. If no link text is specified, default text is used. If no post ID is
 * specified, the current post is used.
 *
 * @since 2.5.0
 *
 * @param string $link_text Descriptive text.
 * @param int    $post_id   Optional post ID. Default to current post.
 * @param string $feed      Optional. Feed format.
*/
function post_comments_feed_link( $link_text = '', $post_id = '', $feed = '' ) {
	$url = esc_url( get_post_comments_feed_link( $post_id, $feed ) );
	if ( empty($link_text) )
		$link_text = __('Comments Feed');

	/**
	 * Filter the post comment feed link anchor tag.
	 *
	 * @since 2.8.0
	 *
	 * @param string $link    The complete anchor tag for the comment feed link.
	 * @param int    $post_id Post ID.
	 * @param string $feed    The feed type, or an empty string for the default feed type.
	 */
	echo apply_filters( 'post_comments_feed_link_html', "<a href='$url'>$link_text</a>", $post_id, $feed );
}

/**
 * Retrieve the feed link for a given author.
 *
 * Returns a link to the feed for all posts by a given author. A specific feed
 * can be requested or left blank to get the default feed.
 *
 * @since 2.5.0
 *
 * @param int    $author_id ID of an author.
 * @param string $feed      Optional. Feed type.
 * @return string Link to the feed for the author specified by $author_id.
*/
function get_author_feed_link( $author_id, $feed = '' ) {
	$author_id = (int) $author_id;
	$permalink_structure = get_option('permalink_structure');

	if ( empty($feed) )
		$feed = get_default_feed();

	if ( '' == $permalink_structure ) {
		$link = home_url("?feed=$feed&amp;author=" . $author_id);
	} else {
		$link = get_author_posts_url($author_id);
		if ( $feed == get_default_feed() )
			$feed_link = 'feed';
		else
			$feed_link = "feed/$feed";

		$link = trailingslashit($link) . user_trailingslashit($feed_link, 'feed');
	}

	/**
	 * Filter the feed link for a given author.
	 *
	 * @since 1.5.1
	 *
	 * @param string $link The author feed link.
	 * @param string $feed Feed type.
	 */
	$link = apply_filters( 'author_feed_link', $link, $feed );

	return $link;
}

/**
 * Retrieve the feed link for a category.
 *
 * Returns a link to the feed for all posts in a given category. A specific feed
 * can be requested or left blank to get the default feed.
 *
 * @since 2.5.0
 *
 * @param int    $cat_id ID of a category.
 * @param string $feed   Optional. Feed type.
 * @return string Link to the feed for the category specified by $cat_id.
*/
function get_category_feed_link( $cat_id, $feed = '' ) {
	return get_term_feed_link( $cat_id, 'category', $feed );
}

/**
 * Retrieve the feed link for a term.
 *
 * Returns a link to the feed for all posts in a given term. A specific feed
 * can be requested or left blank to get the default feed.
 *
 * @since 3.0.0
 *
 * @param int    $term_id  ID of a category.
 * @param string $taxonomy Optional. Taxonomy of $term_id
 * @param string $feed     Optional. Feed type.
 * @return string|false Link to the feed for the term specified by $term_id and $taxonomy.
*/
function get_term_feed_link( $term_id, $taxonomy = 'category', $feed = '' ) {
	$term_id = ( int ) $term_id;

	$term = get_term( $term_id, $taxonomy  );

	if ( empty( $term ) || is_wp_error( $term ) )
		return false;

	if ( empty( $feed ) )
		$feed = get_default_feed();

	$permalink_structure = get_option( 'permalink_structure' );

	if ( '' == $permalink_structure ) {
		if ( 'category' == $taxonomy ) {
			$link = home_url("?feed=$feed&amp;cat=$term_id");
		}
		elseif ( 'post_tag' == $taxonomy ) {
			$link = home_url("?feed=$feed&amp;tag=$term->slug");
		} else {
			$t = get_taxonomy( $taxonomy );
			$link = home_url("?feed=$feed&amp;$t->query_var=$term->slug");
		}
	} else {
		$link = get_term_link( $term_id, $term->taxonomy );
		if ( $feed == get_default_feed() )
			$feed_link = 'feed';
		else
			$feed_link = "feed/$feed";

		$link = trailingslashit( $link ) . user_trailingslashit( $feed_link, 'feed' );
	}

	if ( 'category' == $taxonomy ) {
		/**
		 * Filter the category feed link.
		 *
		 * @since 1.5.1
		 *
		 * @param string $link The category feed link.
		 * @param string $feed Feed type.
		 */
		$link = apply_filters( 'category_feed_link', $link, $feed );
	} elseif ( 'post_tag' == $taxonomy ) {
		/**
		 * Filter the post tag feed link.
		 *
		 * @since 2.3.0
		 *
		 * @param string $link The tag feed link.
		 * @param string $feed Feed type.
		 */
		$link = apply_filters( 'tag_feed_link', $link, $feed );
	} else {
		/**
		 * Filter the feed link for a taxonomy other than 'category' or 'post_tag'.
		 *
		 * @since 3.0.0
		 *
		 * @param string $link The taxonomy feed link.
		 * @param string $feed Feed type.
		 * @param string $feed The taxonomy name.
		 */
		$link = apply_filters( 'taxonomy_feed_link', $link, $feed, $taxonomy );
	}

	return $link;
}

/**
 * Retrieve permalink for feed of tag.
 *
 * @since 2.3.0
 *
 * @param int    $tag_id Tag ID.
 * @param string $feed   Optional. Feed type.
 * @return string The feed permalink for the given tag.
 */
function get_tag_feed_link( $tag_id, $feed = '' ) {
	return get_term_feed_link( $tag_id, 'post_tag', $feed );
}

/**
 * Retrieve edit tag link.
 *
 * @since 2.7.0
 *
 * @param int    $tag_id   Tag ID
 * @param string $taxonomy Taxonomy
 * @return string The edit tag link URL for the given tag.
 */
function get_edit_tag_link( $tag_id, $taxonomy = 'post_tag' ) {
	/**
	 * Filter the edit link for a tag (or term in another taxonomy).
	 *
	 * @since 2.7.0
	 *
	 * @param string $link The term edit link.
	 */
	return apply_filters( 'get_edit_tag_link', get_edit_term_link( $tag_id, $taxonomy ) );
}

/**
 * Display or retrieve edit tag link with formatting.
 *
 * @since 2.7.0
 *
 * @param string $link   Optional. Anchor text.
 * @param string $before Optional. Display before edit link.
 * @param string $after  Optional. Display after edit link.
 * @param object $tag    Tag object.
 */
function edit_tag_link( $link = '', $before = '', $after = '', $tag = null ) {
	$link = edit_term_link( $link, '', '', $tag, false );

	/**
	 * Filter the anchor tag for the edit link for a tag (or term in another taxonomy).
	 *
	 * @since 2.7.0
	 *
	 * @param string $link The anchor tag for the edit link.
	 */
	echo $before . apply_filters( 'edit_tag_link', $link ) . $after;
}

/**
 * Retrieve edit term url.
 *
 * @since 3.1.0
 *
 * @param int    $term_id     Term ID.
 * @param string $taxonomy    Taxonomy.
 * @param string $object_type The object type. Used to highlight the proper post type menu on the linked page.
 *                            Defaults to the first object_type associated with the taxonomy.
 * @return string|null The edit term link URL for the given term, or null on failure.
 */
function get_edit_term_link( $term_id, $taxonomy, $object_type = '' ) {
	$tax = get_taxonomy( $taxonomy );
	if ( ! $tax || ! current_user_can( $tax->cap->edit_terms ) ) {
		return;
	}

	$term = get_term( $term_id, $taxonomy );
	if ( ! $term || is_wp_error( $term ) ) {
		return;
	}

	$args = array(
		'action' => 'edit',
		'taxonomy' => $taxonomy,
		'tag_ID' => $term->term_id,
	);

	if ( $object_type ) {
		$args['post_type'] = $object_type;
	} elseif ( ! empty( $tax->object_type ) ) {
		$args['post_type'] = reset( $tax->object_type );
	}

	$location = add_query_arg( $args, admin_url( 'edit-tags.php' ) );

	/**
	 * Filter the edit link for a term.
	 *
	 * @since 3.1.0
	 *
	 * @param string $location    The edit link.
	 * @param int    $term_id     Term ID.
	 * @param string $taxonomy    Taxonomy name.
	 * @param string $object_type The object type (eg. the post type).
	 */
	return apply_filters( 'get_edit_term_link', $location, $term_id, $taxonomy, $object_type );
}

/**
 * Display or retrieve edit term link with formatting.
 *
 * @since 3.1.0
 *
 * @param string $link   Optional. Anchor text. Default empty.
 * @param string $before Optional. Display before edit link. Default empty.
 * @param string $after  Optional. Display after edit link. Default empty.
 * @param object $term   Optional. Term object. If null, the queried object will be inspected. Default null.
 * @param bool   $echo   Optional. Whether or not to echo the return. Default true.
 * @return string|void HTML content.
 */
function edit_term_link( $link = '', $before = '', $after = '', $term = null, $echo = true ) {
	if ( is_null( $term ) )
		$term = get_queried_object();

	if ( ! $term )
		return;

	$tax = get_taxonomy( $term->taxonomy );
	if ( ! current_user_can( $tax->cap->edit_terms ) )
		return;

	if ( empty( $link ) )
		$link = __('Edit This');

	$link = '<a href="' . get_edit_term_link( $term->term_id, $term->taxonomy ) . '">' . $link . '</a>';

	/**
	 * Filter the anchor tag for the edit link of a term.
	 *
	 * @since 3.1.0
	 *
	 * @param string $link    The anchor tag for the edit link.
	 * @param int    $term_id Term ID.
	 */
	$link = $before . apply_filters( 'edit_term_link', $link, $term->term_id ) . $after;

	if ( $echo )
		echo $link;
	else
		return $link;
}

/**
 * Retrieve permalink for search.
 *
 * @since  3.0.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $query Optional. The query string to use. If empty the current query is used.
 * @return string The search permalink.
 */
function get_search_link( $query = '' ) {
	global $wp_rewrite;

	if ( empty($query) )
		$search = get_search_query( false );
	else
		$search = stripslashes($query);

	$permastruct = $wp_rewrite->get_search_permastruct();

	if ( empty( $permastruct ) ) {
		$link = home_url('?s=' . urlencode($search) );
	} else {
		$search = urlencode($search);
		$search = str_replace('%2F', '/', $search); // %2F(/) is not valid within a URL, send it unencoded.
		$link = str_replace( '%search%', $search, $permastruct );
		$link = home_url( user_trailingslashit( $link, 'search' ) );
	}

	/**
	 * Filter the search permalink.
	 *
	 * @since 3.0.0
	 *
	 * @param string $link   Search permalink.
	 * @param string $search The URL-encoded search term.
	 */
	return apply_filters( 'search_link', $link, $search );
}

/**
 * Retrieve the permalink for the feed of the search results.
 *
 * @since 2.5.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $search_query Optional. Search query.
 * @param string $feed         Optional. Feed type.
 * @return string The search results feed permalink.
 */
function get_search_feed_link($search_query = '', $feed = '') {
	global $wp_rewrite;
	$link = get_search_link($search_query);

	if ( empty($feed) )
		$feed = get_default_feed();

	$permastruct = $wp_rewrite->get_search_permastruct();

	if ( empty($permastruct) ) {
		$link = add_query_arg('feed', $feed, $link);
	} else {
		$link = trailingslashit($link);
		$link .= "feed/$feed/";
	}

	/**
	 * Filter the search feed link.
	 *
	 * @since 2.5.0
	 *
	 * @param string $link Search feed link.
	 * @param string $feed Feed type.
	 * @param string $type The search type. One of 'posts' or 'comments'.
	 */
	return apply_filters( 'search_feed_link', $link, $feed, 'posts' );
}

/**
 * Retrieve the permalink for the comments feed of the search results.
 *
 * @since 2.5.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $search_query Optional. Search query.
 * @param string $feed         Optional. Feed type.
 * @return string The comments feed search results permalink.
 */
function get_search_comments_feed_link($search_query = '', $feed = '') {
	global $wp_rewrite;

	if ( empty($feed) )
		$feed = get_default_feed();

	$link = get_search_feed_link($search_query, $feed);

	$permastruct = $wp_rewrite->get_search_permastruct();

	if ( empty($permastruct) )
		$link = add_query_arg('feed', 'comments-' . $feed, $link);
	else
		$link = add_query_arg('withcomments', 1, $link);

	/** This filter is documented in wp-includes/link-template.php */
	return apply_filters( 'search_feed_link', $link, $feed, 'comments' );
}

/**
 * Retrieve the permalink for a post type archive.
 *
 * @since 3.1.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string $post_type Post type
 * @return string|false The post type archive permalink.
 */
function get_post_type_archive_link( $post_type ) {
	global $wp_rewrite;
	if ( ! $post_type_obj = get_post_type_object( $post_type ) )
		return false;

	if ( ! $post_type_obj->has_archive )
		return false;

	if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) ) {
		$struct = ( true === $post_type_obj->has_archive ) ? $post_type_obj->rewrite['slug'] : $post_type_obj->has_archive;
		if ( $post_type_obj->rewrite['with_front'] )
			$struct = $wp_rewrite->front . $struct;
		else
			$struct = $wp_rewrite->root . $struct;
		$link = home_url( user_trailingslashit( $struct, 'post_type_archive' ) );
	} else {
		$link = home_url( '?post_type=' . $post_type );
	}

	/**
	 * Filter the post type archive permalink.
	 *
	 * @since 3.1.0
	 *
	 * @param string $link      The post type archive permalink.
	 * @param string $post_type Post type name.
	 */
	return apply_filters( 'post_type_archive_link', $link, $post_type );
}

/**
 * Retrieve the permalink for a post type archive feed.
 *
 * @since 3.1.0
 *
 * @param string $post_type Post type
 * @param string $feed      Optional. Feed type
 * @return string|false The post type feed permalink.
 */
function get_post_type_archive_feed_link( $post_type, $feed = '' ) {
	$default_feed = get_default_feed();
	if ( empty( $feed ) )
		$feed = $default_feed;

	if ( ! $link = get_post_type_archive_link( $post_type ) )
		return false;

	$post_type_obj = get_post_type_object( $post_type );
	if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) && $post_type_obj->rewrite['feeds'] ) {
		$link = trailingslashit( $link );
		$link .= 'feed/';
		if ( $feed != $default_feed )
			$link .= "$feed/";
	} else {
		$link = add_query_arg( 'feed', $feed, $link );
	}

	/**
	 * Filter the post type archive feed link.
	 *
	 * @since 3.1.0
	 *
	 * @param string $link The post type archive feed link.
	 * @param string $feed Feed type.
	 */
	return apply_filters( 'post_type_archive_feed_link', $link, $feed );
}

/**
 * Retrieve edit posts link for post.
 *
 * Can be used within the WordPress loop or outside of it. Can be used with
 * pages, posts, attachments, and revisions.
 *
 * @since 2.3.0
 *
 * @param int    $id      Optional. Post ID.
 * @param string $context Optional, defaults to display. How to write the '&', defaults to '&amp;'.
 * @return string|void The edit post link for the given post.
 */
function get_edit_post_link( $id = 0, $context = 'display' ) {
	if ( ! $post = get_post( $id ) )
		return;

	if ( 'revision' === $post->post_type )
		$action = '';
	elseif ( 'display' == $context )
		$action = '&amp;action=edit';
	else
		$action = '&action=edit';

	$post_type_object = get_post_type_object( $post->post_type );
	if ( !$post_type_object )
		return;

	if ( !current_user_can( 'edit_post', $post->ID ) )
		return;

	/**
	 * Filter the post edit link.
	 *
	 * @since 2.3.0
	 *
	 * @param string $link    The edit link.
	 * @param int    $post_id Post ID.
	 * @param string $context The link context. If set to 'display' then ampersands
	 *                        are encoded.
	 */
	return apply_filters( 'get_edit_post_link', admin_url( sprintf( $post_type_object->_edit_link . $action, $post->ID ) ), $post->ID, $context );
}

/**
 * Display edit post link for post.
 *
 * @since 1.0.0
 *
 * @param string $text   Optional. Anchor text.
 * @param string $before Optional. Display before edit link.
 * @param string $after  Optional. Display after edit link.
 * @param int    $id     Optional. Post ID.
 */
function edit_post_link( $text = null, $before = '', $after = '', $id = 0 ) {
	if ( ! $post = get_post( $id ) ) {
		return;
	}

	if ( ! $url = get_edit_post_link( $post->ID ) ) {
		return;
	}

	if ( null === $text ) {
		$text = __( 'Edit This' );
	}

	$link = '<a class="post-edit-link" href="' . $url . '">' . $text . '</a>';

	/**
	 * Filter the post edit link anchor tag.
	 *
	 * @since 2.3.0
	 *
	 * @param string $link    Anchor tag for the edit link.
	 * @param int    $post_id Post ID.
	 * @param string $text    Anchor text.
	 */
	echo $before . apply_filters( 'edit_post_link', $link, $post->ID, $text ) . $after;
}

/**
 * Retrieve delete posts link for post.
 *
 * Can be used within the WordPress loop or outside of it, with any post type.
 *
 * @since 2.9.0
 *
 * @param int    $id           Optional. Post ID.
 * @param string $deprecated   Not used.
 * @param bool   $force_delete Whether to bypass trash and force deletion. Default is false.
 * @return string|void The delete post link URL for the given post.
 */
function get_delete_post_link( $id = 0, $deprecated = '', $force_delete = false ) {
	if ( ! empty( $deprecated ) )
		_deprecated_argument( __FUNCTION__, '3.0' );

	if ( !$post = get_post( $id ) )
		return;

	$post_type_object = get_post_type_object( $post->post_type );
	if ( !$post_type_object )
		return;

	if ( !current_user_can( 'delete_post', $post->ID ) )
		return;

	$action = ( $force_delete || !EMPTY_TRASH_DAYS ) ? 'delete' : 'trash';

	$delete_link = add_query_arg( 'action', $action, admin_url( sprintf( $post_type_object->_edit_link, $post->ID ) ) );

	/**
	 * Filter the post delete link.
	 *
	 * @since 2.9.0
	 *
	 * @param string $link         The delete link.
	 * @param int    $post_id      Post ID.
	 * @param bool   $force_delete Whether to bypass the trash and force deletion. Default false.
	 */
	return apply_filters( 'get_delete_post_link', wp_nonce_url( $delete_link, "$action-post_{$post->ID}" ), $post->ID, $force_delete );
}

/**
 * Retrieve edit comment link.
 *
 * @since 2.3.0
 *
 * @param int $comment_id Optional. Comment ID.
 * @return string|void The edit comment link URL for the given comment.
 */
function get_edit_comment_link( $comment_id = 0 ) {
	$comment = get_comment( $comment_id );

	if ( !current_user_can( 'edit_comment', $comment->comment_ID ) )
		return;

	$location = admin_url('comment.php?action=editcomment&amp;c=') . $comment->comment_ID;

	/**
	 * Filter the comment edit link.
	 *
	 * @since 2.3.0
	 *
	 * @param string $location The edit link.
	 */
	return apply_filters( 'get_edit_comment_link', $location );
}

/**
 * Display edit comment link with formatting.
 *
 * @since 1.0.0
 *
 * @global object $comment
 *
 * @param string $text   Optional. Anchor text.
 * @param string $before Optional. Display before edit link.
 * @param string $after  Optional. Display after edit link.
 */
function edit_comment_link( $text = null, $before = '', $after = '' ) {
	global $comment;

	if ( ! current_user_can( 'edit_comment', $comment->comment_ID ) ) {
		return;
	}

	if ( null === $text ) {
		$text = __( 'Edit This' );
	}

	$link = '<a class="comment-edit-link" href="' . get_edit_comment_link( $comment->comment_ID ) . '">' . $text . '</a>';

	/**
	 * Filter the comment edit link anchor tag.
	 *
	 * @since 2.3.0
	 *
	 * @param string $link       Anchor tag for the edit link.
	 * @param int    $comment_id Comment ID.
	 * @param string $text       Anchor text.
	 */
	echo $before . apply_filters( 'edit_comment_link', $link, $comment->comment_ID, $text ) . $after;
}

/**
 * Display edit bookmark (literally a URL external to blog) link.
 *
 * @since 2.7.0
 *
 * @param int|stdClass $link Optional. Bookmark ID.
 * @return string|void The edit bookmark link URL.
 */
function get_edit_bookmark_link( $link = 0 ) {
	$link = get_bookmark( $link );

	if ( !current_user_can('manage_links') )
		return;

	$location = admin_url('link.php?action=edit&amp;link_id=') . $link->link_id;

	/**
	 * Filter the bookmark (link) edit link.
	 *
	 * @since 2.7.0
	 *
	 * @param string $location The edit link.
	 * @param int    $link_id  Bookmark ID.
	 */
	return apply_filters( 'get_edit_bookmark_link', $location, $link->link_id );
}

/**
 * Display edit bookmark (literally a URL external to blog) link anchor content.
 *
 * @since 2.7.0
 *
 * @param string $link     Optional. Anchor text.
 * @param string $before   Optional. Display before edit link.
 * @param string $after    Optional. Display after edit link.
 * @param int    $bookmark Optional. Bookmark ID.
 */
function edit_bookmark_link( $link = '', $before = '', $after = '', $bookmark = null ) {
	$bookmark = get_bookmark($bookmark);

	if ( !current_user_can('manage_links') )
		return;

	if ( empty($link) )
		$link = __('Edit This');

	$link = '<a href="' . get_edit_bookmark_link( $bookmark ) . '">' . $link . '</a>';

	/**
	 * Filter the bookmark edit link anchor tag.
	 *
	 * @since 2.7.0
	 *
	 * @param string $link    Anchor tag for the edit link.
	 * @param int    $link_id Bookmark ID.
	 */
	echo $before . apply_filters( 'edit_bookmark_link', $link, $bookmark->link_id ) . $after;
}

/**
 * Retrieve edit user link
 *
 * @since 3.5.0
 *
 * @param int $user_id Optional. User ID. Defaults to the current user.
 * @return string URL to edit user page or empty string.
 */
function get_edit_user_link( $user_id = null ) {
	if ( ! $user_id )
		$user_id = get_current_user_id();

	if ( empty( $user_id ) || ! current_user_can( 'edit_user', $user_id ) )
		return '';

	$user = get_userdata( $user_id );

	if ( ! $user )
		return '';

	if ( get_current_user_id() == $user->ID )
		$link = get_edit_profile_url( $user->ID );
	else
		$link = add_query_arg( 'user_id', $user->ID, self_admin_url( 'user-edit.php' ) );

	/**
	 * Filter the user edit link.
	 *
	 * @since 3.5.0
	 *
	 * @param string $link    The edit link.
	 * @param int    $user_id User ID.
	 */
	return apply_filters( 'get_edit_user_link', $link, $user->ID );
}

// Navigation links

/**
 * Retrieve previous post that is adjacent to current post.
 *
 * @since 1.5.0
 *
 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return null|string|WP_Post Post object if successful. Null if global $post is not set. Empty string if no corresponding post exists.
 */
function get_previous_post( $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	return get_adjacent_post( $in_same_term, $excluded_terms, true, $taxonomy );
}

/**
 * Retrieve next post that is adjacent to current post.
 *
 * @since 1.5.0
 *
 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return null|string|WP_Post Post object if successful. Null if global $post is not set. Empty string if no corresponding post exists.
 */
function get_next_post( $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	return get_adjacent_post( $in_same_term, $excluded_terms, false, $taxonomy );
}

/**
 * Retrieve adjacent post.
 *
 * Can either be next or previous post.
 *
 * @since 2.5.0
 *
 * @global wpdb $wpdb
 *
 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param bool         $previous       Optional. Whether to retrieve previous post.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return null|string|WP_Post Post object if successful. Null if global $post is not set. Empty string if no corresponding post exists.
 */
function get_adjacent_post( $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {
	global $wpdb;

	if ( ( ! $post = get_post() ) || ! taxonomy_exists( $taxonomy ) )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$where = '';

	if ( $in_same_term || ! empty( $excluded_terms ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
		$where = $wpdb->prepare( "AND tt.taxonomy = %s", $taxonomy );

		if ( ! empty( $excluded_terms ) && ! is_array( $excluded_terms ) ) {
			// back-compat, $excluded_terms used to be $excluded_terms with IDs separated by " and "
			if ( false !== strpos( $excluded_terms, ' and ' ) ) {
				_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded terms.' ), "'and'" ) );
				$excluded_terms = explode( ' and ', $excluded_terms );
			} else {
				$excluded_terms = explode( ',', $excluded_terms );
			}

			$excluded_terms = array_map( 'intval', $excluded_terms );
		}

		if ( $in_same_term ) {
			if ( ! is_object_in_taxonomy( $post->post_type, $taxonomy ) )
				return '';
			$term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

			// Remove any exclusions from the term array to include.
			$term_array = array_diff( $term_array, (array) $excluded_terms );
			$term_array = array_map( 'intval', $term_array );

			if ( ! $term_array || is_wp_error( $term_array ) )
				return '';

			$where .= " AND tt.term_id IN (" . implode( ',', $term_array ) . ")";
		}

		if ( ! empty( $excluded_terms ) ) {
			$where .= " AND p.ID NOT IN ( SELECT tr.object_id FROM $wpdb->term_relationships tr LEFT JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) WHERE tt.term_id IN (" . implode( $excluded_terms, ',' ) . ') )';
		}
	}

	// 'post_status' clause depends on the current user.
	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();

		$post_type_object = get_post_type_object( $post->post_type );
		if ( empty( $post_type_object ) ) {
			$post_type_cap    = $post->post_type;
			$read_private_cap = 'read_private_' . $post_type_cap . 's';
		} else {
			$read_private_cap = $post_type_object->cap->read_private_posts;
		}

		/*
		 * Results should include private posts belonging to the current user, or private posts where the
		 * current user has the 'read_private_posts' cap.
		 */
		$private_states = get_post_stati( array( 'private' => true ) );
		$where .= " AND ( p.post_status = 'publish'";
		foreach ( (array) $private_states as $state ) {
			if ( current_user_can( $read_private_cap ) ) {
				$where .= $wpdb->prepare( " OR p.post_status = %s", $state );
			} else {
				$where .= $wpdb->prepare( " OR (p.post_author = %d AND p.post_status = %s)", $user_id, $state );
			}
		}
		$where .= " )";
	} else {
		$where .= " AND p.post_status = 'publish'";
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	/**
	 * Filter the JOIN clause in the SQL for an adjacent post query.
	 *
	 * The dynamic portion of the hook name, `$adjacent`, refers to the type
	 * of adjacency, 'next' or 'previous'.
	 *
	 * @since 2.5.0
	 *
	 * @param string $join           The JOIN clause in the SQL.
	 * @param bool   $in_same_term   Whether post should be in a same taxonomy term.
	 * @param array  $excluded_terms Array of excluded term IDs.
	 */
	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_term, $excluded_terms );

	/**
	 * Filter the WHERE clause in the SQL for an adjacent post query.
	 *
	 * The dynamic portion of the hook name, `$adjacent`, refers to the type
	 * of adjacency, 'next' or 'previous'.
	 *
	 * @since 2.5.0
	 *
	 * @param string $where          The `WHERE` clause in the SQL.
	 * @param bool   $in_same_term   Whether post should be in a same taxonomy term.
	 * @param array  $excluded_terms Array of excluded term IDs.
	 */
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare( "WHERE p.post_date $op %s AND p.post_type = %s $where", $current_post_date, $post->post_type ), $in_same_term, $excluded_terms );

	/**
	 * Filter the ORDER BY clause in the SQL for an adjacent post query.
	 *
	 * The dynamic portion of the hook name, `$adjacent`, refers to the type
	 * of adjacency, 'next' or 'previous'.
	 *
	 * @since 2.5.0
	 *
	 * @param string $order_by The `ORDER BY` clause in the SQL.
	 */
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.ID FROM $wpdb->posts AS p $join $where $sort";
	$query_key = 'adjacent_post_' . md5( $query );
	$result = wp_cache_get( $query_key, 'counts' );
	if ( false !== $result ) {
		if ( $result )
			$result = get_post( $result );
		return $result;
	}

	$result = $wpdb->get_var( $query );
	if ( null === $result )
		$result = '';

	wp_cache_set( $query_key, $result, 'counts' );

	if ( $result )
		$result = get_post( $result );

	return $result;
}

/**
 * Get adjacent post relational link.
 *
 * Can either be next or previous post relational link.
 *
 * @since 2.8.0
 *
 * @param string       $title          Optional. Link title format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param bool         $previous       Optional. Whether to display link to previous or next post. Default true.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return string|void The adjacent post relational link URL.
 */
function get_adjacent_post_rel_link( $title = '%title', $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {
	if ( $previous && is_attachment() && $post = get_post() )
		$post = get_post( $post->post_parent );
	else
		$post = get_adjacent_post( $in_same_term, $excluded_terms, $previous, $taxonomy );

	if ( empty( $post ) )
		return;

	$post_title = the_title_attribute( array( 'echo' => false, 'post' => $post ) );

	if ( empty( $post_title ) )
		$post_title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );

	$date = mysql2date( get_option( 'date_format' ), $post->post_date );

	$title = str_replace( '%title', $post_title, $title );
	$title = str_replace( '%date', $date, $title );

	$link = $previous ? "<link rel='prev' title='" : "<link rel='next' title='";
	$link .= esc_attr( $title );
	$link .= "' href='" . get_permalink( $post ) . "' />\n";

	$adjacent = $previous ? 'previous' : 'next';

	/**
	 * Filter the adjacent post relational link.
	 *
	 * The dynamic portion of the hook name, `$adjacent`, refers to the type
	 * of adjacency, 'next' or 'previous'.
	 *
	 * @since 2.8.0
	 *
	 * @param string $link The relational link.
	 */
	return apply_filters( "{$adjacent}_post_rel_link", $link );
}

/**
 * Display relational links for the posts adjacent to the current post.
 *
 * @since 2.8.0
 *
 * @param string       $title          Optional. Link title format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function adjacent_posts_rel_link( $title = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	echo get_adjacent_post_rel_link( $title, $in_same_term, $excluded_terms, true, $taxonomy );
	echo get_adjacent_post_rel_link( $title, $in_same_term, $excluded_terms, false, $taxonomy );
}

/**
 * Display relational links for the posts adjacent to the current post for single post pages.
 *
 * This is meant to be attached to actions like 'wp_head'. Do not call this directly in plugins or theme templates.
 * @since 3.0.0
 *
 */
function adjacent_posts_rel_link_wp_head() {
	if ( ! is_single() || is_attachment() ) {
		return;
	}
	adjacent_posts_rel_link();
}

/**
 * Display relational link for the next post adjacent to the current post.
 *
 * @since 2.8.0
 *
 * @param string       $title          Optional. Link title format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function next_post_rel_link( $title = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	echo get_adjacent_post_rel_link( $title, $in_same_term, $excluded_terms, false, $taxonomy );
}

/**
 * Display relational link for the previous post adjacent to the current post.
 *
 * @since 2.8.0
 *
 * @param string       $title          Optional. Link title format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs. Default true.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function prev_post_rel_link( $title = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	echo get_adjacent_post_rel_link( $title, $in_same_term, $excluded_terms, true, $taxonomy );
}

/**
 * Retrieve boundary post.
 *
 * Boundary being either the first or last post by publish date within the constraints specified
 * by $in_same_term or $excluded_terms.
 *
 * @since 2.8.0
 *
 * @param bool         $in_same_term   Optional. Whether returned post should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param bool         $start          Optional. Whether to retrieve first or last post.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return null|array Array containing the boundary post object if successful, null otherwise.
 */
function get_boundary_post( $in_same_term = false, $excluded_terms = '', $start = true, $taxonomy = 'category' ) {
	$post = get_post();
	if ( ! $post || ! is_single() || is_attachment() || ! taxonomy_exists( $taxonomy ) )
		return null;

	$query_args = array(
		'posts_per_page' => 1,
		'order' => $start ? 'ASC' : 'DESC',
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false
	);

	$term_array = array();

	if ( ! is_array( $excluded_terms ) ) {
		if ( ! empty( $excluded_terms ) )
			$excluded_terms = explode( ',', $excluded_terms );
		else
			$excluded_terms = array();
	}

	if ( $in_same_term || ! empty( $excluded_terms ) ) {
		if ( $in_same_term )
			$term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

		if ( ! empty( $excluded_terms ) ) {
			$excluded_terms = array_map( 'intval', $excluded_terms );
			$excluded_terms = array_diff( $excluded_terms, $term_array );

			$inverse_terms = array();
			foreach ( $excluded_terms as $excluded_term )
				$inverse_terms[] = $excluded_term * -1;
			$excluded_terms = $inverse_terms;
		}

		$query_args[ 'tax_query' ] = array( array(
			'taxonomy' => $taxonomy,
			'terms' => array_merge( $term_array, $excluded_terms )
		) );
	}

	return get_posts( $query_args );
}

/*
 * Get previous post link that is adjacent to the current post.
 *
 * @since 3.7.0
 *
 * @param string       $format         Optional. Link anchor format.
 * @param string       $link           Optional. Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return string The link URL of the previous post in relation to the current post.
 */
function get_previous_post_link( $format = '&laquo; %link', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	return get_adjacent_post_link( $format, $link, $in_same_term, $excluded_terms, true, $taxonomy );
}

/**
 * Display previous post link that is adjacent to the current post.
 *
 * @since 1.5.0
 * @see get_previous_post_link()
 *
 * @param string       $format         Optional. Link anchor format.
 * @param string       $link           Optional. Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function previous_post_link( $format = '&laquo; %link', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	echo get_previous_post_link( $format, $link, $in_same_term, $excluded_terms, $taxonomy );
}

/**
 * Get next post link that is adjacent to the current post.
 *
 * @since 3.7.0
 *
 * @param string       $format         Optional. Link anchor format.
 * @param string       $link           Optional. Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return string The link URL of the next post in relation to the current post.
 */
function get_next_post_link( $format = '%link &raquo;', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	return get_adjacent_post_link( $format, $link, $in_same_term, $excluded_terms, false, $taxonomy );
}

/**
 * Display next post link that is adjacent to the current post.
 *
 * @since 1.5.0
 * @see get_next_post_link()
 *
 * @param string       $format         Optional. Link anchor format.
 * @param string       $link           Optional. Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function next_post_link( $format = '%link &raquo;', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {
	 echo get_next_post_link( $format, $link, $in_same_term, $excluded_terms, $taxonomy );
}

/**
 * Get adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * @since 3.7.0
 *
 * @param string       $format         Link anchor format.
 * @param string       $link           Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded terms IDs.
 * @param bool         $previous       Optional. Whether to display link to previous or next post. Default true.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return string The link URL of the previous or next post in relation to the current post.
 */
function get_adjacent_post_link( $format, $link, $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {
	if ( $previous && is_attachment() )
		$post = get_post( get_post()->post_parent );
	else
		$post = get_adjacent_post( $in_same_term, $excluded_terms, $previous, $taxonomy );

	if ( ! $post ) {
		$output = '';
	} else {
		$title = $post->post_title;

		if ( empty( $post->post_title ) )
			$title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $title, $post->ID );

		$date = mysql2date( get_option( 'date_format' ), $post->post_date );
		$rel = $previous ? 'prev' : 'next';

		$string = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'">';
		$inlink = str_replace( '%title', $title, $link );
		$inlink = str_replace( '%date', $date, $inlink );
		$inlink = $string . $inlink . '</a>';

		$output = str_replace( '%link', $inlink, $format );
	}

	$adjacent = $previous ? 'previous' : 'next';

	/**
	 * Filter the adjacent post link.
	 *
	 * The dynamic portion of the hook name, `$adjacent`, refers to the type
	 * of adjacency, 'next' or 'previous'.
	 *
	 * @since 2.6.0
	 * @since 4.2.0 Added the `$adjacent` parameter.
	 *
	 * @param string  $output   The adjacent post link.
	 * @param string  $format   Link anchor format.
	 * @param string  $link     Link permalink format.
	 * @param WP_Post $post     The adjacent post.
	 * @param string  $adjacent Whether the post is previous or next.
	 */
	return apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post, $adjacent );
}

/**
 * Display adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * @since 2.5.0
 *
 * @param string       $format         Link anchor format.
 * @param string       $link           Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded category IDs.
 * @param bool         $previous       Optional. Whether to display link to previous or next post. Default true.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 */
function adjacent_post_link( $format, $link, $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {
	echo get_adjacent_post_link( $format, $link, $in_same_term, $excluded_terms, $previous, $taxonomy );
}

/**
 * Retrieve links for page numbers.
 *
 * @since 1.5.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int  $pagenum Optional. Page ID.
 * @param bool $escape  Optional. Whether to escape the URL for display, with esc_url(). Defaults to true.
* 	                    Otherwise, prepares the URL with esc_url_raw().
 * @return string The link URL for the given page number.
 */
function get_pagenum_link($pagenum = 1, $escape = true ) {
	global $wp_rewrite;

	$pagenum = (int) $pagenum;

	$request = remove_query_arg( 'paged' );

	$home_root = parse_url(home_url());
	$home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
	$home_root = preg_quote( $home_root, '|' );

	$request = preg_replace('|^'. $home_root . '|i', '', $request);
	$request = preg_replace('|^/+|', '', $request);

	if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
		$base = trailingslashit( get_bloginfo( 'url' ) );

		if ( $pagenum > 1 ) {
			$result = add_query_arg( 'paged', $pagenum, $base . $request );
		} else {
			$result = $base . $request;
		}
	} else {
		$qs_regex = '|\?.*?$|';
		preg_match( $qs_regex, $request, $qs_match );

		if ( !empty( $qs_match[0] ) ) {
			$query_string = $qs_match[0];
			$request = preg_replace( $qs_regex, '', $request );
		} else {
			$query_string = '';
		}

		$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
		$request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
		$request = ltrim($request, '/');

		$base = trailingslashit( get_bloginfo( 'url' ) );

		if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
			$base .= $wp_rewrite->index . '/';

		if ( $pagenum > 1 ) {
			$request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
		}

		$result = $base . $request . $query_string;
	}

	/**
	 * Filter the page number link for the current request.
	 *
	 * @since 2.5.0
	 *
	 * @param string $result The page number link.
	 */
	$result = apply_filters( 'get_pagenum_link', $result );

	if ( $escape )
		return esc_url( $result );
	else
		return esc_url_raw( $result );
}

/**
 * Retrieve next posts page link.
 *
 * Backported from 2.1.3 to 2.0.10.
 *
 * @since 2.0.10
 *
 * @global int $paged
 *
 * @param int $max_page Optional. Max pages.
 * @return string|void The link URL for next posts page.
 */
function get_next_posts_page_link($max_page = 0) {
	global $paged;

	if ( !is_single() ) {
		if ( !$paged )
			$paged = 1;
		$nextpage = intval($paged) + 1;
		if ( !$max_page || $max_page >= $nextpage )
			return get_pagenum_link($nextpage);
	}
}

/**
 * Display or return the next posts page link.
 *
 * @since 0.71
 *
 * @param int   $max_page Optional. Max pages.
 * @param bool  $echo     Optional. Echo or return;
 * @return string|void The link URL for next posts page if `$echo = false`.
 */
function next_posts( $max_page = 0, $echo = true ) {
	$output = esc_url( get_next_posts_page_link( $max_page ) );

	if ( $echo )
		echo $output;
	else
		return $output;
}

/**
 * Return the next posts page link.
 *
 * @since 2.7.0
 *
 * @global int      $paged
 * @global WP_Query $wp_query
 *
 * @param string $label    Content for link text.
 * @param int    $max_page Optional. Max pages.
 * @return string|void HTML-formatted next posts page link.
 */
function get_next_posts_link( $label = null, $max_page = 0 ) {
	global $paged, $wp_query;

	if ( !$max_page )
		$max_page = $wp_query->max_num_pages;

	if ( !$paged )
		$paged = 1;

	$nextpage = intval($paged) + 1;

	if ( null === $label )
		$label = __( 'Next Page &raquo;' );

	if ( !is_single() && ( $nextpage <= $max_page ) ) {
		/**
		 * Filter the anchor tag attributes for the next posts page link.
		 *
		 * @since 2.7.0
		 *
		 * @param string $attributes Attributes for the anchor tag.
		 */
		$attr = apply_filters( 'next_posts_link_attributes', '' );

		return '<a href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a>';
	}
}

/**
 * Display the next posts page link.
 *
 * @since 0.71
 *
 * @param string $label    Content for link text.
 * @param int    $max_page Optional. Max pages.
 */
function next_posts_link( $label = null, $max_page = 0 ) {
	echo get_next_posts_link( $label, $max_page );
}

/**
 * Retrieve previous posts page link.
 *
 * Will only return string, if not on a single page or post.
 *
 * Backported to 2.0.10 from 2.1.3.
 *
 * @since 2.0.10
 *
 * @global int $paged
 *
 * @return string|void The link for the previous posts page.
 */
function get_previous_posts_page_link() {
	global $paged;

	if ( !is_single() ) {
		$nextpage = intval($paged) - 1;
		if ( $nextpage < 1 )
			$nextpage = 1;
		return get_pagenum_link($nextpage);
	}
}

/**
 * Display or return the previous posts page link.
 *
 * @since 0.71
 *
 * @param bool $echo Optional. Echo or return;
 * @return string|void The previous posts page link if `$echo = false`.
 */
function previous_posts( $echo = true ) {
	$output = esc_url( get_previous_posts_page_link() );

	if ( $echo )
		echo $output;
	else
		return $output;
}

/**
 * Return the previous posts page link.
 *
 * @since 2.7.0
 *
 * @global int $paged
 *
 * @param string $label Optional. Previous page link text.
 * @return string|void HTML-formatted previous page link.
 */
function get_previous_posts_link( $label = null ) {
	global $paged;

	if ( null === $label )
		$label = __( '&laquo; Previous Page' );

	if ( !is_single() && $paged > 1 ) {
		/**
		 * Filter the anchor tag attributes for the previous posts page link.
		 *
		 * @since 2.7.0
		 *
		 * @param string $attributes Attributes for the anchor tag.
		 */
		$attr = apply_filters( 'previous_posts_link_attributes', '' );
		return '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) .'</a>';
	}
}

/**
 * Display the previous posts page link.
 *
 * @since 0.71
 *
 * @param string $label Optional. Previous page link text.
 */
function previous_posts_link( $label = null ) {
	echo get_previous_posts_link( $label );
}

/**
 * Return post pages link navigation for previous and next pages.
 *
 * @since 2.8.0
 *
 * @global WP_Query $wp_query
 *
 * @param string|array $args Optional args.
 * @return string The posts link navigation.
 */
function get_posts_nav_link( $args = array() ) {
	global $wp_query;

	$return = '';

	if ( !is_singular() ) {
		$defaults = array(
			'sep' => ' &#8212; ',
			'prelabel' => __('&laquo; Previous Page'),
			'nxtlabel' => __('Next Page &raquo;'),
		);
		$args = wp_parse_args( $args, $defaults );

		$max_num_pages = $wp_query->max_num_pages;
		$paged = get_query_var('paged');

		//only have sep if there's both prev and next results
		if ($paged < 2 || $paged >= $max_num_pages) {
			$args['sep'] = '';
		}

		if ( $max_num_pages > 1 ) {
			$return = get_previous_posts_link($args['prelabel']);
			$return .= preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $args['sep']);
			$return .= get_next_posts_link($args['nxtlabel']);
		}
	}
	return $return;

}

/**
 * Display post pages link navigation for previous and next pages.
 *
 * @since 0.71
 *
 * @param string $sep      Optional. Separator for posts navigation links.
 * @param string $prelabel Optional. Label for previous pages.
 * @param string $nxtlabel Optional Label for next pages.
 */
function posts_nav_link( $sep = '', $prelabel = '', $nxtlabel = '' ) {
	$args = array_filter( compact('sep', 'prelabel', 'nxtlabel') );
	echo get_posts_nav_link($args);
}

/**
 * Return navigation to next/previous post when applicable.
 *
 * @since 4.1.0
 *
 * @param array $args {
 *     Optional. Default post navigation arguments. Default empty array.
 *
 *     @type string $prev_text          Anchor text to display in the previous post link. Default `%title`.
 *     @type string $next_text          Anchor text to display in the next post link. Default `%title`.
 *     @type string $screen_reader_text Screen reader text for nav element. Default 'Post navigation'.
 * }
 * @return string Markup for post links.
 */
function get_the_post_navigation( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'prev_text'          => '%title',
		'next_text'          => '%title',
		'screen_reader_text' => __( 'Post navigation' ),
	) );

	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', $args['prev_text'] );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', $args['next_text'] );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'post-navigation', $args['screen_reader_text'] );
	}

	return $navigation;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 4.1.0
 *
 * @param array $args Optional. See {@see get_the_post_navigation()} for available
 *                    arguments. Default empty array.
 */
function the_post_navigation( $args = array() ) {
	echo get_the_post_navigation( $args );
}

/**
 * Return navigation to next/previous set of posts when applicable.
 *
 * @since 4.1.0
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param array $args {
 *     Optional. Default posts navigation arguments. Default empty array.
 *
 *     @type string $prev_text          Anchor text to display in the previous posts link.
 *                                      Default 'Older posts'.
 *     @type string $next_text          Anchor text to display in the next posts link.
 *                                      Default 'Newer posts'.
 *     @type string $screen_reader_text Screen reader text for nav element.
 *                                      Default 'Posts navigation'.
 * }
 * @return string Markup for posts links.
 */
function get_the_posts_navigation( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		$args = wp_parse_args( $args, array(
			'prev_text'          => __( 'Older posts' ),
			'next_text'          => __( 'Newer posts' ),
			'screen_reader_text' => __( 'Posts navigation' ),
		) );

		$next_link = get_previous_posts_link( $args['next_text'] );
		$prev_link = get_next_posts_link( $args['prev_text'] );

		if ( $prev_link ) {
			$navigation .= '<div class="nav-previous">' . $prev_link . '</div>';
		}

		if ( $next_link ) {
			$navigation .= '<div class="nav-next">' . $next_link . '</div>';
		}

		$navigation = _navigation_markup( $navigation, 'posts-navigation', $args['screen_reader_text'] );
	}

	return $navigation;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 4.1.0
 *
 * @param array $args Optional. See {@see get_the_posts_navigation()} for available
 *                    arguments. Default empty array.
 */
function the_posts_navigation( $args = array() ) {
	echo get_the_posts_navigation( $args );
}

/**
 * Return a paginated navigation to next/previous set of posts,
 * when applicable.
 *
 * @since 4.1.0
 *
 * @param array $args {
 *     Optional. Default pagination arguments, {@see paginate_links()}.
 *
 *     @type string $screen_reader_text Screen reader text for navigation element.
 *                                      Default 'Posts navigation'.
 * }
 * @return string Markup for pagination links.
 */
function get_the_posts_pagination( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		$args = wp_parse_args( $args, array(
			'mid_size'           => 1,
			'prev_text'          => _x( 'Previous', 'previous post' ),
			'next_text'          => _x( 'Next', 'next post' ),
			'screen_reader_text' => __( 'Posts navigation' ),
		) );

		// Make sure we get a string back. Plain is the next best thing.
		if ( isset( $args['type'] ) && 'array' == $args['type'] ) {
			$args['type'] = 'plain';
		}

		// Set up paginated links.
		$links = paginate_links( $args );

		if ( $links ) {
			$navigation = _navigation_markup( $links, 'pagination', $args['screen_reader_text'] );
		}
	}

	return $navigation;
}

/**
 * Display a paginated navigation to next/previous set of posts,
 * when applicable.
 *
 * @since 4.1.0
 *
 * @param array $args Optional. See {@see get_the_posts_pagination()} for available arguments.
 *                    Default empty array.
 */
function the_posts_pagination( $args = array() ) {
	echo get_the_posts_pagination( $args );
}

/**
 * Wraps passed links in navigational markup.
 *
 * @since 4.1.0
 * @access private
 *
 * @param string $links              Navigational links.
 * @param string $class              Optional. Custom class for nav element. Default: 'posts-navigation'.
 * @param string $screen_reader_text Optional. Screen reader text for nav element. Default: 'Posts navigation'.
 * @return string Navigation template tag.
 */
function _navigation_markup( $links, $class = 'posts-navigation', $screen_reader_text = '' ) {
	if ( empty( $screen_reader_text ) ) {
		$screen_reader_text = __( 'Posts navigation' );
	}

	$template = '
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>';

	return sprintf( $template, sanitize_html_class( $class ), esc_html( $screen_reader_text ), $links );
}

/**
 * Retrieve comments page number link.
 *
 * @since 2.7.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int $pagenum  Optional. Page number.
 * @param int $max_page Optional. The maximum number of comment pages.
 * @return string The comments page number link URL.
 */
function get_comments_pagenum_link( $pagenum = 1, $max_page = 0 ) {
	global $wp_rewrite;

	$pagenum = (int) $pagenum;

	$result = get_permalink();

	if ( 'newest' == get_option('default_comments_page') ) {
		if ( $pagenum != $max_page ) {
			if ( $wp_rewrite->using_permalinks() )
				$result = user_trailingslashit( trailingslashit($result) . $wp_rewrite->comments_pagination_base . '-' . $pagenum, 'commentpaged');
			else
				$result = add_query_arg( 'cpage', $pagenum, $result );
		}
	} elseif ( $pagenum > 1 ) {
		if ( $wp_rewrite->using_permalinks() )
			$result = user_trailingslashit( trailingslashit($result) . $wp_rewrite->comments_pagination_base . '-' . $pagenum, 'commentpaged');
		else
			$result = add_query_arg( 'cpage', $pagenum, $result );
	}

	$result .= '#comments';

	/**
	 * Filter the comments page number link for the current request.
	 *
	 * @since 2.7.0
	 *
	 * @param string $result The comments page number link.
	 */
	return apply_filters( 'get_comments_pagenum_link', $result );
}

/**
 * Return the link to next comments page.
 *
 * @since 2.7.1
 *
 * @global WP_Query $wp_query
 *
 * @param string $label    Optional. Label for link text.
 * @param int    $max_page Optional. Max page.
 * @return string|void HTML-formatted link for the next page of comments.
 */
function get_next_comments_link( $label = '', $max_page = 0 ) {
	global $wp_query;

	if ( !is_singular() || !get_option('page_comments') )
		return;

	$page = get_query_var('cpage');

	if ( ! $page ) {
		$page = 1;
	}

	$nextpage = intval($page) + 1;

	if ( empty($max_page) )
		$max_page = $wp_query->max_num_comment_pages;

	if ( empty($max_page) )
		$max_page = get_comment_pages_count();

	if ( $nextpage > $max_page )
		return;

	if ( empty($label) )
		$label = __('Newer Comments &raquo;');

	/**
	 * Filter the anchor tag attributes for the next comments page link.
	 *
	 * @since 2.7.0
	 *
	 * @param string $attributes Attributes for the anchor tag.
	 */
	return '<a href="' . esc_url( get_comments_pagenum_link( $nextpage, $max_page ) ) . '" ' . apply_filters( 'next_comments_link_attributes', '' ) . '>'. preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) .'</a>';
}

/**
 * Display the link to next comments page.
 *
 * @since 2.7.0
 *
 * @param string $label    Optional. Label for link text.
 * @param int    $max_page Optional. Max page.
 */
function next_comments_link( $label = '', $max_page = 0 ) {
	echo get_next_comments_link( $label, $max_page );
}

/**
 * Return the previous comments page link.
 *
 * @since 2.7.1
 *
 * @param string $label Optional. Label for comments link text.
 * @return string|void HTML-formatted link for the previous page of comments.
 */
function get_previous_comments_link( $label = '' ) {
	if ( !is_singular() || !get_option('page_comments') )
		return;

	$page = get_query_var('cpage');

	if ( intval($page) <= 1 )
		return;

	$prevpage = intval($page) - 1;

	if ( empty($label) )
		$label = __('&laquo; Older Comments');

	/**
	 * Filter the anchor tag attributes for the previous comments page link.
	 *
	 * @since 2.7.0
	 *
	 * @param string $attributes Attributes for the anchor tag.
	 */
	return '<a href="' . esc_url( get_comments_pagenum_link( $prevpage ) ) . '" ' . apply_filters( 'previous_comments_link_attributes', '' ) . '>' . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) .'</a>';
}

/**
 * Display the previous comments page link.
 *
 * @since 2.7.0
 *
 * @param string $label Optional. Label for comments link text.
 */
function previous_comments_link( $label = '' ) {
	echo get_previous_comments_link( $label );
}

/**
 * Create pagination links for the comments on the current post.
 *
 * @see paginate_links()
 * @since 2.7.0
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string|array $args Optional args. See paginate_links().
 * @return string|void Markup for pagination links.
*/
function paginate_comments_links($args = array()) {
	global $wp_rewrite;

	if ( !is_singular() || !get_option('page_comments') )
		return;

	$page = get_query_var('cpage');
	if ( !$page )
		$page = 1;
	$max_page = get_comment_pages_count();
	$defaults = array(
		'base' => add_query_arg( 'cpage', '%#%' ),
		'format' => '',
		'total' => $max_page,
		'current' => $page,
		'echo' => true,
		'add_fragment' => '#comments'
	);
	if ( $wp_rewrite->using_permalinks() )
		$defaults['base'] = user_trailingslashit(trailingslashit(get_permalink()) . $wp_rewrite->comments_pagination_base . '-%#%', 'commentpaged');

	$args = wp_parse_args( $args, $defaults );
	$page_links = paginate_links( $args );

	if ( $args['echo'] )
		echo $page_links;
	else
		return $page_links;
}

/**
 * Retrieve the Press This bookmarklet link.
 *
 * Use this in 'a' element 'href' attribute.
 *
 * @since 2.6.0
 *
 * @global bool          $is_IE
 * @global string        $wp_version
 * @global WP_Press_This $wp_press_this
 *
 * @return string The Press This bookmarklet link URL.
 */
function get_shortcut_link() {
	global $is_IE, $wp_version;

	include_once( ABSPATH . 'wp-admin/includes/class-wp-press-this.php' );
	$bookmarklet_version = $GLOBALS['wp_press_this']->version;
	$link = '';

	if ( $is_IE ) {
		/**
		 * Return the old/shorter bookmarklet code for MSIE 8 and lower,
		 * since they only support a max length of ~2000 characters for
		 * bookmark[let] URLs, which is way to small for our smarter one.
		 * Do update the version number so users do not get the "upgrade your
		 * bookmarklet" notice when using PT in those browsers.
		 */
		$ua = $_SERVER['HTTP_USER_AGENT'];

		if ( ! empty( $ua ) && preg_match( '/\bMSIE (\d)/', $ua, $matches ) && (int) $matches[1] <= 8 ) {
			$url = wp_json_encode( admin_url( 'press-this.php' ) );

			$link = 'javascript:var d=document,w=window,e=w.getSelection,k=d.getSelection,x=d.selection,' .
				's=(e?e():(k)?k():(x?x.createRange().text:0)),f=' . $url . ',l=d.location,e=encodeURIComponent,' .
				'u=f+"?u="+e(l.href)+"&t="+e(d.title)+"&s="+e(s)+"&v=' . $bookmarklet_version . '";' .
				
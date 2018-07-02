<?php
/**
 * Custome Function for theme template
 * 
 * 
 */

register_nav_menus( array(
	'footer_menu' => 'Custom Footer Menu',
	) );

function wimpie_lite_web_layout($classes){
	if(get_theme_mod('wimpie_lite_webpage_layout') == 'boxed'){
		$classes[]= 'boxed-layout';
	}
	elseif(get_theme_mod('wimpie_lite_webpage_layout') == 'fullwidth'){
		$classes[]='fullwidth';
	}
	
	return $classes;
}
add_filter( 'body_class', 'wimpie_lite_web_layout' );

function wimpie_lite_sidebar_layout($classes){
	global $post;
	if( is_404()){
		$classes[] = ' ';
	}elseif(is_singular()){
		$post_class = get_post_meta( $post -> ID, 'wimpie_lite_sidebar_layout', true );
		if(empty($post_class)){
			$post_class = 'right-sidebar';
			$classes[] = $post_class;}
			else{
				$post_class = get_post_meta( $post -> ID, 'wimpie_lite_sidebar_layout', true );
				$classes[] = $post_class;}
			}else{
				$classes[] = 'right-sidebar';	
			}
			return $classes;
		}
		add_filter('body_class', 'wimpie_lite_sidebar_layout');

		
		function wimpie_lite_bxslidercb(){
			$wimpie_slider_category = get_theme_mod('wimpie_lite_slider_setting_category');
			$wimpie_show_pager = (!get_theme_mod('wimpie_lite_slider_show_pager') || get_theme_mod('wimpie_lite_slider_show_pager') == "yes") ? "true" : "false";
			$wimpie_show_controls = (!get_theme_mod('wimpie_lite_slider_show_controls') || get_theme_mod('wimpie_lite_slider_show_controls') == "yes") ? "true" : "false";
			$wimpie_auto_transition = "true";
			if(get_theme_mod('wimpie_lite_slider_show_transitions') &&
				get_theme_mod('wimpie_lite_slider_show_transitions')=='no')
			{
				$wimpie_auto_transition = "false";
			}
			$wimpie_slider_transition = (get_theme_mod('wimpie_lite_slider_transitions_type')) ? get_theme_mod('wimpie_lite_slider_transitions_type') :"fade" ;
			$wimpie_slider_speed = (!get_theme_mod('wimpie_lite_slider_speed')) ? "2000" : get_theme_mod('wimpie_lite_slider_speed');
			$wimpie_slider_pause = (!get_theme_mod('wimpie_lite_slider_pause')) ? "2000" : get_theme_mod('wimpie_lite_slider_pause');
			$wimpie_show_caption = get_theme_mod('wimpie_lite_slider_show_caption');       
			?>
			<div id="main-slider" class="slider">
				<script type="text/javascript">
					jQuery(function($){
						$('#main-slider .bx-slider').bxSlider({
							pager: <?php echo esc_attr($wimpie_show_pager); ?>,
							controls: <?php echo esc_attr($wimpie_show_controls); ?>,
							mode: '<?php echo esc_attr($wimpie_slider_transition); ?>',
							auto : <?php echo esc_attr($wimpie_auto_transition); ?>,
							speed: <?php echo esc_attr($wimpie_slider_speed); ?>,
							pause: <?php echo esc_attr($wimpie_slider_pause); ?>,
							//adaptiveHeight: true,
						});
					});
				</script>
				<?php
				if( !empty($wimpie_slider_category)) :

					$loop = new WP_Query(array(
						'cat' => $wimpie_slider_category,
						'posts_per_page' => -1    
						));
						?>
						<div class="bx-slider">
							<?php
							if($loop->have_posts()) : 
								while($loop->have_posts()) : $loop-> the_post();
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
							
							?>
							<div class="slides">
								<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" />
								<?php if($wimpie_show_caption == 'yes'): ?>
									<div class="caption-wrapper">  
										<div class="ed-container">
											<div class="slider-caption">
												<div class="mid-content">
													<div class="small-caption"> <?php the_title(); ?> </div>
													<div class="slider-content">
														<?php the_content(); 
														?>
													</div>
													<a href="<?php the_permalink(); ?>" class="slider-btn"> <?php echo esc_attr(get_theme_mod('wimpie_lite_slider_button_text')); ?> </a>
												</div>
											</div>
										</div>
									</div>
								<?php  endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
					
				<?php endif; ?>		
			<?php  endif; ?>
		</div>
		<?php
	}
	add_action('wimpie_bxslider','wimpie_lite_bxslidercb', 10);

	function wimpie_lite_social_cb(){
		$facebooklink = get_theme_mod('wimpie_lite_social_facebook');
		$twitterlink = get_theme_mod('wimpie_lite_social_twitter');
		$google_pluslink = get_theme_mod('wimpie_lite_social_googleplus');
		$youtubelink = get_theme_mod('wimpie_lite_social_youtube');
		$pinterestlink = get_theme_mod('wimpie_lite_social_pinterest');
		$linkedinlink = get_theme_mod('wimpie_lite_social_linkedin');
		$instagramlink = get_theme_mod('wimpie_lite_social_instagram');
		?>
		<div class="social-icons ">
			<?php if(!empty($facebooklink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_facebook')); ?>" class="facebook" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($twitterlink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_twitter')); ?>" class="twitter" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($google_pluslink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_googleplus')); ?>" class="gplus" data-title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($youtubelink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_youtube')); ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($pinterestlink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_pinterest')); ?>" class="pinterest" data-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($linkedinlink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_linkedin')); ?>" class="linkedin" data-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i><span></span></a>
			<?php } ?>

			<?php if(!empty($instagramlink)){ ?>
			<a href="<?php echo esc_url(get_theme_mod('wimpie_lite_social_instagram')); ?>" class="instagram" data-title="instagram" target="_blank"><i class="fa fa-instagram"></i><span></span></a>
			<?php } ?>
		</div>
		<?php
	}
	add_action('wimpie_social','wimpie_lite_social_cb', 10);

	function wimpie_lite_excerpt( $wimpie_content , $wimpie_letter_count){
		$wimpie_letter_count = !empty($wimpie_letter_count) ? $wimpie_letter_count : 100 ;
		$wimpie_striped_content = strip_tags($wimpie_content);
		$wimpie_lite_excerpt = mb_substr($wimpie_striped_content, 0 , $wimpie_letter_count);
		if(strlen($wimpie_striped_content) > strlen($wimpie_lite_excerpt)){
			$wimpie_lite_excerpt.= "...";
		}
		return $wimpie_lite_excerpt;
	}

	//Dynamic styles on header
	function wimpie_lite_header_styles_scripts(){
		$favicon = get_theme_mod('wimpie_lite_favicon_upload');
		$cta_bg_v = get_theme_mod('wimpie_lite_callto_bkgimage');
		$image_url = get_template_directory_uri()."/images/";
		if(!empty($favicon)):
			echo "<link type='image/png' rel='icon' href='".esc_url($favicon)."'/>\n";
		endif;
		echo "<style type='text/css' media='all'>";
		if(!empty($cta_bg_v)){
			$cta_bg =   '.call-to-action {background: url("'.esc_url(get_theme_mod('wimpie_lite_callto_bkgimage')).'") no-repeat scroll center top rgba(0, 0, 0, 0);';
			echo $cta_bg;
		}
		echo "</style>\n"; 

		//Custom CSS CODE
		$custom_css = get_theme_mod('wimpielite_custom_tools_css');
		if(!empty($custom_css)){
			echo "<style type='text/css' media='all'>";
			echo $custom_css;
			echo "</style>\n";
		}
		//custom js
		$custom_js = get_theme_mod('wimpielite_custom_tools_js');
		if(!empty($custom_js)){
			echo '<script type="text/javascript">'.$custom_js.'</script>';
		}
	}

	add_action('wp_head','wimpie_lite_header_styles_scripts');

	function wimpie_lite_fonts_cb(){
		$http = 'http';
		echo "<link href='".$http."://fonts.googleapis.com/css?family=Arimo:400,700|Open+Sans:400,700,600italic,300|Roboto+Condensed:300,400,700|Roboto:300,400,700|Slabo+27px|Oswald:400,300,700|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|PT+Sans:400,700,400italic,700italic|Droid+Sans:400,700|Raleway:400,100,200,300,500,600,700,800,900|Droid+Serif:400,700,400italic,700italic|Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic|Montserrat:400,700|Roboto+Slab:400,100,300,700|Merriweather:400italic,400,900,300italic,300,700,700italic,900italic|Lora:400,700,400italic,700italic|PT+Sans+Narrow:400,700|Bitter:400,700,400italic|Lobster|Yanone+Kaffeesatz:400,200,300,700|Arvo:400,700,400italic,700italic|Oxygen:400,300,700|Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900|Dosis:200,300,400,500,600,700,800|Ubuntu+Condensed|Playfair+Display:400,700,900,400italic,700italic,900italic|Cabin:400,500,600,700,400italic,500italic,600italic|Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>";   
	}
	add_action('wp_footer', 'wimpie_lite_fonts_cb');

	// New Template for header search
	function get_search_form_header(){
		get_template_part('searchform-header');
	}



/**
 * 8Degree More Themes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Add stylesheet and JS for upsell page.
function wimpie_lite_upsell_style() {
	wp_enqueue_style( 'upsell-style', get_template_directory_uri() . '/css/upsell.css');
}

// Add upsell page to the menu.
function wimpie_lite_add_upsell() {
	$page = add_theme_page(
		__( 'More Themes', 'wimpie-lite' ),
		__( 'More Themes', 'wimpie-lite' ),
		'administrator',
		'wimpie-lite-themes',
		'wimpie_lite_display_upsell'
		);

	add_action( 'admin_print_styles-' . $page, 'wimpie_lite_upsell_style' );
}
add_action( 'admin_menu', 'wimpie_lite_add_upsell', 11 );

// Define markup for the upsell page.
function wimpie_lite_display_upsell() {

	// Set template directory uri
	$directory_uri = get_template_directory_uri();
	?>
	<div class="wrap">
		<div class="container-fluid">
			<div id="upsell_container">  
				<div class="row">
					<div id="upsell_header" class="col-md-12">
						<h2>
							<a href="http://8degreethemes.com/" target="_blank">
								<img src="http://8degreethemes.com/wp-content/uploads/2015/05/logo.png"/>
							</a>
						</h2>

						<h3><?php _e( 'Product of 8Degree Themes', 'wimpie-lite' ); ?></h3>
					</div>
				</div>

				<div id="upsell_themes" class="row">
					<?php
					// Set the argument array with author name.
					$args = array(
						'author' => '8degreethemes',
						);

					// Set the $request array.
					$request = array(
						'body' => array(
							'action'  => 'query_themes',
							'request' => serialize( (object)$args )
							)
						);
					$themes = wimpie_lite_get_themes( $request );
					$active_theme = wp_get_theme()->get( 'Name' );
					$counter = 1;

					// For currently active theme.
					foreach ( $themes->themes as $theme ) {
						if( $active_theme == $theme->name ) {?>

						<div id="<?php echo $theme->slug; ?>" class="theme-container col-md-6 col-lg-4">
							<div class="image-container">
								<img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

								<div class="theme-description">
									<p><?php echo $theme->description; ?></p>
								</div>
							</div>
							<div class="theme-details active">
								<span class="theme-name"><?php echo $theme->name . ':' . __( 'Current theme', 'wimpie-lite' ); ?></span>
								<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>">Customize</a>
							</div>
						</div>

						<?php
						$counter++;
						break;
					}
				}

					// For all other themes.
				foreach ( $themes->themes as $theme ) {
					if( $active_theme != $theme->name ) {

							// Set the argument array with author name.
						$args = array(
							'slug' => $theme->slug,
							);

							// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'theme_information',
								'request' => serialize( (object)$args )
								)
							);

						$theme_details = wimpie_lite_get_themes( $request );
						?>

						<div id="<?php echo $theme->slug; ?>" class="theme-container col-md-6 col-lg-4 <?php echo $counter % 3 == 1 ? 'no-left-megin' : ""; ?>">
							<div class="image-container">
								<img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

								<div class="theme-description">
									<p><?php echo $theme->description; ?></p>
								</div>
							</div>
							<div class="theme-details">
								<span class="theme-name"><?php echo $theme->name; ?></span>

								<!-- Check if the theme is installed -->
								<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>

								<!-- Show the tick image notifying the theme is already installed. -->
								<img data-toggle="tooltip" title="<?php _e( 'Already installed', 'wimpie-lite' ); ?>" data-placement="bottom" class="theme-exists" src="<?php echo $directory_uri ?>/images/8dt-right.png"/>

								<!-- Activate Button -->
								<a  class="button button-primary activate right"
								href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" >Activate</a>
								<?php }
								else {

										// Set the install url for the theme.
									$install_url = add_query_arg( array(
										'action' => 'install-theme',
										'theme'  => $theme->slug,
										), self_admin_url( 'update.php' ) );
										?>
										<!-- Install Button -->
										<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-primary install right" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'wimpie-lite' ); ?></a>
										<?php } ?>

										<!-- Preview button -->
										<a class="button button-secondary preview right" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'wimpie-lite' ); ?></a>
									</div>
								</div>
								<?php
								$counter++;
							}
						}?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

// Get all 8Degree themes by using API.
	function wimpie_lite_get_themes( $request ) {

	// Generate a cache key that would hold the response for this request:
		$key = 'wimpie-lite_' . md5( serialize( $request ) );

	// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

		// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

		// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

				// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

			// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
			// Error object returned
				return $response;
			}
		}
		return $themes;
	}
if ( is_admin() ) : // Load only if we are viewing an admin page

function wimpie_lite_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'wimpielite_custom_js', get_template_directory_uri().'/inc/js/custom.js', array( 'jquery' ),'',true );
	wp_enqueue_style( 'wimpielite_admin_style',get_template_directory_uri().'/inc/css/admin.css', '1.0', 'screen' );
}
add_action('admin_enqueue_scripts', 'wimpie_lite_admin_scripts');
endif;
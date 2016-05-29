<?php
/**
 * @package Fontawesome Icons
 * @version 1.0
 */
/*
Plugin Name: SS Font Awesome Icon
Plugin URI: http://sobshomoy.com/plugins/ss-font-awesome-icon
Description: All fontawesome icons you can create in your post inside or widgets. Easily integretion. Just go http://fontawesome.io/icons/ choose your icon and wirte only the "iwifi" if you found "fa-wifi"
Author: Saiful Islam
Version: 1.0
Author URI: http://bn.hs-bd.com/
*/

/* Plugin Root dir */
define('SS_FA_ICONS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
wp_enqueue_style('ss-fa-icons', SS_FA_ICONS_PATH.'css/style.css');

//include fontawesome cdn
wp_register_style('ss_fa_cdn_icons', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array() );
wp_enqueue_style('ss_fa_cdn_icons');
//enabled shortcode for widget
add_filter('widget_text', 'do_shortcode');



//main function for fontawesome
function font_awesome_function($atts){
   extract(shortcode_atts(array(
      'name' => 'facebook',
      'size' => 20,
	  'padding' => '5',
	  'margin' => '5',
	  'color' => '#fff',
	  'bg' => '#000',
	  
   ), $atts));

   $return_string = '<i style="background:'.$bg.';color:'.$color.';font-size:'.$size.'px;padding:'.$padding.'%; margin:'.$margin.'%" class="fa fa-'.$name.'">';
   $return_string .= '</i>';
   return $return_string;
}

function register_shortcodes(){
   add_shortcode('icon', 'font_awesome_function');
}
add_action( 'init', 'register_shortcodes');
?>
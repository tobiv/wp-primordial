<?php
/**
 * Plugin Name: WP Primordial
 * Plugin URI: https://github.com/tobiv/wp-primordial
 * Description: Basic WordPress plugin. Remove some unneeded stuff from the html header.
 * Version: 1.0.0
 * Author: Tobias Vogler
 * Author URI: https://tvdesign.ch
 * License: GPL-3.0+
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Text Domain: wp-primordial
 */

/*
* Remove jquery embed
*/
function my_deregister_scripts(){
   wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

/*
 * Remove idiotic emoji js
 */
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );

/*
 * Remove stuff from wp_head
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);

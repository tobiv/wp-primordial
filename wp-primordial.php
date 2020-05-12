<?php
/**
 * Plugin Name: WP Primordial
 * Plugin URI: https://github.com/tobiv/wp-primordial
 * Description: Basic WordPress primer plugin for <tv> websites.
 * Version: 1.0.0
 * Author: Tobias Vogler
 * Author URI: https://tvdesign.ch
 * License: GPL-3.0+
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Text Domain: wp-primordial
 */

class WP_Primordial {

  // Default options
  private $options = array(
    'remove_embed'       => true,
    'remove_emojis'      => true,
    'remove_generator'   => true,
    'remove_rsd'         => true,
    'remove_wlw'         => true,
    'remove_rest_output' => true,
    'remove_feed_links'  => true,

    'disable_xmlrpc'     => true,

    'hide_admin_bar'     => true,
    'hide_core_update'   => true,
  );

  function __construct() {
    // Check if config file exists
    // Read into $options array

    $this->init();
  }

  private function init() {
    // Deregister Scripts
    if($this->options['remove_embed'] === true) {
      add_action('wp_footer', array('this', 'deregister_scripts'));
    }

    // Remove idiotic emoji inlines
    if($this->options['remove_emojis'] === true) {
      remove_action('wp_head', 'print_emoji_detection_script', 7 );
      remove_action('wp_print_styles', 'print_emoji_styles' );
    }

    // Remove stuff from wp_head
    if($this->options['remove_generator'] === true)   remove_action('wp_head', 'wp_generator');
    if($this->options['remove_rsd'] === true)         remove_action('wp_head', 'rsd_link');
    if($this->options['remove_wlw'] === true)         remove_action('wp_head', 'wlwmanifest_link');
    if($this->options['remove_rest_output'] === true) remove_action('wp_head', 'rest_output_link_wp_head', 10);

    if($this->options['remove_feed_links'] === true) {
      remove_action('wp_head', 'feed_links_extra', 3);
      remove_action('wp_head', 'feed_links', 2);
    }

    // Disable XML-RPC
    if($this->options['disable_xmlrpc'] === true) {
      add_filter( 'xmlrpc_enabled', '__return_false' );
    }

    // Remove admin bar
    if($this->options['hide_admin_bar'] === true) {
      show_admin_bar(false);
    }

    // Hide core update nag in admin
    if($this->options['hide_core_update'] === true) {
      remove_action('admin_notices', 'update_nag', 3);
    }
  }

  /*
   * Deregister jquery embed script
   */
  private function deregister_scripts() {
    wp_deregister_script('wp-embed');
  }
}

$tv_wp_primordial = new WP_Primordial();

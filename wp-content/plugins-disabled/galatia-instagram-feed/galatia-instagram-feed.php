<?php
/*
Plugin Name: Galatia Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Edge Themes
Version: 2.0
*/
define('GALATIA_INSTAGRAM_FEED_VERSION', '2.0');
define('GALATIA_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('GALATIA_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'GALATIA_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'GALATIA_INSTAGRAM_ASSETS_PATH', GALATIA_INSTAGRAM_ABS_PATH . '/assets' );
define( 'GALATIA_INSTAGRAM_ASSETS_URL_PATH', GALATIA_INSTAGRAM_URL_PATH . 'assets' );
define( 'GALATIA_INSTAGRAM_SHORTCODES_PATH', GALATIA_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'GALATIA_INSTAGRAM_SHORTCODES_URL_PATH', GALATIA_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'galatia_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function galatia_instagram_theme_installed() {
        return defined( 'EDGE_ROOT' );
    }
}

if ( ! function_exists( 'galatia_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function galatia_instagram_feed_text_domain() {
		load_plugin_textdomain( 'galatia-instagram-feed', false, GALATIA_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'galatia_instagram_feed_text_domain' );
}
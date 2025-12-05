<?php

if ( ! function_exists( 'galatia_edge_include_woocommerce_shortcodes' ) ) {
	function galatia_edge_include_woocommerce_shortcodes() {
		foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( galatia_edge_core_plugin_installed() ) {
		add_action( 'galatia_core_action_include_shortcodes_file', 'galatia_edge_include_woocommerce_shortcodes' );
	}
}

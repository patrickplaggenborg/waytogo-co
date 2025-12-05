<?php

if ( ! function_exists( 'galatia_edge_disable_wpml_css' ) ) {
	function galatia_edge_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'galatia_edge_disable_wpml_css' );
}
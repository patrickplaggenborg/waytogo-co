<?php

if ( ! function_exists( 'galatia_core_add_dropcaps_shortcodes' ) ) {
	function galatia_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'GalatiaCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcode', 'galatia_core_add_dropcaps_shortcodes' );
}
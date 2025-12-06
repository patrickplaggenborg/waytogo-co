<?php

if ( ! function_exists( 'galatia_core_add_intro_section_shortcodes' ) ) {
	function galatia_core_add_intro_section_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'GalatiaCore\CPT\Shortcodes\IntroSection\IntroSection'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcode', 'galatia_core_add_intro_section_shortcodes' );
}

if ( ! function_exists( 'galatia_core_set_intro_section_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for intro section shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function galatia_core_set_intro_section_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-intro-section';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_icon_class', 'galatia_core_set_intro_section_icon_class_name_for_vc_shortcodes' );
}
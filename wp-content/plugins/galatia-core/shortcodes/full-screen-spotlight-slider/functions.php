<?php

if ( ! function_exists( 'galatia_core_enqueue_scripts_for_full_screen_spotlight_slider_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function galatia_core_enqueue_scripts_for_full_screen_spotlight_slider_shortcodes() {
		wp_enqueue_script( 'fullPage', GALATIA_CORE_SHORTCODES_URL_PATH . '/full-screen-spotlight-slider/assets/js/plugins/jquery.fullPage.min.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'galatia_edge_action_enqueue_third_party_scripts', 'galatia_core_enqueue_scripts_for_full_screen_spotlight_slider_shortcodes' );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edgtf_Full_Screen_Spotlight_Slider extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'galatia_core_add_full_screen_spotlight_slider_shortcodes' ) ) {
	function galatia_core_add_full_screen_spotlight_slider_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'GalatiaCore\CPT\Shortcodes\FullScreenSpotlightSlider\FullScreenSpotlightSlider',
			'GalatiaCore\CPT\Shortcodes\FullScreenSpotlightSlider\FullScreenSpotlightSliderItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcode', 'galatia_core_add_full_screen_spotlight_slider_shortcodes' );
}

if ( ! function_exists( 'galatia_core_set_full_screen_spotlight_slider_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for full screen spotlight slider holder shortcode
	 */
	function galatia_core_set_full_screen_spotlight_slider_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_edgtf_full_screen_spotlight_slider_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_style', 'galatia_core_set_full_screen_spotlight_slider_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'galatia_core_set_full_screen_spotlight_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for full screen spotlight slider holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function galatia_core_set_full_screen_spotlight_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-full-screen-spotlight-slider';
        $shortcodes_icon_class_array[] = '.icon-wpb-full-screen-spotlight-slider-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_icon_class', 'galatia_core_set_full_screen_spotlight_slider_icon_class_name_for_vc_shortcodes' );
}
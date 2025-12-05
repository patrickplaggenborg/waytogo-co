<?php

if ( ! function_exists( 'galatia_core_enqueue_scripts_for_horizontal_scrolling_portfolio_list_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function galatia_core_enqueue_scripts_for_horizontal_scrolling_portfolio_list_shortcodes() {
		wp_enqueue_script( 'hammer', GALATIA_CORE_CPT_URL_PATH . '/portfolio/shortcodes/horizontaly-scrolling-portfolio-list/assets/js/plugins/hammer.min.js', false, true );
		wp_enqueue_script( 'virtual-scroll', GALATIA_CORE_CPT_URL_PATH . '/portfolio/shortcodes/horizontaly-scrolling-portfolio-list/assets/js/plugins/virtual-scroll.min.js', false, true );
	}

	add_action( 'galatia_edge_action_enqueue_third_party_scripts', 'galatia_core_enqueue_scripts_for_horizontal_scrolling_portfolio_list_shortcodes' );
}

if ( ! function_exists( 'galatia_core_add_horizontaly_scrolling_portfolio_list_shortcode' ) ) {
	function galatia_core_add_horizontaly_scrolling_portfolio_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'GalatiaCore\CPT\Shortcodes\Portfolio\HorizontalyScrollingPortfolioList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcode', 'galatia_core_add_horizontaly_scrolling_portfolio_list_shortcode' );
}

if ( ! function_exists( 'galatia_core_set_horizontaly_scrolling_portfolio_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function galatia_core_set_horizontaly_scrolling_portfolio_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-horizontaly-scrolling-portfolio-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_icon_class', 'galatia_core_set_horizontaly_scrolling_portfolio_list_icon_class_name_for_vc_shortcodes' );
}
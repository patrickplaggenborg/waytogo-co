<?php

if ( ! function_exists( 'galatia_edge_breadcrumbs_title_area_typography_style' ) ) {
	function galatia_edge_breadcrumbs_title_area_typography_style() {
		
		$item_styles = galatia_edge_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.edgtf-title-holder .edgtf-title-wrapper .edgtf-breadcrumbs'
		);
		
		echo galatia_edge_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = galatia_edge_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.edgtf-title-holder .edgtf-title-wrapper .edgtf-breadcrumbs a:hover'
		);
		
		echo galatia_edge_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_breadcrumbs_title_area_typography_style' );
}
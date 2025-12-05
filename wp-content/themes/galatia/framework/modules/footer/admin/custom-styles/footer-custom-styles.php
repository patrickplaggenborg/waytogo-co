<?php

if ( ! function_exists( 'galatia_edge_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function galatia_edge_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = galatia_edge_options()->getOptionValue( 'footer_top_background_color' );
		$border_color     = galatia_edge_options()->getOptionValue( 'footer_top_border_color' );
		$border_width     = galatia_edge_options()->getOptionValue( 'footer_top_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = galatia_edge_filter_px( $border_width ) . 'px';
		}
		
		echo galatia_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-top-holder', $item_styles );
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_footer_top_general_styles' );
}

if ( ! function_exists( 'galatia_edge_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function galatia_edge_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = galatia_edge_options()->getOptionValue( 'footer_bottom_background_color' );
		$border_color     = galatia_edge_options()->getOptionValue( 'footer_bottom_border_color' );
		$border_width     = galatia_edge_options()->getOptionValue( 'footer_bottom_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = galatia_edge_filter_px( $border_width ) . 'px';
		}
		
		echo galatia_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_footer_bottom_general_styles' );
}
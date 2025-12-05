<?php

if ( ! function_exists( 'galatia_edge_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function galatia_edge_header_top_bar_styles() {
		$top_header_height = galatia_edge_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo galatia_edge_dynamic_css( '.edgtf-top-bar', array( 'height' => galatia_edge_filter_px( $top_header_height ) . 'px' ) );
			echo galatia_edge_dynamic_css( '.edgtf-top-bar .edgtf-logo-wrapper a', array( 'max-height' => galatia_edge_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo galatia_edge_dynamic_css( '.edgtf-header-box .edgtf-top-bar-background', array( 'height' => galatia_edge_get_top_bar_background_height() . 'px' ) );
		
		$top_bar_container_selector = '.edgtf-top-bar > .edgtf-vertical-align-containers';
		$top_bar_container_styles   = array();
		$container_side_padding     = galatia_edge_options()->getOptionValue( 'top_bar_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( galatia_edge_string_ends_with( $container_side_padding, 'px' ) || galatia_edge_string_ends_with( $container_side_padding, '%' ) ) {
				$top_bar_container_styles['padding-left'] = $container_side_padding;
				$top_bar_container_styles['padding-right'] = $container_side_padding;
			} else {
				$top_bar_container_styles['padding-left'] = galatia_edge_filter_px( $container_side_padding ) . 'px';
				$top_bar_container_styles['padding-right'] = galatia_edge_filter_px( $container_side_padding ) . 'px';
			}
			
			echo galatia_edge_dynamic_css( $top_bar_container_selector, $top_bar_container_styles );
		}
		
		if ( galatia_edge_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.edgtf-top-bar .edgtf-grid .edgtf-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = galatia_edge_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = galatia_edge_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = galatia_edge_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo galatia_edge_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = galatia_edge_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = galatia_edge_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( galatia_edge_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = galatia_edge_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = galatia_edge_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo galatia_edge_dynamic_css( '.edgtf-header-box .edgtf-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( galatia_edge_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo galatia_edge_dynamic_css( '.edgtf-top-bar', $top_bar_styles );
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_header_top_bar_styles' );
}
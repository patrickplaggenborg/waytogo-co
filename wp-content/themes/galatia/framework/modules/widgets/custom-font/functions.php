<?php

if ( ! function_exists( 'galatia_edge_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function galatia_edge_register_custom_font_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_custom_font_widget' );
}
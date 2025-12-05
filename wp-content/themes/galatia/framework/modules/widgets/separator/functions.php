<?php

if ( ! function_exists( 'galatia_edge_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function galatia_edge_register_separator_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_separator_widget' );
}
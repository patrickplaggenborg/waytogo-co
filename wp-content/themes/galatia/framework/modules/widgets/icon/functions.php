<?php

if ( ! function_exists( 'galatia_edge_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function galatia_edge_register_icon_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_icon_widget' );
}
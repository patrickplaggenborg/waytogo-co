<?php

if ( ! function_exists( 'galatia_edge_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function galatia_edge_register_button_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_button_widget' );
}
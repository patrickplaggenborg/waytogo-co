<?php

if ( ! function_exists( 'galatia_edge_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function galatia_edge_register_search_opener_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_search_opener_widget' );
}
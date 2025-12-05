<?php

if ( ! function_exists( 'galatia_edge_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function galatia_edge_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_sidearea_opener_widget' );
}
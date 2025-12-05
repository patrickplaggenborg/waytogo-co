<?php

if ( ! function_exists( 'galatia_edge_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function galatia_edge_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_sticky_sidebar_widget' );
}
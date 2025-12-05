<?php

if ( ! function_exists( 'galatia_edge_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function galatia_edge_register_author_info_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_author_info_widget' );
}
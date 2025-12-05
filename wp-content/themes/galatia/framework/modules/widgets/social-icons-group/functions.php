<?php

if ( ! function_exists( 'galatia_edge_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function galatia_edge_register_social_icons_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_social_icons_widget' );
}
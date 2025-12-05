<?php

if ( ! function_exists( 'galatia_edge_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function galatia_edge_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_recent_posts_widget' );
}
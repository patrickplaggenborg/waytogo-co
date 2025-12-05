<?php

if ( ! function_exists( 'galatia_edge_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function galatia_edge_register_blog_list_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_blog_list_widget' );
}
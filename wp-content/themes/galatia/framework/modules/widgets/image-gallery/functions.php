<?php

if ( ! function_exists( 'galatia_edge_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function galatia_edge_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_image_gallery_widget' );
}
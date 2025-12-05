<?php

if ( ! function_exists( 'galatia_edge_register_widgets' ) ) {
	function galatia_edge_register_widgets() {
		$widgets = apply_filters( 'galatia_edge_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'galatia_edge_register_widgets' );
}
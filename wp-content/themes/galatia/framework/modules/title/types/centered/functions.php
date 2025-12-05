<?php

if ( ! function_exists( 'galatia_edge_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function galatia_edge_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'galatia' );
		
		return $type;
	}
	
	add_filter( 'galatia_edge_filter_title_type_global_option', 'galatia_edge_set_title_centered_type_for_options' );
	add_filter( 'galatia_edge_filter_title_type_meta_boxes', 'galatia_edge_set_title_centered_type_for_options' );
}
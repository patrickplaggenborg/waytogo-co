<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_standard_options' ) ) {
	function galatia_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_standard_map' ) ) {
	function galatia_edge_header_standard_map( $parent ) {
		$hide_dep_options = galatia_edge_get_hide_dep_for_header_standard_options();
		
		galatia_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'galatia' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'galatia' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'galatia' ),
					'left'   => esc_html__( 'Left', 'galatia' ),
					'center' => esc_html__( 'Center', 'galatia' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_header_menu_area_options_map', 'galatia_edge_header_standard_map' );
}
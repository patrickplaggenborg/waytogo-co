<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_standard_meta_map' ) ) {
	function galatia_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = galatia_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgtf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'galatia' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'galatia' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'galatia' ),
					'left'   => esc_html__( 'Left', 'galatia' ),
					'right'  => esc_html__( 'Right', 'galatia' ),
					'center' => esc_html__( 'Center', 'galatia' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_header_area_meta_boxes_map', 'galatia_edge_header_standard_meta_map' );
}
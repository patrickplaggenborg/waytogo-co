<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_vertical_area_meta_options_map' ) ) {
	function galatia_edge_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = galatia_edge_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'galatia' )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'galatia' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'galatia' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'galatia' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'galatia' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'galatia' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'galatia' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'galatia' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'galatia' ),
				'description'   => esc_html__( 'Set border on vertical area', 'galatia' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = galatia_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'edgtf_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'galatia' ),
				'description' => esc_html__( 'Choose color of border', 'galatia' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'galatia' ),
				'description'   => esc_html__( 'Set content in vertical center', 'galatia' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_header_area_meta_boxes_map', 'galatia_edge_header_vertical_area_meta_options_map' );
}
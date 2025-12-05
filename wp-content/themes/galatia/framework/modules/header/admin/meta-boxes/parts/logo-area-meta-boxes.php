<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_logo_area_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_logo_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_logo_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}


if ( ! function_exists( 'galatia_edge_header_logo_area_meta_options_map' ) ) {
	function galatia_edge_header_logo_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = galatia_edge_get_hide_dep_for_header_logo_area_meta_boxes();
		
		$logo_area_container = galatia_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_area_style',
				'title'  => esc_html__( 'Logo Area Style', 'galatia' )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_logo_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area In Grid', 'galatia' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'galatia' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_container = galatia_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'edgtf_logo_area_in_grid_meta'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'galatia' ),
				'description' => esc_html__( 'Set grid background color for logo area', 'galatia' ),
				'parent'      => $logo_area_in_grid_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'galatia' ),
				'description' => esc_html__( 'Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'galatia' ),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_logo_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'galatia' ),
				'description'   => esc_html__( 'Set border on grid logo area', 'galatia' ),
				'parent'        => $logo_area_in_grid_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_border_container = galatia_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_border_container',
				'parent'          => $logo_area_in_grid_container,
				'dependency' => array(
					'show' => array(
						'edgtf_logo_area_in_grid_border_meta'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'galatia' ),
				'description' => esc_html__( 'Set border color for grid area', 'galatia' ),
				'parent'      => $logo_area_in_grid_border_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'galatia' ),
				'description' => esc_html__( 'Choose a background color for logo area', 'galatia' ),
				'parent'      => $logo_area_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'galatia' ),
				'description' => esc_html__( 'Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'galatia' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_logo_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area Border', 'galatia' ),
				'description'   => esc_html__( 'Set border on logo area', 'galatia' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		$logo_area_border_bottom_color_container = galatia_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_border_bottom_color_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'edgtf_logo_area_border_meta'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'galatia' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'galatia' ),
				'parent'      => $logo_area_border_bottom_color_container
			)
		);

		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_area_height_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'galatia' ),
				'description' => esc_html__( 'Enter logo area height (default is 90px)', 'galatia' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => esc_html__( 'px', 'galatia' )
				)
			)
		);
		
		do_action( 'galatia_edge_action_header_logo_area_additional_meta_boxes_map', $logo_area_container );
	}
	
	add_action( 'galatia_edge_action_header_logo_area_meta_boxes_map', 'galatia_edge_header_logo_area_meta_options_map', 10, 1 );
}
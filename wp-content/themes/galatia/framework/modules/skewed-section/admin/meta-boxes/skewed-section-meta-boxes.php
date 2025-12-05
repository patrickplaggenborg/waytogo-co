<?php

if ( ! function_exists( 'galatia_edge_skewed_section_title_meta' ) ) {
	function galatia_edge_skewed_section_title_meta( $show_title_area_container ) {
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'galatia' )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_skewed_section_on_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'galatia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'galatia' ),
				'options'       => galatia_edge_get_yes_no_select_array(),
				'parent'        => $show_title_area_container
			)
		);
		
		$show_skewed_section_title_area_container = galatia_edge_add_admin_container(
			array(
				'parent'     => $show_title_area_container,
				'name'       => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_skewed_section_on_title_area_meta' => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_title_area_skewed_section_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Position', 'galatia' ),
				'description'   => esc_html__( 'Specify skewed section position', 'galatia' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					''        => esc_html__( 'Default', 'galatia' ),
					'outline' => esc_html__( 'Outline', 'galatia' ),
					'inset'   => esc_html__( 'Inset', 'galatia' )
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'edgtf_title_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Title Area SVG Path', 'galatia' ),
				'description' => esc_html__( 'Enter your Section On Title Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'galatia' ),
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'edgtf_title_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'galatia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'galatia' ),
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_title_area_meta_boxes', 'galatia_edge_skewed_section_title_meta', 20 );
}

if ( ! function_exists( 'galatia_edge_skewed_section_header_meta' ) ) {
	function galatia_edge_skewed_section_header_meta( $show_header_area_container ) {
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'galatia' )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_skewed_section_on_header_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'galatia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'galatia' ),
				'options'       => galatia_edge_get_yes_no_select_array(),
				'parent'        => $show_header_area_container
			)
		);
		
		$show_skewed_section_header_area_container = galatia_edge_add_admin_container(
			array(
				'parent'     => $show_header_area_container,
				'name'       => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_skewed_section_on_header_area_meta' => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'edgtf_header_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Header Area SVG Path', 'galatia' ),
				'description' => esc_html__( 'Enter your Section On Header Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'galatia' ),
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'edgtf_header_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'galatia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'galatia' ),
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_header_area_meta_boxes', 'galatia_edge_skewed_section_header_meta', 20 );
}
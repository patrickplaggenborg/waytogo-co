<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_vertical_area_options' ) ) {
	function galatia_edge_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_vertical_options_map' ) ) {
	function galatia_edge_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = galatia_edge_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = galatia_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'galatia' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'galatia' ),
				'parent'      => $vertical_area_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'galatia' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'galatia' ),
				'parent'        => $vertical_area_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'galatia' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'galatia' ),
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'galatia' ),
				'description'   => esc_html__( 'Set border on vertical area', 'galatia' )
			)
		);
		
		$vertical_header_shadow_border_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'dependency' => array(
					'hide' => array(
						'vertical_header_border'  => 'no'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'galatia' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'galatia' ),
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__( 'Center Content', 'galatia' ),
				'description'   => esc_html__( 'Set content in vertical center', 'galatia' ),
			)
		);
		
		do_action( 'galatia_edge_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'galatia_edge_action_additional_header_menu_area_options_map', 'galatia_edge_header_vertical_options_map' );
}
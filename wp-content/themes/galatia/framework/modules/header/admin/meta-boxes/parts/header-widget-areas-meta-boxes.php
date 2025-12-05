<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_widget_areas_meta_options_map' ) ) {
	function galatia_edge_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= galatia_edge_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_two 	= galatia_edge_get_hide_dep_for_header_widget_area_two_meta_boxes();
		
		$header_widget_areas_container = galatia_edge_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'galatia' )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'galatia' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = galatia_edge_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'edgtf_disable_header_widget_areas_meta' => 'yes'
					)
				)
			)
		);
					
		$galatia_custom_sidebars = galatia_edge_get_custom_sidebars();
		if ( count( $galatia_custom_sidebars ) > 0 ) {
			galatia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'galatia' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'galatia' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $galatia_custom_sidebars
				)
			);
		}

		if ( count( $galatia_custom_sidebars ) > 0 ) {
			galatia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_header_widget_area_two_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'galatia' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'galatia' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $galatia_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'edgtf_header_type_meta' => $hide_dep_widget_area_two
						)
					)
				)
			);
		}
		
		do_action( 'galatia_edge_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}
	
	add_action( 'galatia_edge_action_header_widget_areas_meta_boxes_map', 'galatia_edge_header_widget_areas_meta_options_map', 10, 1 );
}
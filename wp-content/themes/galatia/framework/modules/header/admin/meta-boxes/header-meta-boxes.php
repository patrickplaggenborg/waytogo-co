<?php

if ( ! function_exists( 'galatia_edge_header_types_meta_boxes' ) ) {
	function galatia_edge_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'galatia_edge_filter_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'galatia' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( EDGE_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'galatia_edge_map_header_meta' ) ) {
	function galatia_edge_map_header_meta() {
		$header_type_meta_boxes              = galatia_edge_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = galatia_edge_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'galatia' ),
				'name'  => 'header_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'galatia' ),
				'description'   => esc_html__( 'Select header type layout', 'galatia' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'galatia' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'galatia' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'galatia' ),
					'light-header' => esc_html__( 'Light', 'galatia' ),
					'dark-header'  => esc_html__( 'Dark', 'galatia' )
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'edgtf_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'galatia' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'galatia' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'galatia' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'galatia' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'galatia' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'galatia' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'galatia' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);

        $edgtf_header_additional_fixed_behaviour = galatia_edge_add_admin_container(
            array(
                'parent'     => $header_meta_box,
                'name'       => 'edgtf_header_additional_fixed_behaviour',
                'dependency' => array(
                    'show' => array(
                        'edgtf_header_behaviour_meta' => 'fixed-on-scroll',
                    )
                )
            )
        );

        galatia_edge_create_meta_box_field(
            array(
                'parent'          => $edgtf_header_additional_fixed_behaviour,
                'type'            => 'select',
                'name'            => 'edgtf_header_additional_fixed_behaviour_meta',
                'default_value'   => '',
                'label'           => esc_html__( 'Choose Additional Fixed Header Behaviour', 'galatia' ),
                'description'     => esc_html__( 'Select the behaviour of fixed header when you scroll down to page', 'galatia' ),
                'options'         => array(
                    ''                                => esc_html__( 'Default', 'galatia'),
                    'fixed-standard'                  => esc_html__( 'Fixed Standard', 'galatia' ),
                    'fixed-only-logo'                      => esc_html__( 'Only Logo Fixed', 'galatia' )
                ),
                'dependency' => array(
                    'hide' => array(
                        'edgtf_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
                    )
                )
            )
        );
		
		//additional area
		do_action( 'galatia_edge_action_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'galatia_edge_action_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'galatia_edge_action_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'galatia_edge_action_header_menu_area_meta_boxes_map', $header_meta_box );

		//dropdown
		do_action( 'galatia_edge_action_dropdown_meta_boxes_map', $header_meta_box );

		//widget areaa
		do_action( 'galatia_edge_action_header_widget_areas_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_header_meta', 50 );
}
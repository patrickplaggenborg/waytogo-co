<?php

if ( ! function_exists( 'galatia_edge_get_title_types_meta_boxes' ) ) {
	function galatia_edge_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'galatia_edge_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'galatia' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'galatia_edge_map_title_meta' ) ) {
	function galatia_edge_map_title_meta() {
		$title_type_meta_boxes = galatia_edge_get_title_types_meta_boxes();
		
		$title_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'galatia' ),
				'name'  => 'title_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'galatia' ),
				'parent'        => $title_meta_box,
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = galatia_edge_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'edgtf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'edgtf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'galatia' ),
						'description'   => esc_html__( 'Choose title type', 'galatia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'galatia' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'galatia' ),
						'options'       => galatia_edge_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'galatia' ),
						'description' => esc_html__( 'Set a height for Title Area', 'galatia' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

                galatia_edge_create_meta_box_field(
                    array(
                        'name'          => 'edgtf_title_area_side_padding_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Side Padding', 'galatia' ),
                        'description'   => esc_html__( 'Set title area side padding', 'galatia' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'        => array(
                            'col_width' => 2,
                            'suffix'    => 'px'
                        )
                    )
                );
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'galatia' ),
						'description' => esc_html__( 'Choose a background color for title area', 'galatia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'galatia' ),
						'description' => esc_html__( 'Choose an Image for title area', 'galatia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'galatia' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'galatia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'galatia' ),
							'hide'                => esc_html__( 'Hide Image', 'galatia' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'galatia' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'galatia' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'galatia' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'galatia' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'galatia' )
						)
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'galatia' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'galatia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'galatia' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'galatia' ),
							'window-top'    => esc_html__( 'From Window Top', 'galatia' )
						)
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'galatia' ),
						'options'       => galatia_edge_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'galatia' ),
						'description' => esc_html__( 'Choose a color for title text', 'galatia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'galatia' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'galatia' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'galatia' ),
						'options'       => galatia_edge_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'galatia' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'galatia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'galatia_edge_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_title_meta', 60 );
}
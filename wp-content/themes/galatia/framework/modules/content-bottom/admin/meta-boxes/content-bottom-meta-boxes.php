<?php

if ( ! function_exists( 'galatia_edge_map_content_bottom_meta' ) ) {
	function galatia_edge_map_content_bottom_meta() {
		
		$content_bottom_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'galatia' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'galatia' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'galatia' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		$show_content_bottom_meta_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'edgtf_show_content_bottom_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_content_bottom_area_meta' => 'yes'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'galatia' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'galatia' ),
				'options'       => galatia_edge_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'galatia' ),
				'options'       => galatia_edge_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'edgtf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'galatia' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'galatia' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_content_bottom_meta', 71 );
}
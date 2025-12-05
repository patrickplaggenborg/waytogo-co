<?php

if ( ! function_exists( 'galatia_edge_logo_meta_box_map' ) ) {
	function galatia_edge_logo_meta_box_map() {
		
		$logo_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'galatia' ),
				'name'  => 'logo_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'galatia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'galatia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'galatia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'galatia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'galatia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'galatia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'galatia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'galatia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'galatia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'galatia' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_logo_meta_box_map', 47 );
}
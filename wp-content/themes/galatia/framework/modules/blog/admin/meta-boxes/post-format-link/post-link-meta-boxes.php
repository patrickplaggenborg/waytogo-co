<?php

if ( ! function_exists( 'galatia_edge_map_post_link_meta' ) ) {
	function galatia_edge_map_post_link_meta() {
		$link_post_format_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'galatia' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'galatia' ),
				'description' => esc_html__( 'Enter link', 'galatia' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_link_meta', 24 );
}
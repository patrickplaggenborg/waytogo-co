<?php

if ( ! function_exists( 'galatia_edge_map_post_quote_meta' ) ) {
	function galatia_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'galatia' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'galatia' ),
				'description' => esc_html__( 'Enter Quote text', 'galatia' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'galatia' ),
				'description' => esc_html__( 'Enter Quote author', 'galatia' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_quote_meta', 25 );
}
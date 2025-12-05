<?php

if ( ! function_exists( 'galatia_edge_map_post_gallery_meta' ) ) {
	
	function galatia_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'galatia' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		galatia_edge_add_multiple_images_field(
			array(
				'name'        => 'edgtf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'galatia' ),
				'description' => esc_html__( 'Choose your gallery images', 'galatia' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_gallery_meta', 21 );
}

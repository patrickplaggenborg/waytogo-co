<?php

if ( ! function_exists( 'galatia_edge_map_post_video_meta' ) ) {
	function galatia_edge_map_post_video_meta() {
		$video_post_format_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'galatia' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'galatia' ),
				'description'   => esc_html__( 'Choose video type', 'galatia' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'galatia' ),
					'self'            => esc_html__( 'Self Hosted', 'galatia' )
				)
			)
		);
		
		$edgtf_video_embedded_container = galatia_edge_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'edgtf_video_embedded_container'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'galatia' ),
				'description' => esc_html__( 'Enter Video URL', 'galatia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'galatia' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'galatia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'galatia' ),
				'description' => esc_html__( 'Enter video image', 'galatia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_video_meta', 22 );
}
<?php

if ( ! function_exists( 'galatia_edge_map_post_audio_meta' ) ) {
	function galatia_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'galatia' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'galatia' ),
				'description'   => esc_html__( 'Choose audio type', 'galatia' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'galatia' ),
					'self'            => esc_html__( 'Self Hosted', 'galatia' )
				)
			)
		);
		
		$edgtf_audio_embedded_container = galatia_edge_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'edgtf_audio_embedded_container'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'galatia' ),
				'description' => esc_html__( 'Enter audio URL', 'galatia' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'galatia' ),
				'description' => esc_html__( 'Enter audio link', 'galatia' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_audio_meta', 23 );
}
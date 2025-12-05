<?php

if ( ! function_exists( 'galatia_core_map_testimonials_meta' ) ) {
	function galatia_core_map_testimonials_meta() {
		$testimonial_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'galatia-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'galatia-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'galatia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'galatia-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'galatia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'galatia-core' ),
				'description' => esc_html__( 'Enter author name', 'galatia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'galatia-core' ),
				'description' => esc_html__( 'Enter author job position', 'galatia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_core_map_testimonials_meta', 95 );
}
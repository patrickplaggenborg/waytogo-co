<?php

if ( ! function_exists( 'galatia_edge_centered_title_type_options_meta_boxes' ) ) {
	function galatia_edge_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'galatia' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'galatia' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_title_area_meta_boxes', 'galatia_edge_centered_title_type_options_meta_boxes', 5 );
}
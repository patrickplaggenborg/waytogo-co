<?php

if ( ! function_exists( 'galatia_edge_map_sidebar_meta' ) ) {
	function galatia_edge_map_sidebar_meta() {
		$edgtf_sidebar_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'galatia' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'galatia' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'galatia' ),
				'parent'      => $edgtf_sidebar_meta_box,
                'options'       => galatia_edge_get_custom_sidebars_options( true )
			)
		);
		
		$edgtf_custom_sidebars = galatia_edge_get_custom_sidebars();
		if ( count( $edgtf_custom_sidebars ) > 0 ) {
			galatia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'galatia' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'galatia' ),
					'parent'      => $edgtf_sidebar_meta_box,
					'options'     => $edgtf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_sidebar_meta', 31 );
}
<?php

if ( ! function_exists( 'galatia_edge_sidebar_options_map' ) ) {
	function galatia_edge_sidebar_options_map() {
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'galatia' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = galatia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'galatia' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		galatia_edge_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'galatia' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'galatia' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => galatia_edge_get_custom_sidebars_options()
		) );
		
		$galatia_custom_sidebars = galatia_edge_get_custom_sidebars();
		if ( count( $galatia_custom_sidebars ) > 0 ) {
			galatia_edge_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'galatia' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'galatia' ),
				'parent'      => $sidebar_panel,
				'options'     => $galatia_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_sidebar_options_map', galatia_edge_set_options_map_position( 'sidebar' ) );
}
<?php

if ( ! function_exists( 'galatia_edge_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function galatia_edge_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'galatia' ),
				'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable it through global theme options or on page meta box options.', 'galatia' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgtf-widget-title-holder"><h6 class="edgtf-widget-title">',
				'after_title'   => '</h6></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'galatia_edge_register_sidebars', 1 );
}

if ( ! function_exists( 'galatia_edge_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates GalatiaEdgeClassSidebar object
	 */
	function galatia_edge_add_support_custom_sidebar() {
		add_theme_support( 'GalatiaEdgeClassSidebar' );
		
		if ( get_theme_support( 'GalatiaEdgeClassSidebar' ) ) {
			new GalatiaEdgeClassSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'galatia_edge_add_support_custom_sidebar' );
}
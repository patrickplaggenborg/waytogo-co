<?php

if ( ! function_exists( 'galatia_edge_logo_options_map' ) ) {
	function galatia_edge_logo_options_map() {
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'galatia' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = galatia_edge_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'galatia' )
			)
		);
		
		$hide_logo_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'galatia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'galatia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'galatia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'galatia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'galatia' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_logo_options_map', galatia_edge_set_options_map_position( 'logo' ) );
}
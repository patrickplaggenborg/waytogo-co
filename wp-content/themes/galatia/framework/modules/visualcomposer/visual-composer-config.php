<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = EDGE_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'galatia_edge_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function galatia_edge_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'galatia_edge_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'galatia_edge_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function galatia_edge_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Edge Row Content Width', 'galatia' ),
				'value'      => array(
					esc_html__( 'Full Width', 'galatia' ) => 'full-width',
					esc_html__( 'In Grid', 'galatia' )    => 'grid'
				),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Edge Anchor ID', 'galatia' ),
				'description' => esc_html__( 'For example "home"', 'galatia' ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Edge Background Color', 'galatia' ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_color_in_grid',
				'heading'    => esc_html__( 'Edge In-Grid Background Color', 'galatia' ),
				'description'=> esc_html__('Set this color if you want to have row background color that will be set in grid', 'galatia'),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Edge Background Image', 'galatia' ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Edge Background Position', 'galatia' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'galatia' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Edge Disable Background Image', 'galatia' ),
				'value'       => array(
					esc_html__( 'Never', 'galatia' )        => '',
					esc_html__( 'Below 1280px', 'galatia' ) => '1280',
					esc_html__( 'Below 1024px', 'galatia' ) => '1024',
					esc_html__( 'Below 768px', 'galatia' )  => '768',
					esc_html__( 'Below 680px', 'galatia' )  => '680',
					esc_html__( 'Below 480px', 'galatia' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'galatia' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Edge Parallax Background Image', 'galatia' ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Edge Parallax Speed', 'galatia' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'galatia' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Edge Parallax Section Height (px)', 'galatia' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Edge Content Aligment', 'galatia' ),
				'value'      => array(
					esc_html__( 'Default', 'galatia' ) => '',
					esc_html__( 'Left', 'galatia' )    => 'left',
					esc_html__( 'Center', 'galatia' )  => 'center',
					esc_html__( 'Right', 'galatia' )   => 'right'
				),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);

		do_action( 'galatia_edge_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Edge Row Content Width', 'galatia' ),
				'value'      => array(
					esc_html__( 'Full Width', 'galatia' ) => 'full-width',
					esc_html__( 'In Grid', 'galatia' )    => 'grid'
				),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Edge Background Color', 'galatia' ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Edge Background Image', 'galatia' ),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Edge Background Position', 'galatia' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'galatia' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Edge Disable Background Image', 'galatia' ),
				'value'       => array(
					esc_html__( 'Never', 'galatia' )        => '',
					esc_html__( 'Below 1280px', 'galatia' ) => '1280',
					esc_html__( 'Below 1024px', 'galatia' ) => '1024',
					esc_html__( 'Below 768px', 'galatia' )  => '768',
					esc_html__( 'Below 680px', 'galatia' )  => '680',
					esc_html__( 'Below 480px', 'galatia' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'galatia' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Edge Content Aligment', 'galatia' ),
				'value'      => array(
					esc_html__( 'Default', 'galatia' ) => '',
					esc_html__( 'Left', 'galatia' )    => 'left',
					esc_html__( 'Center', 'galatia' )  => 'center',
					esc_html__( 'Right', 'galatia' )   => 'right'
				),
				'group'      => esc_html__( 'Edge Settings', 'galatia' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( galatia_edge_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Edge Enable Passepartout', 'galatia' ),
					'value'       => array_flip( galatia_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Edge Settings', 'galatia' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Edge Passepartout Size', 'galatia' ),
					'value'       => array(
						esc_html__( 'Tiny', 'galatia' )   => 'tiny',
						esc_html__( 'Small', 'galatia' )  => 'small',
						esc_html__( 'Normal', 'galatia' ) => 'normal',
						esc_html__( 'Large', 'galatia' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'galatia' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Edge Disable Side Passepartout', 'galatia' ),
					'value'       => array_flip( galatia_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'galatia' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Edge Disable Top Passepartout', 'galatia' ),
					'value'       => array_flip( galatia_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'galatia' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'galatia_edge_vc_row_map' );
}
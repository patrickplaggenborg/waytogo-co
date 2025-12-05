<?php

if ( ! function_exists( 'galatia_edge_map_footer_meta' ) ) {
	function galatia_edge_map_footer_meta() {
		
		$footer_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'galatia' ),
				'name'  => 'footer_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'galatia' ),
				'options'       => galatia_edge_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = galatia_edge_add_admin_container(
			array(
				'name'       => 'edgtf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			galatia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'galatia' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'galatia' ),
					'options'       => galatia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			galatia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'galatia' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'galatia' ),
					'options'       => galatia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			galatia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'galatia' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'galatia' ),
					'options'       => galatia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = galatia_edge_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'galatia' ),
					'description' => esc_html__( 'Define style for footer top area', 'galatia' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'edgtf_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = galatia_edge_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'galatia' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'galatia' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'galatia' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			galatia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'galatia' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'galatia' ),
					'options'       => galatia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = galatia_edge_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'galatia' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'galatia' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'edgtf_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = galatia_edge_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'galatia' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'galatia' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'galatia' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_footer_meta', 70 );
}
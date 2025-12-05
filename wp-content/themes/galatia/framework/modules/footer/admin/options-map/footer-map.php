<?php

if ( ! function_exists( 'galatia_edge_footer_options_map' ) ) {
	function galatia_edge_footer_options_map() {

		galatia_edge_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'galatia' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = galatia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'galatia' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'galatia' ),
				'parent'        => $footer_panel
			)
		);

        galatia_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'galatia' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'galatia' ),
                'parent'        => $footer_panel
            )
        );

		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'galatia' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = galatia_edge_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'galatia' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'galatia' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'galatia' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'galatia' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'galatia' ),
					'left'   => esc_html__( 'Left', 'galatia' ),
					'center' => esc_html__( 'Center', 'galatia' ),
					'right'  => esc_html__( 'Right', 'galatia' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = galatia_edge_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'galatia' ),
				'description' => esc_html__( 'Define style for footer top area', 'galatia' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = galatia_edge_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'galatia' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'galatia' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'galatia' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'galatia' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'galatia' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'galatia' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = galatia_edge_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'galatia' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'galatia' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = galatia_edge_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'galatia' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'galatia' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			galatia_edge_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'galatia' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'galatia_edge_action_options_map', 'galatia_edge_footer_options_map', galatia_edge_set_options_map_position( 'footer' ) );
}
<?php

if ( ! function_exists( 'galatia_core_map_portfolio_settings_meta' ) ) {
	function galatia_core_map_portfolio_settings_meta() {
		$meta_box = galatia_edge_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'galatia-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		galatia_edge_create_meta_box_field( array(
			'name'        => 'edgtf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'galatia-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'galatia-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'galatia-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'galatia-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'galatia-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'galatia-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'galatia-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'galatia-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'galatia-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'galatia-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'galatia-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'galatia-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'galatia-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'galatia-core' ),
				'advanced'          => esc_html__( 'Portfolio Advanced', 'galatia-core' )
			)
		) );

        $info_content_meta_container = galatia_edge_add_admin_container(
            array(
                'parent'          => $meta_box,
                'name'            => 'edgtf_info_content_container',
                'dependency' => array(
                    'show' => array(
                        'edgtf_portfolio_single_template_meta'  => array(
                            '',
                            'advanced'
                        )
                    )
                )
            )
        );

        galatia_edge_create_meta_box_field( array(
            'name'        => 'edgtf_portfolio_single_info_content',
            'type'        => 'textarea',
            'label'       => esc_html__( 'Portfolio Info Content', 'galatia-core' ),
            'description' => esc_html__( 'Enter portfolio info content', 'galatia-core' ),
            'parent'      => $info_content_meta_container
        ) );

        galatia_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_portfolio_single_skin_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Portfolio Skin', 'galatia-core' ),
                'description'   => esc_html__( '', 'galatia-core' ),
                'parent'        => $info_content_meta_container,
                'options'       => array(
                    ''          => esc_html__('Default/Light', 'galatia-core'),
                    'dark'      => esc_html__('Dark', 'galatia-core')
                ),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        galatia_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_portfolio_single_title_skin_meta',
                'type'          => 'select',
                'default_value' => 'dark',
                'label'         => esc_html__( 'Portfolio Title Area Skin', 'galatia-core' ),
                'description'   => esc_html__( '', 'galatia-core' ),
                'parent'        => $info_content_meta_container,
                'options'       => array(
                    'dark'          => esc_html__('Dark', 'galatia-core'),
                    'light'      => esc_html__('Light', 'galatia-core')
                ),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        galatia_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_portfolio_single_title_break_words_meta',
                'type'          => 'text',
                'default_value' => '',
                'label'         => esc_html__( 'Portfolio Title Line Break Position', 'galatia-core' ),
                'description'   => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'galatia-core' ),
                'parent'        => $info_content_meta_container,
                'args'        => array(
                    'col_width' => 3
                )
            )
        );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'galatia-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'galatia-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => galatia_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'galatia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'galatia-core' ),
				'default_value' => '',
				'options'       => galatia_edge_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'galatia-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'galatia-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => galatia_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'galatia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'galatia-core' ),
				'default_value' => '',
				'options'       => galatia_edge_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'galatia-core' ),
				'parent'        => $meta_box,
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'galatia-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'galatia-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'galatia-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'galatia-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

        galatia_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_portfolio_featured_image_for_lists_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Featured Image For Portfolio List Shortcodes', 'galatia-core' ),
                'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode, if not set, featured image will be shown', 'galatia-core' ),
                'parent'      => $meta_box
            )
        );
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'galatia-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'galatia-core' ),
				'parent'      => $meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'galatia-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'galatia-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'galatia-core' ),
					'small'              => esc_html__( 'Small', 'galatia-core' ),
					'large-width'        => esc_html__( 'Large Width', 'galatia-core' ),
					'large-height'       => esc_html__( 'Large Height', 'galatia-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'galatia-core' )
				)
			)
		);

		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'galatia-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'galatia-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'galatia-core' ),
					'large-width' => esc_html__( 'Large Width', 'galatia-core' )
				)
			)
		);

        galatia_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_portfolio_masonry_original_padding_meta',
                'type'          => 'text',
                'label'         => esc_html__( 'Padding for Masonry - Image Original Proportion (%)', 'galatia-core' ),
                'description'   => esc_html__( 'Choose item padding when it appears in Masonry type portfolio lists where image proportion is original', 'galatia-core' ),
                'default_value' => '',
                'parent'        => $meta_box,
                'args'        => array(
                    'col_width' => 3
                )
            )
        );
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_core_map_portfolio_settings_meta', 41 );
}
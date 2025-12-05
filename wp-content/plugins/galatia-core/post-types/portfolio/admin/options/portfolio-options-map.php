<?php

if ( ! function_exists( 'galatia_edge_portfolio_options_map' ) ) {
	function galatia_edge_portfolio_options_map() {
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'galatia-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = galatia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'galatia-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'galatia-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'galatia-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'galatia-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'galatia-core' ),
				'parent'        => $panel_archive,
				'options'       => galatia_edge_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'galatia-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'galatia-core' ),
				'default_value' => 'normal',
				'options'       => galatia_edge_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'galatia-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'galatia-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'galatia-core' ),
					'landscape' => esc_html__( 'Landscape', 'galatia-core' ),
					'portrait'  => esc_html__( 'Portrait', 'galatia-core' ),
					'square'    => esc_html__( 'Square', 'galatia-core' ),
					'predefined'=> esc_html__( 'Predefined', 'galatia-core' ),
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'galatia-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'galatia-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'galatia-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'galatia-core' )
				)
			)
		);
		
		$panel = galatia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'galatia-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'galatia-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'galatia-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'galatia-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'galatia-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => galatia_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'galatia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'galatia-core' ),
				'default_value' => 'normal',
				'options'       => galatia_edge_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = galatia_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'galatia-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'galatia-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => galatia_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'galatia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'galatia-core' ),
				'default_value' => 'normal',
				'options'       => galatia_edge_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'galatia-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'galatia-core' ),
					'yes' => esc_html__( 'Yes', 'galatia-core' ),
					'no'  => esc_html__( 'No', 'galatia-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'galatia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = galatia_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'galatia-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'galatia-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);

        galatia_edge_add_admin_field(
            array(
                'name'          => 'portfolio_single_related_posts',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Show Related Portfolios', 'galatia-core' ),
                'description'   => esc_html__( 'Enabling this option will show related portfolios on single portfolio page', 'galatia-core' ),
                'parent'        => $panel,
                'default_value' => 'yes'
            )
        );
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'galatia-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'galatia-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_portfolio_options_map', galatia_edge_set_options_map_position( 'portfolio' ) );
}
<?php

if ( ! function_exists( 'galatia_edge_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function galatia_edge_woocommerce_options_map() {
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'galatia' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = galatia_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'galatia' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'galatia' ),
				'options'     => galatia_edge_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'galatia' ),
				'default_value' => 'edgtf-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'galatia' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'galatia' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'galatia' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'galatia' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'galatia' ),
				'default_value' => 'normal',
				'options'       => galatia_edge_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'galatia' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'galatia' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'galatia' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'galatia' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'galatia' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'galatia' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'galatia' ),
				'default_value' => 'h4',
				'options'       => galatia_edge_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'galatia' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = galatia_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'galatia' ),
				'parent'        => $panel_single_product,
				'options'       => galatia_edge_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'galatia' ),
				'options'       => galatia_edge_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'galatia' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'galatia' ),
					'3' => esc_html__( 'Three', 'galatia' ),
					'2' => esc_html__( 'Two', 'galatia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'below-image',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'galatia' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'galatia' ),
					'on-right-side' => esc_html__( 'On The Right Side Of Featured Image', 'galatia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'galatia' ),
				'parent'        => $panel_single_product,
				'options'       => galatia_edge_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'galatia' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'galatia' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'galatia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'galatia' ),
				'default_value' => 'edgtf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'galatia' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'galatia' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'galatia' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('galatia_edge_woocommerce_additional_options_map');
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_woocommerce_options_map', galatia_edge_set_options_map_position( 'woocommerce' ) );
}
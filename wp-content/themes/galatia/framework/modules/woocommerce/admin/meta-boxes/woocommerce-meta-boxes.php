<?php

if ( ! function_exists( 'galatia_edge_map_woocommerce_meta' ) ) {
	function galatia_edge_map_woocommerce_meta() {
		
		$woocommerce_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'galatia' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'galatia' ),
				'description' => esc_html__( 'Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'galatia' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'galatia' ),
					'small'              => esc_html__( 'Small', 'galatia' ),
					'large-width'        => esc_html__( 'Large Width', 'galatia' ),
					'large-height'       => esc_html__( 'Large Height', 'galatia' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'galatia' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'galatia' ),
				'options'       => galatia_edge_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'galatia' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_woocommerce_meta', 99 );
}
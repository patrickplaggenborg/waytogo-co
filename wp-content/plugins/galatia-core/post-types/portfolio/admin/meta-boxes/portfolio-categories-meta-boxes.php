<?php

if ( ! function_exists( 'galatia_edge_portfolio_category_additional_fields' ) ) {
	function galatia_edge_portfolio_category_additional_fields() {
		
		$fields = galatia_edge_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		galatia_edge_add_taxonomy_field(
			array(
				'name'   => 'edgtf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'galatia-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'galatia_edge_action_custom_taxonomy_fields', 'galatia_edge_portfolio_category_additional_fields' );
}
<?php

if ( ! function_exists( 'galatia_edge_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function galatia_edge_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'galatia' );
		
		return $templates;
	}
	
	add_filter( 'galatia_edge_filter_register_blog_templates', 'galatia_edge_register_blog_standard_template_file' );
}

if ( ! function_exists( 'galatia_edge_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function galatia_edge_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'galatia' );
		
		return $options;
	}
	
	add_filter( 'galatia_edge_filter_blog_list_type_global_option', 'galatia_edge_set_blog_standard_type_global_option' );
}
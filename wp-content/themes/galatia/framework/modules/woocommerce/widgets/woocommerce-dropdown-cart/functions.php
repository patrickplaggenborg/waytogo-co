<?php

if ( ! function_exists( 'galatia_edge_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function galatia_edge_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'galatia_edge_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function galatia_edge_get_dropdown_cart_icon_class() {
		$classes = array(
			'edgtf-header-cart'
		);
		
		$classes[] = galatia_edge_get_icon_sources_class( 'dropdown_cart', 'edgtf-header-cart' );
		
		return $classes;
	}
}
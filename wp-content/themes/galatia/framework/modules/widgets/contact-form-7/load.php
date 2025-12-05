<?php

if ( galatia_edge_contact_form_7_installed() ) {
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'galatia_edge_filter_register_widgets', 'galatia_edge_register_cf7_widget' );
}

if ( ! function_exists( 'galatia_edge_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function galatia_edge_register_cf7_widget( $widgets ) {
		$widgets[] = 'GalatiaEdgeClassContactForm7Widget';
		
		return $widgets;
	}
}
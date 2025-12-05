<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edgtf_Workflow extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edgtf_Workflow_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'galatia_core_add_workflow_shortcodes' ) ) {
	function galatia_core_add_workflow_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'GalatiaCore\CPT\Shortcodes\Workflow\Workflow',
			'GalatiaCore\CPT\Shortcodes\WorkflowItem\WorkflowItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcode', 'galatia_core_add_workflow_shortcodes' );
}

if ( ! function_exists( 'galatia_core_set_worklow_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for workflow shortcode
	 */
	function galatia_core_set_workflow_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_edgtf_worklof_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_style', 'galatia_core_set_workflow_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'galatia_core_set_workflow_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for workflow shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function galatia_core_set_workflow_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow';
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'galatia_core_filter_add_vc_shortcodes_custom_icon_class', 'galatia_core_set_workflow_icon_class_name_for_vc_shortcodes' );
}
<?php
namespace GalatiaCore\CPT\Shortcodes\FullScreenSections;

use GalatiaCore\Lib;

class FullScreenSections implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_full_screen_sections';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Full Screen Sections', 'galatia-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-full-screen-sections extended-custom-icon',
					'category'  => esc_html__( 'by GALATIA', 'galatia-core' ),
					'as_parent' => array( 'only' => 'edgtf_full_screen_sections_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_continuous_vertical',
							'heading'     => esc_html__( 'Enable Continuous Scrolling', 'galatia-core' ),
							'description' => esc_html__( 'Defines whether scrolling down in the last section or should scroll down to the first one and if scrolling up in the first section should scroll up to the last one', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Navigation Arrows', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_pagination',
							'heading'     => esc_html__( 'Enable Pagination Dots', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
                        array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_for_mobile',
							'heading'     => esc_html__( 'Disable this functionality for mobile devices', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'enable_continuous_vertical' => 'no',
			'enable_navigation'          => 'yes',
			'enable_pagination'          => 'yes',
            'disable_for_mobile'         => 'no'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );
		$params['content']        = $content;
		
		$html = galatia_core_get_shortcode_module_template_part( 'templates/full-screen-sections', 'full-screen-sections', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_navigation'] === 'yes' ? 'edgtf-fss-has-nav' : '';
		$holderClasses[] = $params['disable_for_mobile'] === 'yes' ? 'edgtf-fss-disabled-for-mobile' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$data = array();
		
		if ( ! empty( $params['enable_continuous_vertical'] ) ) {
			$data['data-enable-continuous-vertical'] = $params['enable_continuous_vertical'];
		}
		
		if ( ! empty( $params['enable_navigation'] ) ) {
			$data['data-enable-navigation'] = $params['enable_navigation'];
		}
		
		if ( ! empty( $params['enable_pagination'] ) ) {
			$data['data-enable-pagination'] = $params['enable_pagination'];
		}
		
		return $data;
	}
}

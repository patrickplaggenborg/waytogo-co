<?php
namespace GalatiaCore\CPT\Shortcodes\FullScreenSpotlightSlider;

use GalatiaCore\Lib;

class FullScreenSpotlightSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_full_screen_spotlight_slider';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Full Screen Spotlight Slider', 'galatia-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-clients-carousel extended-custom-icon',
					'category'  => esc_html__( 'by GALATIA', 'galatia-core' ),
					'as_parent' => array( 'only' => 'edgtf_full_screen_spotlight_slider_item' ),
					'js_view'   => 'VcColumnView'
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array();
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );
		$params['content']        = $content;
		
		$html = galatia_core_get_shortcode_module_template_part( 'templates/full-screen-spotlight-slider', 'full-screen-spotlight-slider', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();

		//$holderClasses[] = $params['enable_navigation'] === 'yes' ? 'edgtf-fss-has-nav' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params ) {
		$data = array();

		if ( ! empty( $params['enable_continuous_vertical'] ) ) {
			$data['data-enable-continuous-vertical'] = $params['enable_continuous_vertical'];
		}

		return $data;
	}
}

<?php
namespace GalatiaCore\CPT\Shortcodes\FullScreenSpotlightSlider;

use GalatiaCore\Lib;

class FullScreenSpotlightSliderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_full_screen_spotlight_slider_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Full Screen Spotlight Slider Item', 'galatia-core' ),
					'base'            => $this->base,
					'as_child'        => array( 'only' => 'edgtf_full_screen_spotlight_slider' ),
					'category'        => esc_html__( 'by GALATIA', 'galatia-core' ),
					'icon'            => 'icon-wpb-gallery-blocks extended-custom-icon',
					'params'          => array(
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title',
                            'heading'    => esc_html__( 'Title', 'galatia-core' ),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__( 'Title Color', 'galatia-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title_break_words',
                            'heading'     => esc_html__( 'Position of Line Break', 'galatia-core' ),
                            'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'galatia-core' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'caption',
                            'heading'    => esc_html__( 'Caption', 'galatia-core' ),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'caption_color',
                            'heading'    => esc_html__( 'Caption Title Color', 'galatia-core' ),
                            'dependency' => array( 'element' => 'caption', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__( 'Link', 'galatia-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'link_target',
                            'heading'     => esc_html__( 'Link Target', 'galatia-core' ),
                            'value'       => array_flip( galatia_edge_get_link_target_array() ),
                            'dependency' => array( 'element' => 'link', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'background_color',
                            'heading'    => esc_html__( 'Background Color', 'galatia-core' )
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'image',
                            'heading'     => esc_html__( 'Image', 'galatia-core' ),
                            'description' => esc_html__( 'Select image from media library', 'galatia-core' )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
            'title'                 => '',
            'title_break_words'     => '',
            'caption'               => '',
			'link'                  => '#',
            'background_color'      => '',
            'title_color'           => '',
            'caption_color'         => '',
            'image'                 => '',
            'link_target'           => '_self'
		);
		$params = shortcode_atts( $args, $atts );
		$rand_class = 'edgtf-fss-custom-' . mt_rand(100000,1000000);
		
		$params['holder_unique_class'] = $rand_class;
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_data']         = $this->getHolderData( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );

		$params['content'] = $content;
		
		$html = galatia_core_get_shortcode_module_template_part( 'templates/full-screen-spotlight-slider-item', 'full-screen-spotlight-slider', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['holder_unique_class'] ) ? $params['holder_unique_class'] : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'edgtf-fss-item-va-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'edgtf-fss-item-ha-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['link'] ) ? 'edgtf-fss-item-has-link' : '';
		$holderClasses[] = ! empty( $params['header_skin'] ) ? 'edgtf-fss-item-has-style' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_unique_class'];

		return $data;
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getItemInnerStyles( $params ) {
		$styles = array();
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return implode( ';', $styles );
	}
}
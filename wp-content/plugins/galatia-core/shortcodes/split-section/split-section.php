<?php
namespace GalatiaCore\CPT\Shortcodes\SplitSection;

use GalatiaCore\Lib;

class SplitSection implements Lib\ShortcodeInterface {
    private $base;
	
    public function __construct() {
        $this->base = 'edgtf_split_section';

        add_action('vc_before_init', array($this, 'vcMap'));
    }
	
    public function getBase() {
        return $this->base;
    }
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Split Section', 'galatia-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by GALATIA', 'galatia-core' ),
					'icon'     => 'icon-wpb-split-section extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'attach_image',
							'param_name' => 'image',
							'heading'    => esc_html__( 'Image', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_position',
							'heading'     => esc_html__( 'Image Position', 'galatia-core' ),
							'value'       => array(
								esc_html__( 'Left', 'galatia-core' )  => 'left',
								esc_html__( 'Right', 'galatia-core' ) => 'right'
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'content_background',
							'heading'    => esc_html__( 'Content Background Color', 'galatia-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'galatia-core' ),
							'value'       => array_flip( galatia_edge_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px or %)', 'galatia-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_text',
							'heading'    => esc_html__( 'Button Text', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'galatia-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'galatia-core' )   => 'solid',
								esc_html__( 'Outline', 'galatia-core' ) => 'outline',
								esc_html__( 'Text', 'galatia-core' )    => 'simple'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'       => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_size',
							'heading'     => esc_html__( 'Button Size', 'galatia-core' ),
							'value'       => array(
								esc_html__( 'Default', 'galatia-core' ) => '',
								esc_html__( 'Small', 'galatia-core' )   => 'small',
								esc_html__( 'Medium', 'galatia-core' )  => 'medium',
								esc_html__( 'Large', 'galatia-core' )   => 'large',
								esc_html__( 'Huge', 'galatia-core' )    => 'huge'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'       => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'galatia-core' ),
							'value'      => array_flip( galatia_edge_get_link_target_array() ),
							'dependency' => array( 'element' => 'button_link', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' ),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_background_color',
							'heading'    => esc_html__( 'Button Background Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' ),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_background_color',
							'heading'    => esc_html__( 'Button Hover Background Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_border_color',
							'heading'    => esc_html__( 'Button Border Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_border_color',
							'heading'    => esc_html__( 'Button Hover Border Color', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px or %)', 'galatia-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
							'group'      => esc_html__( 'Button Style', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'breakpoint',
							'heading'     => esc_html__( 'Responsive Breakpoint', 'galatia-core' ),
							'value'       => array(
								esc_html__( 'Never', 'galatia-core' )        => '',
								esc_html__( 'Below 1366px', 'galatia-core' ) => '1366',
								esc_html__( 'Below 1024px', 'galatia-core' ) => '1024',
								esc_html__( 'Below 768px', 'galatia-core' )  => '768',
								esc_html__( 'Below 680px', 'galatia-core' )  => '680',
								esc_html__( 'Below 480px', 'galatia-core' )  => '480'
							),
							'description' => esc_html__( 'Choose on which stage you want to break image and text content to be one under other', 'galatia-core' ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'image'                         => '',
			'image_position'                => 'left',
			'content_background'            => '',
			'title'                         => '',
			'title_tag'                     => 'h2',
			'title_color'                   => '',
			'text'                          => '',
			'text_tag'                      => 'h5',
			'text_color'                    => '',
			'text_top_margin'               => '',
			'button_text'                   => '',
			'button_type'                   => 'outline',
			'button_size'                   => 'normal',
			'button_link'                   => '',
			'button_target'                 => '_self',
			'button_color'                  => '',
			'button_hover_color'            => '',
			'button_background_color'       => '',
			'button_hover_background_color' => '',
			'button_border_color'           => '',
			'button_hover_border_color'     => '',
			'button_top_margin'             => '',
			'breakpoint'                    => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content_style']  = $this->getContentStyles( $params );
		$params['image_styles']   = $this->getImageBackgroundStyles( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $default_atts['text_tag'];
		$params['text_styles']    = $this->getTextStyles( $params );
		
		$html = galatia_core_get_shortcode_module_template_part( 'templates/split-section', 'split-section', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = 'edgtf-ss-image-' . $params['image_position'];
		$holderClasses[] = ! empty( $params['breakpoint'] ) ? 'edgtf-ss-break-' . $params['breakpoint'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getImageBackgroundStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['image'] ) ) {
			$image_src = wp_get_attachment_image_src( $params['image'], 'full' );
			
			if ( is_array( $image_src ) ) {
				$image_src = $image_src[0];
			}
			
			$styles[] = 'background-image: url(' . $image_src . ')';
		}
		
		return implode( ';', $styles );
	}
	
	private function getContentStyles($params) {
		$styles   = array();

		if(!empty($params['content_background'])) {
			$styles[] = 'background-color:'. $params['content_background'];
		}

		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		if ( $params['text_top_margin'] !== '' ) {
			if ( galatia_edge_string_ends_with( $params['text_top_margin'], '%' ) || galatia_edge_string_ends_with( $params['text_top_margin'], 'px' ) ) {
				$styles[] = 'margin-top: ' . $params['width'];
			} else {
				$styles[] = 'margin-top: ' . $params['text_top_margin'] . 'px';
			}
		}

		return implode( ';', $styles );
	}
}
<?php
namespace GalatiaCore\CPT\Shortcodes\Roadmap;

use GalatiaCore\Lib;

class Roadmap implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_roadmap';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Roadmap', 'galatia-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-roadmap extended-custom-icon',
					'category'                  => esc_html__( 'by GALATIA', 'galatia-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'galatia-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'galatia-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'galatia-core' ),
							'value'		  => array(
								esc_html__('Light', 'galatia-core') => 'light',
								esc_html__('Dark', 'galatia-core') => 'dark',
							)
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'stage',
							'heading'    => esc_html__( 'Roadmap Stage', 'galatia-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'stage_title',
									'heading'    => esc_html__( 'Stage Title', 'galatia-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'info_title',
									'heading'    => esc_html__( 'Info Title', 'galatia-core' )
								),
								array(
									'type'        => 'textarea',
									'param_name'  => 'info_text',
									'heading'     => esc_html__( 'Info Text', 'galatia-core' ),
									'description' => esc_html__( 'Select image from media library', 'galatia-core' )
								),
								array(
									'type'        => 'dropdown',
									'param_name'  => 'stage_reached',
									'heading'     => esc_html__( 'Stage Reached', 'galatia-core' ),
									'value'	      => array(
										esc_html__('No', 'galatia-core') => 'no',
										esc_html__('Yes', 'galatia-core') => 'yes'
									)
								)
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'    => '',
			'skin'			  => 'light',
			'stage'           => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['this_object']        = $this;
		$params['stage']         	  = json_decode( urldecode( $params['stage'] ), true );

		$html = galatia_core_get_shortcode_module_template_part( 'templates/roadmap-template', 'roadmap', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holder_classes = array();

		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = ! empty( $params['skin'] ) ? 'edgtf-roadmap-skin-'.esc_attr( $params['skin'] ) : 'edgtf-roadmap-skin-light';

		return implode( ' ', $holder_classes );
	}

	public function getItemAdditional( $stage_params ) {
		$additional = array();
		$additional['classes'] = 'edgtf-roadmap-item';
		$additional['style'] = '';

		if ( $stage_params['number']%2 == 0 ){
			$additional['classes'] .= ' edgtf-roadmap-item-below';
		} else {
			$additional['classes'] .= ' edgtf-roadmap-item-above';
		}

		if ($stage_params['stage_reached'] == 'yes') {
			$additional['classes'] .= ' edgtf-roadmap-reached-item';
		}

		return $additional;
	}
}
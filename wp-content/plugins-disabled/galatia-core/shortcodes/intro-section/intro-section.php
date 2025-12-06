<?php
namespace GalatiaCore\CPT\Shortcodes\IntroSection;

use GalatiaCore\Lib;

class IntroSection implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'edgtf_intro_section';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(
				array(
					'name' => esc_html__('Intro Section', 'galatia-core'),
					'base' => $this->getBase(),
					'category' => esc_html__('by GALATIA', 'galatia-core'),
					'icon' => 'icon-wpb-intro-section extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type' => 'textfield',
							'param_name' => 'title',
							'heading' => esc_html__('Title', 'galatia-core'),
							'admin_label' => true
						),
						array(
							'type' => 'textfield',
							'param_name' => 'subtitle',
							'heading' => esc_html__('Subtitle', 'galatia-core')
						),
						array(
							'type' => 'textarea',
							'param_name' => 'text',
							'heading' => esc_html__('Text', 'galatia-core')
						),
						array(
							'type' => 'textfield',
							'param_name' => 'btn_txt',
							'heading' => esc_html__('Button Text', 'galatia-core'),
						),
						array(
							'type' => 'textfield',
							'param_name' => 'link',
							'heading' => esc_html__('Button Link', 'galatia-core'),
							'admin_label' => true,
							'dependency' => array('element' => 'btn_txt', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'param_name' => 'link_target',
							'heading' => esc_html__('Button Link Target', 'galatia-core'),
							'value' => array_flip(galatia_edge_get_link_target_array()),
							'dependency' => array('element' => 'btn_txt', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'param_name' => 'alignment',
							'heading' => esc_html__('Alignment', 'galatia-core'),
							'value' => array(
								esc_html__('Top', 'galatia-core') => 'top',
								esc_html__('Center', 'galatia-core') => 'center',
								esc_html__('Bottom', 'galatia-core') => 'bottom',
							),
							'admin_label' => true,
							'group' => esc_html__('Design Options', 'galatia-core'),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'text_color',
							'heading' => esc_html__('Text Color', 'galatia-core'),
							'group' => esc_html__('Design Options', 'galatia-core'),
						),
						array(
							'type' => 'attach_image',
							'param_name' => 'bg_image',
							'heading' => esc_html__('Background Image', 'galatia-core'),
							'group' => esc_html__('Design Options', 'galatia-core'),
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'bg_image' => '',
			'title' => '',
			'subtitle' => '',
			'text' => '',
			'btn_txt' => '',
			'link' => '',
			'link_target' => '',
			'text_color' => '',
			'alignment' => 'top',
		);

		$params = shortcode_atts($args, $atts);

		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['styles'] = $this->getStyles($params);

		$html = galatia_core_get_shortcode_module_template_part('templates/intro-section', 'intro-section', '', $params);

		return $html;
	}

	private function getHolderClasses($params) {
		$holderClasses = array();

		$holderClasses[] = !empty($params['alignment']) ? 'edgtf-is-align-' . esc_attr($params['alignment']) : '';

		return implode(' ', $holderClasses);
	}

	private function getStyles($params) {
		$styles = array();

		if (!empty($params['text_color'])) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		return implode(';', $styles);
	}
}
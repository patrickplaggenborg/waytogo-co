<?php
namespace GalatiaCore\CPT\Shortcodes\Workflow;

use GalatiaCore\Lib;

class Workflow implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edgtf_workflow';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__('Workflow', 'galatia-core'),
                    'base'                      => $this->base,
                    'as_parent'                 => array('only' => 'edgtf_workflow_item'),
                    'content_element'           => true,
                    'category'                  => esc_html__('by GALATIA', 'galatia-core'),
                    'icon'                      => 'icon-wpb-workflow extended-custom-icon',
                    'show_settings_on_create'   => true,
                    'js_view'                   => 'VcColumnView',
                    'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Extra class name', 'galatia-core'),
                                'param_name' => 'custom_clas',
                                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'galatia-core')
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Workflow line color', 'galatia-core'),
                                'param_name' => 'line_color',
                                'description' => esc_html__('Pick a color for the workflow line.', 'galatia-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Animate Workflow', 'galatia-core'),
                                'param_name' => 'animate',
                                'value' => array(
                                    esc_html__('Yes', 'galatia-core') => 'yes',
                                    esc_html__('No', 'galatia-core') => 'no',
                                ),
                                'description' => esc_html__('Animate Workflow shortcode when it comes into viewport', 'galatia-core'),
                                'save_always' => true,
                            )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'custom_clas'     => '',
            'line_color'   => '',
            'circle_color' => '',
            'animate'      => 'yes',
        ));

        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['custom_clas'] = $this->getWorkflowClasses($params);
        $params['content']  = $content;
        $output             = '';

        $output .= galatia_core_get_shortcode_module_template_part('templates/workflow-holder-template', 'workflow', '', $params);

        return $output;
    }

    private function getWorkflowClasses($params) {

        $custom_clas = '';
        $class    = $params['custom_clas'];

        if($class !== '') {
            $custom_clas = $class;
        }

        if($params['animate'] == 'yes') {
            $custom_clas = 'edgtf-workflow-animate';
        }

        return $custom_clas;
    }

    private function getStyleProperties($params) {

        $style                    = array();
        $style['main_line_style'] = '';

        if($params['line_color'] !== '') {
            $style['main_line_style'] = 'background-color:'.$params['line_color'].';';
        }

        return $style;
    }
}

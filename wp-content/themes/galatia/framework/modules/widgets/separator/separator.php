<?php

if ( class_exists( 'GalatiaEdgeClassWidget' ) ) {
    class GalatiaEdgeClassSeparatorWidget extends GalatiaEdgeClassWidget
    {
        public function __construct()
        {
            parent::__construct(
                'edgtf_separator_widget',
                esc_html__('Galatia Separator Widget', 'galatia'),
                array('description' => esc_html__('Add a separator element to your widget areas', 'galatia'))
            );

            $this->setParams();
        }

        protected function setParams()
        {
            $this->params = array(
                array(
                    'type' => 'dropdown',
                    'name' => 'type',
                    'title' => esc_html__('Type', 'galatia'),
                    'options' => array(
                        'normal' => esc_html__('Normal', 'galatia'),
                        'full-width' => esc_html__('Full Width', 'galatia')
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'position',
                    'title' => esc_html__('Position', 'galatia'),
                    'options' => array(
                        'center' => esc_html__('Center', 'galatia'),
                        'left' => esc_html__('Left', 'galatia'),
                        'right' => esc_html__('Right', 'galatia')
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'border_style',
                    'title' => esc_html__('Style', 'galatia'),
                    'options' => array(
                        'solid' => esc_html__('Solid', 'galatia'),
                        'dashed' => esc_html__('Dashed', 'galatia'),
                        'dotted' => esc_html__('Dotted', 'galatia')
                    )
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'color',
                    'title' => esc_html__('Color', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'width',
                    'title' => esc_html__('Width (px or %)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'thickness',
                    'title' => esc_html__('Thickness (px)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'top_margin',
                    'title' => esc_html__('Top Margin (px or %)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'bottom_margin',
                    'title' => esc_html__('Bottom Margin (px or %)', 'galatia')
                )
            );
        }

        public function widget($args, $instance)
        {
            if (!is_array($instance)) {
                $instance = array();
            }

            //prepare variables
            $params = '';

            //is instance empty?
            if (is_array($instance) && count($instance)) {
                //generate shortcode params
                foreach ($instance as $key => $value) {
                    $params .= " $key='$value' ";
                }
            }

            echo '<div class="widget edgtf-separator-widget">';
            echo do_shortcode("[edgtf_separator $params]"); // XSS OK
            echo '</div>';
        }
    }
}
<?php

if ( class_exists( 'GalatiaEdgeClassWidget' ) ) {
    class GalatiaEdgeClassButtonWidget extends GalatiaEdgeClassWidget
    {
        public function __construct()
        {
            parent::__construct(
                'edgtf_button_widget',
                esc_html__('Galatia Button Widget', 'galatia'),
                array('description' => esc_html__('Add button element to widget areas', 'galatia'))
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
                        'solid' => esc_html__('Solid', 'galatia'),
                        'outline' => esc_html__('Outline', 'galatia'),
                        'simple' => esc_html__('Simple', 'galatia')
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'size',
                    'title' => esc_html__('Size', 'galatia'),
                    'options' => array(
                        'small' => esc_html__('Small', 'galatia'),
                        'medium' => esc_html__('Medium', 'galatia'),
                        'large' => esc_html__('Large', 'galatia'),
                        'huge' => esc_html__('Huge', 'galatia')
                    ),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'text',
                    'title' => esc_html__('Text', 'galatia'),
                    'default' => esc_html__('Button Text', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'link',
                    'title' => esc_html__('Link', 'galatia')
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'target',
                    'title' => esc_html__('Link Target', 'galatia'),
                    'options' => galatia_edge_get_link_target_array()
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'color',
                    'title' => esc_html__('Color', 'galatia')
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'hover_color',
                    'title' => esc_html__('Hover Color', 'galatia')
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'background_color',
                    'title' => esc_html__('Background Color', 'galatia'),
                    'description' => esc_html__('This option is only available for solid button type', 'galatia')
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'hover_background_color',
                    'title' => esc_html__('Hover Background Color', 'galatia'),
                    'description' => esc_html__('This option is only available for solid button type', 'galatia')
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'border_color',
                    'title' => esc_html__('Border Color', 'galatia'),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'galatia')
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'hover_border_color',
                    'title' => esc_html__('Hover Border Color', 'galatia'),
                    'description' => esc_html__('This option is only available for solid and outline button type', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'margin',
                    'title' => esc_html__('Margin', 'galatia'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'galatia')
                )
            );
        }

        public function widget($args, $instance)
        {
            $params = '';

            if (!is_array($instance)) {
                $instance = array();
            }

            // Filter out all empty params
            $instance = array_filter($instance, function ($array_value) {
                return trim($array_value) != '';
            });

            // Default values
            if (!isset($instance['text'])) {
                $instance['text'] = 'Button Text';
            }

            // Generate shortcode params
            foreach ($instance as $key => $value) {
                $params .= " $key='$value' ";
            }

            echo '<div class="widget edgtf-button-widget">';
            echo do_shortcode("[edgtf_button $params]"); // XSS OK
            echo '</div>';
        }
    }
}
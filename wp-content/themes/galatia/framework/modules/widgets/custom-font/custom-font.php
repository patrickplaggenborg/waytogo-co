<?php

if ( class_exists( 'GalatiaEdgeClassWidget' ) ) {
    class GalatiaEdgeClassCustomFontWidget extends GalatiaEdgeClassWidget
    {
        public function __construct()
        {
            parent::__construct(
                'edgtf_custom_font_widget',
                esc_html__('Galatia Custom Font Widget', 'galatia'),
                array('description' => esc_html__('Add custom font element to widget areas', 'galatia'))
            );

            $this->setParams();
        }

        protected function setParams()
        {
            $this->params = array(
                array(
                    'type' => 'textfield',
                    'name' => 'custom_class',
                    'title' => esc_html__('Custom CSS Class', 'galatia'),
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'title',
                    'title' => esc_html__('Title Text', 'galatia')
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'title_tag',
                    'title' => esc_html__('Title Tag', 'galatia'),
                    'options' => galatia_edge_get_title_tag(true, array('p' => 'p'))
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_family',
                    'title' => esc_html__('Font Family', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_size',
                    'title' => esc_html__('Font Size (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'line_height',
                    'title' => esc_html__('Line Height (px or em)', 'galatia')
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'font_weight',
                    'title' => esc_html__('Font Weight', 'galatia'),
                    'options' => galatia_edge_get_font_weight_array(true)
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'font_style',
                    'title' => esc_html__('Font Style', 'galatia'),
                    'options' => galatia_edge_get_font_style_array(true)
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'letter_spacing',
                    'title' => esc_html__('Letter Spacing (px or em)', 'galatia')
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'text_transform',
                    'title' => esc_html__('Text Transform', 'galatia'),
                    'options' => galatia_edge_get_text_transform_array(true)
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'text_decoration',
                    'title' => esc_html__('Text Decoration', 'galatia'),
                    'options' => galatia_edge_get_text_decorations(true)
                ),
                array(
                    'type' => 'colorpicker',
                    'name' => 'color',
                    'title' => esc_html__('Color', 'galatia')
                ),
                array(
                    'type' => 'dropdown',
                    'name' => 'text_align',
                    'title' => esc_html__('Text Align', 'galatia'),
                    'options' => array(
                        '' => esc_html__('Default', 'galatia'),
                        'left' => esc_html__('Left', 'galatia'),
                        'center' => esc_html__('Center', 'galatia'),
                        'right' => esc_html__('Right', 'galatia'),
                        'justify' => esc_html__('Justify', 'galatia')
                    )
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'margin',
                    'title' => esc_html__('Margin (px or %)', 'galatia'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_size_1280',
                    'title' => esc_html__('Small Laptops Font Size (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'line_height_1280',
                    'title' => esc_html__('Small Laptops Line Height (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_size_1024',
                    'title' => esc_html__('Tablets Landscape Font Size (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'line_height_1024',
                    'title' => esc_html__('Tablets Landscape Line Height (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_size_768',
                    'title' => esc_html__('Tablets Portrait Font Size (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'line_height_768',
                    'title' => esc_html__('Tablets Portrait Line Height (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'font_size_680',
                    'title' => esc_html__('Mobiles Font Size (px or em)', 'galatia')
                ),
                array(
                    'type' => 'textfield',
                    'name' => 'line_height_680',
                    'title' => esc_html__('Mobiles Line Height (px or em)', 'galatia')
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

            // Generate shortcode params
            foreach ($instance as $key => $value) {
                $params .= " $key='$value' ";
            }

            echo '<div class="widget edgtf-custom-font-widget">';
            echo do_shortcode("[edgtf_custom_font $params]"); // XSS OK
            echo '</div>';
        }
    }
}
<?php

if ( ! function_exists( 'galatia_edge_sidearea_options_map' ) ) {
	function galatia_edge_sidearea_options_map() {

        galatia_edge_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'galatia'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = galatia_edge_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'galatia'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'galatia'),
                'description'   => esc_html__('Choose a type of Side Area', 'galatia'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'galatia'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'galatia'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'galatia'),
                ),
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'galatia'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'galatia'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = galatia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'galatia'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'galatia'),
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'galatia'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'galatia'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'name'          => 'sidearea_background_image',
                'type'          => 'image',
                'label'         => esc_html__( 'Side Area Background Image', 'galatia' ),
                'description'   => esc_html__( 'Choose an image that will be displayed as background image of Side Area', 'galatia' ),
                'parent'        => $side_area_width_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'galatia'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'galatia'),
                'options'       => galatia_edge_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = galatia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'galatia'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'galatia'),
                'options'       => galatia_edge_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = galatia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'galatia'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'galatia'),
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'galatia'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'galatia'),
            )
        );

        $side_area_icon_style_group = galatia_edge_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'galatia'),
                'description' => esc_html__('Define styles for Side Area icon', 'galatia')
            )
        );

        $side_area_icon_style_row1 = galatia_edge_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'galatia')
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'galatia')
            )
        );

        $side_area_icon_style_row2 = galatia_edge_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'galatia')
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'galatia')
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'galatia'),
                'description' => esc_html__('Choose a background color for Side Area', 'galatia')
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'galatia'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'galatia'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        galatia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'galatia'),
                'description'   => esc_html__('Choose text alignment for side area', 'galatia'),
                'options'       => array(
                    ''       => esc_html__('Default', 'galatia'),
                    'left'   => esc_html__('Left', 'galatia'),
                    'center' => esc_html__('Center', 'galatia'),
                    'right'  => esc_html__('Right', 'galatia')
                )
            )
        );
    }

    add_action('galatia_edge_action_options_map', 'galatia_edge_sidearea_options_map', galatia_edge_set_options_map_position( 'sidearea' ) );
}
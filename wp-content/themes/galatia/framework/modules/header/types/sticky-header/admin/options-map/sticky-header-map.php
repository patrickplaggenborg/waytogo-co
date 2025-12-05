<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_sticky_header_options' ) ) {
	function galatia_edge_get_hide_dep_for_sticky_header_options() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_sticky_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_get_additional_hide_dep_for_sticky_header_options' ) ) {
	function galatia_edge_get_additional_hide_dep_for_sticky_header_options() {
		$additional_hide_dep_options = apply_filters( 'galatia_edge_filter_sticky_header_additional_hide_global_option', $additional_hide_dep_options = array() );
		
		return $additional_hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_header_sticky_options_map' ) ) {
	function galatia_edge_header_sticky_options_map() {
		$hide_dep_options            = galatia_edge_get_hide_dep_for_sticky_header_options();
			
		$panel_sticky_header = galatia_edge_add_admin_panel(
			array(
				'title'           => esc_html__( 'Sticky Header', 'galatia' ),
				'name'            => 'panel_sticky_header',
				'page'            => '_header_page',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'scroll_amount_for_sticky',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky', 'galatia' ),
				'description' => esc_html__( 'Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis', 'galatia' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'sticky_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Sticky Header in Grid', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will put sticky header in grid', 'galatia' ),
				'parent'        => $panel_sticky_header,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'galatia' ),
				'description' => esc_html__( 'Choose a background color for header area', 'galatia' ),
				'parent'      => $panel_sticky_header
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_header_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'galatia' ),
				'description' => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'galatia' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 1
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_header_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'galatia' ),
				'description' => esc_html__( 'Set border bottom color for header area', 'galatia' ),
				'parent'      => $panel_sticky_header
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_header_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Sticky Header Height', 'galatia' ),
				'description' => esc_html__( 'Enter height for sticky header (default is 60px)', 'galatia' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'   => 'sticky_header_side_padding',
				'type'   => 'text',
				'label'  => esc_html__( 'Sticky Header Side Padding', 'galatia' ),
				'parent' => $panel_sticky_header,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'galatia' )
				)
			)
		);
		
		$group_sticky_header_menu = galatia_edge_add_admin_group(
			array(
				'title'       => esc_html__( 'Sticky Header Menu', 'galatia' ),
				'name'        => 'group_sticky_header_menu',
				'parent'      => $panel_sticky_header,
				'description' => esc_html__( 'Define styles for sticky menu items', 'galatia' )
			)
		);
		
		$row1_sticky_header_menu = galatia_edge_add_admin_row(
			array(
				'name'   => 'row1',
				'parent' => $group_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__( 'Text Color', 'galatia' ),
				'description' => '',
				'parent'      => $row1_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'        => 'sticky_hovercolor',
				'type'        => 'colorsimple',
				'label'       => esc_html__( esc_html__( 'Hover/Active Color', 'galatia' ), 'galatia' ),
				'description' => '',
				'parent'      => $row1_sticky_header_menu
			)
		);
		
		$row2_sticky_header_menu = galatia_edge_add_admin_row(
			array(
				'name'   => 'row2',
				'parent' => $group_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'name'          => 'sticky_google_fonts',
				'type'          => 'fontsimple',
				'label'         => esc_html__( 'Font Family', 'galatia' ),
				'default_value' => '-1',
				'parent'        => $row2_sticky_header_menu,
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_font_size',
				'label'         => esc_html__( 'Font Size', 'galatia' ),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_line_height',
				'label'         => esc_html__( 'Line Height', 'galatia' ),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_text_transform',
				'label'         => esc_html__( 'Text Transform', 'galatia' ),
				'default_value' => '',
				'options'       => galatia_edge_get_text_transform_array(),
				'parent'        => $row2_sticky_header_menu
			)
		);
		
		$row3_sticky_header_menu = galatia_edge_add_admin_row(
			array(
				'name'   => 'row3',
				'parent' => $group_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'galatia' ),
				'options'       => galatia_edge_get_font_style_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'galatia' ),
				'options'       => galatia_edge_get_font_weight_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'galatia' ),
				'default_value' => '',
				'parent'        => $row3_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_header_sticky_options_map', 'galatia_edge_header_sticky_options_map', 10, 1 );
}
<?php

if ( ! function_exists( 'galatia_edge_map_general_meta' ) ) {
	function galatia_edge_map_general_meta() {
		
		$general_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'galatia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'galatia' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'galatia' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'galatia' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'galatia' ),
				'parent'        => $general_meta_box
			)
		);
		
		$edgtf_content_padding_group = galatia_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'galatia' ),
				'description' => esc_html__( 'Define styles for Content area', 'galatia' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgtf_content_padding_row = galatia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row',
					'parent' => $edgtf_content_padding_group
				)
			);
			
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'galatia' ),
						'parent'      => $edgtf_content_padding_row
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'galatia' ),
						'parent'        => $edgtf_content_padding_row
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'galatia' ),
						'options'       => galatia_edge_get_yes_no_select_array(),
						'parent'        => $edgtf_content_padding_row
					)
				);
		
			$edgtf_content_padding_row_1 = galatia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row_1',
					'next'   => true,
					'parent' => $edgtf_content_padding_group
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'galatia' ),
						'parent' => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'    => 'edgtf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'galatia' ),
						'parent'  => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'galatia' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'galatia' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'galatia' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'galatia' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'galatia' ),
					'edgtf-grid-1100' => esc_html__( '1100px', 'galatia' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'galatia' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'galatia' )
				)
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'galatia' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'galatia' ),
				'options'     => galatia_edge_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'    => 'edgtf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'galatia' ),
				'parent'  => $general_meta_box,
				'options' => galatia_edge_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = galatia_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'galatia' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'galatia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'galatia' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'galatia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'galatia' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'galatia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'galatia' ),
						'description'   => esc_html__( 'Choose background image attachment', 'galatia' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'galatia' ),
							'fixed'  => esc_html__( 'Fixed', 'galatia' ),
							'scroll' => esc_html__( 'Scroll', 'galatia' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'galatia' ),
				'parent'        => $general_meta_box,
				'options'       => galatia_edge_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = galatia_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgtf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'galatia' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'galatia' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'galatia' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'galatia' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'galatia' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'galatia' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				galatia_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'galatia' ),
						'options'       => galatia_edge_get_yes_no_select_array(),
					)
				);
		
				galatia_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'galatia' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'galatia' ),
						'options'       => galatia_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'galatia' ),
				'parent'        => $general_meta_box,
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = galatia_edge_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				galatia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'galatia' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'galatia' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => galatia_edge_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = galatia_edge_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'edgtf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					galatia_edge_create_meta_box_field(
						array(
							'name'   => 'edgtf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'galatia' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = galatia_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'galatia' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'galatia' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = galatia_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					galatia_edge_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgtf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'galatia' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'galatia' ),
								'galatia_loader'        => esc_html__( 'Galatia Loader', 'galatia' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'galatia' ),
								'pulse'                 => esc_html__( 'Pulse', 'galatia' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'galatia' ),
								'cube'                  => esc_html__( 'Cube', 'galatia' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'galatia' ),
								'stripes'               => esc_html__( 'Stripes', 'galatia' ),
								'wave'                  => esc_html__( 'Wave', 'galatia' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'galatia' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'galatia' ),
								'atom'                  => esc_html__( 'Atom', 'galatia' ),
								'clock'                 => esc_html__( 'Clock', 'galatia' ),
								'mitosis'               => esc_html__( 'Mitosis', 'galatia' ),
								'lines'                 => esc_html__( 'Lines', 'galatia' ),
								'fussion'               => esc_html__( 'Fussion', 'galatia' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'galatia' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'galatia' )
							)
						)
					);

					galatia_edge_create_meta_box_field(
						array(
							'type'          => 'imagesimple',
							'name'          => 'edgtf_loader_front_image_meta',
							'label'         => esc_html__( 'Loader Front Image', 'galatia' ),
							'default_value' => '',
							'parent'        => $row_pt_spinner_animation_meta,
							'dependency'    => array(
								'show' => array(
									'edgtf_smooth_pt_spinner_type_meta' => 'galatia_loader'
								)
							)
						)
					);

					galatia_edge_create_meta_box_field(
						array(
							'type'          => 'imagesimple',
							'name'          => 'edgtf_loader_image_meta',
							'default_value' => '',
							'label'         => esc_html__('Loader Back Image', 'galatia'),
							'parent'        => $row_pt_spinner_animation_meta,
							'dependency'    => array(
								'show' => array(
									'edgtf_smooth_pt_spinner_type_meta' => 'galatia_loader'
								)
							)
						)
					);
					
					galatia_edge_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgtf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'galatia' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					galatia_edge_create_meta_box_field(
						array(
							'name'        => 'edgtf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'galatia' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'galatia' ),
							'options'     => galatia_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'galatia' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'galatia' ),
				'parent'      => $general_meta_box,
				'options'     => galatia_edge_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_general_meta', 10 );
}

if ( ! function_exists( 'galatia_edge_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function galatia_edge_container_background_style( $style ) {
		$page_id      = galatia_edge_get_page_id();
		$class_prefix = galatia_edge_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .edgtf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'edgtf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'edgtf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'edgtf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = galatia_edge_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'galatia_edge_filter_add_page_custom_style', 'galatia_edge_container_background_style' );
}
<?php

/*** Post Settings ***/

if ( ! function_exists( 'galatia_edge_map_post_meta' ) ) {
	function galatia_edge_map_post_meta() {
		
		$post_meta_box = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'galatia' ),
				'name'  => 'post-meta'
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'galatia' ),
				'parent'        => $post_meta_box,
				'options'       => galatia_edge_get_yes_no_select_array()
			)
		);
		
		galatia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'galatia' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'galatia' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => galatia_edge_get_custom_sidebars_options( true )
			)
		);
		
		$galatia_custom_sidebars = galatia_edge_get_custom_sidebars();
		if ( count( $galatia_custom_sidebars ) > 0 ) {
			galatia_edge_create_meta_box_field( array(
				'name'        => 'edgtf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'galatia' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'galatia' ),
				'parent'      => $post_meta_box,
				'options'     => galatia_edge_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'galatia' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list shortcode. If not uploaded, featured image will be shown.', 'galatia' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('galatia_edge_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_edge_map_post_meta', 20 );
}

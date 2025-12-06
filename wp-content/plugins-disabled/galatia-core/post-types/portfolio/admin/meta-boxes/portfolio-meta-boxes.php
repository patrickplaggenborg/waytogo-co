<?php

if ( ! function_exists( 'galatia_core_map_portfolio_meta' ) ) {
	function galatia_core_map_portfolio_meta() {
		global $galatia_edge_global_Framework;
		
		$galatia_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$galatia_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$galatia_portfolio_images = new GalatiaEdgeClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'galatia-core' ), '', '', 'portfolio_images' );
		$galatia_edge_global_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images', $galatia_portfolio_images );
		
		$galatia_portfolio_image_gallery = new GalatiaEdgeClassMultipleImages( 'edgtf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'galatia-core' ), esc_html__( 'Choose your portfolio images', 'galatia-core' ) );
		$galatia_portfolio_images->addChild( 'edgtf-portfolio-image-gallery', $galatia_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$galatia_portfolio_images_videos = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'galatia-core' ),
				'name'  => 'edgtf_portfolio_images_videos'
			)
		);
		galatia_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_single_upload',
				'parent'      => $galatia_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'galatia-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'galatia-core' ),
						'options' => array(
							'image' => esc_html__('Image','galatia-core'),
							'video' => esc_html__('Video','galatia-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'galatia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'galatia-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'galatia-core'),
							'vimeo' => esc_html__('Vimeo', 'galatia-core'),
							'self' => esc_html__('Self Hosted', 'galatia-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'galatia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'galatia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'galatia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$galatia_additional_sidebar_items = galatia_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'galatia-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		galatia_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_properties',
				'parent'      => $galatia_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'galatia-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'galatia-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'galatia-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'galatia-core' )
					)
				)
			)
		);
	}
	
	add_action( 'galatia_edge_action_meta_boxes_map', 'galatia_core_map_portfolio_meta', 40 );
}
<?php

if ( ! function_exists( 'galatia_edge_social_options_map' ) ) {
	function galatia_edge_social_options_map() {

	    $page = '_social_page';
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'galatia' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = galatia_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'galatia' ),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = galatia_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'galatia' ),
				'dependency' => array(
					'show' => array(
						'enable_social_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'galatia' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'galatia' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'galatia' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'galatia' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('galatia_edge_action_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = galatia_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'galatia' ),
				'dependency' => array(
					'hide' => array(
						'enable_social_share'  => 'no'
					)
				)
			)
		);
		
		/**
		 * Facebook
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_facebook_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_twitter_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'galatia' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		/**
		 * Google Plus
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_google_plus_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_google_plus_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_google_plus_container
			)
		);
		
		/**
		 * Linked In
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_linkedin_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_tumblr_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_pinterest_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		galatia_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'galatia' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_vk_share'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'galatia' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'GALATIA_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = galatia_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'galatia' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			galatia_edge_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'GALATIA_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = galatia_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'galatia' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			galatia_edge_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = galatia_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'galatia' ),
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'galatia' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'galatia' ),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = galatia_edge_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'parent'          => $panel_open_graph,
				'dependency' => array(
					'show' => array(
						'enable_open_graph'  => 'yes'
					)
				)
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => EDGE_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'galatia' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'galatia' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('galatia_edge_action_social_options', $page);
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_social_options_map', galatia_edge_set_options_map_position( 'social' ) );
}
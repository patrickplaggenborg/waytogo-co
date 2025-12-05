<?php

if ( ! function_exists( 'galatia_edge_include_mobile_header_menu' ) ) {
	function galatia_edge_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'galatia' );
		
		return $menus;
	}
	
	add_filter( 'galatia_edge_filter_register_headers_menu', 'galatia_edge_include_mobile_header_menu' );
}

if ( ! function_exists( 'galatia_edge_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function galatia_edge_register_mobile_header_areas() {
		if ( galatia_edge_is_responsive_on() && galatia_edge_core_plugin_installed() ) {
			register_sidebar(
				array(
					'id'            => 'edgtf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'galatia' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side on mobile header', 'galatia' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'galatia_edge_register_mobile_header_areas' );
}

if ( ! function_exists( 'galatia_edge_mobile_header_class' ) ) {
	function galatia_edge_mobile_header_class( $classes ) {
		$classes[] = 'edgtf-default-mobile-header edgtf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'galatia_edge_mobile_header_class' );
}

if ( ! function_exists( 'galatia_edge_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function galatia_edge_get_mobile_header( $slug = '', $module = '' ) {
		if ( galatia_edge_is_responsive_on() ) {
			$mobile_menu_title = galatia_edge_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => galatia_edge_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('galatia_edge_filter_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('galatia_edge_filter_mobile_menu_slug', '');
            $parameters = apply_filters('galatia_edge_filter_mobile_menu_parameters', $parameters);

            galatia_edge_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'galatia_edge_action_after_wrapper_inner', 'galatia_edge_get_mobile_header', 20 );
}

if ( ! function_exists( 'galatia_edge_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function galatia_edge_get_mobile_logo() {
		$show_logo_image = galatia_edge_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$page_id       = galatia_edge_get_page_id();
			$header_height = galatia_edge_set_default_mobile_menu_height_for_header_types();
			
			$mobile_logo_image = galatia_edge_get_meta_field_intersect( 'logo_image_mobile', $page_id );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : galatia_edge_get_meta_field_intersect( 'logo_image', $page_id );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = galatia_edge_get_image_dimensions( $logo_image );
			
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			} else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
				$logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_styles'     => $logo_styles
			);
			
			galatia_edge_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'galatia_edge_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function galatia_edge_get_mobile_nav() {
		galatia_edge_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'galatia_edge_mobile_header_per_page_js_var' ) ) {
    function galatia_edge_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['edgtfMobileHeaderHeight'] = galatia_edge_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'galatia_edge_filter_per_page_js_vars', 'galatia_edge_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'galatia_edge_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function galatia_edge_get_mobile_navigation_icon_class() {
		$classes = array(
			'edgtf-mobile-menu-opener'
		);
		
		$classes[] = galatia_edge_get_icon_sources_class( 'mobile', 'edgtf-mobile-menu-opener' );

		return $classes;
	}
}
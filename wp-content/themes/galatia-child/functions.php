<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'galatia_edge_child_theme_enqueue_scripts' ) ) {
	function galatia_edge_child_theme_enqueue_scripts() {
		$parent_style = 'galatia-edge-default-style';

		wp_enqueue_style( 'galatia-edge-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'galatia_edge_child_theme_enqueue_scripts' );
}

if ( ! function_exists( 'display_portfolio_archive_title' ) ) {
    /**
     * Function that changes the portfolio category title according to the portfolio category name
     */
    function display_portfolio_archive_title( $title ) {

        if( is_tax( 'portfolio-category' ) ) {
            global $wp_query;
 
            //get current taxonomy and it's name and assign to title
            $tax      = $wp_query->get_queried_object();
            $category_title = $tax->name;
            $title      = $category_title;
        }    
 
        return $title;
 
    }
    add_filter( 'galatia_edge_filter_title_text', 'display_portfolio_archive_title' );
}
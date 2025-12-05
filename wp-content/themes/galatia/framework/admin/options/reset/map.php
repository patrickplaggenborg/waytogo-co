<?php

if ( ! function_exists( 'galatia_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function galatia_edge_reset_options_map() {
		
		galatia_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'galatia' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = galatia_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'galatia' )
			)
		);
		
		galatia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'galatia' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'galatia' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'galatia_edge_action_options_map', 'galatia_edge_reset_options_map', galatia_edge_set_options_map_position( 'reset' ) );
}
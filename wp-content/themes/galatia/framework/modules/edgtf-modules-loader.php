<?php

if ( ! function_exists( 'galatia_edge_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to galatia_edge_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function galatia_edge_load_modules() {
		foreach ( glob( EDGE_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'galatia_edge_action_before_options_map', 'galatia_edge_load_modules' );
}
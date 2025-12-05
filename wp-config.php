<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'ptrck_wp3' );

/** MySQL database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') ?: 'ptrck_wp3' );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: 'X@q~XX0MK[~AsQP9ZZ,51..7' );

/** MySQL hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'localhost' );

/**
 * Database SSL Configuration
 * Required because the database server has require_secure_transport=ON
 */
define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Debug: Log database configuration to stderr (Coolify logs)
 * This helps verify environment variables are being read correctly
 */
error_log('=== WordPress Database Configuration ===');
error_log('DB_HOST: ' . DB_HOST);
error_log('DB_NAME: ' . DB_NAME);
error_log('DB_USER: ' . DB_USER);
error_log('DB_PASSWORD: ' . (DB_PASSWORD ? '[SET - ' . strlen(DB_PASSWORD) . ' chars]' : '[NOT SET]'));
error_log('========================================');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'LvTf2BBxK4OIeWF351rCoLKqoM4yBHwnU3QtG3aljeODV3pfgSUM4ZMYaDV1QgnR');
define('SECURE_AUTH_KEY',  'cXl4i9VznxxDpakavUMpJmxHqC5I4bXpEvVtN3fmlhzaCsiKB776L5b4QjKfvxfp');
define('LOGGED_IN_KEY',    'QwowxyEbT7m1iv20PWMI27MCAJdYvZ6aKzGqNLugMwvmE93TB82zz8osVaiVc3Ct');
define('NONCE_KEY',        'uMqRCOwO4iWgSMyMJvMtZPpXu9qKNn9tPb63jqqK2B7biRLRr1SlBTRyNmbxqiqg');
define('AUTH_SALT',        'tdu5cDjkyV9ya2dgwqF5btZCNcponz6RSbB2pVyeBbCPWbpVC3alBlNTrbDpU3eB');
define('SECURE_AUTH_SALT', '9Rd8Q2jz6CGyhigohxQTsRBwZGisX2j7q4nBl5vv2boaksKTXU0g3haePbyVSRwa');
define('LOGGED_IN_SALT',   'Z3JAHu22aPIquMj9bX3IzB2ALITiP5vytOWrdP7SfpIo7D1ZNSsNeZeMFxcoQPZm');
define('NONCE_SALT',       'iutL8OrIwlPS1rzRaPtJ9XFDkZnPobIJCsnnJ17t6XqoUidy2DIhygUieHqcEPbe');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', filter_var(getenv('WORDPRESS_DEBUG'), FILTER_VALIDATE_BOOLEAN) ?: false);

/**
 * WordPress Debug Logging
 * 
 * WP_DEBUG_LOG - Log errors to wp-content/debug.log (default: true for logging)
 * WP_DEBUG_DISPLAY - Display errors on screen (default: false to hide in browser)
 * SAVEQUERIES - Save database queries for analysis (default: false)
 */
define('WP_DEBUG_LOG', filter_var(getenv('WORDPRESS_DEBUG_LOG'), FILTER_VALIDATE_BOOLEAN) ?: true);
define('WP_DEBUG_DISPLAY', filter_var(getenv('WORDPRESS_DEBUG_DISPLAY'), FILTER_VALIDATE_BOOLEAN) ?: false);
@ini_set('display_errors', 0);
@ini_set('display_startup_errors', 0);

/**
 * Save database queries for analysis (optional, can impact performance)
 */
define('SAVEQUERIES', filter_var(getenv('WORDPRESS_SAVEQUERIES'), FILTER_VALIDATE_BOOLEAN) ?: false);

/**
 * Configure PHP error logging to stderr (captured by Coolify/Docker logs)
 * This ensures errors appear in Coolify service logs
 */
@ini_set('log_errors', 1);
@ini_set('error_log', 'php://stderr');

/**
 * Custom error handler to log WordPress errors to stderr (Coolify logs)
 * This runs before WordPress loads, so we can catch early errors too
 */
if (WP_DEBUG || WP_DEBUG_LOG) {
	set_error_handler(function($errno, $errstr, $errfile, $errline) {
		// Log to stderr (Coolify logs)
		$error_types = array(
			E_ERROR => 'ERROR',
			E_WARNING => 'WARNING',
			E_PARSE => 'PARSE',
			E_NOTICE => 'NOTICE',
			E_CORE_ERROR => 'CORE_ERROR',
			E_CORE_WARNING => 'CORE_WARNING',
			E_COMPILE_ERROR => 'COMPILE_ERROR',
			E_COMPILE_WARNING => 'COMPILE_WARNING',
			E_USER_ERROR => 'USER_ERROR',
			E_USER_WARNING => 'USER_WARNING',
			E_USER_NOTICE => 'USER_NOTICE',
			E_STRICT => 'STRICT',
			E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
			E_DEPRECATED => 'DEPRECATED',
			E_USER_DEPRECATED => 'USER_DEPRECATED'
		);
		$error_type = isset($error_types[$errno]) ? $error_types[$errno] : 'UNKNOWN';
		$message = sprintf('[WordPress %s] %s in %s on line %d', $error_type, $errstr, $errfile, $errline);
		error_log($message);
		// Continue with default error handling
		return false;
	}, E_ALL);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
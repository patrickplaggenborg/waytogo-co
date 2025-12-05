<?php

/*
   Class: GalatiaEdgeClassFramework
   A class that initializes Edge Framework
*/

class GalatiaEdgeClassFramework {
	private static $instance;
	public $edgtOptions;
	public $edgtMetaBoxes;
	public $edgtTaxonomyOptions;
	public $edgtUserOptions;
	private $skin;

	private function __construct() {
		$this->edgtOptions          = GalatiaEdgeClassOptions::get_instance();
		$this->edgtMetaBoxes        = GalatiaEdgeClassMetaBoxes::get_instance();
		$this->edgtTaxonomyOptions  = GalatiaEdgeClassTaxonomyOptions::get_instance();
		$this->edgtUserOptions      = GalatiaEdgeClassUserOptions::get_instance();
		$this->edgtDashboardOptions = GalatiaEdgeClassDashboardOptions::get_instance();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function getSkin() {
		return $this->skin;
	}

	public function setSkin( GalatiaEdgeClassSkinAbstract $skinObject ) {
		$this->skin = $skinObject;
	}
}

/**
 * Class GalatiaEdgeClassSkinManager
 *
 * Class that used like a factory for skins.
 * It loads required skin file and instantiates skin class
 */
class GalatiaEdgeClassSkinManager {
	/**
	 * @var this will be an instance of skin
	 */
	private $skin;

	/**
	 * @see GalatiaEdgeClassSkinManager::setSkin()
	 */
	public function __construct() {
		$this->setSkin();
	}

	/**
	 * Loads wanted skin, instantiates skin class and stores it in $skin attribute
	 *
	 * @param string $skinName skin to load. Must match skin folder name
	 */
	private function setSkin( $skinName = EDGE_PROFILE_SLUG ) {
		if ( $skinName !== '' ) {
			if ( file_exists( get_template_directory() . '/framework/admin/skins/' . $skinName . '/skin.php' ) ) {
				require_once get_template_directory() . '/framework/admin/skins/' . $skinName . '/skin.php';

				$this->skin = new GalatiaEdgeSkin();
			}
		} else {
			$this->skin = false;
		}
	}

	/**
	 * Returns current skin object. It $skin attribute isn't set it calls setSkin method
	 *
	 * @return mixed
	 *
	 * @see GalatiaEdgeClassSkinManager::setSkin()
	 */
	public function getSkin() {
		if ( empty( $this->skin ) ) {
			$this->setSkin();
		}

		return $this->skin;
	}
}

/**
 * Class GalatiaEdgeClassSkinAbstract
 *
 * Abstract class that each skin class must extend
 */
abstract class GalatiaEdgeClassSkinAbstract {
	/**
	 * @var string
	 */
	protected $skinName;
	/**
	 * @var array of styles that skin will be including
	 */
	protected $styles;
	/**
	 * @var array of scripts that skin will be including
	 */
	protected $scripts;
	/**
	 * @var array of icons names for each menu item that theme is adding
	 */
	protected $icons;
	/**
	 * @var array of menu items positions of each menu item that theme is adding
	 */
	protected $itemPosition;

	/**
	 * Returns skin name attribute whenever skin is used in concatenation
	 * @return mixed
	 */
	public function __toString() {
		return $this->skinName;
	}

	/**
	 * @return mixed
	 */
	public function getSkinName() {
		return $this->skinName;
	}

	/**
	 * Loads template part with params. Uses locate_template function which is child theme friendly
	 *
	 * @param $template string template to load
	 * @param array $params parameters to pass to template
	 */
	public function loadTemplatePart( $template, $params = array() ) {
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( $template !== '' ) {
			include( galatia_edge_find_template_path( 'framework/admin/skins/' . $this->skinName . '/templates/' . $template . '.php' ) );
		}
	}

	/**
	 * Goes through each added scripts and enqueus it
	 */
	public function enqueueScripts() {
		if ( is_array( $this->scripts ) && count( $this->scripts ) ) {
			foreach ( $this->scripts as $scriptHandle => $scriptPath ) {
				wp_enqueue_script( $scriptHandle );
			}
		}
	}

	/**
	 * Goes through each added styles and enqueus it
	 */
	public function enqueueStyles() {
		if ( is_array( $this->styles ) && count( $this->styles ) ) {
			foreach ( $this->styles as $styleHandle => $stylePath ) {
				wp_enqueue_style( $styleHandle );
			}
		}
	}

	/**
	 * Echoes script tag that generates global variable that will be used in TinyMCE
	 */
	public function setShortcodeJSParams() { ?>
        <script>
            window.edgtSCIcon = '<?php echo galatia_edge_get_skin_uri() . '/assets/img/admin-logo-icon.png'; ?>';
            window.edgtSCLabel = '<?php echo esc_html( ucfirst( $this->skinName ) ); ?> <?php esc_html_e( 'Shortcodes', 'galatia' ) ?>';
        </script>
	<?php }

	/**
	 * Formates skin name so it can be used in concatenation
	 * @return string
	 */
	public function getSkinLabel() {
		return ucfirst( $this->skinName );
	}

	/**
	 * Returns URI to skin folder
	 * @return string
	 */
	public function getSkinURI() {
		return get_template_directory_uri() . '/framework/admin/skins/' . $this->skinName;
	}

	/**
	 * Here options page content will be generated
	 * @return mixed
	 */
	public abstract function renderOptions();

	/**
	 * Here backup options page will be generated
	 * @return mixed
	 */
	public abstract function renderBackupOptions();

	/**
	 * Here import page will be generated
	 * @return mixed
	 */
	public abstract function renderImport();

	/**
	 * Here all scripts will be registered
	 * @return mixed
	 */
	public abstract function registerScripts();

	/**
	 * Here all styles will be registered
	 * @return mixed
	 */
	public abstract function registerStyles();
}

/*
   Class: GalatiaEdgeClassOptions
   A class that initializes Edge Options
*/

class GalatiaEdgeClassOptions {
	private static $instance;
	public $adminPages;
	public $options;
	public $optionsByType;

	private function __construct() {
		$this->adminPages    = array();
		$this->options       = array();
		$this->optionsByType = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function addAdminPage( $key, $page ) {
		$this->adminPages[ $key ] = $page;
	}

	public function getAdminPage( $key ) {
		return $this->adminPages[ $key ];
	}

	public function adminPageExists( $key ) {
		return array_key_exists( $key, $this->adminPages );
	}

	public function getAdminPageFromSlug( $slug ) {
		foreach ( $this->adminPages as $key => $page ) {
			if ( $page->slug == $slug ) {
				return $page;
			}
		}

		return;
	}

	public function addOption( $key, $value, $type = '' ) {
		$this->options[ $key ] = $value;

		$this->addOptionByType( $type, $key );
	}

	public function getOption( $key ) {
		if ( isset( $this->options[ $key ] ) ) {
			return $this->options[ $key ];
		}

		return;
	}

	public function addOptionByType( $type, $key ) {
		$this->optionsByType[ $type ][] = $key;
	}

	public function getOptionsByType( $type ) {
		if ( array_key_exists( $type, $this->optionsByType ) ) {
			return $this->optionsByType[ $type ];
		}

		return false;
	}

	public function getOptionValue( $key ) {
		global $galatia_edge_global_options;

		if ( array_key_exists( $key, $galatia_edge_global_options ) ) {
			return $galatia_edge_global_options[ $key ];
		} elseif ( array_key_exists( $key, $this->options ) ) {
			return $this->getOption( $key );
		}

		return false;
	}
}

/*
   Class: GalatiaEdgeClassAdminPage
   A class that initializes Edge Admin Page
*/

class GalatiaEdgeClassAdminPage implements iGalatiaEdgeInterfaceLayoutNode {
	public $layout;
	private $factory;
	public $slug;
	public $title;
	public $icon;

	function __construct( $slug = "", $title_label = "", $icon = "" ) {
		$this->layout  = array();
		$this->factory = new GalatiaEdgeClassFieldFactory();
		$this->slug    = $slug;
		$this->title   = $title_label;
		$this->icon    = $icon;
	}

	public function hasChidren() {
		return ( count( $this->layout ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->layout[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->layout[ $key ] = $value;
	}

	function render() {
		foreach ( $this->layout as $child ) {
			$this->renderChild( $child );
		}
	}

	public function renderChild( iGalatiaEdgeInterfaceRender $child ) {
		$child->render( $this->factory );
	}
}

/*
   Class: GalatiaEdgeClassMetaBoxes
   A class that initializes Edge Meta Boxes
*/

class GalatiaEdgeClassMetaBoxes {
	private static $instance;
	public $metaBoxes;
	public $options;
	public $optionsByType;

	private function __construct() {
		$this->metaBoxes     = array();
		$this->options       = array();
		$this->optionsByType = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function addMetaBox( $key, $box ) {
		$this->metaBoxes[ $key ] = $box;
	}

	public function getMetaBox( $key ) {
		return $this->metaBoxes[ $key ];
	}

	public function addOption( $key, $value, $type = '' ) {
		$this->options[ $key ] = $value;
		$this->addOptionByType( $type, $key );
	}

	public function getOption( $key ) {
		if ( isset( $this->options[ $key ] ) ) {
			return $this->options[ $key ];
		}

		return;
	}

	public function addOptionByType( $type, $key ) {
		$this->optionsByType[ $type ][] = $key;
	}

	public function getOptionsByType( $type ) {

		if ( array_key_exists( $type, $this->optionsByType ) ) {
			return $this->optionsByType[ $type ];
		}

		return array();
	}

	public function getMetaBoxesByScope( $scope ) {
		$boxes = array();

		if ( is_array( $this->metaBoxes ) && count( $this->metaBoxes ) ) {
			foreach ( $this->metaBoxes as $metabox ) {
				if ( is_array( $metabox->scope ) && in_array( $scope, $metabox->scope ) ) {
					$boxes[] = $metabox;
				} elseif ( $metabox->scope !== '' && $metabox->scope === $scope ) {
					$boxes[] = $metabox;
				}
			}
		}

		return $boxes;
	}
}

/*
   Class: GalatiaEdgeClassMetaBox
   A class that initializes Edge Meta Box
*/

class GalatiaEdgeClassMetaBox implements iGalatiaEdgeInterfaceLayoutNode {
	public $layout;
	private $factory;
	public $scope;
	public $title;
	public $hidden_property;
	public $hidden_values = array();
	public $name;

	function __construct( $scope = "", $title_label = "", $hidden_property = "", $hidden_values = array(), $name = '' ) {
		$this->layout          = array();
		$this->factory         = new GalatiaEdgeClassFieldFactory();
		$this->scope           = $scope;
		$this->title           = $this->setTitle( $title_label );
		$this->hidden_property = $hidden_property;
		$this->hidden_values   = $hidden_values;
		$this->name            = $name;
	}

	public function hasChidren() {
		return ( count( $this->layout ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->layout[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->layout[ $key ] = $value;
	}

	function render() {
		foreach ( $this->layout as $child ) {
			$this->renderChild( $child );
		}
	}

	public function renderChild( iGalatiaEdgeInterfaceRender $child ) {
		$child->render( $this->factory );
	}

	public function setTitle( $label ) {
		global $galatia_edge_global_Framework;

		return $galatia_edge_global_Framework->getSkin()->getSkinLabel() . ' ' . $label;
	}
}

/*
   Class: GalatiaEdgeClassTaxonomyOptions
   A class that initializes GalatiaEdgeClass Taxonomy Options
*/

class GalatiaEdgeClassTaxonomyOptions {
	private static $instance;
	public $taxonomyOptions;

	private function __construct() {
		$this->taxonomyOptions = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function addTaxonomyOptions( $key, $options ) {
		$this->taxonomyOptions[ $key ] = $options;
	}

	public function getTaxonomyOptions( $key ) {
		return $this->taxonomyOptions[ $key ];
	}
}

/*
   Class: GalatiaEdgeClassTaxonomyOption
   A class that initializes GalatiaEdgeClass Taxonomy Option
*/

class GalatiaEdgeClassTaxonomyOption implements iGalatiaEdgeInterfaceLayoutNode {
	public $layout;
	private $factory;
	public $scope;

	function __construct( $scope = "" ) {
		$this->layout  = array();
		$this->factory = new GalatiaEdgeClassTaxonomyFieldFactory();
		$this->scope   = $scope;
	}

	public function hasChidren() {
		return ( count( $this->layout ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->layout[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->layout[ $key ] = $value;
	}

	function render() {
		foreach ( $this->layout as $child ) {
			$this->renderChild( $child );
		}
	}

	public function renderChild( iGalatiaEdgeInterfaceRender $child ) {
		$child->render( $this->factory );
	}
}

/*
   Class: GalatiaEdgeClassUserOptions
   A class that initializes GalatiaEdgeClass User Options
*/

class GalatiaEdgeClassUserOptions {
	private static $instance;
	public $userOptions;

	private function __construct() {
		$this->userOptions = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function addUserOptions( $key, $options ) {
		$this->userOptions[ $key ] = $options;
	}

	public function getUserOptions( $key ) {
		return $this->userOptions[ $key ];
	}
}

/*
   Class: GalatiaEdgeClassUserOption
   A class that initializes GalatiaEdgeClass User Option
*/

class GalatiaEdgeClassUserOption implements iGalatiaEdgeInterfaceLayoutNode {
	public $layout;
	private $factory;
	public $scope;

	function __construct( $scope = "" ) {
		$this->layout  = array();
		$this->factory = new GalatiaEdgeClassUserFieldFactory();
		$this->scope   = $scope;
	}

	public function hasChidren() {
		return ( count( $this->layout ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->layout[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->layout[ $key ] = $value;
	}

	function render() {
		foreach ( $this->layout as $child ) {
			$this->renderChild( $child );
		}
	}

	public function renderChild( iGalatiaEdgeInterfaceRender $child ) {
		$child->render( $this->factory );
	}
}

/*
   Class: GalatiaEdgeClassDashboardOptions
   A class that initializes GalatiaEdgeClass Dashboard Options
*/

class GalatiaEdgeClassDashboardOptions {
	private static $instance;
	public $dashboardOptions;

	private function __construct() {
		$this->dashboardOptions = array();
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function addDashboardOptions( $key, $options ) {
		$this->dashboardOptions[ $key ] = $options;
	}

	public function getDashboardOptions( $key ) {
		return $this->dashboardOptions[ $key ];
	}
}

/*
   Class: GalatiaEdgeClassDashboardOption
   A class that initializes GalatiaEdgeClass Dashboard Option
*/

class GalatiaEdgeClassDashboardOption implements iGalatiaEdgeInterfaceLayoutNode {
	public $layout;
	private $factory;

	function __construct() {
		$this->layout  = array();
		$this->factory = new GalatiaEdgeClassDashboardFieldFactory();
	}

	public function hasChidren() {
		return ( count( $this->layout ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->layout[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->layout[ $key ] = $value;
	}

	function render() {
		foreach ( $this->layout as $child ) {
			$this->renderChild( $child );
		}
	}

	public function renderChild( iGalatiaEdgeInterfaceRender $child ) {
		$child->render( $this->factory );
	}
}

if ( ! function_exists( 'galatia_edge_init_framework_variable' ) ) {
	function galatia_edge_init_framework_variable() {
		global $galatia_edge_global_Framework;

		$galatia_edge_global_Framework = GalatiaEdgeClassFramework::get_instance();
		$edgtSkinManager               = new GalatiaEdgeClassSkinManager();
		$galatia_edge_global_Framework->setSkin( $edgtSkinManager->getSkin() );
	}

	add_action( 'galatia_edge_action_before_options_map', 'galatia_edge_init_framework_variable' );
}
?>
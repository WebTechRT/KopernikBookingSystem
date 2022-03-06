<?php 

defined( 'ABSPATH' ) || exit;

class KOPERNIK_Loader {

	public function __construct() {

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->includes();

		if ( is_admin() ) {
			$this->includes_admin();
		} else {
			$this->includes_frontend();
		}
	}

	public function autoload( $class ) {
		$class = strtolower( $class );

		$path    = null;
		$fileize = str_replace( '_', '.', $class );
		$file    = 'class.' . $fileize . '.php';

		if ( strpos( $class, 'kopernik_' ) === 0 ) {
			$path = KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR . '/includes/';
		}

		if ( $path && is_readable( $path . $file ) ) {
			require_once $path . $file;
			return;
		}
	}

	public function includes() {
		// Functions.
		require_once KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR . 'includes/kopernik.functions.core.php';

		//Classes
		require_once KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR . 'includes/admin/class.kopernik.admin.menu.php';
    }
	
	public function includes_admin() {
		// new KOPERNIK_Admin_Menu();
		
		function my_admin_scripts() {
			wp_enqueue_script( 'jquery');
		}
		add_action('admin_enqueue_scripts', 'my_admin_scripts');
			
    }

	public function includes_frontend() {
		function my_public_scripts() {
			//
		}
		add_action('wp_enqueue_scripts', 'my_public_scripts');
    }
}

return new KOPERNIK_Loader();
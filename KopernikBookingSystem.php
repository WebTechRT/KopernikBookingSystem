<?php
/**
 * Main KopernikBookingSystem class
 *
 * @package KopernikBookingSystem/Main
 *
 * @since 1.0.0
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

final class KopernikBookingSystem {
 
    /**
	 * KopernikBookingSystem Plugin Version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	protected static $_instance = null;

    /**
	 * Main (Singleton) Instance of KopernikBookingSystem
	 *
	 * @see      kopernik_booking_system()
	 * @return   KopernikBookingSystem - Main instance
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public static function instance(){
		if(is_null( self::$_instance )){
			self::$_instance = new self();
		}

		return self::$_instance;
	}

     /**
	 * KopernikBookingSystem private constructor.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function __construct() {

		require_once KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR . 'includes/class-kopernik-loader.php';

		//define constants during initializing main class		
        $this->define_constants();
    }

    private function define_constants() {
        kopernik_constant_definer('KOPERNIK_VERSION', $this->version);
    }
}
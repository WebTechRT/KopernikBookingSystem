<?php
/**
 * Main Kopernik Booking System file
 * 
 * @package KopernikBookingSystem/Main
 * 
 * @since 1.0.0
 * @version 1.0.0
 * 
 * Plugin Name: Kopernik Booking System
 * Description: System do rezerwacji
 * Version: 1.0.0
 * Author: Radosław Trędowski & Waldemar Graban
 * Licence GPLv3
 * Licence URI: https://www.gnui.org/lincenes/gppl-3.0.html
 * Requires at least: 5.3
 * Tested up to: 5.7
 * Requires PHP: 7.2
 */

//plugin prefix = wtrtkbs

//For security. It is not possible to run php files outside of wordpress env.
defined('ABSPATH') || exit;

if(!defined('KOPERNIK_BOOKING_SYSTEM_PLUGIN_FILE')) {
    define('KOPERNIK_BOOKING_SYSTEM_PLUGIN_FILE', __FILE__);
}

if(!defined('KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR')) {
    define('KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR', dirname(__FILE__) . '/');
}

if(! class_exists('KopernikBookingSystem')) {
    require_once KOPERNIK_BOOKING_SYSTEM_PLUGIN_DIR . 'KopernikBookingSystem.php';
}


function kopernik_plugin_activate() {
    
   global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = 'wtrtkbs_reservation';

    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    start_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    stop_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name tinytext NOT NULL,
    lastname tinytext NOT NULL,
    mail text NOT NULL,
    phone text NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  
}
function custom_menu() { 

    add_menu_page( 
        'Kalendarz rezerwacji', 
        'Kalendarz rezerwacji', 
        'edit_posts', 
        'menu_slug', 
        'page_callback_function', 
        'dashicons-media-spreadsheet'
    );
}

add_action('admin_menu', 'custom_menu');
register_activation_hook( __FILE__, 'kopernik_plugin_activate' );

function kopernik_booking_system() {
    return KopernikBookingSystem::instance();
}
return kopernik_booking_system();

<?php
/**
 * Plugin Name: Tista WP Dashboard Metabox
 * Plugin URI: 
 * Description: WP Dashboard Metabox
 * Version: 4.2.1
 * Author: TistaTeam
 * Author URI: 
 * Requires at least: 
 * Tested up to: 
 *
 * @package TistaTeam
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Set plugin version constant. */
define( 'WPDM_VERSION', '4.2.1' );

/* Debug output control. */
define( 'WPDM_DEBUG_OUTPUT', 0 );

/* Set constant path to the plugin directory. */
define( 'WPDM_SLUG', basename( plugin_dir_path( __FILE__ ) ) );

/* Set constant path to the main file for activation call */
define( 'WPDM_CORE_FILE', __FILE__ );

/* Set constant path to the plugin directory. */
define( 'WPDM_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/* Set the constant path to the plugin directory URI. */
define( 'WPDM_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	
	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		// Makes sure the plugin functions are defined before trying to use them.
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	}
	define( 'WPDM_NETWORK_ACTIVATED', is_plugin_active_for_network( WPDM_SLUG . '/tista-wp-dashboard.php' ) );

	/* Tista_WP_Dashboard_Metabox Class */
	require_once WPDM_PATH . 'inc/class-tista-wp-dashboard-metabox.php';

	if ( ! function_exists( 'tista_wp_dashboard_metabox' ) ) :
		/**
		 * The main function responsible for returning the one true
		 * Tista_WP_Dashboard_Metabox Instance to functions everywhere.
		 *
		 * Use this function like you would a global variable, except
		 * without needing to declare the global.
		 *
		 * Example: <?php $tista_wp_dashboard_metabox = tista_wp_dashboard_metabox(); ?>
		 *
		 * @since 1.0.0
		 * @return Tista_WP_Dashboard_Metabox The one true Tista_WP_Dashboard_Metabox Instance
		 */
		function tista_wp_dashboard_metabox() {
			return Tista_WP_Dashboard_Metabox::instance();
		}
	endif;

	/**
	 * Loads the main instance of Tista_WP_Dashboard_Metabox to prevent
	 * the need to use globals.
	 *
	 * This doesn't fire the activation hook correctly if done in 'after_setup_theme' hook.
	 *
	 * @since 1.0.0
	 * @return object Tista_WP_Dashboard_Metabox
	 */
	tista_wp_dashboard_metabox();
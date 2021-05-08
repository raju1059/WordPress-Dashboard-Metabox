<?php
/**
 * Tista Tista_WP_Dashboard_Metabox class.
 *
 * @package Tista_WP_Dashboard_Metabox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Tista_WP_Dashboard_Metabox' ) ) :

	/**
	 * It's the main class that does all the things.
	 *
	 * @class Tista_WP_Dashboard_Metabox
	 * @version 4.2.1
	 * @since 1.0.0
	 */
	final class Tista_WP_Dashboard_Metabox {

		/**
		 * The single class instance.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private static $_instance = null;

		/**
		 * Plugin data.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private $data;

		/**
		 * The slug.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $slug;

		/**
		 * The version number.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $version;

		/**
		 * The web URL to the plugin directory.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $plugin_url;

		/**
		 * The server path to the plugin directory.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $plugin_path;

		/**
		 * The web URL to the plugin admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $page_url;

		/**
		 * The setting option name.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $option_name;

		/**
		 * Main Tista_WP_Dashboard_Metabox Instance
		 *
		 * Ensures only one instance of this class exists in memory at any one time.
		 *
		 * @see Tista_WP_Dashboard_Metabox()
		 * @uses Tista_WP_Dashboard_Metabox::init_globals() Setup class globals.
		 * @uses Tista_WP_Dashboard_Metabox::init_includes() Include required files.
		 * @uses Tista_WP_Dashboard_Metabox::init_actions() Setup hooks and actions.
		 *
		 * @since 1.0.0
		 * @static
		 * @return Tista_WP_Dashboard_Metabox.
		 * @codeCoverageIgnore
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init_globals();
				self::$_instance->init_includes();
				self::$_instance->init_actions();
			}
			return self::$_instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Tista_WP_Dashboard_Metabox::instance()
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function __construct() {
			/* We do nothing here! */
		}

		/**
		 * You cannot clone this class.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'tista-wp-dashboard' ), '1.0.0' );
		}

		/**
		 * You cannot unserialize instances of this class.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'tista-wp-dashboard' ), '1.0.0' );
		}

		/**
		 * Setup the class globals.
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function init_globals() {
			$this->data        = new stdClass();
			$this->version     = WPDM_VERSION;
			$this->slug        = 'tista-wp-dashboard';
			$this->option_name = self::sanitize_key( $this->slug );
			$this->plugin_url  = WPDM_URI;
			$this->plugin_path = WPDM_PATH;
			$this->page_url    = WPDM_NETWORK_ACTIVATED ? network_admin_url( 'admin.php?page=' . $this->slug ) : admin_url( 'admin.php?page=' . $this->slug );
			$this->data->admin = true;

		}
		/**
		 * Include required files.
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function init_includes() {
			//require $this->plugin_path . '/inc/widget/class-widget-footer.php';
		}

		/**
		 * Setup the hooks, actions and filters.
		 *
		 * @uses add_action() To add actions.
		 * @uses add_filter() To add filters.
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function init_actions() {
			// Activate plugin.
			register_activation_hook( WPDM_CORE_FILE, array( $this, 'activate' ) );

			// Deactivate plugin.
			register_deactivation_hook( WPDM_CORE_FILE, array( $this, 'deactivate' ) );

			// Load the textdomain.
			add_action( 'init', array( $this, 'load_textdomain' ) );

			// Load init.			
			add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );						
			add_action( 'wp_dashboard_setup', array( $this, 'tista_add_dashboard_widget' ) );						
			add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );
			
		}

		/**
		 * Activate plugin.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function activate() {
			self::set_plugin_state( true );
		}
		/**
		 * Deactivate plugin.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function tista_plugin_cach() {
				// Deactivate plugin.
			register_deactivation_hook( WPDM_CORE_FILE, array( $this, 'deactivate' ) );
		}
		/**
		 * Deactivate plugin.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function deactivate() {
			self::set_plugin_state( false );
		}

		/**
		 * Loads the plugin's translated strings.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'tista-wp-dashboard', false, WPDM_PATH . 'languages/' );
		}

		/**
		 * Sanitize data key.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @param string $key An alpha numeric string to sanitize.
		 * @return string
		 */
		private function sanitize_key( $key ) {
			return preg_replace( '/[^A-Za-z0-9\_]/i', '', str_replace( array( '-', ':' ), '_', $key ) );
		}

		/**
		 * Recursively converts data arrays to objects.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @param array $array An array of data.
		 * @return object
		 */
		private function convert_data( $array ) {
			foreach ( (array) $array as $key => $value ) {
				if ( is_array( $value ) ) {
					$array[ $key ] = self::convert_data( $value );
				}
			}
			return (object) $array;
		}

		/**
		 * Set the `is_plugin_active` option.
		 *
		 * This setting helps determine context. Since the plugin can be included in your theme root you
		 * might want to hide the admin UI when the plugin is not activated and implement your own.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @param bool $value Whether or not the plugin is active.
		 */
		private function set_plugin_state( $value ) {
			self::set_option( 'is_plugin_active', $value );
		}

		/**
		 * Set option value.
		 *
		 * @since 1.0.0
		 *
		 * @param string $name Option name.
		 * @param mixed  $option Option data.
		 */
		public function set_option( $name, $option ) {
			$options          = self::get_options();
			$name             = self::sanitize_key( $name );
			$options[ $name ] = esc_html( $option );
			$this->set_options( $options );
		}

		/**
		 * Set option.
		 *
		 * @since 2.0.0
		 *
		 * @param mixed $options Option data.
		 */
		public function set_options( $options ) {
			WPDM_NETWORK_ACTIVATED ? update_site_option( $this->option_name, $options ) : update_option( $this->option_name, $options );
		}

		/**
		 * Return the option settings array.
		 *
		 * @since 1.0.0
		 */
		public function get_options() {
			return WPDM_NETWORK_ACTIVATED ? get_site_option( $this->option_name, array() ) : get_option( $this->option_name, array() );
		}

		/**
		 * Return a value from the option settings array.
		 *
		 * @since 1.0.0
		 *
		 * @param string $name Option name.
		 * @param mixed  $default The default value if nothing is set.
		 * @return mixed
		 */
		public function get_option( $name, $default = '' ) {
			$options = self::get_options();
			$name    = self::sanitize_key( $name );
			return isset( $options[ $name ] ) ? $options[ $name ] : $default;
		}

		/**
		 * Set data.
		 *
		 * @since 1.0.0
		 *
		 * @param string $key Unique object key.
		 * @param mixed  $data Any kind of data.
		 */
		public function set_data( $key, $data ) {
			if ( ! empty( $key ) ) {
				if ( is_array( $data ) ) {
					$data = self::convert_data( $data );
				}
				$key = self::sanitize_key( $key );
				// @codingStandardsIgnoreStart
				$this->data->$key = $data;
				// @codingStandardsIgnoreEnd
			}
		}

		/**
		 * Get data.
		 *
		 * @since 1.0.0
		 *
		 * @param string $key Unique object key.
		 * @return string|object
		 */
		public function get_data( $key ) {
			return isset( $this->data->$key ) ? $this->data->$key : '';
		}

		/**
		 * Return the plugin slug.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_slug() {
			return $this->slug;
		}

		/**
		 * Return the plugin version number.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_version() {
			return $this->version;
		}

		/**
		 * Return the plugin URL.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_plugin_url() {
			return $this->plugin_url;
		}

		/**
		 * Return the plugin path.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_plugin_path() {
			return $this->plugin_path;
		}

		/**
		 * Return the plugin page URL.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_page_url() {
			return $this->page_url;
		}

		/**
		 * Return the option settings name.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_option_name() {
			return $this->option_name;
		}
		
		/**
		 * Adds the news dashboard widget.
		 *
		 * @since 3.9.0
		 * @access public
		 * @return void
		 */
		public function add_dashboard_widget() {
			// Create the widget.
			wp_add_dashboard_widget( 'tista_foundation', apply_filters( 'tista_dashboard_widget_title', esc_attr__( 'Tista Dashboard Two', 'tista-wp-dashboard' ) ), array( $this, 'display_news_dashboard_widget' ) );

			// Make sure our widget is on top off all others.
			global $wp_meta_boxes;

			// Get the regular dashboard widgets array.
			$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

			// Backup and delete our new dashboard widget from the end of the array.
			$tista_widget_backup = array(
				'tista_foundation' => $normal_dashboard['tista_foundation'],
			);
			unset( $normal_dashboard['tista_foundation'] );

			// Merge the two arrays together so our widget is at the beginning.
			$sorted_dashboard = array_merge( $tista_widget_backup, $normal_dashboard );

			// Save the sorted array back into the original metaboxes.
			$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		}
		/**
		 * Renders the news dashboard widget.
		 *
		 * @since 3.9.0
		 * @access public
		 * @return void
		 */
		public function display_news_dashboard_widget() {
			 include( WPDM_PATH . 'inc/views/html-contact-form.php' );
			//wp_dashboard_primary_output( 'tista_foundation', $feeds );
			$this->tista_wp_dashboard_metabox_enqueue_scripts();
		}
		
		/**
		 * Adds the news dashboard widget.
		 *
		 * @since 3.9.0
		 * @access public
		 * @return void
		 */
		public function tista_add_dashboard_widget() {
			// Create the widget.
			wp_add_dashboard_widget( 'tista_foundation_two', apply_filters( 'tista_dashboard_widget_title_two', esc_attr__( 'Tista Dashboard One', 'tista-wp-dashboard-two' ) ), array( $this, 'tista_display_dashboard_widget' ) );

			// Make sure our widget is on top off all others.
			global $wp_meta_boxes;

			// Get the regular dashboard widgets array.
			$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

			// Backup and delete our new dashboard widget from the end of the array.
			$tista_widget_backup = array(
				'tista_foundation_two' => $normal_dashboard['tista_foundation_two'],
			);
			unset( $normal_dashboard['tista_foundation_two'] );

			// Merge the two arrays together so our widget is at the beginning.
			$sorted_dashboard = array_merge( $tista_widget_backup, $normal_dashboard );

			// Save the sorted array back into the original metaboxes.
			$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		}
		/**
		 * Renders the news dashboard widget.
		 *
		 * @since 3.9.0
		 * @access public
		 * @return void
		 */
		public function tista_display_dashboard_widget() {
			 include( WPDM_PATH . 'inc/views/html-contact-form.php' );
			//wp_dashboard_primary_output( 'tista_foundation_two', $feeds );
			$this->tista_wp_dashboard_metabox_enqueue_scripts();
		}
		/**
		 * Unset dashboard widget.
		 *
		 * @since 3.9.0
		 * @access public
		 * @return void
		 */
		function remove_dashboard_widgets() {
			global $wp_meta_boxes;
		  
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
			
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);	
						// Main column (left): 
			// Browser Update Required
			unset( $wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag']); 
			// PHP Update Required
			unset( $wp_meta_boxes['dashboard']['normal']['high']['dashboard_php_nag']); 
			 
			// At a Glance
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
			// Right Now
			unset( $wp_meta_boxes['dashboard']['normal']['core']['network_dashboard_right_now']);
			// Activity
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
			// Site Health Status
			unset( $wp_meta_boxes['dashboard']['normal']['core']['health_check_status']);			 
			// Side Column (right): 
			// WordPress Events and News
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			// Quick Draft, Your Recent Drafts
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); 
					 // Remove Welcome panel
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
			// Remove the rest of the dashboard widgets
			//remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			//remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			//remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
			//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			//remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		}
		/**
		 * Admin enque script
		 *
		 * @access  public
		 */
		public function tista_wp_dashboard_metabox_enqueue_scripts() {
			wp_enqueue_style( 'tista-wp-dashboard-admin', WPDM_URI.'/assets/css/smart-forms.css', '', '','screen' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'tista-wp-dashboard-admin', WPDM_URI.'/assets/js/smart-form.js', '', '',true);
		}
	}

endif;
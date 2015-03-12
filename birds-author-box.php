<?php

/**
 * The plugin bootstrap file
 *
 * @link:               http://www.tenbirdsflying.com/theme/birds-author-box/
 * @since               1.0.2
 * @package             Birds_Authorbox
 *
 * @wordpress-plugin
 * Plugin Name:         Birds Author Box
 * Plugin URI:          http://www.tenbirdsflying.com/theme/birds-author-box/
 * Description:         This plugin adds an author box below the post content. Developed to work with themes based on Zurb Foundation 5 framework.
 * Version:             1.0.2
 * Author:              Frédéric Serva
 * Author URI:          http://www.tenbirdsflying.com/
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         birds-authorbox
 * Domain Path:         /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class Birds_Authorbox_Main {
    private static $instance = null;
    private $plugin_path;
    private $plugin_url;
    private $text_domain = 'birds-authorbox';

    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance() {
        // If an instance hasn't been created and set to $instance create an instance and set it to $instance.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
     */
    private function __construct() {
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url  = plugin_dir_url( __FILE__ );

        load_plugin_textdomain( $this->text_domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

        register_activation_hook( __FILE__, array( $this, 'activation' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

        $this->run_plugin();
    }

    public function get_plugin_url() {
        return $this->plugin_url;
    }

    public function get_plugin_path() {
        return $this->plugin_path;
    }

    /**
     * Place code that runs at plugin activation here.
     */
    public function activation() {
    }

    /**
     * Place code that runs at plugin deactivation here.
     */
    public function deactivation() {
    }

    /**
     * Enqueue and register Admin JavaScript files here.
     */
    public function register_admin_scripts() {
    }

    /**
     * Enqueue and register Admin CSS files here.
     */
    public function register_admin_styles() {
        wp_enqueue_style( 'birds-author-box-admin-style', plugins_url( '/birds-author-box/admin/css/authorbox_admin.css' ), array( 'dashicons' ), null );
    }

    /**
     * Enqueue and register Frontend JavaScript files here.
     */
    public function register_scripts() {
        wp_register_script('birds-tabs', plugins_url('/public/js/birds.tabs.js', __FILE__), array('jquery'),null, true);
        wp_enqueue_script('birds-tabs');
    }

    /**
     * Enqueue and register Frontend CSS files here.
     */
    public function register_styles() {
        wp_register_style( 'front-authorbox-css', plugins_url( '/birds-author-box/public/css/authorbox_front.css' ), null, null, 'all' );
        wp_enqueue_style( 'front-authorbox-css' );
    }

    /**
     * Place code for your plugin's functionality here.
     */
    private function run_plugin() {

        require_once $this->plugin_path . 'admin/additional_fields.php';
        require_once $this->plugin_path . 'public/frontend.php';

        // Settings Page
        require_once $this->plugin_path . 'admin/settings/class-settings.php';
        require_once $this->plugin_path . 'admin/settings/settings.php';

    }
}

Birds_Authorbox_Main::get_instance();

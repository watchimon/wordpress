<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Author URI
 * @since      1.0.0
 *
 * @package    Watchimon
 * @subpackage Watchimon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Watchimon
 * @subpackage Watchimon/admin
 * @author     Author Name <Author Email>
 */
class Watchimon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_options_page( 'Watchimon Functions Setup', 'Watchimon', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
        );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links( $links ) {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page() {
        include_once( 'partials/watchimon-admin-display.php' );
    }

    /**
     *
     * admin/class-wp-cbf-admin.php
     *
     **/
    public function validate($input) {
        $valid = array();

        $valid['project_id'] = (isset($input['project_secret']) && !empty($input['project_id'])) ? $input['project_id']: '';
        $valid['project_secret'] = (isset($input['project_secret']) && !empty($input['project_secret'])) ? $input['project_secret']: '';

        $valid['enable_backend'] = (isset($input['enable_backend']) && !empty($input['enable_backend'])) ? 1 : 0;
        $valid['enable_frontend'] = (isset($input['enable_frontend']) && !empty($input['enable_frontend'])) ? 1 : 0;

        return $valid;
    }

    /**
     *
     * admin/class-wp-cbf-admin.php
     *
     **/
    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

}

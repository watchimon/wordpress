<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Author URI
 * @since      1.0.0
 *
 * @package    Watchimon
 * @subpackage Watchimon/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Watchimon
 * @subpackage Watchimon/public
 * @author     Author Name <Author Email>
 */
class Watchimon_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Watchimon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Watchimon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/watchimon.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Adds Meta Data for App validation and Client initialization
     */
    public function add_meta_data()
    {
        $options = get_option($this->plugin_name);
        $projectId = $options['project_id'];
        $projectSecret = $options['project_secret'];

        $isFeLoggingEnabled = (isset($options['enable_frontend']) ? $options['enable_frontend'] : 0);

        if($isFeLoggingEnabled == 1) {
            echo "<script>\n";
            echo "var airbrake = new airbrakeJs.Client({host: \"https://api.watchimon.de\", projectId: '" . $projectId . "', projectKey: '" . $projectSecret . "'});\n";
            echo "</script>\n";
        }
        echo "<!-- Watchimon:" . $projectId . " -->\n";
    }

}

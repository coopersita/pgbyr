<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://modernearth.net
 * @since      1.0.0
 *
 * @package    Gbyr
 * @subpackage Gbyr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gbyr
 * @subpackage Gbyr/public
 * @author     Modern Earth <alicia@modernearth.net>
 */
class Gbyr_Public
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gbyr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gbyr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/gbyr-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gbyr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gbyr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/gbyr-public.js', array('jquery'), $this->version, false);
	}
	//enable only the settings that match the current role
	function gbyr_payment_gateway_by_role($available_gateways)
	{
		$current_user = $current_user = wp_get_current_user();
		$user_roles = array();
		if (0 !== $current_user->ID) {
			$user_roles = $current_user->roles;
		}
		foreach ($available_gateways as $key => $gateway) {
			$roles = get_option('gbyr_' . $key);
			if (is_array($roles) && !empty($roles)) {
				if (empty($user_roles) || empty(array_intersect($roles, $user_roles))) {
					unset($available_gateways[$key]);
				}
			}
		}
		return $available_gateways;
	}
}

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://modernearth.net
 * @since      1.0.0
 *
 * @package    Gbyr
 * @subpackage Gbyr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gbyr
 * @subpackage Gbyr/admin
 * @author     Modern Earth <alicia@modernearth.net>
 */
class Gbyr_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/gbyr-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/gbyr-admin.js', array('jquery'), $this->version, false);
	}

	// add woocommerce new setting tab
	function gbyr_add_settings_tab($settings_tabs)
	{
		$settings_tabs['gbyr_settings_tabs'] = __('Gateway by Role', 'gbyr');
		return $settings_tabs;
	}

	// Display the settings
	function gbyr_settings_tab()
	{
		woocommerce_admin_fields($this->gbyr_get_settings());
	}

	//The settings array
	function gbyr_get_settings()
	{
		global $wp_roles;
		global $woocommerce;

		$all_roles = $wp_roles->roles;

		$gateways = $woocommerce->payment_gateways->payment_gateways();

		$role_options = array();

		array_walk($all_roles, function ($val, $key) use (&$role_options) {
			$role_options[$key] = $val['name'];
		});

		$settings = array(
			array(
				'name'     => __('Gateway by Role', 'gbyr'),
				'type'     => 'title',
				'desc'     => 'If you select roles for a gateway, that gateway will only be available for those roles. Only active gateways will be displayed below.',
			),
		);

		if ($gateways) {
			foreach ($gateways as $key => $gateway) {
				$settings[] = array(
					'name' => __($gateway->settings['title'], 'gbyr'),
					'type' => 'multiselect',
					'id'   => 'gbyr_' . $key,
					'options' => $role_options,
					'class' => 'wc-enhanced-select',
				);
			}
		}

		$settings[] = array(
			'type' => 'sectionend',
		);

		return apply_filters('wc_gbyr_settings_tabs_settings', $settings);
	}

	//save the settings
	function gdbyc_update_settings()
	{
		woocommerce_update_options($this->gbyr_get_settings());
	}

	function test()
	{
		// global $woocommerce;

		// $gateways = $woocommerce->payment_gateways->get_available_payment_gateways();

		// echo '<pre>' . print_r($gateways, true) . '</pre>';
	}
}

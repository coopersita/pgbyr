<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://modernearth.net
 * @since             1.0.0
 * @package           Gbyr
 *
 * @wordpress-plugin
 * Plugin Name:       Gateway by Role
 * Plugin URI:        https://modernearth.net
 * Description:       Assign payment gateway availability by role
 * Version:           1.0.0
 * Author:            Modern Earth
 * Author URI:        https://modernearth.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gbyr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GBYR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gbyr-activator.php
 */
function activate_gbyr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gbyr-activator.php';
	Gbyr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gbyr-deactivator.php
 */
function deactivate_gbyr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gbyr-deactivator.php';
	Gbyr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gbyr' );
register_deactivation_hook( __FILE__, 'deactivate_gbyr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gbyr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gbyr() {

	$plugin = new Gbyr();
	$plugin->run();

}
run_gbyr();

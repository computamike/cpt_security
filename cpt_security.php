<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/computamike
 * @since             1.0.0
 * @package           Cpt_security
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Post Type Security
 * Plugin URI:        https://github.com/computamike/cpt_security
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mike Hingley
 * Author URI:        https://github.com/computamike
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cpt_security
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
define( 'CPT_SECURITY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cpt_security-activator.php
 */
function activate_cpt_security() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cpt_security-activator.php';
	Cpt_security_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cpt_security-deactivator.php
 */
function deactivate_cpt_security() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cpt_security-deactivator.php';
	Cpt_security_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cpt_security' );
register_deactivation_hook( __FILE__, 'deactivate_cpt_security' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cpt_security.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cpt_security() {

	$plugin = new Cpt_security();
	$plugin->run();

}
run_cpt_security();

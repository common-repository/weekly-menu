<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.piumaz.it
 * @since             1.0.0
 * @package           Pmz_Weekly_Menu
 *
 * @wordpress-plugin
 * Plugin Name:       Weekly Menu
 * Plugin URI:        www.piumaz.it/products/pmz-weekly-menu
 * Description:       This plugin allows you to easily add a weekly menu with main meals. Designed for school and work canteens that have fixed menu.
 * Version:           1.0.0
 * Author:            Daniele Piumatti
 * Author URI:        www.piumaz.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pmz-weekly-menu
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pmz-weekly-menu-activator.php
 */
function activate_pmz_weekly_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pmz-weekly-menu-activator.php';
	Pmz_Weekly_Menu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pmz-weekly-menu-deactivator.php
 */
function deactivate_pmz_weekly_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pmz-weekly-menu-deactivator.php';
	Pmz_Weekly_Menu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pmz_weekly_menu' );
register_deactivation_hook( __FILE__, 'deactivate_pmz_weekly_menu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pmz-weekly-menu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pmz_weekly_menu() {

	$plugin = new Pmz_Weekly_Menu();
	$plugin->run();

}
run_pmz_weekly_menu();

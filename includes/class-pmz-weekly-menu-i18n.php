<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.piumaz.it
 * @since      1.0.0
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/includes
 * @author     Daniele Piumatti <piumaz@hotmail.it>
 */
class Pmz_Weekly_Menu_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pmz-weekly-menu',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

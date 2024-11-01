<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.piumaz.it
 * @since      1.0.0
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/public
 * @author     Daniele Piumatti <piumaz@hotmail.it>
 */
class Pmz_Weekly_Menu_Public {

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

	public function render() {
		if ( is_single() ) {
			Pmz_Weekly_Menu_Loader::get_template( 'single', 'pmz-weekly-menu' );
		} else {
			Pmz_Weekly_Menu_Loader::get_template( 'archive', 'pmz-weekly-menu');
		}


	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pmz_Weekly_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pmz_Weekly_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pmz-weekly-menu-public.css', array(), $this->version, 'all' );

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
		 * defined in Pmz_Weekly_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pmz_Weekly_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pmz-weekly-menu-public.js', array( 'jquery' ), $this->version, false );

	}

}

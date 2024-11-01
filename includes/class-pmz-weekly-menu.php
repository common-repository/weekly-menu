<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.piumaz.it
 * @since      1.0.0
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/includes
 * @author     Daniele Piumatti <piumaz@hotmail.it>
 */
class Pmz_Weekly_Menu {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pmz_Weekly_Menu_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'pmz-weekly-menu';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		
		$this->loader->add_action( 'init', $this, 'register_post_type');
		
		$this->define_admin_hooks();
		$this->define_public_hooks();

		
	}

	public function register_post_type () {
		
		register_post_type('pmz-weekly-menu',
			[
				'labels'      => [
					'name' 				=> _x( 'Weekly Menus', 'post type general name', 'pmz-weekly-menu' ),
					'singular_name' 	=> _x( 'Weekly Menu', 'post type singular name', 'pmz-weekly-menu' ),
					'add_new' 				=> _x( 'Add New', 'weekly menu', 'pmz-weekly-menu' ),
					'add_new_item' 			=> sprintf( __( 'Add New %s', 'pmz-weekly-menu' ), __( 'Weekly Menu', 'pmz-weekly-menu' ) ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'pmz-weekly-menu' ), __( 'Weekly Menu', 'pmz-weekly-menu' ) ),
					'new_item' 				=> sprintf( __( 'New %s', 'pmz-weekly-menu' ), __( 'Weekly Menu', 'pmz-weekly-menu' ) ),
					'all_items' 			=> sprintf( __( 'All %s', 'pmz-weekly-menu' ), __( 'Weekly Menus', 'pmz-weekly-menu' ) ),
					'view_item' 			=> sprintf( __( 'View %s', 'pmz-weekly-menu' ), __( 'Weekly Menu', 'pmz-weekly-menu' ) ),
					'search_items' 			=> sprintf( __( 'Search %a', 'pmz-weekly-menu' ), __( 'Weekly Menus', 'pmz-weekly-menu' ) ),
					'not_found' 			=> sprintf( __( 'No %s Found', 'pmz-weekly-menu' ), __( 'Weekly Menus', 'pmz-weekly-menu' ) ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'pmz-weekly-menu' ), __( 'Weekly Menus', 'pmz-weekly-menu' ) ),
					'parent_item_colon' 	=> '',
					'menu_name' 			=> __( 'Weekly Menus', 'pmz-weekly-menu' )
				],
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_ui'			 	=> true,
				'show_in_menu' 			=> true,
				'query_var' 			=> true,
				'rewrite' 				=> array(
											'slug' 			=> 'weekly-menu',
											'with_front' 	=> false
											),
				'capability_type' 		=> 'post', 
				'has_archive' 			=> 'weekly-menus',
				'hierarchical' 			=> false,
				'supports' 				=> array(
											'title',
											'author',
											'editor',
											'thumbnail',
											'page-attributes'
											),
				'menu_position' 		=> 5,
				'menu_icon' 			=> 'dashicons-carrot'
			]
		);
	
	}
	
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pmz_Weekly_Menu_Loader. Orchestrates the hooks of the plugin.
	 * - Pmz_Weekly_Menu_i18n. Defines internationalization functionality.
	 * - Pmz_Weekly_Menu_Admin. Defines all hooks for the admin area.
	 * - Pmz_Weekly_Menu_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pmz-weekly-menu-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pmz-weekly-menu-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pmz-weekly-menu-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pmz-weekly-menu-public.php';

		$this->loader = new Pmz_Weekly_Menu_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pmz_Weekly_Menu_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pmz_Weekly_Menu_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pmz_Weekly_Menu_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
				
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_save' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_submenu_page' );
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pmz_Weekly_Menu_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		$this->loader->add_filter( 'template_include', $plugin_public, 'render' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pmz_Weekly_Menu_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

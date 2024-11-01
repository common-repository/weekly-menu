<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.piumaz.it
 * @since      1.0.0
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/admin
 * @author     Daniele Piumatti <piumaz@hotmail.it>
 */
class Pmz_Weekly_Menu_Admin {

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

	private $days = [
			'monday', 
			'tuesday', 
			'wednesday', 
			'thursday', 
			'friday', 
			'saturday', 
			'sunday'
		];
		
	private $meals = [
			'breakfast',
			'lunch', 
			'snack',
			'dinner'
		];
		
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

	public function add_submenu_page() { 
	
		add_submenu_page( 
			'edit.php?post_type=pmz-weekly-menu', 
			__( 'Settings', 'pmz-weekly-menu' ), 
			__( 'Settings', 'pmz-weekly-menu' ), 
			'manage_options', 
			'settings', 
			array($this, 'display_options_page')
		);
	}
	
	public function add_meta_boxes () { 
		add_meta_box( 'pmz-weekly-menu-data', __( 'Menu', 'pmz-weekly-menu' ), array( $this, 'meta_box_content' ), 'pmz-weekly-menu', 'normal', 'default' );
	}

	public function meta_box_content ($post) {
		
		$post_id = $post->ID;

		$fields = get_post_custom( $post_id );
		
		
		$html = '';
		$html .= '<table class="form-table">' . "\n";
		$html .= '<tbody>' . "\n";
		

		$options = get_option($this->plugin_name);
		
		foreach ( $options['days'] as $day => $dayValue) {
			
			$html .= '<tr>';
			
			$html .= '<th>' . __( ucfirst($day), 'pmz-weekly-menu' ) . '</th>';
			
			foreach ( $options['meals'] as $meal => $mealValue) {
				
				$value = '';
				$k = esc_attr( $day . '_' . $meal );
				if ( isset( $fields['_' . $k] ) && isset( $fields['_' . $k][0] ) ) {
					$value = $fields['_' . $k][0];
				}


				$html .= '
				<td>
					<p><label for="' . esc_attr( $day . '_' . $meal ) . '">' . __( ucfirst($meal), 'pmz-weekly-menu' ) . '</label></p>
					<textarea
						class="regular-text"
						name="' . esc_attr( $day . '_' . $meal ) . '"
						id="' . esc_attr( $day . '_' . $meal ) . '"/>' . esc_attr( $value ) . '</textarea>
				</td>';

			}

			$html .= '</tr>';
		}


		$html .= '</tbody>' . "\n";
		$html .= '</table>' . "\n";


		echo $html;

	}
	
	public function meta_box_save ( $post_id ) {
		
		$post = get_post($post_id);

		
		foreach ( $this->days as $day ) {
			
			foreach ( $this->meals as $meal ) {
				
				$f = esc_attr( $day . '_' . $meal );
				
				${$f} = strip_tags(trim($_POST[$f]));


				if ( get_post_meta( $post_id, '_' . $f ) == '' ) {
					add_post_meta( $post_id, '_' . $f, ${$f}, true );
				} elseif( ${$f} != get_post_meta( $post_id, '_' . $f, true ) ) {
					update_post_meta( $post_id, '_' . $f, ${$f} );
				} elseif ( ${$f} == '' ) {
					delete_post_meta( $post_id, '_' . $f, get_post_meta( $post_id, '_' . $f, true ) );
				}
			
			}
			
		}

	}
	
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() { 
		include_once 'partials/pmz-weekly-menu-admin-display.php';
	}
	
	public function validate_options($input) {
		// All checkboxes inputs        
		$valid = [];

		//Cleanup
		$valid['days'] = (isset($input['days']) && count($input['days'])) ? $input['days'] : [];
		$valid['meals'] = (isset($input['meals']) && count($input['meals'])) ? $input['meals'] : [];

		return $valid;
	 }
 
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate_options'));
	}
 
	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pmz-weekly-menu-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pmz-weekly-menu-admin.js', array( 'jquery' ), $this->version, false );

	}

}

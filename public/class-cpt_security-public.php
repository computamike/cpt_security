<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/computamike
 * @since      1.0.0
 *
 * @package    Cpt_security
 * @subpackage Cpt_security/public
 */

require_once realpath( __DIR__ . '/../includes/class-Inflect.php' );
require_once realpath( __DIR__ . '/../includes/class-security-utilities.php' );
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cpt_security
 * @subpackage Cpt_security/public
 * @author     Mike Hingley <computa_mike@hotmail.com>
 */
class Cpt_security_Public {

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
	 * Register the Studies custom post type.
	 */
	public function register_studies(){
		$type = 'study';
		$i = new Inflect();

		$singular = $i->singularize($type);
		$plural   = $i->pluralize($type);

		$labels =  security_utilities::xcompile_post_type_labels(ucfirst($singular), ucfirst($plural));
		$capabilities = security_utilities::compile_post_type_capabilities($singular, $plural);
		$supports = ['title', 'editor', 'revisions', 'page-attributes', 'thumbnail'];
		$arguments = [
			'capabilities' => $capabilities,
			'show_in_rest' => true, // Enable the REST API
			'hierarchical' => false, // Do not use hierarchy
			'public' => true, // Allow access to post type
			'description' => 'Case studies for portfolio.', // Add a description
			'supports' => $supports, // Apply supports
			'menu_icon' => 'dashicons-desktop', // Set icon
			'labels'  => $labels, // Set the primary labels
			'map_meta_cap' => true,
		];
		register_post_type( $type, $arguments);
		security_utilities::post_message(ucfirst($singular), ucfirst($plural));
		security_utilities::bulk_post_message(ucfirst($singular), ucfirst($plural));

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
		 * defined in Cpt_security_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cpt_security_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cpt_security-public.css', array(), $this->version, 'all' );

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
		 * defined in Cpt_security_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cpt_security_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cpt_security-public.js', array( 'jquery' ), $this->version, false );

	}

}

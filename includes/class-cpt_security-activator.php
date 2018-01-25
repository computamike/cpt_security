<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/computamike
 * @since      1.0.0
 *
 * @package    Cpt_security
 * @subpackage Cpt_security/includes
 */
require_once realpath( __DIR__ . '/class-security-utilities.php' );
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cpt_security
 * @subpackage Cpt_security/includes
 * @author     Mike Hingley <computa_mike@hotmail.com>
 */
class Cpt_security_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$role = get_role( 'administrator' );
		    $capabilities = security_utilities::compile_post_type_capabilities('study', 'studies');
		    foreach ($capabilities as $capability) {
		        $role->add_cap( $capability );
		    }
	}

}

<?php
/**
 * Plugin Name: Pelcro: Content Subscription Platform
 * Plugin URI: https://www.pelcro.com/
 * Description: The #1 Content Subscription Platform. All the tools you need to drive subscription revenue from your audience. Setup a membership paywall in minutes.
 * Version: 3.0.4
 * Author: pelcro
 * Author URI: https://www.pelcro.com/
 * Requires at least: 3.0
 * Tested up to: 4.8
 *
 * Text Domain: pelcro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

define('PELCRO_DIR_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('PELCRO_DIR_URL', trailingslashit(plugin_dir_url(__FILE__)));

define('PELCRO_ADMIN_DIR_PATH', trailingslashit(PELCRO_DIR_PATH . 'includes/admin'));
define('PELCRO_ADMIN_DIR_URL', trailingslashit(PELCRO_DIR_URL . 'includes/admin'));

require_once(PELCRO_DIR_PATH . 'includes/functions.php');
require_once(PELCRO_DIR_PATH . 'includes/templates.php');

if (is_admin()) {
	require_once(PELCRO_ADMIN_DIR_PATH . 'admin-handler.php');
}

/**
 * Plugin activation tasks
 *
 * @since 3.0.3
 */
function pelcro_activate_plugin(){
	update_option('pelcro_settings', NULL, 'yes');
}

//Runs the initialization function with the activation hook.
register_activation_hook( __FILE__, 'pelcro_activate_plugin' );

/**
 * Deactivation cleanup.
 *
 * @since 3.0.3
 */
function pelcro_deactivate_plugin(){
  	delete_option('pelcro_settings');
}

//Runs the deactivation function with the deactivation hook.
register_deactivation_hook( __FILE__, 'pelcro_deactivate_plugin' );
<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Retrieve settings or specific setting value
 *
 * @since 2.0.2
 * @param string $key
 * @return mixed
 */
function pelcro_get_settings($key = '', $default = null) {
	$settings = get_option('pelcro_settings', array());

	if (empty($key)) {
		return $settings;
	} else {
		return isset($settings[$key]) ? $settings[$key] : $default;
	}
}
<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Includes required parameters
 *
 * @since 3.0.3
 */
function pelcro_output_scripts() { 
	$site_id = pelcro_get_settings('site_id', '2'); ?>

	<script>var afw = window.afw || (window.afw = {}); afw.siteid = "<?php echo $site_id; ?>";</script>

	<?php
}
add_action('wp_footer', 'pelcro_output_scripts');

/**
 * Includes Pelcro script
 *
 * @since 3.0.3
 */
function pelcro_adding_scripts() {
	$script_url = 'https://cdn.pelcro.com/js/bab/min.js';
	wp_enqueue_script('pelcro-content-subscription',$script_url, null,null, true);
}
add_action( 'wp_enqueue_scripts', 'pelcro_adding_scripts' );
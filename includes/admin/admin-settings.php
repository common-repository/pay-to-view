<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class PELCRO_Admin_Settings {

	private $page_slug = 'pelcro';
	private $page_settings = array();

	/**
	 * Constructor
	 *
	 * @since 2.0.2
	 */
	public function __construct() {
		add_action('admin_menu', array($this, 'register_menu'));
		add_action('admin_init', array($this, 'register_settings'));
	}

	/**
	 * Register admin menu
	 *
	 * @since 2.0.2
	 */
	public function register_menu() {
        add_options_page(
            __('Pelcro Settings', 'pelcro'), 
            __('Pelcro', 'pelcro'), 
            'manage_options', 
            $this->page_slug, 
            array($this, 'output_settings')
        );
	}

	/**
	 * Output settings page
	 *
	 * @since 2.0.2
	 */
	public function output_settings() { 
		$this->page_settings = pelcro_get_settings(); ?>

		<div class="wrap">
			<h2><?php _e('Pelcro Settings', 'pelcro'); ?></h2>

			<form method="post" action="options.php">
				<?php settings_fields('pelcro_settings'); ?>
				<?php do_settings_sections($this->page_slug); ?>
				<?php submit_button(); ?>
			</form>
		</div>

		<?php
	}

	/**
	 * Register admin settings
	 *
	 * @since 2.0.2
	 */
	public function register_settings() {
		register_setting(
			'pelcro_settings',
			'pelcro_settings',
			array($this, 'sanitize_settings')
		);

		# General Settings
		add_settings_section(
			'pelcro_general_setings',
			__('General Settings', 'pelcro'),
			array($this, 'output_section_field'),
			$this->page_slug
		);
		add_settings_section(
			'pelcro_general_setings_description',
			__('You can find your siteID by logging into your dashboard or signing up to pelcro.com', 'pelcro'),
			array($this, 'output_section_field'),
			$this->page_slug
		);
		add_settings_field(
			'site_id',
			__('Site ID', 'pelcro'),
			array($this, 'output_site_id_field'),
			$this->page_slug,
			'pelcro_general_setings'
		);
	}

	/**
	 * Sanitize setting fields
	 *
	 * @since 2.0.2
	 * @param mixed $input
	 * @return mixed $input
	 */
	public function sanitize_settings($input) {

		if (isset($input['site_id'])) {
			$input['site_id'] = sanitize_text_field($input['site_id']);
		}

		return $input;
	}

	/**
	 * Output setting section field
	 *
	 * @since 2.0.2
	 */
	public function output_section_field() {
		printf('');
	}

	/**
	 * Output "Site ID" setting field
	 *
	 * @since 2.0.2
	 */
	public function output_site_id_field() { ?>
		<?php printf(
			'<input type="text" class="regular-text" name="pelcro_settings[site_id]" value="%s" />',
			isset($this->page_settings['site_id']) && $this->page_settings['site_id'] ? $this->page_settings['site_id'] : ''
		); ?>

		<a target="_blank" href="//www.pelcro.com/auth/register?utm_source=wp-plugin-directory" class="button">
			<?php _e('Get your site ID', 'pelcro'); ?>
		</a>

		<p class="description">
			<?php _e('Please enter your "Site ID" code.', 'pelcro'); ?>
		</p>

		<?php
	}
}

if (is_admin()) {
	return new PELCRO_Admin_Settings();
}
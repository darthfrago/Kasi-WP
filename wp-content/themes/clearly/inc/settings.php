<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package clearly
 * @since clearly 1.0
 * @license GPL 2.0
 */

/**
 * Setup theme settings.
 * 
 * @since clearly 1.0
 */
function clearly_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'clearly'));
	siteorigin_settings_add_section('home', __('Home Page', 'clearly'));

	/**
	 * General Settings
	 */
	
	siteorigin_settings_add_field('general', 'logo', 'media', __('Logo', 'clearly'), array(
		'description' => __('Choose a logo to display instead of your site title and icon.', 'clearly'),
		'choose' => __('Choose Image', 'clearly'),
		'update' => __('Set Logo', 'clearly'),
	));

	siteorigin_settings_add_field('general', 'logo_icon_display', 'checkbox', __('Dislay Logo Icon', 'clearly'), array(
		'description' => __('Display the logo icon (defaults to blue power button).', 'clearly'),
	));

	siteorigin_settings_add_field('general', 'logo_icon', 'media', __('Logo Icon', 'clearly'), array(
		'description' => __('An icon to display next to site title.', 'clearly'),
		'choose' => __('Choose Image', 'clearly'),
		'update' => __('Set Logo Icon', 'clearly'),
	));

	// siteorigin_settings_add_field('general', '', '');

	/**
	 * Home Page
	 */

	siteorigin_settings_add_field('home', 'slider_enabled', 'checkbox', __('Display Home Page Slider', 'clearly'));
	siteorigin_settings_add_field('home', 'slider', 'gallery', __('Home Slider Images', 'clearly'));

}
add_action('admin_init', 'clearly_theme_settings');

/**
 * Setup theme default settings.
 * 
 * @param $defaults
 * @return mixed
 * @since clearly 1.0
 */
function clearly_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';
	$defaults['general_logo_icon_display'] = true;
	$defaults['general_logo_icon'] = false;

	$defaults['home_slider_enabled'] = true;
	$defaults['home_slider'] = '';

	$defaults['layout_responsive'] = true;
	$defaults['layout_responsive_menu'] = true;

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'clearly_theme_setting_defaults');
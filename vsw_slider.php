<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.garrettryandesign.com
 * @since             1.0.0
 * @package           Vsw_slider
 *
 * @wordpress-plugin
 * Plugin Name:       WP Vertical Slider Wall
 * Plugin URI:        github.com/garrettdesigns/wp-vertical-slider-wall
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Garrett Kucinski
 * Author URI:        www.garrettryandesign.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vsw_slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vsw_slider-activator.php
 */
function activate_vsw_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vsw_slider-activator.php';
	Vsw_slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vsw_slider-deactivator.php
 */
function deactivate_vsw_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vsw_slider-deactivator.php';
	Vsw_slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vsw_slider' );
register_deactivation_hook( __FILE__, 'deactivate_vsw_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vsw_slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vsw_slider() {

	$plugin = new Vsw_slider();
	$plugin->run();

}
run_vsw_slider();

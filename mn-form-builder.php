<?php

/**
 * Plugin Name:       MN Form Builder
 * Plugin URI:        https://wordpress.org/plugins/mn-form-builder/
 * Description:       MN Form Builder: Effortlessly create and manage custom forms for your WordPress site with ease and flexibility
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Mohammad Naeem
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mnfb
 */

// Do not access directly.
if (!defined('WPINC')) {
    die;
}
// Set plugin version.
define('MNFB_VERSION', '1.0.0');
// Set path to the plugin directory.
define('MNFB_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
// Set path to the plugin directory URI.
define('MNFB_PLUGIN_URL', trailingslashit(plugin_dir_url(__FILE__)));

function mnpb_load_stylesheet()
{
    wp_enqueue_style('mnpb_bootstrap_style', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css');
}
add_action('wp_enqueue_scripts', 'mnpb_load_stylesheet');

function mnpb_load_scripts()
{
    wp_enqueue_script('mnpb_bootstrap_script', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js', array(), true);
}
add_action('wp_enqueue_scripts', 'mnpb_load_scripts');

// Include admin styles
require_once(MNFB_PLUGIN_PATH . 'mnfb-admin-styles.php');

// Load the main class that controls everything.
if (is_admin()) {
    require_once(MNFB_PLUGIN_PATH . 'functions.php');

    // Set Database When Plugin Install.
    register_activation_hook(__FILE__, 'mnfb_database_activate');
    register_deactivation_hook(__FILE__, 'mnfb_database_deactivate');
    require_once(MNFB_PLUGIN_PATH . 'includes/database.php');
}


function mnfb_form_builder_shortcode()
{
    ob_start();
?>
    <?php include(MNFB_PLUGIN_PATH . 'templates/template.php'); ?>
<?php
    return ob_get_clean();
}
add_shortcode('mnfb_form_builder', 'mnfb_form_builder_shortcode');

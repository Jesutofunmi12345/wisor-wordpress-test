<?php
/**
 * Plugin Name: Elementor Events Widget
 * Plugin URI:  https://yourwebsite.com
 * Description: Adds an Elementor widget to display upcoming events from a custom post type.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://yourwebsite.com
 * License:     GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Check if Elementor is installed and active
function ee_check_elementor_activation() {
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', function () {
            echo '<div class="error"><p><strong>Elementor Events Widget:</strong> Elementor is not activated. Please activate Elementor to use this plugin.</p></div>';
        });
        return;
    }
}
add_action('plugins_loaded', 'ee_check_elementor_activation');

// Register Custom Post Type
require_once plugin_dir_path(__FILE__) . 'includes/event-post-type.php';

// Register Elementor Widget
function ee_register_elementor_widget() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-elementor-events-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Events_Widget());
}
add_action('elementor/widgets/register', 'ee_register_elementor_widget');

// Register Shortcode
require_once plugin_dir_path(__FILE__) . 'includes/event-shortcode.php';

// Enqueue Styles
function ee_enqueue_styles() {
    wp_enqueue_style('ee-style', plugin_dir_url(__FILE__) . 'assets/style.css');
}
add_action('wp_enqueue_scripts', 'ee_enqueue_styles');

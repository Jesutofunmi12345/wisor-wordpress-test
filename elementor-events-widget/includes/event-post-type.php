<?php
if (!defined('ABSPATH')) {
    exit;
}

function ee_register_event_post_type() {
    $args = [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar',
        'supports' => ['title', 'editor', 'excerpt'],
        'register_meta_box_cb' => 'ee_add_event_meta_box',
    ];
    register_post_type('events', $args);
}
add_action('init', 'ee_register_event_post_type');

function ee_add_event_meta_box() {
    add_meta_box('event_details', 'Event Details', 'ee_event_meta_box_callback', 'events');
}

function ee_event_meta_box_callback($post) {
    $event_date = get_post_meta($post->ID, 'event_date', true);
    echo '<label for="event_date">Event Date:</label>';
    echo '<input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" />';
}

function ee_save_event_meta($post_id) {
    if (array_key_exists('event_date', $_POST)) {
        update_post_meta($post_id, 'event_date', sanitize_text_field($_POST['event_date']));
    }
}
add_action('save_post', 'ee_save_event_meta');

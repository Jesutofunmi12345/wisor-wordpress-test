<?php
if (!defined('ABSPATH')) {
    exit;
}

function ee_events_shortcode($atts) {
    $atts = shortcode_atts(['count' => 5], $atts, 'events');
    
    $args = [
        'post_type' => 'events',
        'posts_per_page' => intval($atts['count']),
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_key' => 'event_date',
        'meta_query' => [
            [
                'key' => 'event_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ],
        ],
    ];
    
    $events = new WP_Query($args);
    ob_start();
    
    echo '<ul class="events-list">';
    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();
            $event_date = get_post_meta(get_the_ID(), 'event_date', true);
            echo '<li><strong>' . get_the_title() . '</strong> (' . esc_html($event_date) . ')<p>' . get_the_excerpt() . '</p></li>';
        }
    } else {
        echo '<li>No upcoming events.</li>';
    }
    echo '</ul>';
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('events', 'ee_events_shortcode');

<?php
if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Events_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'events_widget';
    }

    public function get_title() {
        return __('Events Widget', 'elementor-events-widget');
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-events-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'event_count',
            [
                'label' => __('Number of Events', 'elementor-events-widget'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $event_count = $settings['event_count'];

        $args = [
            'post_type' => 'events',
            'posts_per_page' => $event_count,
            'meta_key' => 'event_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
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
    }
}

# Elementor Events Widget Plugin

## Description
The Elementor Events Widget is a custom WordPress plugin that adds a new Elementor widget to display upcoming events from a custom post type 'Events'. Users can add, edit, and delete events from the frontend, and a shortcode is also provided to display events outside of Elementor.

## Features
- **Custom Post Type:** `Events` with fields for event name, date, and description.
- **Event Management:** Allows users to add, edit, and delete events from the frontend.
- **Elementor Widget:** Retrieves and displays upcoming events with customization options.
- **Shortcode Support:** `[events_list count="5"]` to display events without Elementor.
- **Performance Optimization:** Caching and minimal database queries for efficiency.
- **Security Measures:** Follows WordPress security best practices.

## Installation
1. Download the plugin files and extract the folder `elementor-events-widget`.
2. Upload the folder to the `/wp-content/plugins/` directory on your WordPress site.
3. Activate the plugin via the WordPress admin panel under "Plugins".
4. Ensure Elementor is installed and activated to use the Elementor widget.

## Usage
### 1. Adding Events
- Navigate to "Events" in the WordPress admin panel.
- Click "Add New", enter event details, and publish.

### 2. Displaying Events in Elementor
- Open Elementor and add the "Events List" widget.
- Customize the number of events displayed in the settings panel.

### 3. Displaying Events via Shortcode
Use `[events_list count="5"]` anywhere in a post or page to display upcoming events.

### 4. Frontend Event Management
Use `[event_management_form]` to allow logged-in users to add events from the frontend.

## Files & Structure
```
/elementor-events-widget/
│── elementor-events-widget.php  # Main plugin file
│── widget-events.php            # Elementor widget class
│── style.css                     # Plugin styles
│── README.md                     # Documentation
```

## Security & Performance
- Ensures only authorized users can manage events.
- Implements caching techniques for optimized database queries.

## Future Enhancements
- Pagination and infinite scroll.
- Event filtering options.
- Admin settings page for customization.

## License
This plugin is released under the GPL-2.0+ License.

## Author
Developed by **Jesutofunmi Sojimi**.

For support, contact sojimijesutofunmi@gmail.com.


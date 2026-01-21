<?php
/**
 * Plugin Name: Sedona Companion
 * Description: Companion plugin to expose ACF fields in REST API and extend site features.
 * Version: 1.0
 * Author: Nazrul Rafi
 * Text Domain: sedona
 * Domain Path: /languages
 */

// Security check
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load plugin text domain for translations
 */
function sedona_load_textdomain() {
    load_plugin_textdomain(
        'sedona',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}
add_action('plugins_loaded', 'sedona_load_textdomain');

/**
 * Register custom image size
 */
add_action('after_setup_theme', function() {
    add_image_size('sedona-blog-thumb', 370, 285, true); // true = hard crop
});


// Include Rest API Files
require_once plugin_dir_path(__FILE__) . 'rest/rest-acf.php';
require_once plugin_dir_path(__FILE__) . 'rest/specialized-news.php';
require_once plugin_dir_path(__FILE__) . 'rest/cat-and-tag-details.php';
require_once plugin_dir_path(__FILE__) . 'rest/related-works.php';
require_once plugin_dir_path(__FILE__) . 'rest/site-meta-info.php';
require_once plugin_dir_path(__FILE__) . 'rest/work-cat-name.php';
require_once plugin_dir_path(__FILE__) . 'rest/recent-works.php';
require_once plugin_dir_path(__FILE__) . 'rest/feature_image.php';
require_once plugin_dir_path(__FILE__) . 'rest/contact-form.php';
require_once plugin_dir_path(__FILE__) . 'rest/post-comment-submit.php';


// Portfolio / works CPT
require_once plugin_dir_path(__FILE__) . 'inc/cpt-works.php';
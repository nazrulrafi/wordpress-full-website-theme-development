<?php
/**
 * Plugin Name: Rethouse Companion
 * Description: Adds Properties, Agents, and Agencies CPT with frontend dashboards.
 * Version: 1.0
 * Author: Nazrul Rafi
 */

if (!defined('ABSPATH')) exit;


// Inside your main plugin file
add_action('wp_enqueue_scripts', 'rethouse_enqueue_scripts');
function rethouse_enqueue_scripts() {
    wp_enqueue_style('nouislider-css', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css', [], '15.7.0');
    wp_enqueue_script('nouislider-js', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js', ['jquery'], '15.7.0', true);

    // Your custom JS for initializing the slider
    wp_enqueue_script('rethouse-filter', plugin_dir_url(__FILE__) . 'assets/js/script.js', ['nouislider-js'], '1.0', true);
    wp_localize_script('rethouse-filter', 'rethouse_ajax', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
}

// Register footer widget
function mytheme_register_footer_widget() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'mytheme' ),
        'id'            => 'footer_widget',
        'description'   => __( 'Widget area for the footer.', 'mytheme' ),
        'before_widget' => '<div class="widget__footer">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'mytheme_register_footer_widget' );


// Include required files
require_once plugin_dir_path(__FILE__) . 'inc/roles.php';
require_once plugin_dir_path(__FILE__) . 'inc/cpt.php';
require_once plugin_dir_path(__FILE__) . 'inc/acf-dependent-dropdowns.php';
require_once plugin_dir_path(__FILE__) . 'inc/property-filter.php';
require_once plugin_dir_path(__FILE__) . 'inc/footer-widgets.php';













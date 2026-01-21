<?php
/**
 * Add Customizer Section: Site Meta Info
 */
function sedona_customize_register($wp_customize) {
    $wp_customize->add_section('site_meta_info', array(
        'title'    => __('Site Meta Info', 'sedona'),
        'priority' => 30,
    ));

    // Logo Dark
    $wp_customize->add_setting('logo_dark');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_dark', array(
        'label'    => __('Logo Dark', 'sedona'),
        'section'  => 'site_meta_info',
        'settings' => 'logo_dark',
    )));

    // Logo White
    $wp_customize->add_setting('logo_white');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_white', array(
        'label'    => __('Logo White', 'sedona'),
        'section'  => 'site_meta_info',
        'settings' => 'logo_white',
    )));

    // Contact Number
    $wp_customize->add_setting('contact_number');
    $wp_customize->add_control('contact_number', array(
        'label'   => __('Contact Number', 'sedona'),
        'section' => 'site_meta_info',
        'type'    => 'text',
    ));

    // Footer Info
    $wp_customize->add_setting('footer_info');
    $wp_customize->add_control('footer_info', array(
        'label'   => __('Footer Info', 'sedona'),
        'section' => 'site_meta_info',
        'type'    => 'text',
    ));
    // Social Links
    $socials = ['facebook', 'youtube', 'instagram', 'twitter'];
    foreach ($socials as $social) {
        $wp_customize->add_setting($social.'_link');
        $wp_customize->add_control($social.'_link', array(
            'label'   => ucfirst($social) . ' URL',
            'section' => 'site_meta_info',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'sedona_customize_register');


/**
 * Expose Site Meta Info in REST API
 */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/site-meta-info', array(
        'methods'  => 'GET',
        'callback' => 'sedona_get_site_meta_info',
        'permission_callback' => '__return_true',
    ));
});

function sedona_get_site_meta_info() {
    $logo_dark  = get_theme_mod('logo_dark');
    $logo_white = get_theme_mod('logo_white');

    // Ensure it returns a URL
    if (is_numeric($logo_dark)) {
        $logo_dark = wp_get_attachment_url($logo_dark);
    }
    if (is_numeric($logo_white)) {
        $logo_white = wp_get_attachment_url($logo_white);
    }

    return array(
        'logo_dark'      => $logo_dark ?: null,
        'logo_white'     => $logo_white ?: null,
        'contact_number' => get_theme_mod('contact_number'),
        'footer_info'    => get_theme_mod('footer_info'),
        'facebook'       => get_theme_mod('facebook_link'),
        'youtube'        => get_theme_mod('youtube_link'),
        'instagram'      => get_theme_mod('instagram_link'),
        'twitter'        => get_theme_mod('twitter_link'),
    );
}


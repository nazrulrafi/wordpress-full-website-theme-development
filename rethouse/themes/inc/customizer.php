<?php
function theme_customize_register($wp_customize) {

    // Add a new section for social links
    $wp_customize->add_section('social_links_section', [
        'title'    => __('Social Links', 'your-theme'),
        'priority' => 30,
    ]);

    // Twitter
    $wp_customize->add_setting('twitter_link', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('twitter_link', [
        'label'    => __('Twitter URL', 'your-theme'),
        'section'  => 'social_links_section',
        'type'     => 'url',
    ]);

    // Facebook
    $wp_customize->add_setting('facebook_link', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('facebook_link', [
        'label'    => __('Facebook URL', 'your-theme'),
        'section'  => 'social_links_section',
        'type'     => 'url',
    ]);

    // Instagram
    $wp_customize->add_setting('instagram_link', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('instagram_link', [
        'label'    => __('Instagram URL', 'your-theme'),
        'section'  => 'social_links_section',
        'type'     => 'url',
    ]);
}

add_action('customize_register', 'theme_customize_register');

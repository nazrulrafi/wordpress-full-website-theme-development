<?php
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/specialized-news', array(
        'methods'  => 'GET',
        'callback' => 'sedona_get_featured_posts',
        'permission_callback' => '__return_true',
    ));
});

function sedona_get_featured_posts() {
    $args = array(
        'post_type'      => 'post', // Or your custom post type
        'posts_per_page' => -1,     // Get all featured posts
        'meta_query'     => array(
            array(
                'key'     => 'is_home_featured',
                'value'   => '1',    // ACF true is saved as "1"
                'compare' => '='
            )
        )
    );

    $query = new WP_Query($args);
    if (!$query->have_posts()) {
        return [];
    }
    $posts = array();
    while ($query->have_posts()) {
        $query->the_post();
        $posts[] = array(
            'id'             => get_the_ID(),
            'title'          => get_the_title(),
            'link'           => get_permalink(),
            'excerpt'        => get_the_excerpt(),
            'featured_image' => get_the_post_thumbnail_url(get_the_ID(), 'sedona-blog-thumb'),
            'slug'           => get_post_field('post_name', get_the_ID()),
            'date'           => get_the_date('d F Y') // Added formatted date
        );
    }
    wp_reset_postdata();
    return $posts;
}

















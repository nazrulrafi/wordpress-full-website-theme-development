<?php
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/recent-works', array(
        'methods'  => 'GET',
        'callback' => 'sedona_get_recent_works',
        'permission_callback' => '__return_true',
    ));
});

function sedona_get_recent_works() {
    $args = array(
        'post_type'      => 'works',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    if (!$query->have_posts()) {
        return [];
    }

    $posts = array();

    while ($query->have_posts()) {
        $query->the_post();

        $works_meta_info = get_field("works_meta_info");
        $works_images = get_field('works_images');

        // Get taxonomy terms
        $terms = get_the_terms(get_the_ID(), 'work_category');
        $categories = [];
        if ($terms && !is_wp_error($terms)) {
            $categories = wp_list_pluck($terms, 'name'); // Only names
        }

        $feature_image = wp_get_attachment_image_src($works_images["feature_image"], 'full');

        $posts[] = array(
            'id'             => get_the_ID(),
            'title'          => get_the_title(),
            'slug'           => get_post_field('post_name', get_the_ID()),
            'link'           => get_permalink(),
            'featured_image' => $feature_image ? $feature_image[0] : null,
            'date'           => $works_meta_info["date"],
            'categories'     => $categories, // ✅ Add taxonomy names
        );
    }

    wp_reset_postdata();
    return $posts;
}

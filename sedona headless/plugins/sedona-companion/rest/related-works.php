<?php
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/related-works/(?P<id>\d+)', [
        'methods'  => 'GET',
        'callback' => 'sedona_get_related_works',
        'permission_callback' => '__return_true',
    ]);
});

function sedona_get_related_works($data) {
    $post_id = intval($data['id']);

    // Get taxonomy terms of current work
    $terms = wp_get_post_terms($post_id, 'work_category', ['fields' => 'ids']);
    if (empty($terms)) {
        return [];
    }

    $args = array(
        'post_type'      => 'works',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id], // exclude current work
        'tax_query'      => array(
            array(
                'taxonomy' => 'work_category',
                'field'    => 'term_id',
                'terms'    => $terms,
            ),
        ),
    );

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return [];
    }

    $posts = [];
    while ($query->have_posts()) {
        $query->the_post();
        $works_meta_info = get_field("works_meta_info");
        $works_images = get_field('works_images');
        $date  = $works_meta_info["date"] ?? '';

        $feature_image = '';
        if (!empty($works_images["feature_image"])) {
            $img = wp_get_attachment_image_src($works_images["feature_image"], 'sedona-blog-thumb');
            $feature_image = $img ? $img[0] : '';
        }

        $posts[] = [
            'id'             => get_the_ID(),
            'title'          => get_the_title(),
            'link'           => get_permalink(),
            'slug'           => get_post_field('post_name', get_the_ID()),
            'featured_image' => $feature_image,
            'date'           => $date,
        ];
    }
    wp_reset_postdata();

    return $posts;
}

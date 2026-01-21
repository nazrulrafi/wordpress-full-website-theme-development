<?php
add_action('rest_api_init', function () {
    register_rest_field('works', 'work_category_names', [
        'get_callback' => function($post_arr) {
            $terms = get_the_terms($post_arr['id'], 'work_category'); // match taxonomy slug
            if (empty($terms) || is_wp_error($terms)) return [];

            return wp_list_pluck($terms, 'name'); // returns array of category names
        },
        'schema' => null,
    ]);
});

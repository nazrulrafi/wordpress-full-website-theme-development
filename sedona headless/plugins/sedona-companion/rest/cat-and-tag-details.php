<?php
// Add category and tag details to REST API posts
add_filter('rest_prepare_post', function($response, $post, $request) {
    // Replace categories with detailed info
    $cats = get_the_category($post->ID);
    $cat_data = [];
    foreach ($cats as $cat) {
        $cat_data[] = [
            'id'   => $cat->term_id,
            'name' => $cat->name,
            'link' => get_category_link($cat->term_id),
        ];
    }
    $response->data['categories'] = $cat_data;

    // Replace tags with detailed info
    $tags = get_the_tags($post->ID);
    $tag_data = [];
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_data[] = [
                'id'   => $tag->term_id,
                'name' => $tag->name,
                'link' => get_tag_link($tag->term_id),
            ];
        }
    }
    $response->data['tags'] = $tag_data;

    return $response;
}, 10, 3);


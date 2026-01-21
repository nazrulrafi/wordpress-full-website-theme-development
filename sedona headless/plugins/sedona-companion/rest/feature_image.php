<?php
// Add featured image URL to REST API response
add_action('rest_api_init', function () {
    register_rest_field(
        array('post', 'page', 'works'), // Add for post types you need
        'featured_image_url',
        array(
            'get_callback' => function ($post_arr) {
                $img_id = $post_arr['featured_media'];
                if (!$img_id) return null;

                $img_src = wp_get_attachment_image_src($img_id, 'full');
                return $img_src ? $img_src[0] : null;
            },
            'schema' => null,
        )
    );
});

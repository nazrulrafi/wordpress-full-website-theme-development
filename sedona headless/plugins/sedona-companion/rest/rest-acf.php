<?php
/**
 * Add ACF fields to REST API responses
 */
function sedona_register_acf_rest() {
    register_rest_field(['page', 'post', 'works'], 'acf', array(
        'get_callback' => function($object) {
            $fields = get_fields($object['id']);
            if (empty($fields)) return null;

            // Recursive function to convert image IDs to URLs
            $convert_ids_to_urls = function(&$value, $key) use (&$convert_ids_to_urls) {
                // Single image or numeric value
                if (is_numeric($value)) {
                    $img = wp_get_attachment_image_src($value, 'full');
                    if ($img) $value = $img[0];
                }
                // If array, loop recursively
                if (is_array($value)) {
                    array_walk($value, $convert_ids_to_urls);
                }
            };

            array_walk($fields, $convert_ids_to_urls);

            return $fields;
        },
        'schema' => null,
    ));
}
add_action('rest_api_init', 'sedona_register_acf_rest');



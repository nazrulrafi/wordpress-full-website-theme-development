<?php
add_filter('acf/fields/post_object/result/name=select_agent', function($title, $post, $field, $post_id) {

    // Get the linked agency
    $agency = get_field('select_agency', $post->ID);

    if (is_object($agency)) {
        $agency_name = get_the_title($agency->ID);
    } elseif (is_int($agency)) {
        $agency_name = get_the_title($agency);
    } else {
        $agency_name = 'No Agency';
    }

    // Return label: "Agent Name (Agency Name)"
    return $post->post_title . ' (' . $agency_name . ')';

}, 10, 4);


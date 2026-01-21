<?php
function rethouse_register_cpts() {
    // Properties
    register_post_type('properties', [
        'labels' => [
            'name'               => 'Properties',
            'singular_name'      => 'Property',
            'menu_name'          => 'Properties',
            'name_admin_bar'     => 'Property',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Property',
            'edit_item'          => 'Edit Property',
            'new_item'           => 'New Property',
            'view_item'          => 'View Property',
            'all_items'          => 'All Properties',
            'search_items'       => 'Search Properties',
            'not_found'          => 'No properties found.',
            'not_found_in_trash' => 'No properties found in Trash.'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title','editor'],
        'rewrite' => ['slug'=>'properties'],
        'show_in_rest' => true,
    ]);


    // Register Location Taxonomy
    register_taxonomy('location', 'properties', [
        'labels' => [
            'name'              => 'Locations',
            'singular_name'     => 'Location',
            'search_items'      => 'Search Locations',
            'all_items'         => 'All Locations',
            'parent_item'       => 'Parent Location',
            'parent_item_colon' => 'Parent Location:',
            'edit_item'         => 'Edit Location',
            'update_item'       => 'Update Location',
            'add_new_item'      => 'Add New Location',
            'new_item_name'     => 'New Location Name',
            'menu_name'         => 'Locations',
        ],
        'hierarchical'      => true, // Works like categories
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'location'],
        'show_in_rest'      => true, // enable for Gutenberg & REST API
    ]);

    // Register Property Category
    register_taxonomy('property_category', 'properties', [
        'labels' => [
            'name'              => 'Property Categories',
            'singular_name'     => 'Property Category',
            'search_items'      => 'Search Property Categories',
            'all_items'         => 'All Property Categories',
            'parent_item'       => 'Parent Property Category',
            'parent_item_colon' => 'Parent Property Category:',
            'edit_item'         => 'Edit Property Category',
            'update_item'       => 'Update Property Category',
            'add_new_item'      => 'Add New Property Category',
            'new_item_name'     => 'New Property Category Name',
            'menu_name'         => 'Property Categories',
        ],
        'hierarchical'      => true, // behaves like Categories
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'property-category'],
        'show_in_rest'      => true, // enable for Gutenberg & REST API
        'show_in_nav_menus' => true, // ✅ Allow in Appearance > Menus

    ]);
    // Agents
    register_post_type('agents', [
        'labels' => [
            'name'               => 'Agents',
            'singular_name'      => 'Agent',
            'menu_name'          => 'Agents',
            'name_admin_bar'     => 'Agent',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Agent',
            'edit_item'          => 'Edit Agent',
            'new_item'           => 'New Agent',
            'view_item'          => 'View Agent',
            'all_items'          => 'All Agents',
            'search_items'       => 'Search Agents',
            'not_found'          => 'No agents found.',
            'not_found_in_trash' => 'No agents found in Trash.'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title','editor','thumbnail'],
    ]);

    // Agencies
    register_post_type('agencies', [
        'labels' => [
            'name'               => 'Agencies',
            'singular_name'      => 'Agency',
            'menu_name'          => 'Agencies',
            'name_admin_bar'     => 'Agency',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Agency',
            'edit_item'          => 'Edit Agency',
            'new_item'           => 'New Agency',
            'view_item'          => 'View Agency',
            'all_items'          => 'All Agencies',
            'search_items'       => 'Search Agencies',
            'not_found'          => 'No agencies found.',
            'not_found_in_trash' => 'No agencies found in Trash.'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title','editor','thumbnail'],
    ]);
}
add_action('init', 'rethouse_register_cpts');


// Add custom column "Agency"
function rethouse_manage_agents_columns( $columns ) {
    $date = $columns['date'];
    unset( $columns['date'] );
    $columns['agency'] = __( 'Agency', 'textdomain' );
    $columns['date'] = $date;
    return $columns;
}
add_filter( 'manage_agents_posts_columns', 'rethouse_manage_agents_columns' );

// Show content in "Agency" column
function rethouse_show_agent_agency_column( $column, $post_id ) {
    if ( $column === 'agency' ) {
        $agency = get_field("select_agency", $post_id);
        $title = get_the_title($agency);
        $link = get_permalink($agency);
        echo "<a href='{$link}' target='_blank'>{$title}</a>";
    }
}
add_action( 'manage_agents_posts_custom_column', 'rethouse_show_agent_agency_column', 10, 2 );




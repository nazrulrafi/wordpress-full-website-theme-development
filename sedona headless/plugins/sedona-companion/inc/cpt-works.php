<?php
// Register Custom Post Type: Works
function create_works_cpt() {
    $labels = array(
        'name'                  => _x( 'Works', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Works', 'textdomain' ),
        'name_admin_bar'        => __( 'Work', 'textdomain' ),
        'add_new'               => __( 'Add New Work', 'textdomain' ),
        'add_new_item'          => __( 'Add New Work', 'textdomain' ),
        'new_item'              => __( 'New Work', 'textdomain' ),
        'edit_item'             => __( 'Edit Work', 'textdomain' ),
        'view_item'             => __( 'View Work', 'textdomain' ),
        'all_items'             => __( 'All Works', 'textdomain' ),
        'search_items'          => __( 'Search Works', 'textdomain' ),
        'not_found'             => __( 'No Works found', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Works found in Trash', 'textdomain' ),
    );

    $args = array(
        'label'                 => __( 'Work', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'revisions', 'editor', 'thumbnail' ),
        'public'                => true,
        'show_in_rest'          => true,
        'rest_base'             => 'works',
        'menu_icon'             => 'dashicons-portfolio',
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'works' ),
    );

    register_post_type( 'works', $args );
}
add_action( 'init', 'create_works_cpt' );

// Register Custom Taxonomy: Work Category
function create_work_category_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Work Categories', 'Taxonomy General Name', 'textdomain' ),
        'singular_name'              => _x( 'Work Category', 'Taxonomy Singular Name', 'textdomain' ),
        'menu_name'                  => __( 'Work Categories', 'textdomain' ),
        'all_items'                  => __( 'All Categories', 'textdomain' ),
        'parent_item'                => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon'          => __( 'Parent Category:', 'textdomain' ),
        'new_item_name'              => __( 'New Category Name', 'textdomain' ),
        'add_new_item'               => __( 'Add New Category', 'textdomain' ),
        'edit_item'                  => __( 'Edit Category', 'textdomain' ),
        'update_item'                => __( 'Update Category', 'textdomain' ),
        'view_item'                  => __( 'View Category', 'textdomain' ),
        'search_items'               => __( 'Search Categories', 'textdomain' ),
        'not_found'                  => __( 'Not Found', 'textdomain' ),
        'no_terms'                   => __( 'No categories', 'textdomain' ),
        'items_list'                 => __( 'Categories list', 'textdomain' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'textdomain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true, // true = behaves like categories
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_rest'               => true, // ✅ REST API enabled
        'rest_base'                  => 'work-category',
        'show_in_nav_menus'          => true,
        'rewrite'                    => array( 'slug' => 'work-category' ),
    );

    register_taxonomy( 'work_category', array( 'works' ), $args );
}
add_action( 'init', 'create_work_category_taxonomy' );

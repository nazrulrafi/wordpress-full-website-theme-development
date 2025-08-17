<?php
/**
 * Plugin Name: Philosophy Companion
 * Description: Adds custom post types like Books and Chapters for the Philosophy theme.
 * Version: 1.1
 * Author: Nazrul Rafi
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types
 */
function philosophy_register_custom_post_types() {

    // Books
    $labels_books = array(
        'name'               => 'Books',
        'singular_name'      => 'Book',
        'menu_name'          => 'Books',
        'name_admin_bar'     => 'Book',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Book',
        'new_item'           => 'New Book',
        'edit_item'          => 'Edit Book',
        'view_item'          => 'View Book',
        'all_items'          => 'All Books',
        'search_items'       => 'Search Books',
        'parent_item_colon'  => 'Parent Books:',
        'not_found'          => 'No books found.',
        'not_found_in_trash' => 'No books found in Trash.'
    );

    $args_books = array(
        'labels'             => $labels_books,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'books' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array( 'title', 'editor', 'thumbnail')
    );

    register_post_type( 'books', $args_books );


    // Chapters
    $labels_chapters = array(
        'name'               => 'Chapters',
        'singular_name'      => 'Chapter',
        'menu_name'          => 'Chapters',
        'name_admin_bar'     => 'Chapter',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Chapter',
        'new_item'           => 'New Chapter',
        'edit_item'          => 'Edit Chapter',
        'view_item'          => 'View Chapter',
        'all_items'          => 'All Chapters',
        'search_items'       => 'Search Chapters',
        'parent_item_colon'  => 'Parent Chapters:',
        'not_found'          => 'No chapters found.',
        'not_found_in_trash' => 'No chapters found in Trash.'
    );

    $args_chapters = array(
        'labels'             => $labels_chapters,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'       => [
            'slug'       => 'books/%book_name%/chapters', // %book_name% will be replaced dynamically
            'with_front' => false
        ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-media-document',
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'chapters', $args_chapters );
}

add_action( 'init', 'philosophy_register_custom_post_types' );



// Add new column to Chapters admin table
add_filter('manage_chapters_posts_columns', function ($columns) {
    $columns['book_name'] = __('Book Name', 'philosophy');
    return $columns;
});

// Fill column with ACF Post Object value
add_action('manage_chapters_posts_custom_column', function ($column, $post_id) {
    if ($column === 'book_name') {
        $book = get_field('book_name', $post_id); // ACF Post Object
        if ($book) {
            echo '<a href="' . get_edit_post_link($book) . '">' . esc_html(get_the_title($book)) . '</a>';
        } else {
            echo '<span style="color:#999">No book assigned</span>';
        }
    }
}, 10, 2);

//Chapter link
add_filter('post_type_link', function ($post_link, $post) {
    if ($post->post_type === 'chapters') {
        $book_id = get_field('book_name', $post->ID); // returns book ID
        if ($book_id) {
            $book_post = get_post($book_id); // get full WP_Post object
            if ($book_post) {
                $post_link = str_replace('%book_name%', $book_post->post_name, $post_link);
            }
        }
    }
    return $post_link;
}, 10, 2);




// Rewrite rules for chapters URLs
add_action('init', function() {
    add_rewrite_rule(
        '^books/([^/]+)/chapters/([^/]+)/?$',
        'index.php?post_type=chapters&name=$matches[2]',
        'top'
    );

    // Optional: Chapter archive by book
    add_rewrite_rule(
        '^books/([^/]+)/chapters/?$',
        'index.php?post_type=chapters&book_name=$matches[1]',
        'top'
    );
});

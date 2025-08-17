<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function philosophy_theme_setup() {
    load_theme_textdomain('philosophy', get_template_directory() . '/languages');
    add_theme_support( 'custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat', 'status'));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'philosophy'),
        'quick_links' => __('Quick Links', 'philosophy'),
    ));
    add_image_size("philosophy-thumb-square", 320, 320, true);
    add_image_size("philosophy-single-post-thumb", 2000, 1000, true);
    add_image_size("philosophy-book-image", 667, 1000, true);
}

add_action('after_setup_theme', 'philosophy_theme_setup');

// Enable SVG upload
function mytheme_allow_svg_upload( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['ico'] = 'image/x-icon';
    return $mimes;
}
add_filter( 'upload_mimes', 'mytheme_allow_svg_upload' );

// Enqueue styles and scripts
function philosophy_enqueue_assets() {
    $theme_uri = get_template_directory_uri();

    // CSS
    wp_enqueue_style('base-css', $theme_uri . '/assets/css/base.css', array(), null);
    wp_enqueue_style('vendor-css', $theme_uri . '/assets/css/vendor.css', array(), null);
    wp_enqueue_style('main-css', $theme_uri . '/assets/css/main.css', array(), null);
    wp_enqueue_style('philosophy-style', get_stylesheet_uri());
    // JS
    wp_enqueue_script('modernizr', $theme_uri . '/assets/js/modernizr.js', array(), null, false);
    wp_enqueue_script('pace', $theme_uri . '/assets/js/pace.min.js', array(), null, false);
    wp_enqueue_script('jquery'); // WordPress built-in jQuery
    wp_enqueue_script('plugins', $theme_uri . '/assets/js/plugins.js', array('jquery'), null, true);
    wp_enqueue_script('main', $theme_uri . '/assets/js/main.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'philosophy_enqueue_assets');


// Hide editor when post format is Quote or Link
function hide_editor_for_quote_link_post_format() {
    global $post;

    if ( $post && in_array( get_post_format( $post->ID ), array('quote', 'link') ) ) {
        remove_post_type_support( 'post', 'editor' );
    }
}
add_action( 'admin_head', 'hide_editor_for_quote_link_post_format' );

// Admin JS to toggle editor dynamically
function admin_hide_editor_for_quote_link() {
    ?>
    <script>
        jQuery(document).ready(function($){
            function toggleEditor(){
                var format = $('input[name="post_format"]:checked').val();
                if(format === 'quote' || format === 'link'){
                    $('#postdivrich').hide(); // Hide description/content editor
                } else {
                    $('#postdivrich').show(); // Show it for other formats
                }
            }
            toggleEditor();
            $('input[name="post_format"]').on('change', toggleEditor);
        });
    </script>
    <?php
}
add_action('admin_footer', 'admin_hide_editor_for_quote_link');



// Add a custom column in the posts list
function add_post_format_column($columns) {
    $columns['post_format'] = __('Post Format', 'textdomain');
    return $columns;
}

add_filter('manage_posts_columns', 'add_post_format_column');

// Display the post format value
function show_post_format_column($column, $post_id) {
    if ('post_format' === $column) {
        $format = get_post_format($post_id);
        if ($format) {
            echo esc_html(ucfirst($format));
        } else {
            echo 'Standard'; // Default if no format
        }
    }
}

add_action('manage_posts_custom_column', 'show_post_format_column', 10, 2);

// Make the column sortable (optional)
function post_format_sortable_column($columns) {
    $columns['post_format'] = 'post_format';
    return $columns;
}

add_filter('manage_edit-post_sortable_columns', 'post_format_sortable_column');


function comment_box_move_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter("comment_form_fields","comment_box_move_bottom",10,1);


function custom_comment_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
<li <?php comment_class(empty($args['has_children']) ? '' : 'thread-alt'); ?> id="comment-<?php comment_ID(); ?>">
    <div class="comment__avatar">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'avatar')); ?>
    </div>
    <div class="comment__content">
        <div class="comment__info">
            <cite><?php comment_author(); ?></cite>
            <div class="comment__meta">
                <time class="comment__time"><?php echo get_comment_date('M j, Y @ H:i'); ?></time>
                <a class="reply" href="#0"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></a>
            </div>
        </div>
        <div class="comment__text">
            <?php if ($comment->comment_approved == '0') : ?>
                <p><em>Your comment is awaiting moderation.</em></p>
            <?php endif; ?>
            <p><?php comment_text(); ?></p>
        </div>
    </div>
    <?php
}

// Remove cookies consent checkbox from comment form
add_filter('comment_form_default_fields', 'remove_comment_cookies_consent');
function remove_comment_cookies_consent($fields) {
    unset($fields['cookies']); // Remove the cookies consent field
    return $fields;
}


// Include the widget class
include get_template_directory() . '/inc/widgets/about-philosophy.php';

// Register the widget
function philosophy_about_widget_register() {
    register_widget('Philosophy_About_Widget');
}
add_action('widgets_init', 'philosophy_about_widget_register');

// Register the sidebar
function philosophy_register_sidebar() {
    register_sidebar([
        'name'          => __('About Philosophy', 'philosophy'),
        'id'            => 'about-philosophy',
        'description'   => __('Widgets in this area will appear in the About Philosophy sidebar.', 'philosophy'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'philosophy_register_sidebar');

// Add .lead class to category and tag descriptions
function philosophy_archive_description_lead($description) {
    if (!empty($description)) {
        // Wrap in <p class="lead"> instead of default <p>
        $description = '<p class="lead">' . wp_kses_post(strip_tags($description, '<a><em><strong>')) . '</p>';
    }
    return $description;
}
add_filter('category_description', 'philosophy_archive_description_lead');
add_filter('tag_description', 'philosophy_archive_description_lead');





// Add Social Links to Customizer
function mytheme_customize_register($wp_customize) {
    // Section for Social Links
    $wp_customize->add_section('social_links_section', array(
            'title'    => __('Social Links', 'mytheme'),
            'priority' => 30,
    ));

    // Social Platforms
    $social_platforms = array('Facebook', 'Instagram', 'Twitter', 'Pinterest', 'GooglePlus', 'LinkedIn');

    foreach ($social_platforms as $platform) {
        $setting_id = strtolower($platform) . '_link';
        $wp_customize->add_setting($setting_id, array(
                'default'   => '',
                'transport' => 'refresh',
        ));
        $wp_customize->add_control($setting_id, array(
                'label'   => __($platform . ' URL', 'mytheme'),
                'section' => 'social_links_section',
                'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'mytheme_customize_register');


<?php
/**
 * rethouse functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rethouse
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


function rethouse_setup() {
	load_theme_textdomain( 'rethouse', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'main_menu' => esc_html__( 'Main Menu', 'rethouse' ),
			'quick_links' => esc_html__( 'Quick Links', 'rethouse' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'rethouse_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
	);
    add_image_size('post-thumb', 750, 500, true); // width, height, crop

}
add_action( 'after_setup_theme', 'rethouse_setup' );

function rethouse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rethouse_content_width', 640 );
}
add_action( 'after_setup_theme', 'rethouse_content_width', 0 );

function rethouse_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rethouse' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rethouse' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rethouse_widgets_init' );


function rethouse_scripts() {
    // Theme stylesheet
    wp_enqueue_style('rethouse-style', get_stylesheet_uri(), array(), _S_VERSION);

    // Bootstrap CSS (CDN)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');

    // Custom CSS
    wp_enqueue_style('rethouse-styles', get_template_directory_uri() . '/assets/css/styles.css', array('bootstrap-css'), filemtime(get_template_directory() . '/assets/css/styles.css'), 'all'
    );

    // Bootstrap Bundle JS (with Popper)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3',
        true
    );

    // Custom JS
    wp_enqueue_script('rethouse-scripts', get_template_directory_uri() . '/assets/js/index.bundle.js', array('jquery', 'bootstrap-js'), filemtime(get_template_directory() . '/assets/js/index.bundle.js'), true);


}
add_action('wp_enqueue_scripts', 'rethouse_scripts');




// Add custom column
add_filter('manage_properties_posts_columns', 'add_is_home_featured_column');
function add_is_home_featured_column($columns) {
    $date = $columns['date'];
    unset($columns['date']);
    $columns['is_home_featured'] = 'Home Featured';
    $columns["date"] = $date;
    return $columns;
}

// Populate custom column
add_action('manage_properties_posts_custom_column', 'show_is_home_featured_column', 10, 2);
function show_is_home_featured_column($column, $post_id) {
    if ($column == 'is_home_featured') {
        $value = get_field('is_home_featured', $post_id);
        echo $value ? 'Yes' : 'No';
    }
}


// Add social links to user profile
function simple_user_social_fields($user) { ?>
    <h3>Social Links</h3>
    <table class="form-table">
        <?php
        $socials = ['facebook','instagram','twitter','telegram','linkedin'];
        foreach($socials as $social): ?>
            <tr>
                <th><label for="<?= $social ?>"><?= ucfirst($social) ?></label></th>
                <td>
                    <input type="text" name="<?= $social ?>" id="<?= $social ?>" value="<?= esc_attr(get_the_author_meta($social, $user->ID)) ?>" class="regular-text" />
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php }
add_action('show_user_profile','simple_user_social_fields');
add_action('edit_user_profile','simple_user_social_fields');
// Save social links
function simple_save_user_social_fields($user_id){
    if(!current_user_can('edit_user',$user_id)) return;
    $socials = ['facebook','instagram','twitter','telegram','linkedin'];
    foreach($socials as $social){
        update_user_meta($user_id, $social, sanitize_text_field($_POST[$social] ?? ''));
    }
}
add_action('personal_options_update','simple_save_user_social_fields');
add_action('edit_user_profile_update','simple_save_user_social_fields');

// Put this in functions.php
add_filter('nav_menu_css_class', function($classes, $item, $args) {
    if ($args->theme_location === 'quick_links') {
        $classes[] = 'list-inline-item';
    }
    return $classes;
}, 10, 3);


add_action('wp_ajax_submit_agent_contact', 'handle_agent_contact');
add_action('wp_ajax_nopriv_submit_agent_contact', 'handle_agent_contact');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/HeaderMenu.php';
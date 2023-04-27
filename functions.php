<?php


if ( ! function_exists( 'wp_bootstrap_starter_setup' ) ) :

function florgenerosa_starter_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Principal', 'wp-bootstrap-starter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    function florgenerosa_add_editor_styles() {
        add_editor_style( 'custom-editor-style.css' );
    }
    add_action( 'admin_init', 'florgenerosa_add_editor_styles' );

}
endif;
add_action( 'after_setup_theme', 'florgenerosa_starter_setup' );

function florgenerosa_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    );

    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'florgenerosa_custom_logo_setup' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/assets/lib/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
};


//Enqueue needed scripts
function register_files() {

	// Styles
	wp_enqueue_style( 'bootstrap-css', get_theme_file_uri() . '/assets/lib/bootstrap5.3/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-icons', get_theme_file_uri() . '/assets/lib/bootstrap-icons/bootstrap-icons.min.css');
	wp_enqueue_style( 'fancybox3', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
	wp_enqueue_style( 'swiper_css', get_theme_file_uri() . '/assets/lib/swiper/css/swiper-bundle.min.css');
	wp_enqueue_style( 'style_css', get_theme_file_uri() . '/assets/dist/css/main.css');

	// Scripts
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri() . '/assets/lib/bootstrap5.3/js/bootstrap.bundle.min.js', '5.3', 'true' );
	wp_enqueue_script( 'fancybox3', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array('jquery'), '3.5.7' ,'true');
	wp_enqueue_script( 'swiper-js', get_theme_file_uri() . '/assets/lib/swiper/js/swiper-bundle.min.js', '6.5.6', 'true' );
	wp_enqueue_script( 'main', get_theme_file_uri() . '/assets/dist/js/main.js', array('jquery'), '1.0.0', 'true' );

}
add_action( 'wp_enqueue_scripts', 'register_files' );

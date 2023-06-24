<?php

if (!function_exists('wp_bootstrap_starter_setup')) :

	function florgenerosa_starter_setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support('title-tag');

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		add_theme_support('html5', array(
			'comment-form',
			'comment-list',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('wp_bootstrap_starter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		function florgenerosa_add_editor_styles()
		{
			add_editor_style('custom-editor-style.css');
		}
		add_action('admin_init', 'florgenerosa_add_editor_styles');
	}
endif;
add_action('after_setup_theme', 'florgenerosa_starter_setup');

function wpb_custom_new_menu() {
	register_nav_menus(
	  array(
		'primary' => __( 'Menu Principal' ),
	  )
	);
  }
  add_action( 'init', 'wpb_custom_new_menu' );

function florgenerosa_custom_logo_setup()
{
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array('site-title', 'site-description'),
		'unlink-homepage-logo' => true,
	);

	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'florgenerosa_custom_logo_setup');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
	require_once get_template_directory() . '/assets/lib/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
	if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
		if (array_key_exists('data-toggle', $atts)) {
			unset($atts['data-toggle']);
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}
	return $atts;
};

//Enqueue needed scripts
function register_files()
{
	// Styles
	wp_enqueue_style('bootstrap', get_theme_file_uri() . '/assets/lib/bootstrap5.3/css/bootstrap.min.css');
	wp_enqueue_style('bootstrap-icons', get_theme_file_uri() . '/assets/lib/bootstrap-icons/bootstrap-icons.min.css');
	wp_enqueue_style('font-awesome-6.4', get_theme_file_uri() . '/assets/lib/font-awesome-6.4.0/css/all.min.css');
	wp_enqueue_style('fancybox3', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
	wp_enqueue_style('swiper', get_theme_file_uri() . '/assets/lib/swiper/css/swiper-bundle.min.css');
	wp_enqueue_style('tom-select', get_theme_file_uri() . '/assets/lib/tom-select/css/tom-select.css');
	wp_enqueue_style('tom-select-bs5', get_theme_file_uri() . '/assets/lib/tom-select/css/tom-select.bootstrap5.min.css');
	wp_enqueue_style('style', get_theme_file_uri() . '/assets/dist/css/main.min.css');

	// Scripts
	wp_enqueue_script('bootstrap', get_theme_file_uri() . '/assets/lib/bootstrap5.3/js/bootstrap.bundle.min.js', '5.3', 'true');
	wp_enqueue_script('fancybox3', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array('jquery'), '5.0', 'true');
	wp_enqueue_script('swiper', get_theme_file_uri() . '/assets/lib/swiper/js/swiper-bundle.min.js', '6.5.6', 'true');
	wp_enqueue_script('tom-select', get_theme_file_uri() . '/assets/lib/tom-select/js/tom-select.complete.js', '2.2.2', 'true');
	wp_enqueue_script('main', get_theme_file_uri() . '/assets/dist/js/main.js', array('jquery'), '1.0.0', 'true');

	if (is_page(array('catalogo'))) {
		wp_enqueue_script('handleCatalog', get_theme_file_uri() . '/assets/dist/js/handleCatalog.js', array(), '1.0.0', true);
	}

	if (is_page(array('cadastro'))) {
		wp_enqueue_script('handleRegister', get_theme_file_uri() . '/assets/dist/js/handleRegister.js', array(), '1.0.0', true);
	}

	// if (is_page(array('adicionar-pratica-pedagogica'))) {
	// 	wp_enqueue_script('handlePPForm', get_theme_file_uri() . '/assets/dist/js/handlePPForm.js', array(), '1.0.0', true);
	// }

	if (is_front_page()) {
		wp_enqueue_script('handleRegister', get_theme_file_uri() . '/assets/dist/js/handleFrontPageSelects.js', array(), '1.0.0', true);
	}
}
add_action('wp_enqueue_scripts', 'register_files');

require_once('inc/define-carbonfields.php');
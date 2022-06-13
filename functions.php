<?php
/**
 * _os functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _os
 */

 if ( ! defined( '_os_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_os_VERSION', '1.0.0' );
}

if ( ! function_exists( '_os_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _os_setup() {

    /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _os, use a find and replace
		 * to change '_os' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_os', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_os' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

    /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array()
		);
	}
endif;

add_action( 'after_setup_theme', '_os_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _os_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_os' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_os' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_os_widgets_init' );

/**
 * link options page to gutenberg colors
*/
function os_guten_colors(){
	$css = '';
	$css .= '.has-primary-theme-color-background-color { background-color: ' . get_field('primary_color','option') . '; }';
	$css .= '.has-secondary-theme-color-background-color { background-color: ' . get_field('secondary_color','option') . '; }';
	$css .= '.has-light-color-background-color { background-color: ' . get_field('light_color','option') . '; }';
	$css .= '.has-dark-color-background-color { background-color: ' . get_field('dark_color','option') . '; }';
	$css .= '.has-primary-theme-color-color { color: ' . get_field('primary_color','option') . '!important; }';
	$css .= '.has-secondary-theme-color-color { color: ' . get_field('secondary_color','option') . '!important; }';
	$css .= '.has-light-color-color { color: ' . get_field('light_color','option') . '!important; }';
	$css .= '.has-dark-color-color { color: ' . get_field('dark_color','option') . '!important; }';

	return wp_strip_all_tags($css);
}

function os_global_css(){
	$primaryCol = get_field('primary_color','option');
	$SecondaryCol = get_field('secondary_color','option');
	$lightCol = get_field('light_color','option');
	$darkCol = get_field('dark_color','option');

	$buttonBorderRadius = get_field('button_border_radius','option');

	$css = "
	.wp-block-button__link{
		border-radius:{$buttonBorderRadius}px;
	}
	";
	return wp_strip_all_tags($css);
}


/**
 * Enqueue scripts and styles.
 */
function _os_scripts() {

    wp_enqueue_style( '_os-style-normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), _os_VERSION );

    wp_enqueue_style( '_os-style', get_stylesheet_uri(), array(), _os_VERSION );

    wp_add_inline_style('_os-style', os_guten_colors() );

    wp_add_inline_style('_os-style', os_global_css() );

    $typoInline = "body{" . get_field('typo_css','option') . "}";

    wp_add_inline_style('_os-style', $typoInline );

    wp_enqueue_script( '_os-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), _os_VERSION, true );

    wp_enqueue_script( '_os-nav-script', get_template_directory_uri() . '/assets/js/nav.js', array('jquery'), _os_VERSION, true);

    wp_enqueue_script( '_os-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), _os_VERSION, true );

    wp_enqueue_script( '_os-webflow', get_template_directory_uri() . '/assets/js/webflow.js', array('_os-lightbox'), _os_VERSION, true );

    wp_enqueue_script( '_os-webflow-animations', get_template_directory_uri() . '/assets/js/animations.js', array('_os-webflow'), _os_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_os_scripts' );


/**
*	Gutenberg assets
*/
add_action( 'enqueue_block_editor_assets', 'os_add_gutenberg_assets' );
function os_add_gutenberg_assets() {

	wp_enqueue_style( 'os-gutenberg-css', get_template_directory_uri() . '/assets/css/guten.css', false );

	wp_add_inline_style('os-gutenberg-css',os_guten_colors() );

	wp_add_inline_style('os-gutenberg-css', os_global_css() );

    $typoInline = get_field('typo_import','option') . ".editor-styles-wrapper p,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6,.editor-styles-wrapper ul,.editor-styles-wrapper ol{" . get_field('typo_css','option') . "}";

    wp_add_inline_style('os-gutenberg-css', $typoInline );

}

/**
 * Allow SVG File uploads
 */
function add_file_types_to_uploads($file_types){

  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg';
  $file_types = array_merge($file_types, $new_filetypes );

  return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

/**
 * Include ACF
 */
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

/**
 * Remove comments
 */
// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


/**
 * Register theme option page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

/**
 * Block register
 */
require get_template_directory() . '/inc/block-register.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which modify gutenberg
 */
require get_template_directory() . '/inc/gutenberg.php';

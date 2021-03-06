<?php
/**
 * test_theme_2016-05-14 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package test_theme_2016-05-14
 */

if ( ! function_exists( 'test_theme_2016_05_14_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_theme_2016_05_14_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on test_theme_2016-05-14, use a find and replace
	 * to change 'test_theme_2016-05-14' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'test_theme_2016-05-14', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'test_theme_2016-05-14' ),
		'secondary' => esc_html__( 'Secondary', 'test_theme_2016-05-14' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'test_theme_2016_05_14_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'test_theme_2016_05_14_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function test_theme_2016_05_14_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'test_theme_2016_05_14_content_width', 1000 );
}
add_action( 'after_setup_theme', 'test_theme_2016_05_14_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function test_theme_2016_05_14_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'test_theme_2016-05-14' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'test_theme_2016-05-14' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'test_theme_2016_05_14_widgets_init' );

/*
 * Enqueue my local font
 */



/*
 * Easier way to handle Google fonts
 */
function google_fonts() {
	$query_args = array(
		// 'family' => 'Montserrat:400,700|Open+Sans:400,700|Oswald:700',
		'family' => 'Open+Sans:400,700|Oswald:700',
		'subset' => 'latin,latin-ext',
		);
	wp_enqueue_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}


/**
 * Enqueue scripts and styles.
 */
function test_theme_2016_05_14_scripts() {
	wp_enqueue_style( 'test_theme_2016-05-14-style', get_template_directory_uri() . '/style.min.css' );

	google_fonts();

	//enqueue local fonts: Montserrat...
	wp_enqueue_style( 'local-fonts', get_template_directory_uri() . '/fonts/fonts_stylesheet.css' );

	wp_enqueue_script( 'test_theme_2016-05-14-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'test_theme_2016-05-14-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'test_theme_2016_05_14_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

<?php
/**
 * DadeCore Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DadeCore_Theme
 */

if ( ! function_exists( 'dadecore_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dadecore_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on "DadeCore Theme", use a different
		 * text domain since you're making a derivative theme.
		 */
		load_theme_textdomain( 'dadecore-theme', get_template_directory() . '/languages' );

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
			'primary_menu' => esc_html__( 'Menú Principal', 'dadecore-theme' ),
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
			'script',
			'style',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'dadecore_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function dadecore_theme_scripts() {
	// Estilos principales del tema
	wp_enqueue_style( 'dadecore-theme-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), null );

	// Fuentes de Google (Inter y Poppins)
	// Precarga para optimización
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap', false );
	wp_style_add_data( 'google-fonts', 'precache', true );


	// Script principal del tema
	wp_enqueue_script( 'dadecore-theme-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true ); // 'true' para cargar en el footer

	// Asegúrate de que jQuery no se cargue por defecto si no lo necesitas,
	// o que se cargue de forma selectiva si algún plugin lo requiere.
	// Por ahora, WordPress cargará su versión si es necesaria.
	// Más adelante podemos desregistrarla si se necesita una solución Vanilla JS pura.
}
add_action( 'wp_enqueue_scripts', 'dadecore_theme_scripts' );

// Incluir el archivo de funciones del customizer si lo creamos más adelante.
// require get_template_directory() . '/inc/customizer.php';

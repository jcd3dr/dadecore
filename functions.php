<?php
/**
 * DadeCore block theme setup
 */

function dadecore_setup() {
    load_theme_textdomain( 'dadecore-theme', get_template_directory() . '/languages' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'block-templates' );
    add_theme_support( 'block-template-parts' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support(
        'html5',
        array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' )
    );
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'dadecore-theme' ),
        )
    );
    add_editor_style( 'assets/css/main.css' );
}
add_action( 'after_setup_theme', 'dadecore_setup' );

/**
 * Enqueue theme assets.
 */
function dadecore_theme_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ! is_admin() ) {
        wp_enqueue_style(
            'dadecore-theme',
            get_template_directory_uri() . '/assets/css/main.css',
            array(),
            $theme_version
        );

        wp_enqueue_style(
            'dadecore-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap',
            array(),
            null
        );
    }

    if ( ( has_nav_menu( 'primary' ) || ( function_exists( 'has_block' ) && has_block( 'core/navigation' ) ) ) && ! is_admin() ) {
        wp_enqueue_script(
            'dadecore-script',
            get_template_directory_uri() . '/assets/js/main.js',
            array(),
            $theme_version,
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'dadecore_theme_scripts' );

/**
 * Register widget areas.
 */
function dadecore_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Blog Sidebar', 'dadecore-theme' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Add widgets here to appear in your blog sidebar.', 'dadecore-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer Widgets', 'dadecore-theme' ),
            'id'            => 'footer-1',
            'description'   => __( 'Widgets added here will appear in the footer.', 'dadecore-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'dadecore_widgets_init' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/security.php';
require get_template_directory() . '/inc/security-settings.php';
require get_template_directory() . '/inc/integrations.php';

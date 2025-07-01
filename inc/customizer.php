<?php
/**
 * Simple Customizer settings for DadeCore Theme.
 */

function dadecore_customize_register( $wp_customize ) {
    // Accent color setting
    $wp_customize->add_setting( 'accent_color', array(
        'default'   => '#00FFC2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'accent_color',
        array(
            'label'    => __( 'Accent Color', 'dadecore-theme' ),
            'section'  => 'colors',
        )
    ) );

    // Login slug setting for security feature
    $wp_customize->add_setting( 'login_slug', array(
        'default' => 'login',
        'sanitize_callback' => 'sanitize_title_with_dashes',
    ) );

    $wp_customize->add_control( 'login_slug', array(
        'label'   => __( 'Custom Login URL Slug', 'dadecore-theme' ),
        'section' => 'title_tagline',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'dadecore_customize_register' );

function dadecore_customizer_css() {
    $accent = get_theme_mod( 'accent_color', '#00FFC2' );
    echo '<style type="text/css">:root{--color-green-tech:' . esc_attr( $accent ) . ';}</style>';
}
add_action( 'wp_head', 'dadecore_customizer_css' );

// Sync login slug from Customizer to option on save
function dadecore_customizer_save_login_slug( $manager ) {
    $slug = $manager->get_setting( 'login_slug' )->value();
    if ( $slug ) {
        update_option( 'dadecore_login_slug', sanitize_title_with_dashes( $slug ) );
        flush_rewrite_rules();
    }
}
add_action( 'customize_save_after', 'dadecore_customizer_save_login_slug' );

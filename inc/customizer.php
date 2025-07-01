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

}
add_action( 'customize_register', 'dadecore_customize_register' );

function dadecore_customizer_css() {
    $accent = get_theme_mod( 'accent_color', '#00FFC2' );
    echo '<style type="text/css">:root{--color-green-tech:' . esc_attr( $accent ) . ';}</style>';
}
add_action( 'wp_head', 'dadecore_customizer_css' );

<?php
/**
 * Basic security enhancements for DadeCore Theme.
 */

// Custom login slug functionality
function dadecore_custom_login_slug() {
    $slug = get_theme_mod( 'login_slug', 'login' );
    if ( 'login' !== $slug ) {
        add_rewrite_rule( "^{$slug}/?", 'wp-login.php', 'top' );
    }
}
add_action( 'init', 'dadecore_custom_login_slug' );

// Limit login attempts using transients
function dadecore_limit_login_attempts( $user, $username, $password ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'dadecore_login_' . md5( $ip );
    $attempts = (int) get_transient( $key );
    if ( $attempts >= 5 ) {
        wp_die( __( 'Too many login attempts. Try again later.', 'dadecore-theme' ) );
    }
    set_transient( $key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
    return $user;
}
add_filter( 'authenticate', 'dadecore_limit_login_attempts', 30, 3 );

// Add simple security headers
function dadecore_security_headers() {
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'Referrer-Policy: no-referrer-when-downgrade' );
}
add_action( 'send_headers', 'dadecore_security_headers' );

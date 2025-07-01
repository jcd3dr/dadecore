<?php
/**
 * Basic security enhancements for DadeCore Theme.
 */

// Custom login slug functionality based on option value or Customizer setting
function dadecore_custom_login_slug() {
    $slug = get_option( 'dadecore_login_slug', '' );
    if ( ! $slug ) {
        $slug = get_theme_mod( 'login_slug', 'login' );
    }
    if ( 'login' !== $slug ) {
        add_rewrite_rule( "^{$slug}/?", 'wp-login.php', 'top' );
    }
}
add_action( 'init', 'dadecore_custom_login_slug' );

// Keep option and Customizer in sync
function dadecore_sync_login_slug( $value ) {
    update_option( 'dadecore_login_slug', sanitize_title_with_dashes( $value ) );
    return $value;
}
add_filter( 'pre_update_option_login_slug', 'dadecore_sync_login_slug' );

// Redirect from default login page if hidden
function dadecore_redirect_default_login() {
    $slug           = get_option( 'dadecore_login_slug', 'login' );
    $hide_default   = (int) get_option( 'dadecore_hide_default_login', 1 );
    if ( $hide_default && 'login' !== $slug && 'wp-login.php' === basename( $_SERVER['PHP_SELF'] ) ) {
        wp_redirect( site_url( $slug ) );
        exit;
    }
}
add_action( 'login_init', 'dadecore_redirect_default_login' );

// Protect wp-admin
function dadecore_protect_admin_area() {
    if ( is_user_logged_in() ) {
        return;
    }

    $protect_admin = (int) get_option( 'dadecore_protect_admin', 1 );
    $slug          = get_option( 'dadecore_login_slug', 'login' );

    if ( $protect_admin && strpos( $_SERVER['REQUEST_URI'], 'wp-admin' ) !== false ) {
        wp_redirect( site_url( $slug ) );
        exit;
    }
}
add_action( 'init', 'dadecore_protect_admin_area' );

// Limit login attempts using transients
function dadecore_limit_login_attempts( $user, $username, $password ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'dadecore_login_' . md5( $ip );
    $attempts = (int) get_transient( $key );

    $max_attempts    = (int) get_option( 'dadecore_max_login_attempts', 5 );
    $lockout_minutes = (int) get_option( 'dadecore_login_lockout_minutes', 15 );

    if ( $attempts >= $max_attempts ) {
        wp_die( __( 'Too many login attempts. Try again later.', 'dadecore-theme' ) );
    }

    set_transient( $key, $attempts + 1, $lockout_minutes * MINUTE_IN_SECONDS );
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

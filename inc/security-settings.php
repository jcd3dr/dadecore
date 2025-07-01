<?php
/**
 * Seguridad Login settings for DadeCore Theme.
 */

// Register settings and add menu page.
function dadecore_security_settings_init() {
    // Register settings
    register_setting( 'dadecore_security_settings', 'dadecore_login_slug', array(
        'sanitize_callback' => 'sanitize_title_with_dashes',
        'default'           => 'login',
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_max_login_attempts', array(
        'sanitize_callback' => 'absint',
        'default'           => 5,
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_login_lockout_minutes', array(
        'sanitize_callback' => 'absint',
        'default'           => 15,
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_hide_default_login', array(
        'sanitize_callback' => 'absint',
        'default'           => 1,
    ) );
    register_setting( 'dadecore_security_settings', 'dadecore_protect_admin', array(
        'sanitize_callback' => 'absint',
        'default'           => 1,
    ) );

    add_options_page(
        __( 'Seguridad Login', 'dadecore-theme' ),
        __( 'Seguridad Login', 'dadecore-theme' ),
        'manage_options',
        'dadecore-security-settings',
        'dadecore_security_settings_page'
    );
}
add_action( 'admin_menu', 'dadecore_security_settings_init' );

// Flush rewrite rules if login slug changes.
function dadecore_flush_rewrite_rules( $old_value, $value, $option ) {
    if ( $old_value !== $value ) {
        flush_rewrite_rules();
    }
}
add_action( 'update_option_dadecore_login_slug', 'dadecore_flush_rewrite_rules', 10, 3 );

// Render settings page.
function dadecore_security_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Seguridad Login', 'dadecore-theme' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'dadecore_security_settings' );
            ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="dadecore_login_slug"><?php esc_html_e( 'Slug personalizado para login', 'dadecore-theme' ); ?></label></th>
                    <td><input name="dadecore_login_slug" type="text" id="dadecore_login_slug" value="<?php echo esc_attr( get_option( 'dadecore_login_slug', 'login' ) ); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dadecore_max_login_attempts"><?php esc_html_e( 'Máx. intentos fallidos', 'dadecore-theme' ); ?></label></th>
                    <td><input name="dadecore_max_login_attempts" type="number" id="dadecore_max_login_attempts" value="<?php echo esc_attr( get_option( 'dadecore_max_login_attempts', 5 ) ); ?>" class="small-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dadecore_login_lockout_minutes"><?php esc_html_e( 'Tiempo de bloqueo (minutos)', 'dadecore-theme' ); ?></label></th>
                    <td><input name="dadecore_login_lockout_minutes" type="number" id="dadecore_login_lockout_minutes" value="<?php echo esc_attr( get_option( 'dadecore_login_lockout_minutes', 15 ) ); ?>" class="small-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dadecore_hide_default_login"><?php esc_html_e( 'Ocultar wp-login.php', 'dadecore-theme' ); ?></label></th>
                    <td><input name="dadecore_hide_default_login" type="checkbox" id="dadecore_hide_default_login" value="1" <?php checked( get_option( 'dadecore_hide_default_login', 1 ) ); ?> /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dadecore_protect_admin"><?php esc_html_e( 'Proteger wp-admin', 'dadecore-theme' ); ?></label></th>
                    <td><input name="dadecore_protect_admin" type="checkbox" id="dadecore_protect_admin" value="1" <?php checked( get_option( 'dadecore_protect_admin', 1 ) ); ?> /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

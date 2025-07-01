<?php
/**
 * Integrations settings for DadeCore Theme.
 */

// Register settings and add menu page
function dadecore_integrations_settings_init() {
    register_setting( 'dadecore_integrations', 'dadecore_gtm_head', array(
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ) );
    register_setting( 'dadecore_integrations', 'dadecore_gtm_body', array(
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ) );

    add_options_page(
        __( 'Integraciones', 'dadecore-theme' ),
        __( 'Integraciones', 'dadecore-theme' ),
        'manage_options',
        'dadecore-integrations',
        'dadecore_integrations_settings_page'
    );
}
add_action( 'admin_menu', 'dadecore_integrations_settings_init' );

// Render settings page
function dadecore_integrations_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Integraciones', 'dadecore-theme' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'dadecore_integrations' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="dadecore_gtm_head"><?php esc_html_e( 'Google Tag Manager &lt;head&gt; code', 'dadecore-theme' ); ?></label></th>
                    <td>
                        <textarea name="dadecore_gtm_head" id="dadecore_gtm_head" class="large-text" rows="4"><?php echo esc_textarea( get_option( 'dadecore_gtm_head', '' ) ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="dadecore_gtm_body"><?php esc_html_e( 'Google Tag Manager &lt;body&gt; code', 'dadecore-theme' ); ?></label></th>
                    <td>
                        <textarea name="dadecore_gtm_body" id="dadecore_gtm_body" class="large-text" rows="4"><?php echo esc_textarea( get_option( 'dadecore_gtm_body', '' ) ); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Output GTM codes
function dadecore_output_gtm_head() {
    $code = get_option( 'dadecore_gtm_head', '' );
    if ( $code ) {
        echo $code . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action( 'wp_head', 'dadecore_output_gtm_head' );

function dadecore_output_gtm_body() {
    $code = get_option( 'dadecore_gtm_body', '' );
    if ( $code ) {
        echo $code . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action( 'wp_body_open', 'dadecore_output_gtm_body' );

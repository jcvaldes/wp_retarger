<?php
function edd_sample_license_menu() {
    add_submenu_page('wp_retarger.php', 'Plugin License', 'Plugin License', 'manage_options', 'wp_retarger-licenser', 'edd_sample_license_page');
    //add_menu_page( 'Licencia', 'Plugin License', 'manage_options', 'wp_retarger-licenser', 'edd_sample_license_page' );
}
add_action('admin_menu', 'edd_sample_license_menu');

function edd_sample_license_page() {
    global $retarger;
    $license    = $retarger->getLicense();
    $status     = $retarger->getStatus();
    ?>
    <div class="wrap">
        <h2><?php _e('Activar WP Retarger'); ?></h2>
        <form method="post" action="options.php">

            <?php settings_fields('edd_sample_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('Licencia del producto'); ?>
                        </th>
                        <td>
                            <div class="col-md-6">
                                <textarea id="retarger_license_key" name="retarger_license_key" type="text" class="regular-text form-control" rows="5" /><?php esc_attr_e( $license ); ?></textarea>
                                <label class="description" for="retarger_license_key"><?php _e('Escribe el código de tu licencia'); ?></label>
                            </div>
                        </td>
                    </tr>
                    <?php if( false !== $license ) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activar licencia'); ?>
                            </th>
                            <td>
                                <?php if( $status !== false && $status == 'active' ) { ?>
                                    <span style="color:green;"><?php _e('Licencia Activa'); ?></span>
                                <?php } else {
                                    wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
                                    <?php if( $status !== false && $status == 'invalid' ) {  ?>
                                        <span style="color:red;"><?php _e('Licencia Invalida'); ?></span> <br>
                                    <?php } ?>
                                    <input type="submit" class="button-secondary" name="edd_license_activate" value="<?php _e('Activar'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if(!($status !== false && $status == 'active') ) {  submit_button();  } ?>

        </form>
    <?php
}

function edd_sample_register_option() {
    // creates our settings in the options table
    register_setting('edd_sample_license', 'retarger_license_key', 'edd_sanitize_license' );
}
add_action('admin_init', 'edd_sample_register_option');

function edd_sanitize_license( $new ) {
    $old = get_option( 'retarger_license_key' );
    if( $old && $old != $new ) {
        delete_option( 'retarger_license_key' ); // new license has been entered, so must reactivate
    }
    return $new;
}


function edd_sample_activate_license() {
    global $retarger;
    define("LICENSER_URL", "http://3541cacd.ngrok.io/api/activate");
    //var_dump($_POST); exit;


    // listen for our activate button to be clicked
    if( isset( $_POST['edd_license_activate'] ) ) {
var_dump("Activando");
        // run a quick security check
        if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
            return; // get out if we didn't click the Activate button

        // retrieve the license from the database
        $license = trim( $_POST[ 'retarger_license_key'] );


        // data to send in our API request
        $api_params = array(
            'action'=> 'activate_license',
            'license'   => $license,
            'domain'       => home_url()
        );

        //var_dump($api_params); exit;

        // Call the custom API.
        $response = wp_remote_post( LICENSER_URL, array(
            'timeout'   => 15,
            'sslverify' => false,
            'body'      => $api_params
        ) );

        // make sure the response came back okay
        if ( is_wp_error( $response ) )
            return false;

        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) );
        // $license_data->license will be either "active" or "inactive"

        //var_dump($retarger);exit;
        if($license_data->status){
            $retarger->setStatus($license_data->status);
        }

    }
}
add_action('admin_init', 'edd_sample_activate_license');
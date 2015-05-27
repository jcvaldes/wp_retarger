<?php

class Uploader
{
    function write()
    {
        if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $uploadedfile = $_FILES['myfile'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        if ( $movefile ) {
            $wp_filetype = $movefile['type'];
            $filename = $movefile['file'];
            $wp_upload_dir = wp_upload_dir();
            return  $wp_upload_dir['url'] . '/' . basename($filename);
            
//             $attachment = array(
//                 'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
//                 'post_mime_type' => $wp_filetype,
//                 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
//                 'post_content' => '',
//                 'post_status' => 'inherit'
//             );
//             $attach_id = wp_insert_attachment( $attachment, $filename);
        }
    }
}

?>
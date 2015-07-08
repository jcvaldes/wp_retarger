<?php

class Ruploader
{
    private $picture;
    private $image = false;

    function upload($url){
        $this->picture = $_FILES['picture'];
        if($this->picture['error'] == 0){
            $filetmp = $this->picture['tmp_name'];
            //clean filename and extract extension
            $filename = $this->picture['name'];
            // get file info
            $filetype = wp_check_filetype( basename( $filename ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
            $filename = $filetitle . '.' . $filetype['ext'];
            $upload_dir = wp_upload_dir();
            /**
            * Check if the filename already exist in the directory and rename the file if necessary
            */
            $i = 0;
            while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
                $filename = $filetitle . '_' . $i . '.' . $filetype['ext']; $i++;
            }
            $filedest = $upload_dir['path'] . '/' . $filename;
            $this->image = $upload_dir['url'] . '/' . $filename;
            /**
            * Check write permissions
            */
            if ( !is_writeable( $upload_dir['path'] ) ) {
                die('Unable to write to directory %s. Is this directory writable by the server?');
                return;
            }
            /**
            * Save temporary file to uploads dir
            */
            if ( !@move_uploaded_file($filetmp, $filedest) ){
                die("Error, the file $filetmp could not moved to : $filedest ");
                continue;
            }

        }else{
            if(!empty($url)){
                $this->image = $url;
            }
        }
        return $this->image;
    }
}

?>
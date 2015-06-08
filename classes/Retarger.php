<?php

class Retarger
{
    private $items = [];
    public $table;

    public function __construct(){
        $this->items = $this->getAll();
        $this->table = new RoutersTable($this->items);
    }

    public function get($id){
        return $this->items[$this->find($id)];
    }

    public function store($data){

        /* TYPE */
        $popup = [];
        $modal = '';
        $router_id = uniqid();

        /* PICTURE */
        $image = false;

        $picture = $_FILES['picture'];

        if($picture['error'] == 0){

            $filetmp = $picture['tmp_name'];

            //clean filename and extract extension
            $filename = $picture['name'];

            // get file info
            // @fixme: wp checks the file extension....
            $filetype = wp_check_filetype( basename( $filename ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
            $filename = $filetitle . '.' . $filetype['ext'];
            $upload_dir = wp_upload_dir();

            /**
            * Check if the filename already exist in the directory and rename the
            * file if necessary
            */
            $i = 0;
            while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
            $filename = $filetitle . '_' . $i . '.' . $filetype['ext'];
            $i++;
            }
            $filedest = $upload_dir['path'] . '/' . $filename;

            $image = $upload_dir['url'] . '/' . $filename;

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
            $image = $data['url_image_redirect'];
        }


        if($data['popup-type'] == 2){
            $popup = [  'width' => $data['popup-width'],
                        'height' => $data['popup-height'],
                        'show' => $data['popup-show'],
                        'url' => $data['url-popup'],
                        'html' => $data['html-popup']
            ];
            $content = '';
            if($popup['show'] == 'url'){
                $content = '<iframe src="'.$popup['url'].'" width="100%" height="100%"  scrolling="no" frameborder="0" style="z-index:3;"></iframe>';
            }else if($popup['show'] == 'html'){
                $content = "<p>".$popup['html']."</p>";
            }

            $modal = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script><script src="'.plugin_dir_url(__FILE__ ).'../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script> <link rel="stylesheet" href="'.plugin_dir_url(__FILE__ ).'../css/jquery.modal.css" type="text/css" media="screen" />  <div class="modal" id="modal" style="position:fixed; top:0px; left:0px;display:none;width:'.$popup['width'].'px;height:'.$popup['height'].'px; z-index:2;"> '.$content.' ';

        }else if($data['popup-type'] == 3){
            $popup = [  'position' => $data['position'],
                        'click' => !!$data['image-click'],
                        'image-click-url' => $data['image-click-url'],
                        'title' => $data['title'],
                        'image' => $image,
                        'description' => $data['description'],
                        'button' => [
                                'text' => $data['button-text'],
                                'url' => $data['button-url'],
                                'background' => $data['button-background'],
                                'color' => $data['button-color'],

                        ]
            ];

            if($image){
                $img = '<img class="img-responsive" src="'.$image.'" id="p3-image">';
            }else{
                $img = '<img class="img-responsive" src="https://en.opensuse.org/images/0/0b/Icon-user.png" id="p3-image">';
            }

            if(!!$data['image-click']){
                $img = '<a href="'.$data['image-click-url'].'" >'. $img .'</a>';
            }

            $assets = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script><script src="'.plugin_dir_url(__FILE__ ).'../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script> <link rel="stylesheet" href="'.plugin_dir_url(__FILE__ ).'../css/jquery.modal.css" type="text/css" media="screen" />';

            $modal = $assets . '<div class="modalb" id="modal" style="display:none;width:600px;"  data-position="'.$data['position'].'"> <table width="100%"> <tr> <td width="100">'.$img.'</td> <td valign="top"> <p id="p3-title"></p> </td> <td valign="bottom" align="center"> <a id="p3-button" style="color:" href=""></a> </td> </tr> <tr><td colspan="3"><p id="p3-description"></p></td></tr></table> </div>';

            $modalb =   '<div class="modalb col-xs-6 col-md-6 col-lg-6" id="modal" style="display:none;"  data-position="'.$data['position'].'">'.
                            '<div class="row">' .
                                '<div class="">' .
                                    '<div class="col-md-3 col-xs-12">' .
                                        $img .
                                    '</div>'.
                                    '<div class="col-md-9 col-xs-12">' .
                                        '<h3>'.$data['title'].'</h3>' .
                                        '<p id="p3-description">'.$data['description'].'</p>' .
                                        '<a id="p3-button" class="btn pull-right" style="color:'.$data['button-color'].';background-color:'.$data['button-background'].'" href="'.$data['button-url'].'">'.$data['button-text'].'</a>' .
                                    '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>';

            $modal = $assets . $modalb;

           /* */

        }

        /* IFRAME */

        $pixel = $data['wp_retarger_pixel'];

        $iframe = '<iframe src="'.$data['urlembed_router'].'" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:0;"></iframe>' . $modal;
        /* Create page */
        $page = array(
          'post_title'    => wp_strip_all_tags($data['name_router']),
          'post_content'  => $pixel . $iframe . '<input type="hidden" id="router_id" value="'.$router_id.'">',
          'post_status'   => 'publish',
          'post_name'     => $data['name_router'],
          'post_type'     => 'page',
          'page_template' => 'retarger.php'
        );

        // Insert the post into the database
        $post_id = wp_insert_post( $page );

        $uploader = new Uploader();
        $url_filename = $uploader->write();

        $aux = array(
            'ID' => $router_id,
            'name_router' => esc_html($data['name_router']),
            'urlembed_router' => esc_html($data['urlembed_router']),
            'pixel' => ($data['wp_retarger_pixel']),
            'post_id' => $post_id,
            'visits' => 0,
            'type' => $data['popup-type'],
            'popup' => $popup
        );

        array_push($this->items, $aux);
        $this->save();

        //var_dump($this->items); exit;
    }

    public function update($data){

        $this->delete($data['id']);
        $this->store($data);
        return;
        $key = $this->find($data['id']);

        $this->items[$key]['ID']  =   $val['ID'];
        $this->items[$key]['name_router'] =   esc_html($data['name_router']);
        $this->items[$key]['urlembed_router'] =   esc_html($data['urlembed_router']);
        $this->items[$key]['pixel']   =   esc_html($data['wp_retarger_pixel']);

        $this->save();
    }

    public function delete($id){
        $key = $this->find($id);

        if($key === false){
            if(count($this->items) == 1){
                $this->items = [];
                return $this->save();
            }
            return false;
        }

        wp_delete_post($this->items[$key]['post_id'], true);
        array_splice($this->items, $key, 1);
        return $this->save();
    }

    /* Helpers */

    public function getAll(){
        return get_option('wp_retarger', array());
    }

    public function find($id){
        foreach ($this->items as $key => $item) {
           if ($item['ID'] == $id) {
                return $key;
           }
        }
        return false;
    }

    public function save(){
        $this->table = new RoutersTable($this->items);
        return update_option('wp_retarger', $this->items);
    }

    public function counter($id){
        $key = $this->find($id);
        if(isset($this->items[$key])){
            $this->items[$key]['visits'] = ($this->items[$key]['visits'] + 1);
        }
        $this->save();
    }
}

?>
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



            $modal = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script><script src="'.plugin_dir_url(__FILE__ ).'../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script> <link rel="stylesheet" href="'.plugin_dir_url(__FILE__ ).'../css/jquery.modal.css" type="text/css" media="screen" />  <div class="modal" id="modal" style="position:fixed; top:0px; left:0px;display:none;width:'.$popup['width'].'px;height:'.$popup['height'].'px; z-index:2;"> '.$content.' </div> <script type="text/javascript" charset="utf-8"> $(function() {$(document).ready(function($) {$("#modal").modal(); }); }); </script>';

        }



        /* IFRAME */

        $pixel = $data['wp_retarger_pixel'];

        $iframe = '<iframe src="'.$data['urlembed_router'].'" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:0;"></iframe>' . $modal;
        /* Create page */
        $page = array(
          'post_title'    => wp_strip_all_tags($data['name_router']),
          'post_content'  => $pixel . $iframe,
          'post_status'   => 'publish',
          'post_name'     => $data['name_router'],
          'post_type'     => 'page',
          'page_template' => 'empty.php',
          'type' => $data['popup-type'],
          'popup' => $popup
        );

        // Insert the post into the database
        $post_id = wp_insert_post( $page );

        $uploader = new Uploader();
        $url_filename = $uploader->write();

        $aux = array(
            'ID' => uniqid(),
            'name_router' => esc_html($data['name_router']),
            'urlembed_router' => esc_html($data['urlembed_router']),
            'pixel' => ($data['wp_retarger_pixel']),
            'post_id' => $post_id
        );

        array_push($this->items, $aux);
        $this->save();
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

        wp_delete_post($this->items[$key]['post_id']);
        array_splice($this->items, $key, 1);
        return $this->save();
    }

    /* Helpers */

    public function getAll(){
        return (get_option('wp_retarger')) ? get_option('wp_retarger') : [];
    }

    public function find($id){
        foreach ($this->items as $key => $item) {
           if ($item['ID'] == $id) {
                return $key;
           }
        }
    }

    public function save(){
        $this->table = new RoutersTable($this->items);
        return update_option('wp_retarger', $this->items);
    }
}

?>
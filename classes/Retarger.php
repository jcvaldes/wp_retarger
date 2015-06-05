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



            $modal = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script><script src="'.plugin_dir_url(__FILE__ ).'../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script> <link rel="stylesheet" href="'.plugin_dir_url(__FILE__ ).'../css/jquery.modal.css" type="text/css" media="screen" />  <div class="modal" id="modal" style="position:fixed; top:0px; left:0px;display:none;width:'.$popup['width'].'px;height:'.$popup['height'].'px; z-index:2;"> '.$content.' <input type="hidden" id="router_id" value="'.$router_id.'">';

        }else if($data['popup-type'] == 3){
            $popup = [  'position' => $data['position'],
                        'click' => !!$data['image-click'],
                        'image-click-url' => $data['image-click-url'],
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'button' => [
                                'text' => $data['button-text'],
                                'url' => $data['button-url'],
                                'background' => $data['button-background'],
                                'color' => $data['button-color'],

                        ]
            ];

            $assets = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script><script src="'.plugin_dir_url(__FILE__ ).'../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script> <link rel="stylesheet" href="'.plugin_dir_url(__FILE__ ).'../css/jquery.modal.css" type="text/css" media="screen" />';

            $modal = $assets . '<div class="modal" id="modal" style="display:none;width:600px;"  data-position="'.$data['position'].'"> <table width="100%"> <tr> <td width="100"><img src="https://en.opensuse.org/images/0/0b/Icon-user.png" alt="" id="p3-image"></1td> <td valign="top"> <p id="p3-title">'.$data['title'].'</p> <br> <p id="p3-description">'.$data['description'].'</p> </td> <td valign="bottom" align="center"> <a id="p3-button" style="color:'.$data['button-color'].';background-color:'.$data['button-background'].'" href="'.$data['button-url'].'">'.$data['button-text'].'</a> </td> </tr> </table> </div>';

           /* */

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
          'page_template' => 'empty.php'
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

        if(!$key)
            return false;

        wp_delete_post($this->items[$key]['post_id']);
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
    }

    public function save(){
        $this->table = new RoutersTable($this->items);
        return update_option('wp_retarger', $this->items);
    }

    public function counter($id){
        $key = $this->find($id);
        $this->items[$key]['visits'] = ($this->items[$key]['visits'] + 1);
        $this->save();
    }
}

?>
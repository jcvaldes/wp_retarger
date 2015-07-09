<?php

require 'Ruploader.php';
require 'Templater.php';

class Retarger
{
    private $items = [];
    private $license = false;
    private $status = false;
    public $table;

    private $ruploader;

    public function __construct(){
        //delete_option( 'retarger_license_key' );delete_option( 'retarger_license_status' );
        $this->items = $this->getAll();
        $this->table = new RoutersTable($this->items);
        $this->license = get_option( 'retarger_license_key' );
        $this->status = get_option( 'retarger_license_status' );

        $this->ruploader = new Ruploader();
    }

    /* CRUD */

    public function get($id){
        return $this->items[$this->find($id)];
    }

    public function store($data){
        /* Vars */
        $popup = [];
        $modal = '';
        $router_id = uniqid();

        $visitas = (isset($data['visits'])) ? intval($data['visits']) : 0;

        if(isset($data['id'])){
            $router_id = $data['id'];
        }

        /* PICTURE - Ruploader.php */
        $image = $this->ruploader->upload($data['url_image_redirect']);

        /* POPUP */

        if($data['popup-type'] == 2){
            $popup = [  'show' => $data['popup-show'],
                        'url' => $data['url-popup'],
                        'html' => $data['html-popup'],
                        'delay' => $data['delay-p2']
            ];

        }else if($data['popup-type'] == 3){
            $popup = [  'position' => $data['position'],
                        'click' => !!$data['image-click'],
                        'image-click-url' => $data['image-click-url'],
                        'title' => $data['title'],
                        'image' => $image,
                        'description' => $data['description'],
                        'delay' => $data['delay-p3'],
                        'button' => [
                                'text' => $data['button-text'],
                                'url' => $data['button-url'],
                                'background' => $data['button-background'],
                                'color' => $data['button-color']
                        ]
            ];
        }

        /* SPLIT TEST */
        $split = [];
        if(count($data['split_rotator_url'])){ //ENABLE
            $x = [];
            $max = true;

            $visits = $data['split_rotator_visit'];
            $conversions = $data['split_rotator_conversions'];
            $statics = $data['split_rotator_statics'];

            $split['static'] = false; //default00000-
            $split['limit'] = $limit = (isset($data['conversions-limit'])) ? $data['conversions-limit'] : 0;

            foreach ($data['split_rotator_url'] as $key => $surl) {
                $v = (isset($visits[$key])) ? $visits[$key] : 0;
                $c = (isset($conversions[$key])) ? $conversions[$key] : 0;

                $s = false;

                if($c >= $limit && $max && $limit != 0){
                    $s = true;
                    $split['static'] = true; //set
                    $max = false;
                }

                $aux = ['url' => $surl, 'visit' => $v, 'conversions' => $c, 'static' => $s];
                array_push($x, $aux);
            }

            $split['urls'] = $x;
        }

        /* Exit Popup */
        $exit_popup = [];

        $exit_popup['description'] = $data['exit_popup_description'];
        $exit_popup['url'] = $data['exit_popup_url'];

        /* Create retarger */
        $page = array(
          'post_title'    => wp_strip_all_tags($data['name_router']),
          'post_content'  => '',
          'post_status'   => 'publish',
          'post_name'     => $data['name_router'],
          'post_type'     => 'retarger',
          'router_id'     => $router_id
        );

        // Insert retarger into the database
        $post_id = wp_insert_post( $page );
        add_post_meta( $post_id, 'router_id', $router_id);

        //echo mysql_real_escape_string (($data['wp_retarger_pixel']));exit;

        $aux = array(
            'ID' => $router_id,
            'name_router' => esc_html($data['name_router']),
            'urlembed_router' => esc_html($data['urlembed_router']),
            'pixel' => ($data['wp_retarger_pixel']),
            'post_id' => $post_id,
            'visits' => $visitas,
            'type' => $data['popup-type'],
            'popup' => $popup,
            'split' => $split,
            'exit_popup' => $exit_popup
        );

        array_push($this->items, $aux);
        $this->save();

    }

    public function update($data){
        $this->delete($data['id']);
        return $this->store($data);
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
        delete_post_meta( $this->items[$key]['post_id'], 'router_id');
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
        return null;
    }

    public function save(){
        $this->table = new RoutersTable($this->items);
        return update_option('wp_retarger', $this->items);
    }

    public function refresh($item){
        if(isset($item['ID'])){
            $this->items[$this->find($item['ID'])] = $item;
            return $this->save();
        }
    }

    public function conversion($id, $url){
        $key = $this->find($id);
        if(isset($this->items[$key])){

            $urls = $this->items[$key]['split']['urls'];
            $limit = $this->items[$key]['split']['limit'];

            foreach ($urls as $k => $u) {
                if($u['url'] == $url){
                    if(isset($this->items[$key]['split']['urls'][$k]['conversions'])){
                        $this->items[$key]['split']['urls'][$k]['conversions'] = ($this->items[$key]['split']['urls'][$k]['conversions']+1);

                        if($this->items[$key]['split']['urls'][$k]['conversions'] >= $limit && $limit > 0 && ($this->items[$key]['split']['static'] != true) ){
                            $this->items[$key]['split']['static'] = true;
                            $this->items[$key]['split']['urls'][$k]['static'] = true;
                        }else{

                        }
                    }else{
                        $this->items[$key]['split']['urls'][$k]['conversions'] = 1;
                    }
                }
            }

        }
        $this->save();
    }

    /* Licenser */

    public function getStatus(){
        return $this->status;
    }

    public function getLicense(){
        return $this->license;
    }

    public function setStatus($status){
        $this->status = $status;
        return update_option('retarger_license_status', $this->status);
    }

    public function setLicense($license){
        $this->license = $license;
        return update_option('retarger_license_key', $this->license);
    }

    public function isActived(){
        if($this->status == 'active'){
            return true;
        }
        return false;
    }

}

?>
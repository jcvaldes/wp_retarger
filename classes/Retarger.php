<?php

class Retarger
{
    private $items = [];

    public function __construct(){
        $this->items = $this->getAll();
    }

    public function get($id){

    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete($id){
        $key = $this->find($id);

        wp_delete_post($this->items[$key]['post_id']);
        unset($this->items[$key]);
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
        return update_option('wp_retarger', $this->items);
    }
}

?>
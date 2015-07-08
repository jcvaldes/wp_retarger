<?php

class Templater
{
    private $item;
    private $retarger;

    private $popup = '';
    private $iframe = '';

    public function __construct(){
        $this->retarger = new Retarger();
    }

    function render($id){
        $this->item = $this->retarger->get($id);

        /* POPUP */
        $this->popup();

        /* SPLIT TEST */
        $this->split();

        return "\xA".$this->iframe . "\xA"."\xA" . $this->popup ."\xA"."\xA" . stripslashes($this->item['pixel']);
    }

    function popup()
    {
        $data = $this->item;

        $content = $modal = '';
        $popup = $data['popup'];

        if($data['type'] == 2){
            if($popup['show'] == 'url'){
                $content = '<iframe class="embed-responsive-item" src="'.$popup['url'].'" width="100%" height="100%" scrolling="no" frameborder="0" style="z-index:3;"></iframe>';
            }else if($popup['show'] == 'html'){
                $content = "<p>".$popup['html']."</p>";
            }

            $modal =    '<div class="modalb col-xs-10 col-sm-8 col-md-6 col-lg-6" id="modal" style="position:fixed; top:0px; left:0px;display:none;z-index:2;height:auto">
                            <div class="embed-responsive embed-responsive-4by3">'.$content.'</div>
                        </div>';

        }else if($data['type'] == 3){

            if($popup['image']){
                $img = '<img class="img-responsive" src="'.$popup['image'].'" id="p3-image">';
            }else{
                $img = '<img class="img-responsive" src="https://en.opensuse.org/images/0/0b/Icon-user.png" id="p3-image">';
            }

            if(!!$popup['click']){
                $img = '<a href="'.$popup['image-click-url'].'" >'. $img .'</a>';
            }

            $modal =   '<div class="modalb col-xs-10 col-sm-8 col-md-5 col-lg-5" id="modal" style="display:none;"  data-position="'.$popup['position'].'">'.
                            '<div class="row">' .
                                '<div class="">' .
                                    '<div class="col-md-3 col-xs-4">' .
                                        $img .
                                    '</div>'.
                                    '<div class="col-md-9 col-xs-8">' .
                                        '<h3>'.$popup['title'].'</h3>' .
                                        '<p id="p3-description">'.$popup['description'].'</p>' .
                                        '<a id="p3-button" class="btn pull-right" style="color:'.$popup['button']['color'].';background-color:'.$popup['button']['background'].'" href="'.$popup['button']['url'].'">'.$popup['button']['text'].'</a>' .
                                    '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>';
            ;
        }

        $this->popup = $modal;
    }

    public function split(){
        $r = $this->item;

        if(isset($r)){
            if($r['split']['static'] == true){ // validate max convertions and static page
                foreach ($r['split']['urls'] as $i => $urls) {
                    if($urls['static'] == true){

                        if(isset($r['split']['urls'][$i]['visit'])){
                            $r['split']['urls'][$i]['visit'] = ($r['split']['urls'][$i]['visit']+1);
                        }else{
                            $r['split']['urls'][$i]['visit'] = 1;
                        }
                        $this->iframe = $this->iframe($urls['url']);
                    }
                }
            }else{ // show random page
                $urls = $r['split']['urls'];
                $limit = $r['split']['limit'];

                $u = array_rand($urls);
                $u = rand(0, count($urls) - 1);

                if(isset($r['split']['urls'][$u]['visit'])){
                    $r['split']['urls'][$u]['visit'] = ($r['split']['urls'][$u]['visit']+1);
                }else{
                    $r['split']['urls'][$u]['visit'] = 1;
                }

                $this->iframe = $this->iframe($urls[$u]['url']);
            }

        }else{ // show no split page
            $this->iframe = $this->iframe($r['urlembed_router']);
            $r['visits'] = (intval($r['visits']) + 1);
        }
        $this->retarger->refresh($r); //save changes
    }

    /* Template Functions */

    public function iframe($url){
        return '<iframe src="'.$url.'" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;border:none; margin:0; padding:0; overflow:hidden; z-index:0;"></iframe>';
    }

}
?>
<?php
/*
 * Plugin Name: wp retarger
 * Plugin URI: http://conectan2enlared.com
 * Description: Herramientas de retargueting.
 * Version: El número de versión del plugin e.j.: 1.0
 * Author: Juan Carlos Valdés
 * Author URI: http://servicioswebmoviles.com/
 * License: Todos Los Derechos Reservados
 */
// require 'Retarger.php';
require 'classes/RoutersTable.php';
require 'classes/Uploader.php';
require 'classes/Retarger.php';

$url_plugin = WP_PLUGIN_URL . "wp_retarger";
$myOptions = array();

$retarger = new Retarger();
//var_dump($retarger->find('5568d7865ca6a'));exit;

function register_wp_retarger_menu_page()
{
    $hook = add_menu_page('WP Retarger', 'WP Retarger', 'manage_options', 'wp_retarger', 'wp_retarger_menu_page', 'dashicons-admin-tools', 6);
    add_action("load-$hook", 'add_options');
}

add_action('admin_menu', 'register_wp_retarger_menu_page');

function wp_retarger_menu_page()
{
    if (! current_user_can('manage_options')) {
        wp_die('Access Denied');
    }
    global $myListTable;
    global $edit;

    if($myListTable->current_action() == 'delete'){
        delete_options();
    }

    if($myListTable->current_action() == 'edit'){
        prepare_edit();
    }

    echo '<div class="wrap"><h2>My Routers</h2>';
    $myListTable->prepare_items();

    echo '<form method="post"><input type="hidden" name="page" value="ttest_list_table">';

    $myListTable->search_box('search', 'search_id');
    $myListTable->display();

    echo '</form></div>';
    require 'views/tabs.php';
}

function add_options()
{
    global $myListTable;
    $myOptions = (get_option('wp_retarger')) ? get_option('wp_retarger') : [];

    if ($_POST['wp_retarger_form_send']) {
        $field_hidden = esc_html($_POST['wp_retarger_form_send']);

        if($_POST['_action'] == 'edit'){

            foreach ($myOptions as $key => $val) {
               if ($val['ID'] == $_POST['id']) {

                    $myOptions[$key]['ID']  =   $val['ID'];
                    $myOptions[$key]['name_router'] =   esc_html($_POST['name_router']);
                    $myOptions[$key]['urlembed_router'] =   esc_html($_POST['urlembed_router']);
                    $myOptions[$key]['pixel']   =   esc_html($_POST['wp_retarger_pixel']);
               }
            }
            update_option('wp_retarger', $myOptions);

        }else if ($field_hidden == 'S') {
            /* IFRAME */

            $pixel = esc_html($_POST['wp_retarger_pixel']);

            $iframe = '<iframe src="'.$_POST['urlembed_router'].'" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;"></iframe>';
            /* Create Post */

            $template = plugin_dir_path(__FILE__) . 'views/post.php';

            // Create post object
            $my_post = array(
              'post_title'    => wp_strip_all_tags($_POST['name_router']),
              'post_content'  => $pixel . $iframe,
              'post_status'   => 'publish',
              'post_name'     => $_POST['name_router'],
              'post_type'     => 'page',
              'page_template' => 'empty.php'
            );

            // Insert the post into the database
            $post_id = wp_insert_post( $my_post );

            $uploader = new Uploader();
            $url_filename = $uploader->write();

            $aux = array(
                'ID' => uniqid(),
                'name_router' => esc_html($_POST['name_router']),
                'urlembed_router' => esc_html($_POST['urlembed_router']),
                'pixel' => esc_html($_POST['wp_retarger_pixel']),
                'post_id' => $post_id
            );

            array_push($myOptions, $aux);
            update_option('wp_retarger', $myOptions);
        }
    }
    if($myOptions != ''){
        $name_router = $myOptions['name_router'];
    }
    $option = 'per_page';
    $args = array(
        'label' => 'Routers',
        'default' => 10,
        'option' => 'routers_per_page'
    );
    add_screen_option($option, $args);
    $myListTable = new RoutersTable($myOptions);
}

function delete_options(){
    global $myListTable;


    $id = $_REQUEST['router'];




    $myListTable = new RoutersTable($myOptions);
}

function prepare_edit(){
    global $myListTable;
    global $edit;
    $myOptions = (get_option('wp_retarger')) ? get_option('wp_retarger') : [];

    $id = $_REQUEST['router'];

    foreach ($myOptions as $key => $val) {
       if ($val['ID'] == $id) {
           $edit = $myOptions[$key];
       }
    }
}


function wp_retarger_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    // wp_enqueue_script( 'my-jquery-tabs', plugin_dir_url(__FILE__ ) . '/js/tabs.js' , array( 'jquery-ui-core', 'jquery-ui-tabs' ), false, false );
    wp_register_script('my-jquery-tabs', plugin_dir_url(__FILE__) . '/js/tabs.js');
    wp_enqueue_script('my-jquery-tabs');

}
add_action('admin_head', 'wp_retarger_enqueue_scripts');

function wp_retarger_enqueue_styles()
{
    wp_register_style('admin-styles', plugin_dir_url(__FILE__) . '/css/admin.css');
    wp_enqueue_style('admin-styles');

}

add_action('admin_head', 'wp_retarger_enqueue_styles');
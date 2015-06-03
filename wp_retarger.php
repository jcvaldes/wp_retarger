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

require 'classes/RoutersTable.php';
require 'classes/Uploader.php';
require 'classes/Retarger.php';

$url_plugin = WP_PLUGIN_URL . "wp_retarger";
$myOptions = array();

$retarger = new Retarger();
//var_dump($retarger->getAll());exit;

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
    global $edit;
    global $retarger;
    //delete
    if($retarger->table->current_action() == 'delete'){
        $retarger->delete($_REQUEST['router']);
    }
    //edit
    if($retarger->table->current_action() == 'edit'){
        $edit = $retarger->get($_REQUEST['router']);
    }

    /* *** */

    echo '<div class="wrap"><h2>My Routers</h2>';
    $retarger->table->prepare_items();

    echo '<form method="post"><input type="hidden" name="page" value="ttest_list_table">';

    $retarger->table->search_box('search', 'search_id');
    $retarger->table->display();

    echo '</form></div>';
    require 'views/tabs.php';
}

function add_options()
{
    global $retarger;

    //var_dump($_POST);exit;
    //update
    if ($_POST['action'] == 'update') {
        $retarger->update($_POST);
    }

    //create
    if ($_POST['action'] == 'create') {
        $retarger->store($_POST);
    }

    $option = 'per_page';
    $args = array(
        'label' => 'Routers',
        'default' => 10,
        'option' => 'routers_per_page'
    );
    add_screen_option($option, $args);
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
/* AJAX */
add_action( 'wp_ajax_counter', 'prefix_ajax_counter' );
add_action( 'wp_ajax_nopriv_counter', 'prefix_ajax_counter' );

function prefix_ajax_counter() {
    global $retarger;

    $id = $_REQUEST['router_id'];

    return $retarger->counter($id);
}

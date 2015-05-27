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

$url_plugin = WP_PLUGIN_URL . "wp_retarger";
$myOptions = array();

// $retarguer = new Retarger();
// add_action('admin_menu', array(
// $retarguer,
// 'CreateMenu'
// ));
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
  
    
    
    echo '</pre><div class="wrap"><h2>My Routers</h2>';
    $myListTable->prepare_items();
    ?>
<form method="post">
	<input type="hidden" name="page" value="ttest_list_table">
        <?php
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
        
        if ($field_hidden == 'S') {
            
            $aux = array(
                'name_router' => esc_html($_POST['name_router']),
                'urlembed_router' => esc_html($_POST['urlembed_router']),
                'pixel' => esc_html($_POST['wp_retarger_pixel'])
            );
            
            array_push($myOptions, $aux);
            // $wp_retarger_pixel = esc_html($_POST['wp_retarger_pixel']);
            // $myOptions['wp_retarger_pixel'] = $wp_retarger_pixel;
            // $myOptions['last_update'] = time();
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

function wp_retarger_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    // wp_enqueue_script( 'my-jquery-tabs', plugin_dir_url(__FILE__ ) . '/js/tabs.js' , array( 'jquery-ui-core', 'jquery-ui-tabs' ), false, false );
    wp_register_script('my-jquery-tabs', plugin_dir_url(__FILE__) . '/js/tabs.js');
    
    wp_enqueue_script('my-jquery-tabs');
}

add_action('admin_head', 'wp_retarger_enqueue_scripts');

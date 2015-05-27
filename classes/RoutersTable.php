<?php
if (! class_exists('WP_List_Table')) {
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class RoutersTable extends WP_List_Table
{
 
    var $found_data = array();
       
    var $example_data = array();

    function __construct($example_data)
    {
        global $status, $page;
        
        parent::__construct(array(
            'singular' => __('router', 'mylisttable'), // singular name of the listed records
            'plural' => __('routers', 'mylisttable'), // plural name of the listed records
            'ajax' => false
        ) // does this table support ajax?

        );
        
        $this->example_data = $example_data;
        add_action('admin_head', array(
            &$this,
            'admin_header'
        ));
    }

    function admin_header()
    {
        $page = (isset($_GET['page'])) ? esc_attr($_GET['page']) : false;
        if ('my_list_test' != $page)
            return;
        echo '<style type="text/css">';
        echo '.wp-list-table .column-id { width: 5%; }';
        echo '.wp-list-table .column-name { width: 50%; }';
        echo '.wp-list-table .column-url { width: 50%; }';
        echo '</style>';
    }

    function no_items()
    {
        _e('No routers found, dude.');
    }

    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'name_router':
            case 'urlembed_router':
//            case 'isbn':
                return $item[$column_name];
            default:
                return print_r($item, true); // Show the whole array for troubleshooting purposes
        }
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'name_router' => array(
                'name_router',
                false
            ),
            'urlembed_router' => array(
                'urlembed_route',
                false
            )
        );
        return $sortable_columns;
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name_router' => __('Name', 'mylisttable'),
            'urlembed_router' => __('Url', 'mylisttable')
        );
        return $columns;
    }

    function usort_reorder($a, $b)
    {
        // If no sort, default to title
        $orderby = (! empty($_GET['orderby'])) ? $_GET['orderby'] : 'name_router';
        // If no order, default to asc
        $order = (! empty($_GET['order'])) ? $_GET['order'] : 'asc';
        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);
        // Send final sort direction to usort
        return ($order === 'asc') ? $result : - $result;
    }

    function column_name_router($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&router=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['ID']),
            'delete' => sprintf('<a href="?page=%s&action=%s&router=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['ID'])
        );
        
        return sprintf('%1$s %2$s', $item['name_router'], $this->row_actions($actions));
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function column_cb($item)
    {
        return sprintf('<input type="checkbox" name="router[]" value="%s" />', $item['ID']);
    }

    function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array(
            $columns,
            $hidden,
            $sortable
        );
        usort($this->example_data, array(
            &$this,
            'usort_reorder'
        ));
        
        $per_page = 5;
        $current_page = $this->get_pagenum();
        $total_items = count($this->example_data);
        
        // only ncessary because we have sample data
        $this->found_data = array_slice($this->example_data, (($current_page - 1) * $per_page), $per_page);
        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // WE have to calculate the total number of items
            'per_page' => $per_page
        ) // WE have to determine how many items to show on a page
);
        $this->items = $this->found_data;
    }
}
 // class
// function my_add_menu_items()
// {
//     $hook = add_menu_page('My Plugin List Table', 'My List Table Example', 'activate_plugins', 'my_list_test', 'my_render_list_page');
//     add_action("load-$hook", 'add_options');
// }

// function add_options()
// {
//     global $myListTable;
//     $option = 'per_page';
//     $args = array(
//         'label' => 'Books',
//         'default' => 10,
//         'option' => 'books_per_page'
//     );
//     add_screen_option($option, $args);
//     $myListTable = new RoutersTable();
// }
//add_action('admin_menu', 'my_add_menu_items');

function my_render_list_page()
{
    global $myListTable;
    echo '</pre><div class="wrap"><h2>My List Table Test</h2>';
    $myListTable->prepare_items();
    ?>
<form method="post">
	<input type="hidden" name="page" value="ttest_list_table">
    <?php
    $myListTable->search_box('search', 'search_id');
    
    $myListTable->display();
    echo '</form></div>';
}

<?php
/**
 * Register the order post type
 */

function store_register_order_post_type() {
    $labels = array(
        'name'               => __( 'Orders', 'store' ),
        'singular_name'      => __( 'Order', 'store' ),
        'menu_name'          => __( 'Orders', 'store' ),
        'add_new'            => __( 'Add New', 'store' ),
        'add_new_item'       => __( 'Add New Order', 'store' ),
        'new_item'           => __( 'New Order', 'store' ),
        'edit_item'          => __( 'Edit Order', 'store' ),
        'view_item'          => __( 'View Order', 'store' ),
        'all_items'          => __( 'All Orders', 'store' ),
        'search_items'       => __( 'Search Orders', 'store' ),
        'not_found'          => __( 'No orders found', 'store' ),
        'not_found_in_trash' => __( 'No orders found in Trash', 'store' ),
        'parent_item_colon'  => '',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'custom-fields'),
    );

    register_post_type( 'order', $args );
}
add_action( 'init', 'store_register_order_post_type', 99999 );
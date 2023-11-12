<?php
/*
Plugin Name: Store
Description: Simple store plugin based on DummyJSON API
Version: 1.0
Author: Doron Nissim
Author URI: https://doroness.com
*/

//define plugin path
define('STORE_PLUGIN_PATH', plugin_dir_path(__FILE__));


/**
 * Make sure the pages exist and have the correct template when plugin is activated
 *
 * @return void
 */
function store_create_pages () {

    //create page with slug 'store' and template 'products-by-category.php' when plugin is activated if it doesn't exist

    $store_page = get_page_by_path( 'store' );

    if ( ! $store_page ) {

        //create page
        $page_id = wp_insert_post(
            array(
                'post_title'     => 'Store',
                'post_name'      => 'store',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'page_template'  => 'products-by-category.php'
            )
        );

        //update page with new ID
        update_option( 'store_page_id', $page_id );
     } else {

        //if the page exists, update it with the new template
        $page_id = $store_page->ID;

        update_post_meta( $page_id, '_wp_page_template', 'products-by-category.php' );

     } 


    //create page with slug 'product' and template 'product-template.php' when plugin is activated if it doesn't exist

    $product_page = get_page_by_path( 'product' );

    if ( ! $product_page ) {

        //create page
        $page_id = wp_insert_post(
            array(
                'post_title'     => 'Product',
                'post_name'      => 'product',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'page_template'  => 'product-template.php'
            )
        );

        //update page with new ID
        update_option( 'product_page_id', $page_id );
     } else {

        //if the page exists, update it with the new template
        $page_id = $product_page->ID;

        update_post_meta( $page_id, '_wp_page_template', 'product-template.php' );

    }

    $cart_page = get_page_by_path( 'cart' );

        if ( ! $cart_page ) {
    
            //create page
            $page_id = wp_insert_post(
                array(
                    'post_title'     => 'Cart',
                    'post_name'      => 'cart',
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'page_template'  => 'cart-template.php'
                )
            );
    
            //update page with new ID
            update_option( 'cart_page_id', $page_id );
        } else {
    
            //if the page exists, update it with the new template
            $page_id = $cart_page->ID;
    
            update_post_meta( $page_id, '_wp_page_template', 'cart-template.php' );
    
        }
    
    $checkout_page = get_page_by_path( 'checkout' );

        if ( ! $checkout_page ) {
    
            //create page
            $page_id = wp_insert_post(
                array(
                    'post_title'     => 'Checkout',
                    'post_name'      => 'checkout',
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'page_template'  => 'checkout-template.php'
                )
            );
    
            //update page with new ID
            update_option( 'checkout_page_id', $page_id );
        } else {
    
            //if the page exists, update it with the new template
            $page_id = $checkout_page->ID;
    
            update_post_meta( $page_id, '_wp_page_template', 'checkout-template.php' );
    
        }

    $admin_orders_page = get_page_by_path( 'admin-orders' );

        if ( ! $admin_orders_page ) {
    
            //create page
            $page_id = wp_insert_post(
                array(
                    'post_title'     => 'Admin Orders',
                    'post_name'      => 'admin-orders',
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'page_template'  => 'admin-orders.php'
                )
            );
    
            //update page with new ID
            update_option( 'admin_orders_page_id', $page_id );
        } else {
    
            //if the page exists, update it with the new template
            $page_id = $admin_orders_page->ID;
    
            update_post_meta( $page_id, '_wp_page_template', 'admin-orders.php' );
    
        }
}
//Activation hook
register_activation_hook( __FILE__, 'store_create_pages' );


//deactivation hook

function str_deactivation_hook() {
    // Deactivation code here...
}

include(STORE_PLUGIN_PATH . 'functions.php');
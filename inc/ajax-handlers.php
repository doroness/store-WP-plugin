<?php

/**
 * Handle ajax request to add product to cart
 */

 function store_add_to_cart() {

    //check nonce
    check_ajax_referer( 'add_to_cart_' . $_POST['product_id'],'add_to_nonce' );

    //get product id from ajax request
    $product_id = intval( $_POST['product_id'] );

    //get product by id
    $product = get_product_by_id( $product_id );

    //add product to cart
    $_SESSION['cart'][] = $product;

    //return cart count
    echo count( $_SESSION['cart'] );

    wp_die();

}

add_action( 'wp_ajax_nopriv_store_add_to_cart', 'store_add_to_cart' );
add_action( 'wp_ajax_store_add_to_cart', 'store_add_to_cart' );

/**
 * Handle ajax request to remove product from cart
 */

function store_remove_from_cart() {

    //if cart is not set or empty, return 0
    if ( ! isset( $_SESSION['cart'] ) || empty( $_SESSION['cart'] ) ) {

        echo 0;

        wp_die();

    }

    //check nonce
    check_ajax_referer( 'remove_from_cart_' . $_POST['position'],'remove_from_nonce' );

    //get product position from ajax request
    $position = intval( $_POST['position'] );

    
    //remove product from cart
    unset( $_SESSION['cart'][$position] );

    //return cart count
    echo count( $_SESSION['cart'] );

    wp_die();

}

add_action( 'wp_ajax_nopriv_store_remove_from_cart', 'store_remove_from_cart' );
add_action( 'wp_ajax_store_remove_from_cart', 'store_remove_from_cart' );

/**
 * Handle ajax to process checkout
 */
 function store_send_order_details () {

    //check nonce
    check_ajax_referer( 'store_checkout_nonce','store_checkout_process' );

    $order_details = array (
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'cart' => $_SESSION['cart']
    );

    $order_updated = store_register_order_details( $order_details );

    $email_sent = store_send_order_details_email( $order_details );

    //check if$order_updated is not wp_error and email is sent
    if ( ! is_wp_error( $order_updated ) && $email_sent) {
            
        //clear cart
        unset( $_SESSION['cart'] );
        
        wp_send_json_success( 'Order details sent successfully' );
    
    } else {
            
        //wp send ajax response error
        wp_send_json_error( 'Error sending order details' );
    }

    wp_die();

 }

 add_action( 'wp_ajax_nopriv_store_send_order_details', 'store_send_order_details' );
 add_action( 'wp_ajax_store_send_order_details', 'store_send_order_details' );

/**
* Send order details email
*
* @param Array $order_details
* @return Boolean
*/

function store_send_order_details_email (Array $order_details = []) {

    //get admin email
    $admin_email = get_option( 'admin_email' );

    //get email subject
    $subject = 'New order from ' . $order_details['name'];

    //get email body
    $body = '<h1>Order details</h1>';
    $body .= '<p><b>Name:</b> ' . $order_details['name'] . '</p>';
    $body .= '<p><b>Email:</b> ' . $order_details['email'] . '</p>';
    $body .= '<p><b>Phone:</b> ' . $order_details['phone'] . '</p>';
    $body .= '<p><b>Address:</b> ' . $order_details['address'] . '</p>';
    $body .= '<h2>Products</h2>';
    $body .= '<ul>';

    foreach ( $order_details['cart'] as $product ) {

        $body .= '<li>' . $product['title'] . ' - ' . $product['price'] . ' USD</li>';

    }

    $body .= '</ul>';

    //set email headers
    $headers = array('Content-Type: text/html; charset=UTF-8');

    //send email
    return wp_mail( $admin_email, $subject, $body, $headers );

}

/**
 * Register order details
 * Create a new post with order details as meta data
 * 
 * @param Array $order_details
 * @return WP_Error
 */

 function  store_register_order_details(Array $order_details = []) {

    //create post object
    $post = array(
        'post_title' => 'Order from ' . $order_details['name'],
        'post_type' => 'order',
        'post_status' => 'publish',
        'meta_input' => array(
            'name' => $order_details['name'],
            'email' => $order_details['email'],
            'phone' => $order_details['phone'],
            'address' => $order_details['address'],
            'cart' => empty( $order_details['cart']) ? '' : format_cart_details( $order_details['cart'] ),
            'order_status' => 'pending',
            'order_date' => date( 'd-M-Y H:i:s' ),
        )

    );

    //insert post, if not created, return a WP_Error object
    return wp_insert_post( $post, true );

 }

 /**
  * Format cart details as simple string
  * @return String
  */

function format_cart_details (Array $cart = []) {

    $cart_details = '';

    foreach ( $cart as $product ) {

        $cart_details .= $product['title'] . ' - ' . $product['price'] . ' USD' . PHP_EOL;

    }

    return $cart_details;

}

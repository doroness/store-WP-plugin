<?php

/**
 *
 * @param integer $prd_id
 * @return Array
 */

function get_product_by_id (int $prd_id = 0 ) {

    $product = array();

    //create WP http get request to get product by id

    try {

        $response = wp_remote_get( 'https://dummyjson.com/products/' . $prd_id );

        if ( is_array( $response ) && ! is_wp_error( $response ) ) {

            $product = json_decode( $response['body'], true );

        }
    } catch (Exception $e) { 
        //log error

        error_log($e->getMessage());
    }

    
    return  $product;
}
 
/**
 * 
 * @return Array
 */
function get_all_products_categories () {

    $categories = array();

    //create WP http get request to get all categories

    try {

        $response = wp_remote_get( 'https://dummyjson.com/products/categories' );

        if ( is_array( $response ) && ! is_wp_error( $response ) ) {

            $categories = json_decode( $response['body'], true );

        }
    } catch (Exception $e) { 
        //log error

        error_log($e->getMessage());


    }
    
    return  $categories;
}

/**
 * @param String $name
 * @return Array
 */
function get_products_of_category (String $category = '') {

    $response = array();

    $endpoint =  empty( $category ) ?  'https://dummyjson.com/products' : 'https://dummyjson.com/products/category/' . $category;
    
    try {

        $response = wp_remote_get( $endpoint );

        if ( is_array( $response ) && ! is_wp_error( $response ) ) {

            $response = json_decode( $response['body'], true );

        }
    } catch (Exception $e) { 
        //log error

        error_log($e->getMessage());
    }
    
    
    return  $response;
}

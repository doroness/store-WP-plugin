'use strict';

//on document ready

jQuery(document).ready(function ($) { 

    console.log('script.js loaded');

    $('.product__add-to-cart').on('click', function (e) {

        e.preventDefault();

        //get product id via data-product_id attribute

        var productId = $(this).data('product_id');

        var nonce = $(this).data('nonce');

        addProductToCart(productId,nonce,updateCartCount);
    });

    $('.cart__item-remove').on('click', function (e) {  

        e.preventDefault();

        //get product id via data-product_id attribute

        var productPosition = $(this).data('position');

        var nonce = $(this).data('nonce');

        removeProductFromCart(productPosition,nonce,updateCartCount);
    });

    //Listen for click on form submit button, send request to wp ajax
    //to send email with order details

    $('#store-checkout-form').on('submit', function (e) {

        e.preventDefault();

        //make submit button disabled
        $('#store-checkout-form-submit').attr('disabled', true);

        //get form data

        var formData = $(this).serialize();

        handleCheckoutForm(formData);

    });

});

/**
 * send request to wp ajax to send email with order details
 */

function handleCheckoutForm(formData) {

    var checkoutFormMassages = document.querySelector('.checkout-form__massages');
    
    //send request to wp ajax
    fetch(ajax_object.ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=store_send_order_details&' + formData,
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        console.log(data);

        if (data.success) {
            
            //get .checkout-form__massages element and add success message

            checkoutFormMassages.classList.add('checkout-form__massages--success');

            checkoutFormMassages.innerHTML = '👍' + data.data;

        
        } else {
            //throw error
            throw new Error('Error processing order');

            checkoutFormMassages.classList.add('checkout-form__massages--error');

            checkoutFormMassages.innerHTML = '👎' + data.data;

        }
        
    })
    .catch(function (error) {
        console.log(error);
    });
}

/**
 * using fetch API send request wp ajax
 * @param {*} productId 
 * @param {*} nonce
 * @param {*} updateCartCount
 */
function addProductToCart(productId,nonce,updateCartCount) {

    console.log(ajax_object);
    
    //send request to wp ajax
    fetch(ajax_object.ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=store_add_to_cart&add_to_nonce=' + nonce + '&product_id=' + productId,
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        console.log(data);
        //update cart count
        updateCartCount(data);
    })
    .catch(function (error) {
        console.log(error);
    });
   
}

/**
 * 
 * send request to wp ajax to remove product from cart by product position
 * 
 * @param {*} productPosition
 * @param {*} nonce
 * @param {*} updateCartCount
 * @returns
 *  */

function removeProductFromCart(productPosition,nonce,updateCartCount) {

    //send request to wp ajax
    fetch(ajax_object.ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=store_remove_from_cart&remove_from_nonce=' + nonce + '&position=' + productPosition,
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {

        console.log(data);

        //update cart count
        updateCartCount(data);

        //trigger page reload
        window.location.reload();
    
    })
    .catch(function (error) {
        console.log(error);
    });
   


}

function updateCartCount(count) {

   //get cart count element by id 'cart-count__number'
    var cartCountElement = document.getElementById('cart-count__number');

    if (cartCountElement)
        cartCountElement.innerHTML = count;
   
}
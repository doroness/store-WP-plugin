<?php

?>

<form id="store-checkout-form" class="row checkout-form" method="POST">
    
    <div class="col-lg-12 col-xs-12">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="col-lg-12 col-xs-12">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="col-lg-12 col-xs-12">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>

    <div class="col-lg-12 col-xs-12">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
    </div>

    <div class="col-lg-12 col-xs-12"> 
        
    <?php wp_nonce_field( 'store_checkout_nonce', 'store_checkout_process' ); ?>

    <input id="store-checkout-form-submit" type="submit" value="Submit">
    
    </div>
</form>

<div class="checkout-form__massages">

</div>
<?php

/**
 * Display the cart total
 */

$cart_total = store_get_cart_total_sum();

$num_items = store_get_cart_total_items();

$show_checkout = $num_items > 0 ? true : false;

?>


<div class="cart__total">

    <h3 class="cart__total-title">Cart Total</h3>

    <p class="cart__total-price"><?= $cart_total; ?> (USD)</p>

    <p class="cart__total-items"><?= $num_items; ?> items</p>

    <?php if ( $show_checkout ) : ?>

        <a class="cart__total-checkout" href="<?= home_url( 'checkout' ); ?>">Checkout</a>

    <?php endif; ?>
    
</div>


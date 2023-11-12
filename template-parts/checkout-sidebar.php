<?php

//if session['cart'] is not set or empty, return 0

$total_items = store_get_cart_total_items();

$total_sum = store_get_cart_total_sum() ;


?>

<h1 class="checkout__title">Checkout</h1>

<p>You have <b><?= $total_items ?></b> items in your cart
with a total of <b><?= $total_sum ?></b> (USD)</p>
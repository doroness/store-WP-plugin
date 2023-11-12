<?php
    //get cart items for the current session
    $cart_items =  isset( $_SESSION['cart'] ) ? $_SESSION['cart'] : [];
?>

<div class="cart">

    <?php if (!empty($cart_items)) : ?>

        <ul class="cart__items">

        <?php foreach ($cart_items as $index => $item) : ?>

            <?php
                //calculate discount
                $discount = $item['price'] - ($item['price'] * $item['discountPercentage'] / 100);
                $nonce = wp_create_nonce('remove_from_cart_' . $index);
            ?>
            
            <li class="cart__item"> 
                <div class="cart__item-thumbnail">
                    <img src="<?= $item['thumbnail']?>" alt="<?= $item['title']; ?>">
                </div>
                <div class="cart__item-info">
                    <h4><?= $item['title']; ?></h4>
                    <p>Price: <?= $item['price']; ?></p>
                    <p>Discount: <?= $item['discountPercentage']; ?>%</p>
                    <p>Price After Discount: <?= $discount; ?></p>
                    <button data-nonce=<?= $nonce ?> data-position=<?= $index ?> class="cart__item-remove" >Remove Item</button>
                </div>
            </li>
        
        <?php endforeach; ?>

        </ul>

    <?php else : ?>

        <div class="cart__empty">
            <h1 class="cart__empty-title">Your cart is empty</h1>
            <a class="cart__empty-link" href="<?= home_url( 'store' ); ?>">Go to products</a>
        </div>

    <?php endif ?>
</div>
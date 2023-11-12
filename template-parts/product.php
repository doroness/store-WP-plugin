<?php
/**
 * The template for displaying a single product
 *
 * @package Store
*/
?>

<?php
$product = [];

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

    //sanitize input $_GET['product_id'
    $product_id = intval ($_GET['product_id']);

    $product = get_product_by_id($product_id);

}

//var_dump($product);
?>


<?php if (isset($product['message']) || empty($product)): ?>

    <h1>Product not found</h1>

    <p>Sorry, we couldn't find the product you were looking for.</p>

</article>

<?php else : ?>

    <article id="single-product__<?= $product['id'] ?>" class="product">

        <div class="row">

            <div class="col-lg-6 col-xs-12">

                <img class="product__thumbnail" src="<?= $product['thumbnail']; ?>" alt="<?= $product['title']; ?>">

            </div>
            <div class="col-lg-6 col-xs-12 product__info ">

                <h1 class="product__title"><?= $product['title']; ?></h1>

                <p class="product__description"><?= $product['description']; ?></p>

                <p class="product__price">Price: $<?= $product['price']; ?></p>

                <p class="product__discount">Discount: <?= $product['discountPercentage']; ?>%</p>

                <p class="product__rating">Rating: <?= $product['rating']; ?></p>

                <p class="product__stock">In Stock: <?= $product['stock']; ?></p>

                <p class="product__brand">Brand: <?= $product['brand']; ?></p>

                <p class="product__category">Category: 
                    <a href="<?= home_url( 'store' ) . '?category_name=' . $product['category'] ?>" class="product__category-link">
                        <?= $product['category']; ?>
                    </a>
                </p>
                <?php //add nounce
                    $nonce = wp_create_nonce('add_to_cart_' . $product['id']);
                ?>
                <button data-nonce=<?= $nonce ?>   data-product_id="<?=$product['id']?>" class="product__add-to-cart">
                    Add To Cart
                </button>

            </div>
        </div>

        <aside class="single-product__gallery" >

        <h2>Product Images</h2>

            <div class="product-images row">
                <?php
                foreach ($product['images'] as $image) {
                    echo '<img class="col-xs-6 col-lg-3" src="' . $image . '" alt="' . $product['title'] . '">';
                }
                ?>
            </div>

        </aside>

    </article>


<?php endif; ?>
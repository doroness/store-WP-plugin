<?php 
    
$response = [];
$category_title = '';   

//if category_name parameter isset, redirect to home page and is not empty 
if (isset($_GET['category_name']) && !empty($_GET['category_name'])) {

    $response = get_products_of_category($_GET['category_name']);
    //format category name
    $category_title = ucwords(str_replace('-', ' ', $_GET['category_name']));
   
} else {
    
    $response= get_products_of_category();

    $category_title = 'All';
}

$products = $response['products'];


?>

<section class="section">

    <?php if (!empty($products)) : ?>

        <div class="products-by-category__title">
            <h1>Products of '<?= $category_title; ?>' Category</h1>
        </div>

        <ul class="products-by-category__list row">

            <?php foreach ($products as $product) : ?>

                <li class="products-by-category__item col-lg-3 col-md-4 col-xs-6">
                    <a class="products-by-category__link" href="<?= home_url( 'product'  ) . '?product_id=' .  $product['id']; ?>">
                        <img class="products-by-category__img" src="<?= $product['images'][0]; ?>" alt="<?= $product['title']; ?>">
                        <h3 class="products-by-category__title"><?= $product['title']; ?></h3>
                        <p class="products-by-category__price"><?= $product['price']; ?> (USD)</p>
                    </a>
                </li>

            <?php endforeach ?>

        </ul>

    <?php endif ?>

</section>



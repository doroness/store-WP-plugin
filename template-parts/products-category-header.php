<?php

$categories_menu = get_all_products_categories();


?>

<section class="section section--full-width categories">

<?php if (!empty($categories_menu)) : ?>

    <ul class="categories__menu">
        <?php foreach ($categories_menu as $category) : ?>
            <li class="categories-menu__item">
                <a class="categories-menu__link" href="<?= home_url( 'store' ) . '?category_name=' .  $category; ?>">
                    <?php
                        //format category name
                        $category = ucwords(str_replace('-', ' ', $category));
                        echo $category;
                    ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

<?php endif ?>

</section>

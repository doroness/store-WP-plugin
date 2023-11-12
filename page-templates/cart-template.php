<?php
/**
 * 
 * The template for displaying the cart
 *
 * @package Store
 */

get_header();
?>

	<main id="primary" class="site-main cart">

	<section class='section'>

		<div class="row">

			<div class="col-lg-8 col-xs-12">

				<?php include(  STORE_PLUGIN_PATH . 'template-parts/cart-items.php');?>

			</div>

			<div class="col-lg-4 col-xs-12">

				<?php include(  STORE_PLUGIN_PATH . 'template-parts/cart-total.php');?>

			</div>

		</div>

	</section>

	</main><!-- #main -->

<?php

get_footer();

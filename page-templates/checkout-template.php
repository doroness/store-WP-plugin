<?php
/**
 * 
 * The template for displaying the Checkout page
 *
 * @package Store
 */

get_header();
?>

	<main id="primary" class="site-main checkout">

	<section class='section'>

		<div class="row">

            <div class="col-lg-3 col-xs-10 col-xs-offset-1">

                <?php include(  STORE_PLUGIN_PATH . 'template-parts/checkout-sidebar.php');?>

            </div>

			<div class="col-lg-6 col-xs-10 col-xs-offset-1">

				<?php include(  STORE_PLUGIN_PATH . 'template-parts/checkout-form.php');?>

			</div>

		</div>

	</section>

	</main><!-- #main -->

<?php

get_footer();

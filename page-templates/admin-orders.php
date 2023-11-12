<?php
/**
 * 
 * The template for displaying Orders for Admin
 *
 * @package Store
 */

get_header();
?>

	<main id="primary" class="site-main checkout">

	<section class='section'>

		<div class="row">
		
		<?php if ( current_user_can( 'manage_options' )) : //only if is admin ?>

			<?php

				$current_user = wp_get_current_user();

				$current_user_name = $current_user->user_login;
				
			?>

			<div class="col-lg-12">

				<h1>Hello <?php echo $current_user_name; ?></h1>

				<?php include(  STORE_PLUGIN_PATH . 'template-parts/all-orders.php'); ?>

			</div>

		<?php else : ?>

			<p?>You are not allowed to view this page</p>

		<?php endif; ?>

		</div>

	</section>

	</main><!-- #main -->

<?php

get_footer();

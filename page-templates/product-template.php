<?php
/**
 * 
 * The template for displaying a single product
 *
 * @package Store
 */

get_header();
?>

	<main id="primary" class="site-main product">

	<section class='section'>

			<?php
		
			// Include the template file directly from the plugin's directory
			include(  STORE_PLUGIN_PATH . 'template-parts/product.php');
			?>
	</section>

	</main><!-- #main -->

<?php

get_footer();

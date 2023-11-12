<?php
/**
 * The template for displaying producst lists
 *
 * @package Store
 */

get_header();
?>

	<main id="primary" class="site-main category">

		<?php
		
			// Include the template file directly from the plugin's directory
		
			include (  STORE_PLUGIN_PATH . 'template-parts/products-category-header.php');

			include (  STORE_PLUGIN_PATH . 'template-parts/products-category.php');
		?>

		

	</main><!-- #main -->

<?php

get_footer();

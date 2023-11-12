<?php
/**
 * Register custom templates
 *
 * @param [type] $templates
 * @return void
 */
function store_add_page_template ($templates) {

    $templates['products-by-category.php'] = 'Store Product List';

    $templates['product-template.php']  = 'Store Single Product';

    $templates['cart-template.php']     = 'Store Cart';

    $templates['checkout-template.php'] = 'Store Checkout';

    $templates['admin-orders.php'] = 'Store Admin Orders';

    return $templates;
}
	
add_filter ('theme_page_templates', 'store_add_page_template');

/**
 * redirect to custom template in plugin directory
 * Take care of the template hierarchy and redirect to the custom template in the plugin directory
 *
 * @param [type] $template
 * @return void
 */
function store_redirect_page_template ($template) {

    $post = get_post();

    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );

    if ('products-by-category.php' == $page_template) 
        $template = WP_PLUGIN_DIR . '/store/page-templates/products-by-category.php';
    
    if ('product-template.php' == $page_template)
        $template = WP_PLUGIN_DIR . '/store/page-templates/product-template.php';

     if ('cart-template.php' == $page_template)
        $template = WP_PLUGIN_DIR . '/store/page-templates/cart-template.php';

    if ('checkout-template.php' == $page_template)
        $template = WP_PLUGIN_DIR . '/store/page-templates/checkout-template.php';

    if ('admin-orders.php' == $page_template)
        $template = WP_PLUGIN_DIR . '/store/page-templates/admin-orders.php';

    return $template;
}

add_filter ('page_template', 'store_redirect_page_template', 0);

/**
 * Enqueue scripts and styles
 */

function store_scripts_and_styles() {

    wp_enqueue_style( 'store-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), null, 'all' );

    //enqueue flexboxgrid css
    wp_enqueue_style( 'flexboxgrid', plugin_dir_url(__FILE__) . 'assets/css/flexboxgrid-6.3.1/dist/flexboxgrid.min.css', array(), '6.3.1', 'all' );

    //load scripts
    wp_enqueue_script( 'store-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true );

    //locolize store-script with ajaxurl

    wp_localize_script( 'store-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}

add_action( 'wp_enqueue_scripts', 'store_scripts_and_styles' );

//set a session 
function store_start_session() {
    if( ! session_id() ) {
        session_start();
    
    }
    //add a session variable to store the cart
    if ( ! isset( $_SESSION['cart'] ) ) {
        $_SESSION['cart'] = array();
    }
}

add_action('init', 'store_start_session', 1);

/**
 * Add mini cart to footer
 *
 * @return void
 */
function store_add_cart_count_to_footer() {

//if page slug is cart, don't show cart count
if ( is_page( 'cart' ) ) return;

$items = count( $_SESSION['cart'] );

//get cart page url by slug
$cart_page_url = get_permalink( get_page_by_path( 'cart' ) );

//heredoc syntax
$cart_count = <<<EOD
    <div class="cart-count">
        There are: <span id="cart-count__number" class="cart-count__number" >$items</span> in your cart
        <a class="cart-count__link" href="$cart_page_url">View Cart</a>
    </div>
EOD;

echo $cart_count;

}

add_action( 'wp_footer', 'store_add_cart_count_to_footer' );


/**
 * Get cart total items
 *
 * @return Integer
 */
 
function store_get_cart_total_items () {

    $total_items = 0;

    //if session['cart'] is not set or empty, return 0

    if ( ! isset( $_SESSION['cart'] ) || empty( $_SESSION['cart'] ) ) 
        return $total_items;

    //cart is an array of products - count the number of products in the cart
    $total_items = count( $_SESSION['cart'] );

    return $total_items;
}

/**
 * Get cart total sum
 *
 * @return Integer
 */

function store_get_cart_total_sum () {

    $total_sum = 0;

    //if session['cart'] is not set or empty, return 0

    if ( ! isset( $_SESSION['cart'] ) || empty( $_SESSION['cart'] ) ) 
        return $total_sum;

    //cart is an array of products - count the number of products in the cart
    foreach ( $_SESSION['cart'] as $product ) {

        $total_sum += $product['price'];

    }

    return $total_sum;

}

include 'inc/http-calls.php';

include 'inc/order-cpt.php';

include 'inc/ajax-handlers.php';
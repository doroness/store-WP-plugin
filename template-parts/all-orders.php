<?php

//get all custom post type 'order' and meta key 'order_status' = 'pending'

$pending_orders = new WP_Query( array(
    'post_type' => 'order',
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => 'order_status',
            'value' => 'pending',
            'compare' => '='
        )
    )
) );


//loop through the orders and display them in a table

if ( $pending_orders->have_posts() ) : ?>
<ul class="admin-orders">

    <?php while ( $pending_orders->have_posts() ) : $pending_orders->the_post(); ?>
        <li class="admin-orders__item">
            <a href="<?php echo get_edit_post_link(); ?>">
                #<?php echo get_the_ID(); ?>
            </a>
            
            <sapn><?php echo get_post_meta( get_the_ID(), 'name', true ); ?></sapn>
            
            <span><?php echo get_post_meta( get_the_ID(), 'total', true ); ?></span>
          
            <a href="<?php echo get_edit_post_link(); ?>">
                View
            </a>

            <a href="<?php echo get_delete_post_link(); ?>">
                Delete
            </a>
          
        </li>

    <?php endwhile; ?>

</ul>
   

<?php else : ?>

    <p>No orders found</p>

<?php endif; ?>


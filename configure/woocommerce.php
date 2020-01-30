<?php

function pcll_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'pcll_add_woocommerce_support' );

/**
* Ensure cart contents update when products are added to the cart via AJAX
*/

function my_header_add_to_cart_fragment( $fragments ) {

    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents icon-shopping_cart" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php            
    }
        ?></a><?php

    $fragments['a.cart-contents.icon-shopping_cart'] = ob_get_clean();
    
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );
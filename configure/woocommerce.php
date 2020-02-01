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


/* Additional product information */

function pcll_add_product_info() {
    $cabCat = get_field('cab_category');
    $handouts = get_field('handouts');

    if (get_field('nccaom_approved') == "1") {
        $nccaom = 'Approved';
    } else {
        $nccaom = 'Pending';
    }

    if (get_field('cab_approved') == "1") {
        $cab = 'Approved';
    } elseif ($cabCat < 1) {
        $cab = null;
    } else {
        $cab = 'Pending';
    }

    $youtubeURL = get_field('youtube_preview');

    /* Additional product information rendered */

    echo '<ul>';
    echo '<li>', get_field('number_of_ceus'), ' CEUs/PDAs';
    echo ' (NCCAOM ', $nccaom;
    if ($cab) {
        echo ' and CAB ', $cab;
    }
    echo ')</li>';

    if ($cab) {
        echo '<li>', 'CAB Category ', $cabCat, '</li>';
    }

    if ($handouts) {
        echo '<li>Handouts Included</li>';
    }
    echo '</ul>';
}


add_action('woocommerce_shop_loop_item_title', 'pcll_add_product_info');


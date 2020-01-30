<?php

function pcll_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'pcll_add_woocommerce_support' );

/** Remove image sizing from WooCommerce */
function remove_default_image_sizes( $sizes ) {
  
    /* Default WordPress */
    unset( $sizes[ 'thumbnail' ]);          // Remove Thumbnail (150 x 150 hard cropped)
    unset( $sizes[ 'medium' ]);          // Remove Medium resolution (300 x 300 max height 300px)
    unset( $sizes[ 'medium_large' ]);    // Remove Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
    unset( $sizes[ 'large' ]);           // Remove Large resolution (1024 x 1024 max height 1024px)
    
    /* With WooCommerce */
    unset( $sizes[ 'shop_thumbnail' ]);  // Remove Shop thumbnail (180 x 180 hard cropped)
    unset( $sizes[ 'shop_catalog' ]);    // Remove Shop catalog (300 x 300 hard cropped)
    unset( $sizes[ 'shop_single' ]);     // Shop single (600 x 600 hard cropped)
    
    return $sizes;
}
  
  add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );

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
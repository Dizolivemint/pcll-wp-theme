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

/* Shop filter */

// array of filters (field key => field name)
$GLOBALS['my_query_filters'] = array( 
	'field_1'	=> 'location', 
    'field_2'	=> 'related_instructors',
    'field_3'	=> 'topic_category',
    'field_4'	=> 'nccaom_category'
);


// action
add_action('woocommerce_product_query_meta_query', 'my_pre_get_posts', 10, 1);

function my_pre_get_posts( $query ) {
    // Only on shop pages
    if( ! is_shop() ) return $meta_query;
	// bail early if is in admin
	if( is_admin() ) return;
	
	// get meta query
	$meta_query = $query->get('meta_query');
	
	// loop over filters
	foreach( $GLOBALS['my_query_filters'] as $key => $name ) {
		
		// continue if not found in url
		if( empty($_GET[ $name ]) ) {
			
			continue;
			
		}
		
		
		// get the value for this filter
		// eg: http://www.website.com/events?city=melbourne,sydney
		$value = explode(',', $_GET[ $name ]);
			
		// append meta query
    	$meta_query[] = array(
            'key'		=> $name,
            'value'		=> $value,
            'compare'	=> 'IN',
        );
        
	} 
	
	// update meta query
    $query->set('meta_query', $meta_query);
    
    return $query;
}

// add_filter( 'woocommerce_product_query_meta_query', 'show_only_products_with_specific_metakey', 10, 2 );
// function show_only_products_with_specific_metakey( $meta_query, $query ) {
//     // Only on shop pages
//     if( ! is_shop() ) return $meta_query;

//     $meta_query[] = array(
//         'key'     => '_the_meta_key',
//         'value'     => array('L','XL'),
//         'compare' => 'IN'
//     );
//     return $meta_query;
// }

function pcll_product_filter() {
    ?>
    <div id="archive-filters">
    <?php foreach( $GLOBALS['my_query_filters'] as $key => $name ): 
        
        // get the field's settings without attempting to load a value
        $field = get_field_object($key, false, false);
        
        
        // set value if available
        if( isset($_GET[ $name ]) ) {
            
            $field['value'] = explode(',', $_GET[ $name ]);
            
        }
        
        
        // create filter
    ?>
        <div class="filter" data-filter="<?php echo $name; ?>">
            <?php create_field( $field ); ?>
        </div>
        
    <?php endforeach; ?>
    </div>

    <script type="text/javascript">
    (function($) {
        
        // change
        $('#archive-filters').on('change', 'input[type="checkbox"]', function(){

            // vars
            var url = '<?php echo home_url('property'); ?>';
                args = {};
                
            
            // loop over filters
            $('#archive-filters .filter').each(function(){
                
                // vars
                var filter = $(this).data('filter'),
                    vals = [];
                
                
                // find checked inputs
                $(this).find('input:checked').each(function(){
        
                    vals.push( $(this).val() );
        
                });
                
                
                // append to args
                args[ filter ] = vals.join(',');
                
            });
            
            
            // update url
            url += '?';
            
            
            // loop over args
            $.each(args, function( name, value ){
                
                url += name + '=' + value + '&';
                
            });
            
            
            // remove last &
            url = url.slice(0, -1);
            
            
            // reload page
            window.location.replace( url );
            

        });

    })(jQuery);
    </script>
    <?php
}
add_action( 'woocommerce_product_query', 'pcll_product_filter');
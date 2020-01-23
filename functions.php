<?php

	// Utilities

	include( 'configure/utilities.php' );

	// CONFIG

	include( 'configure/configure.php' );

	// JAVASCRIPT & CSS

	include( 'configure/js-css.php' );

	// SHORTCODES

	include( 'configure/shortcodes.php' );

	// ACF

	include( 'configure/acf.php' );

	// HOOKS ADMIN

	if( is_admin() )
	{
		include( 'configure/admin.php' );
	}

	// DEREGISTER SCRIPTS

	add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

	function my_deregister_styles() {
		wp_deregister_style( 'edwiserbridge_font_awesome' );
		wp_deregister_style( 'edwiserbridge' );
		wp_deregister_style( 'wdmdatatablecss' );
		wp_deregister_style( 'Edwiser Bridge Single Sign On-public-style' );
		wp_deregister_style( 'heateor_sss_frontend_css' );
		wp_deregister_style( 'woocommerce-general' );
		wp_deregister_style( 'woocommerce-inline' );
		wp_deregister_style( 'woocommerce-layout' );
		wp_deregister_style( 'woocommerce-smallscreen' );
		wp_deregister_style( 'woocommerce_integration' );
		wp_deregister_style( 'eb-public-jquery-ui-css' );
		wp_deregister_style( 'heateor_sss_sharing_default_svg' );
		wp_deregister_style( 'wc-block-style' );
		wp_deregister_style( 'wp-block-library' );

	}

	add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

	function my_deregister_javascript() {
		wp_deregister_script( 'edwiserbridge' );
		wp_deregister_script( 'edwiserbridgeui-block' );
		wp_deregister_script( 'wdmdatatablejs' );
		wp_deregister_script( 'Edwiser Bridge Single Sign On-public-script ' );
		wp_deregister_script( 'heateor_sss_sharing_js' );
		wp_deregister_script( 'jquery-blockui' );
		wp_deregister_script( 'js-cookie' );
		wp_deregister_script( 'wc-add-to-cart' );
		wp_deregister_script( 'wc-cart-fragments' );
		wp_deregister_script( 'woocommerce' );
        wp_deregister_script( 'woocommerce_integration' );
		if (is_admin()) return;
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-core' );
		wp_deregister_script( 'jquery-ui-button' );
		wp_deregister_script( 'jquery-ui-core' );
		wp_deregister_script( 'jquery-ui-dialog' );
		wp_deregister_script( 'jquery-ui-draggable' );
		wp_deregister_script( 'jquery-ui-mouse' );
		wp_deregister_script( 'jquery-ui-position' );
		wp_deregister_script( 'jquery-ui-resizable' );
        wp_deregister_script( 'jquery-ui-widget' );
	}
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


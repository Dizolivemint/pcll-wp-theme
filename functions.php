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

	require get_theme_file_path('/inc/search-route.php');

	function pcll_custom_rest() {
	  register_rest_field('post', 'authorName', array(
		'get_callback' => function() {return get_the_author();}
	  ));
	}
	
	add_action('rest_api_init', 'pcll_custom_rest');
	
	function pageBanner($args = NULL) {
	  
	  if (!$args['title']) {
		$args['title'] = get_the_title();
	  }
	
	  if (!$args['subtitle']) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	  }
	
	  if (!$args['photo']) {
		if (get_field('page_banner_background_image')) {
		  $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
		} else {
		  $args['photo'] = get_theme_file_uri('/images/pclldefaultbg.jpg');
		}
	  }
	
	  ?>
	  <div class="page-banner">
		<div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
		<div class="page-banner__content container container--narrow">
		  <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
		  <div class="page-banner__intro">
			<p><?php echo $args['subtitle']; ?></p>
		  </div>
		</div>  
	  </div>
	<?php }
	
	function pcll_files() {
	  wp_localize_script('main-pcll-js', 'pcllData', array(
		'root_url' => get_site_url()
	  ));
	}
	
	add_action('wp_enqueue_scripts', 'pcll_files');
	
	function pcll_features() {
	  add_theme_support('title-tag');
	  add_theme_support('post-thumbnails');
	  add_image_size('instructorLandscape', 400, 260, true);
	  add_image_size('instructorPortrait', 480, 650, true);
	  add_image_size('pageBanner', 1500, 350, true);
	}
	
	add_action('after_setup_theme', 'pcll_features');
	
	function pcll_adjust_queries($query) {
	  if (!is_admin() AND is_post_type_archive('podcast') AND is_main_query()) {
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('orderby', 'event_date');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	  }
	
	  if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
				  array(
					'key' => 'event_date',
					'compare' => '>=',
					'value' => $today,
					'type' => 'numeric'
				  )
				));
	  }
	}
	
	add_action('pre_get_posts', 'pcll_adjust_queries');
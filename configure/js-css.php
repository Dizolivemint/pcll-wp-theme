<?php
	function _add_javascript()
	{
		wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/dist/js/main.js', array(), null, true );
		wp_localize_script('main-js', 'pcllData', array(
			'root_url' => get_site_url()
		));
	}

	add_action('wp_enqueue_scripts', '_add_javascript', 100);

	function _add_stylesheets()
	{
		wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/dist/css/main.css', array(), null, 'all' );
	}
	add_action('wp_enqueue_scripts', '_add_stylesheets');

	// DEREGISTER SCRIPTS

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

	add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

	function my_deregister_javascript() {
		if (is_admin()) return;
		wp_deregister_script( 'edwiserbridge' );
		wp_deregister_script( 'edwiserbridgeui-block' );
		wp_deregister_script( 'wdmdatatablejs' );
		wp_deregister_script( 'Edwiser Bridge Single Sign On-public-script ' );
		// wp_deregister_script( 'heateor_sss_sharing_js' );
		wp_deregister_script( 'jquery-blockui' );
		wp_deregister_script( 'js-cookie' );
		wp_deregister_script( 'wc-add-to-cart' );
		wp_deregister_script( 'wc-cart-fragments' );
		wp_deregister_script( 'woocommerce' );
		wp_deregister_script( 'woocommerce_integration' );
	}

	add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

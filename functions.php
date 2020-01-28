<?php

	// UTILS

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

	// CUSTOM PAGE QUERIES

	include( 'configure/cpq.php' );

	// WOOCOMMERCE

	include( 'configure/woocommerce.php' );

	// PAGE CUSTOMIZATIONS
	
	include( 'configure/page-features.php' );

	// REGISTER CUSTOM REST API

	require get_theme_file_path('/inc/search-route.php');

	function pcll_custom_rest() {
		register_rest_field('post', 'authorName', array(
		  'get_callback' => function() {return get_the_author();}
		));
	}
	
	add_action('rest_api_init', 'pcll_custom_rest');
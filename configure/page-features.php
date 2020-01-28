<?php
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
	
	function pcll_features() {
	  add_theme_support('title-tag');
	  add_theme_support('post-thumbnails');
	  add_image_size('instructorLandscape', 400, 260, true);
	  add_image_size('instructorPortrait', 480, 650, true);
	  add_image_size('pageBanner', 1500, 350, true);
	}
	
	add_action('after_setup_theme', 'pcll_features');
	

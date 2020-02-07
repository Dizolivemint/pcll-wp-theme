<?php
function pcll_adjust_queries($query) {
	if (!is_admin() AND is_post_type_archive('podcast') AND $query->is_main_query()) {
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('orderby', 'event_date');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	  }
	
	  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
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
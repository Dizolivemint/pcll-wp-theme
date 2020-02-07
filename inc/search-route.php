<?php

add_action('rest_api_init', 'pcllRegisterSearch');

function pcllRegisterSearch() {
  register_rest_route('pcll/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'pcllSearchResults'
  ));
}

function pcllSearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'instructor', 'product', 'podcast', 'event'),
    's' => sanitize_text_field($data['term'])
  ));

  $results = array(
    'generalInfo' => array(),
    'instructors' => array(),
    'products' => array(),
    'events' => array(),
    'podcasts' => array()
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }

    if (get_post_type() == 'instructor') {
      $relatedProduct = get_field('related_product');

      if ($relatedProduct) {
        foreach($relatedProduct as $product) {
          array_push($results['products'], array(
            'title' => get_the_title($product),
            'permalink' => get_the_permalink($product)
          ));
        }
      }
      
      array_push($results['instructors'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'image' => get_field('instructor_image')
      ));
    }

    if (get_post_type() == 'product') {
      $relatedPodcasts = get_field('related_podcast');

      if ($relatedPodcasts) {
        foreach($relatedPodcasts as $podcast) {
          array_push($results['podcasts'], array(
            'title' => get_the_title($podcast),
            'permalink' => get_the_permalink($podcast)
          ));
        }
      }

      $relatedInstructors = get_field('related_instructor');

      if ($relatedInstructors) {
        foreach($relatedInstructors as $instructor) {
          array_push($results['instructors'], array(
            'title' => get_the_title($instructor),
            'permalink' => get_the_permalink($instructor),
            'image' => get_field('instructor_image')
          ));
        }
      }
    
      array_push($results['products'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'id' => get_the_id()
      ));
    }

    if (get_post_type() == 'podcast') {
      array_push($results['podcasts'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if (get_post_type() == 'event') {
      $eventDate = new DateTime(get_field('event_date'));
      $description = null;
      if (has_excerpt()) {
        $description = get_the_excerpt();
      } else {
        $description = wp_trim_words(get_the_content(), 18);
      }

      array_push($results['events'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'month' => $eventDate->format('M'),
        'day' => $eventDate->format('d'),
        'description' => $description
      ));
    }
    
  }

  if ($results['products']) {
    $productsMetaQuery = array('relation' => 'OR');

    foreach($results['products'] as $item) {
      array_push($productsMetaQuery, array(
          'key' => 'related_products',
          'compare' => 'LIKE',
          'value' => '"' . $item['id'] . '"'
        ));
    }

    $productRelationshipQuery = new WP_Query(array(
      'post_type' => array('instructor', 'event', 'podcast'),
      'meta_query' => $productsMetaQuery
    ));

    while($productRelationshipQuery->have_posts()) {
      $productRelationshipQuery->the_post();

      if (get_post_type() == 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $description = null;
        if (has_excerpt()) {
          $description = get_the_excerpt();
        } else {
          $description = wp_trim_words(get_the_content(), 18);
        }

        array_push($results['events'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'month' => $eventDate->format('M'),
          'day' => $eventDate->format('d'),
          'description' => $description
        ));
      }

      if (get_post_type() == 'instructor') {
        array_push($results['instructors'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'image' => get_field('instructor_image')
        ));
      }

      if (get_post_type() == 'podcast') {
        array_push($results['podcasts'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ));
      }

    }
    $results['instructors'] = array_values(array_unique($results['instructors'], SORT_REGULAR));
    $results['podcasts'] = array_values(array_unique($results['podcasts'], SORT_REGULAR));
    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
  }

  if ($results['instructors']) {
    $instructorsMetaQuery = array('relation' => 'OR');

    foreach($results['instructors'] as $item) {
      array_push($instructorsMetaQuery, array(
          'key' => 'related_instructors',
          'compare' => 'LIKE',
          'value' => '"' . $item['id'] . '"'
        ));
    }

    $instructorRelationshipQuery = new WP_Query(array(
      'post_type' => array('product', 'event', 'podcast'),
      'meta_query' => $instructorsMetaQuery
    ));

    while($instructorRelationshipQuery->have_posts()) {
      $instructorRelationshipQuery->the_post();

      if (get_post_type() == 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $description = null;
        if (has_excerpt()) {
          $description = get_the_excerpt();
        } else {
          $description = wp_trim_words(get_the_content(), 18);
        }

        array_push($results['events'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'month' => $eventDate->format('M'),
          'day' => $eventDate->format('d'),
          'description' => $description
        ));
      }

      if (get_post_type() == 'product') {
        array_push($results['products'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ));
      }

      if (get_post_type() == 'podcast') {
        array_push($results['podcasts'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ));
      }
    }
    $results['podcasts'] = array_values(array_unique($results['podcasts'], SORT_REGULAR));
    $results['products'] = array_values(array_unique($results['products'], SORT_REGULAR));
    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
  }


  return $results;

}
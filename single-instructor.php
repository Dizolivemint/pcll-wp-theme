<?php
  
  get_header();

  while(have_posts()) {
    the_post();
     ?>
    

    <div class="mt-2">
          
      <div class="row">

          <div class="col-sm d-flex justify-content-center">
            <img style="width:300px;" src="<?php the_field('instructor_image'); ?>"/>
          </div>

          <div class="col-sm">
            <?php the_content(); ?>
            
          </div>

      </div>
      <hr class="section-break">
      
      <div class="row">
        <?php

          $relatedProducts = get_field('related_products');

          if ($relatedProducts) {
            echo '<div class="col-sm">';
            echo '<hr>';
            echo '<h2>Course(s)</h2>';
            echo '<ul>';
            foreach($relatedProducts as $product) { ?>
              <li><a href="<?php echo get_the_permalink($product); ?>"><?php echo get_the_title($product); ?></a></li>
            <?php }
            echo '</ul>';
            echo '</div>';
          }

        ?>

        <?php

          $relatedPodcasts = get_field('related_podcasts');

          if ($relatedPodcasts) {
            echo '<div class="col-sm">';
            echo '<hr>';
            echo '<h2>Podcast(s)</h2>';
            echo '<ul>';
            foreach($relatedPodcasts as $podcast) { ?>
              <li><a href="<?php echo get_the_permalink($podcast); ?>"><?php echo get_the_title($podcast); ?></a></li>
            <?php }
            echo '</ul>';
            echo '</div>';
          }

        ?>
      </div>
    </div>
    
    
  <?php }

  get_footer();

?>
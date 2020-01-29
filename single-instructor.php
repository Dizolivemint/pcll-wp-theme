<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();
     ?>
    

    <div class="container page-section">
          
      <div class="row">

          <div class="col-sm">
          <?php $instructorImage = get_field('instructor_image'); ?>
            <img src="<?php $instructorImage ?>"/>
          </div>

          <div class="col-sm">
            <?php the_content(); ?>
            
          </div>

      </div>
      <hr class="section-break">
      <?php echo do_shortcode('[Sassy_Social_Share style="background-color:#000;"]') ?>
      
      <div class="row">
        <?php

          $relatedProducts = get_field('related_products');

          if ($relatedProducts) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Course(s)</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedProducts as $product) { ?>
              <li><a href="<?php echo get_the_permalink($product); ?>"><?php echo get_the_title($product); ?></a></li>
            <?php }
            echo '</ul>';
          }

        ?>

        <?php

          $relatedPodcasts = get_field('related_podcasts');

          if ($relatedPodcasts) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Course(s)</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedPodcasts as $podcast) { ?>
              <li><a href="<?php echo get_the_permalink($podcast); ?>"><?php echo get_the_title($podcast); ?></a></li>
            <?php }
            echo '</ul>';
          }

        ?>
      </div>
    </div>
    
  <?php }

  get_footer();

?>
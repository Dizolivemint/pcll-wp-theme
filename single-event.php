<?php
  
  get_header();

  while(have_posts()) {
    the_post();
     ?>
    

    <div class="mt-2">
          
      <div class="row mb-1">

          <div class="col-sm d-flex justify-content-center mb-1">
            <img style="width:300px; align-self: flex-start;" src="<?php the_field('event_image'); ?>"/>
          </div>

          <div class="col-sm mr-1 ml-1">
            <?php the_content(); ?>
            
          </div>

      </div>
      
      <div class="row">
        <?php

          $relatedProducts = get_field('related_products');

          if ($relatedProducts) {
            echo '<div class="col-sm m-1">';
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

        $relatedInstructors = get_field('related_instructors');

        if ($relatedInstructors) {
          echo '<div class="col-sm m-1">';
          echo '<h2>Instructor(s)</h2>';
          echo '<ul>';
          foreach($relatedInstructors as $instructor) { ?>
            <li><a href="<?php echo get_the_permalink($instructor); ?>"><?php echo get_the_title($instructor); ?></a></li>
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
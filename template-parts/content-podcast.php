<div class="podcast-summary">
  <a class="podcast-summary__date t-center" href="#">
    <span class="podcast-summary__month"><?php
      $podcastDate = new DateTime(get_field('podcast_date'));
      echo $podcastDate->format('M')
    ?></span>
    <span class="podcast-summary__day"><?php echo $podcastDate->format('d') ?></span>  
  </a>
  <div class="podcast-summary__content">
    <h5 class="podcast-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <p><?php if (has_excerpt()) {
        echo get_the_excerpt();
      } else {
        echo wp_trim_words(get_the_content(), 18);
        } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
  </div>
</div>
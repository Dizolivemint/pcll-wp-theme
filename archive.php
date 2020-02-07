<?php

get_header();
// pageBanner(array(
//   'title' => get_the_archive_title(),
//   'subtitle' => get_the_archive_description()
// ));
 ?>

<div class="container">
<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="col-lg-12 border">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <div>
        <?php the_excerpt(); ?>
        <p><a class="btn btn-link" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
      </div>

    </div>
  <?php }
  echo paginate_links();
?>
</div>

<?php get_footer();

?>
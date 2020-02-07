<?php

get_header();
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'Check out our upcomming events and live courses'
));
 ?>

<div class="container">
<?php
  
  while(have_posts()) {
    the_post(); 
    get_template_part('template-parts/content-event');
   }
  echo paginate_links();
?>

<hr>

<p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events archive</a>.</p>

</div>

<?php get_footer();

?>
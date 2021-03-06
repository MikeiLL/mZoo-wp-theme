<?php use Roots\Sage\Extras; ?>

<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php
$args = array( 'post_type' => 'post', 'paged' => $paged );
$zoo_loop = new WP_Query( $args );
?>

<?php while ($zoo_loop->have_posts()) : $zoo_loop->the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>

  
<?php
/**
 * Template Name: Teasers
 */
?>
	<h1 class="media-zen">
		<?php echo get_bloginfo ( 'description' ); ?>
	</h1>
	<div class="home_container">
	
		<?php
		// The Query
		$teaser_query = new WP_Query( 'post_type=teasers' );

		?>

		<?php while ($teaser_query->have_posts()) : $teaser_query->the_post(); ?>  
			<div id="bp_foundation" class="container-fluid bp_foundation current">
				<div class="row-fluid heading_stripe">
					<?php the_title( '<h2>', '</h2>' ); ?>
				</div>
				<p><?php get_template_part('templates/content', 'page'); ?></p>
				<a name="next" class="btn round pink pull-right" href="#">See how it works >></a>
			</div>
		<?php endwhile; ?>
		<?php 
		/* Restore original Post Data */
		wp_reset_postdata(); 
		?>

		
	</div>
		





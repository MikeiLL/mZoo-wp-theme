	<h1 class="media-zen">
		<?php echo get_bloginfo ( 'description' ); ?>
	</h1>
	<div class="home_container">
	
		<?php while (have_posts()) : the_post(); ?>  
			<?php if (get_post_type() == 'teasers') {?>
			<div id="bp_foundation" class="container-fluid bp_foundation current">
				<div class="row-fluid heading_stripe">
					<?php the_title( '<h2>', '</h2>' ); ?>
				</div>
				<p><?php get_template_part('templates/content', 'page'); ?></p>
				<a name="next" class="btn round pink pull-right" href="#">See how it works >></a>
			<?php } ?>
			</div>
		<?php endwhile; ?>

		
	</div>





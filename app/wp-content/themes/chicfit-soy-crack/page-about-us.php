<?php /*Template name: About Us  */ ?>

<?php get_header(); ?>

	<main role="main"  class="wrapper-inner">
		<!-- section -->
		<section>
				<div class="us-about">
					<h1><?php the_title(); ?></h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

						<br class="clear">
					</article>	
				</div>

		<?php endwhile; ?>
		<?php else: ?>
		<?php endif; ?>

		<div class="container-sidebar">
			<?php get_sidebar(); ?>
		</div>

		</section>
		<!-- /section -->
	</main>
<?php get_footer(); ?>

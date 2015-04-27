<?php get_header(); ?>

<main role="main" class="all-content" style="padding-top:60px;border:none;">
	
	<section class="wrapper-index">

		<?php if (have_posts()): the_post(); ?>

			<h1><?php _e( 'Archivos creados por ', 'html5blank' ); echo get_the_author(); ?></h1>

		<?php if ( get_the_author_meta('description')) : ?>

		<?php echo get_avatar(get_the_author_meta('user_email')); ?>

			<h2><?php _e( 'About ', 'html5blank' ); echo get_the_author() ; ?></h2>

			<?php echo wpautop( get_the_author_meta('description') ); ?>

		<?php endif; ?>

		<?php rewind_posts(); while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-loop">
			
			<!-- post thumbnail -->
			<a href="<?php the_permalink()?>">
				<div class="img-post" style="background-image:url('<?php the_field('imagen_post_banner'); ?>')"></div>
			</a>
			<!-- /post thumbnail -->

			<!-- post post -->
			<div class="content-post">
				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h2>
				<p><?php html5wp_excerpt('html5wp_custom_post'); // Build your custom callback length in functions.php ?></p>
				<div class="content-author">
					<div class="img-author">
						<img src="<?php the_field('imagen_post_banner'); ?>" alt="">
					</div>

					<div class="name-author">
						<?php the_author_posts_link(); ?>
					</div>
								
				</div>
			</div>
			<!-- /post post -->

			<!-- post details -->
			<div class="date-post">
				<div id="flecha"></div>
				<span class="date">
					<time datetime="<?php the_time('d/m'); ?>">
						<p class="dia"><?php echo get_the_date('d'); ?> </p>
						<p class="mes"><?php echo get_the_date('F'); ?> </p>
					</time>
				</span>
			</div>
				
			<!-- /post details -->

		</div>
	</article>
	<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2>No hay post.</h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->

		<?php get_sidebar(); ?>
	
	</main>



<?php get_footer(); ?>
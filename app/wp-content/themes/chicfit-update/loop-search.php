<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-loop">
			
			<!-- post thumbnail -->
			<a href="<?php the_permalink()?>" class="img-post" style="background-image:url('<?php the_field('imagen_post_banner'); ?>')">
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
						<?php echo get_avatar(get_the_author_meta()); ?>
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
						<div class="icon">
							<i class="fa fa-calendar"></i>
						</div>
						<div class="info-date">
							<p class="dia"><?php echo get_the_date('d'); ?> </p>
							<p class="mes"><?php echo get_the_date('F'); ?> </p>
						</div>
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
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
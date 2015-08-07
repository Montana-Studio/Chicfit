<?php get_header(); ?>

<!-- SINGLE -->
<section class="content-post">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article class="single-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="container-one">
					<div class="content-title">
						<h1>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h1>
						<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
					</div>

					<div class="img-post" style="background-image:url('<?php the_field('imagen_post_normal'); ?>')">
						<div class="date">
							<i class="fa fa-calendar"></i>
							<time><?php echo get_the_date('d/m'); ?></time>
						</div>
					</div>
				</div>

<div id="mt_hi_A"></div>

				<div class="container-two">
					
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>

					<div class="content-text">
						<?php the_content();?>
						<div class="content-author">
							<div class="img-author">
								<?php echo get_avatar(get_the_author_meta()); ?>
							</div>
							<div class="name-author">
								<div class="author">
								<a href="">Publicado por </a> <?php the_author_posts_link(); ?>
								</div>
							</div>
						</div>

						<?php comments_template( '', true ); // Remove if you don't want comments ?>
					</div>

				</div>
				<div class="container-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</article>
			
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>
			<article>
				<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
			</article>
		<?php endif; ?>
</section>
<!-- /SINGLE -->

<div id="mt_skycrapper_B"></div>

<?php get_footer(); ?>

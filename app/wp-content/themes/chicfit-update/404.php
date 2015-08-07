<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404">
				<div class="error404">

					<div class="logo-error">
						<a href="<?php echo home_url(); ?>">
							<svg viewBox="0 0 300 95">
								<use xlink:href="#svg_logo"/> 
							</svg>
						</a>
					</div>
					<div class="txt-error">
						<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
						<h2>
							<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
						</h2>
					</div>
					
				</div>
				

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

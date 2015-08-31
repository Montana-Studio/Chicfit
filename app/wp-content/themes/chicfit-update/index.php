<?php get_header(); ?>

<!-- 728X90_CFD -->
<div id='div-gpt-ad-1430935394858-7' style='max-width:728px;margin:0 auto;padding:5px 0;clear:both;display:block;'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1430935394858-7'); });
	</script>
</div>

<!--SLIDER CONTENT-->
<div id='slider' class='swipe'>
	<div class='swipe-wrap'>
		<?php $query = new WP_Query('posts_per_page=3&category_name=slide'); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				
				<div class="content-slide" style="background-image:url(<?php the_field('imagen_post_banner'); ?>);">
					<a href="<?php the_permalink()?>">
					<article id="post-<?php the_ID(); ?>">
						<main>
							<h1><?php the_title(); ?></h1>
						</main>
					</article>
					</a>
				</div>
				

			<?php endwhile;
			wp_reset_postdata();
			else: ?>
			<h2>No hay post.</h2>
		<?php endif; ?>
	</div>
	<div class="btn_prev" onclick='mySwipe.prev()'><i class="fa fa-chevron-left"></i></div>
	<div class="btn_next" onclick='mySwipe.next()'><i class="fa fa-chevron-right"></i></div>
</div>

<!--970x250_CFD_ALL-->
<div id='div-gpt-ad-1430935394858-9' style='max-width:970px;margin:0 auto -40px;display:block;clear:both;padding:5px 0;'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1430935394858-9'); });
	</script>
</div>

<!-- LOOP DESTACADOS -->
<div class="destacados">

	<?php $query = new WP_Query('posts_per_page=4&category_name=destacado'); ?>

	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<article class="content-destacados" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div>
				<a href="<?php the_permalink()?>">
					<img src="<?php the_field('imagen_post_banner'); ?>" alt="" class="img-loop">
				</a>
			</div>
			<div class="content-art">
				<a href="<?php the_permalink()?>">
					<h2><?php if (strlen($post->post_title) > 40) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . ' ... '; } else {
								the_title();
								} ?></h2>
				</a>
				<p><?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?></p>
				<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>

				<a href="<?php the_permalink()?>" class="alt_link"></a>
			</div>
		</article>

	<?php endwhile;
	wp_reset_postdata();
	else: ?>
		<h2>No hay post.</h2>
	<?php endif; ?>
</div>
<!-- / LOOP DESTACADOS -->


<!--CONTENT WRAP -->

<!-- 728x90_CFD_cont -->
<div id='div-gpt-ad-1430935394858-8' style='max-width:728px;margin:0 auto;padding:5px 0;clear:both;display:block;'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1430935394858-8'); });
	</script>
</div>

<!-- LOOP MÁS RECIENTES -->
<div class="content-loop-home">
	<div id="container" class="container-principal">

			<div id="reciente" class="item-principal">
				<div class="bg-color">
					<h2>LO MÁS RECIENTE</h2>
					<nav class="tags">
						<?php html5blank_nav(); ?>
					</nav>	
				</div>			
			</div>

			<?php //if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article class="item-principal" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="bg-color-none">
					<div class="social">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>&t=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/share?url=<?php the_permalink()?>&via=chicfitdaily&text=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><i class="fa fa-twitter"></i></a></li>
					</div>
					<div class="principal-post" style="background-image:url('<?php the_field('imagen_post_banner'); ?>')">
						<a href="<?php the_permalink()?>">
							<h2><?php if (strlen($post->post_title) > 41) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . ' ... '; } else {
								the_title();
								} ?></h2>
							<div class="date"><p><?php echo get_the_date('d F'); ?></p></div>
						</a>
					</div>
				</div>
			</article>

			<?php /* endwhile;
			wp_reset_postdata();
			else: ?>
				<p>No hay post.</p>
			<?php endif; */?>
			
			<?php endwhile; ?>

			<?php else: ?>

				 <!-- article -->
				<article>
					<h2>No hay post.</h2>
				</article>
				<!-- /article -->

			<?php endif; ?>

			<div class="item-principal paginador">
				<div class="bg-color">
					<h2>VER MÁS</h2>
					<div class="paginador-arrow">
						<?php get_template_part('pagination'); ?>
					</div>
				</div>
			</div>

	</div>
</div>
<!-- /LOOP MÁS RECIENTES -->


<?php get_footer(); ?>
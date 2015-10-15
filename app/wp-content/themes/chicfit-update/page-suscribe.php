<?php /* Template Name: Subscribe */ ?>
<?php get_header(); ?>


<div class="content-page-news">
	<img src="<?php echo get_template_directory_uri(); ?>/img/bg-newsletter-page.jpg?>" alt="">

	<div class="logo-title">
		<div class="logo">
			<svg viewBox="0 0 300 95">
				<use xlink:href="#svg_logo_white"/>
			</svg>
		</div>
		<div class="newsltt-title">NEWSLETTER</div>
	</div>

	<div class="msg-bienvenida">
		<h1>¡BIENVENIDA!</h1>
		<h2>SUSCRIPCIÓN REALIZADA CON ÉXITO</h2>
		<div class="be-social-nw">
		<div class="title-social">Chicfit también en</div>
			<ul>
				<li><a href="https://www.facebook.com/chicfitdaily" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/chicfitdaily" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li><a href="https://instagram.com/chicfitdaily/" target="_blank"><i class="fa fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
	
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

<?php get_footer(); ?>
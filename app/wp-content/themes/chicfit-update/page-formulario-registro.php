<?php /* Template Name: Form Newsletter */ ?> 
<?php get_header(); ?>


<div class="content-page-news content-news-form" style="background:url('<?php echo get_template_directory_uri(); ?>/img/bg-newsletter-new.jpg?>')">

	<div class="logo-title">
		<div class="logo">
			<svg viewBox="0 0 300 95">
				<use xlink:href="#svg_logo_white"/>
			</svg>
		</div>
		<div class="newsltt-title">NEWSLETTER</div>
	</div>

	<div class="msg-bienvenida msg-nuevo-registro">
		<h1 class="title-new-form">SUSCRIBETE</h1>
		<div class="txt-info-news">Entérate de todo sobre consejos, recetas, ejercicios y mucho más ¡Sé parte de Chicfit y motívate con nosotras por la vida sana y el deporte!</div>
		<div class="formulario-nuevo-news">
			<?php echo do_shortcode('[newsletter_signup_form id=0]');?>
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
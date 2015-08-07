<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="page-content">

			<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts );?> <?php echo get_search_query(); ?></h1>

			<?php get_template_part('loop-search'); ?>
			<?php get_template_part('pagination'); ?>


		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>

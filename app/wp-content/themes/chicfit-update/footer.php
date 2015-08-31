			
				<div class="push"></div>
			</div>


		<!-- /wrapper -->
			
			<!-- footer -->

			<footer class="footer" role="contentinfo">

				<div class="bg-newsletter"></div> 
				<div class="newsletter-new-suscribe"> 

					<div class="content-popups animation-pop">

						<?php $my_query = new WP_Query( 'p=1245' ); ?>

						<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

							<div class="bg-image-popups"></div>
							<div class="bg-color-popups" style="background-image:url('<?php the_field('background_image') ?>');"></div> 
							<div class="bg-content-popups">
								<div class="close-button-popups">
									<i class="fa fa-times"></i>
								</div> 
								<div class="first-box-popups">
									<div class="content-first-box-pop">
										<div class="logo">
										<svg viewBox="0 0 300 95">
											<use xlink:href="#svg_logo_white"/> 
										</svg>
										</div>
										<div class="title-content-p">
											<?php the_title(); ?>
										</div> 
									</div>
								</div>
								<div class="second-box-popups">
									<div class="form-popups"><?php echo do_shortcode('[newsletter_signup_form id=0]' ); ?></div>
									<div class="texto-popups">
										<div class="mensaje-popups">
											<h2><?php the_field('titulo_contenido'); ?></h2>
											<div class="mensaje-single"><?php the_content(); ?></div>
										</div>
										<div class="social-popups">
											<ul>
												<li><a href="https://www.facebook.com/chicfitdaily"><i class="fa fa-facebook"></i></a></li>
												<li><a href="https://twitter.com/chicfitdaily"><i class="fa fa-twitter"></i></a></li>
												<li><a href="https://instagram.com/chicfitdaily/"><i class="fa fa-instagram"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							
							</article>
							
						<?php endwhile; ?>
					</div>
					<div class="newsletter-footer">
					<div class="content-poweredby">
						<div class="powered-txt">Powered By</div>
						<div class="logo-powered">
							<a href="http://mediatrends.cl/" target="_blank"> 
								<svg viewBox="0 0 792 656.856">
									<use xlink:href="#mediatrends-logo_popups" />
								</svg>
							</a>
						</div>
					</div>
				</div>
				</div>	



				<div class="cont-feedinstaram">
					<h2><i class="fa fa-instagram"></i> INSTAGRAM <span>CHICFIT</span></h2>
					<marquee behavior="scroll" scrollamount="1" direction="left" width="100%" speed="10000">
						<div id="instafeed" style="height:200px;"></div>
					</marquee>
				</div>

				<div class="footer-content">
					<div class="container-footer">
						<div class="first-box">
							<div class="logo">
								<a href="<?php echo home_url(); ?>">
									<svg viewBox="0 0 300 95">
										<use xlink:href="#svg_logo"/> 
									</svg>
								</a>
							</div>
							<nav class="nav">
								<?php html5blank_nav(); ?>
							</nav>
						</div>

						<div class="second-box">
							<div class="newsletter">
								<h4>Newsletter</h4>
								<?php echo do_shortcode('[newsletter_signup_form id=0]');?>
							</div>
						</div>
						
						<div class="third-box">
							<div class="siguenos">
								<h4>Siguenos</h4>
								<ul>
									<li><a href="https://www.facebook.com/chicfitdaily"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://twitter.com/chicfitdaily"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://instagram.com/chicfitdaily/"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>

						<div class="four-box">
							<ul>
								<li><a href="mailto:ignacia&#64;chicfit.cl"><i class="fa fa-envelope-o"></i> CONTACTO PUBLICITARIO</a></li>
								<li><a href="mailto:chicfitdaily&#64;gmail.com"><i class="fa fa-envelope-o"></i> CONTACTO EDITORIAL</a></li>
								<li><a href="about-us"><i class="fa fa-heart-o"></i> ABOUT US</a></li>
							</ul>
						</div>
					</div>
				</div>
				
			</footer>

			<div class="hi-impact-120x600">
				
				<!--160X600_CFD-->
				<div id='div-gpt-ad-1430935394858-2'style='width:160px;float:left;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1430935394858-2'); });
					</script> 
				</div>

				<!--160x600_CFD_right-->
				<div id='div-gpt-ad-1430935394858-3' style='width:160px;float:right;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1430935394858-3'); });
					</script>
				</div>
			</div>
    
			<!-- /footer -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.marquee.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/instafeed.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/swipe.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.touchSwipe.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>

		<?php wp_footer(); ?>
		
		<!--intersitial_CFD_ALL-->
		<div id='div-gpt-ad-1431382352477-0'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1431382352477-0'); });
			</script>
		</div>

	</body>
</html>

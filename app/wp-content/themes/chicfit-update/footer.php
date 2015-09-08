
				<div class="push"></div>
			</div>
		<!-- /wrapper -->

			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="bg-newsletter"></div>
				<div class="newsletter-new-suscribe">
					<div class="content-popups animation-pop">
							<?php echo get_template_part('page','newsletter'); ?>
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

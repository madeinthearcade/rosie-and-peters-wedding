
<footer class="footer" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h6>Quick Links</h6>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'extra-menu',
					'container' => false,
					'menu_id' => 'footer-menu',
					'menu_class' => '',
					'fallback_cb' => false
				));
				?>
			</div>
			<div class="col-md-4">
				<h6>Location</h6>
				<div class="extra-text">
					Pillory Barn
					<br>
					The Maidstone Studios
					<br>
					New Cut Road
					<br>
					Maidstone, Kent
					<br>
					ME14 5NZ
				</div>
			</div>
			<div class="col-md-4">
				<h6>Accreditations</h6>
				<div class="extra-text">
					<p>Here are some generic accreditation logos.</p>
					<div class="row">
						<div class="col-md-4">
							<a href="#" target="_blank">
								<img src="<?php echo get_template_directory_uri();?>/img/template/generic-logo.png" alt="logo" class="img-responsive accreditation-logo">
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" target="_blank">
								<img src="<?php echo get_template_directory_uri();?>/img/template/generic-logo.png" alt="logo" class="img-responsive accreditation-logo">
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" target="_blank">
								<img src="<?php echo get_template_directory_uri();?>/img/template/generic-logo.png" alt="logo" class="img-responsive accreditation-logo">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<p class="copyright">
				&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?>
				<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//html5blank.com" title="HTML5 Blank">HTML5 Blank</a>.
				</p>
			</div>
			<div class="col-md-6">
				<p class="copyright" id="creator">
					Created by <a href="http://www.pillorybarn.co.uk" target="_blank">Pillory Barn</a>
				</p>
			</div>
		</div>

		<!-- /footer container -->
	</div>
</footer>
<?php wp_footer(); ?>
<!-- analytics -->
<script>
(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
ga('send', 'pageview');
</script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
</body>
</html>
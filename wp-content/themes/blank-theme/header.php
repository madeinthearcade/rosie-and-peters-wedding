<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<link href="//www.google-analytics.com" rel="dns-prefetch">
<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php bloginfo('description'); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="alobaidi-fade-plugin"></div>
	<header>
		<div class="container">
			<a href="<?php echo home_url(); ?>" id="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/template/logo.png" alt="logo" class="img-responsive">
			</a>
			<div class="cta">
				<p class="no-margin-bottom">
					If you have any questions, please contact us
				</p>
				<a href="tel:0000 000 0000" class="contact">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<span>0000 000 0000</span>
				</a>
				<a href="mailto:" class="contact">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<span>Email us</span>
				</a>
				<a href="#" class="contact" target="_blank">
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<span>Follow us</span>
				</a>
			</div>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		</div>
	</header>
	<nav role="navigation" id="main-navigation">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<div class="container">
				<?php html5blank_nav(); ?>
			</div>
		</div>
	</nav>
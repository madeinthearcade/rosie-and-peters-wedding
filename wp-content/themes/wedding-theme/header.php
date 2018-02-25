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

	<header role="header" class="main-header">
      <a href="#" id="menu-btn">
         <span id="menu-btn__span">
            Menu
         </span>
      </a>
      <nav role="navigation" class="main-header__nav">
         <?php
         wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_id' => false,
            'menu_class' => 'main-header__menu',
            'fallback_cb' => false
         ));
         ?>
      </nav>
   </header>
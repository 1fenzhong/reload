<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<?php roots_stylesheets(); ?>

	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.6.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.6.2.min.js"><\/script>')</script>

	<?php wp_head(); ?>
	<?php roots_head(); ?>

	<script defer src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
</head>

<body <?php $page_slug = $post->post_name; body_class($page_slug); ?>>

	<?php roots_wrap_before(); ?>
	<div id="wrap" class="container" role="document">
	<?php roots_header_before(); ?>
		<header id="banner" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="banner">
			<?php roots_header_inside(); ?>
			<div class="container clearfix">
			    <h1 id="logo">
				<strong><?php bloginfo('name'); ?></strong>
				<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>">
				    <img src="<?php echo get_header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			    </h1>
				
				<?php if ($roots_options['clean_menu']) { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<h2><?php bloginfo('description'); ?></h2>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php } ?>		
				<?php } else { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation')); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<h2 class="float-left"><?php bloginfo('description'); ?></h2>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation')); ?>
					</nav>
					<?php } ?>								
				<?php } ?>
			
			</div>
		</header>
	<?php roots_header_after(); ?>
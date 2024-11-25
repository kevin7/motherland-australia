<?php

$admin_logo = get_field('admin_logo', 'option');
$admin_mobile_logo = get_field('admin_mobile_logo', 'option');
$admin_tracking_header = get_field('admin_tracking_header', 'option');

$admin_link_li = get_field('admin_link_li', 'option');
$admin_link_ig = get_field('admin_link_ig', 'option');
$admin_link_fb = get_field('admin_link_fb', 'option');
$admin_link_tt = get_field('admin_link_tt', 'option');

$admin_pb_enable = get_field('admin_pb_enable', 'option');
$admin_pb_image = get_field('admin_pb_image', 'option');
$admin_pb_text = get_field('admin_pb_text', 'option');
$admin_pb_link = make_link('admin_pb_link', 'c-link', 'option');

?>
<!doctype html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="theme-color" content="#FFF9F4">
		<title><?php wp_title(' | '); ?></title>

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<?php wp_head(); ?>


		<?php echo $admin_tracking_header ?>
	
	</head>
	<body <?php body_class(implode(' ', siteClasses()) . ($admin_pb_enable ? 'has-promobar' : '') ); ?> itemscope itemtype="http://schema.org/WebPage">

	<div id="main">

        <?php if ($admin_pb_enable) :  ?>
        <div class="c-promobar">
            <div class="o-wrapper">
                <div class="c-promobar__wrapper">
                    <?php if (isset($admin_pb_image['url'])) :  ?>
                        <img src="<?=$admin_pb_image['url']?>" alt="<?=$admin_pb_image['alt']?>">
                    <?php endif; ?>
                    <?php if ($admin_pb_text) :  ?>
                        <span class="text"><?=$admin_pb_text?></span>
                    <?php endif; ?>
                    <?php if ($admin_pb_link) :  ?>
                        <?php render('link', $admin_pb_link);?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
		<div class="c-header">
			<div class="c-header__wrapper">

				<div class="c-nav-desktop c-nav-desktop--left">
						
					<?php wp_nav_menu(array(
							'container' => false, 
							'menu' => 'Main Nav - Left', 
							'theme_location' => 'main-nav'
					)); ?>

				</div> <!-- .c-nav -->

				<a href="/" class="c-header__logo">
					<img src="<?=$admin_logo ?>" alt="<?php echo bloginfo('name'); ?>">
				</a> <!-- .logo -->
				<a href="/" class="c-header__mobile-logo">
					<img src="<?=$admin_mobile_logo ?>" alt="<?php echo bloginfo('name'); ?>">
				</a> <!-- .logo -->

				<div class="c-nav-desktop c-nav-desktop--right">
						
					<?php wp_nav_menu(array(
							'container' => false, 
							'menu' => 'Main Nav - Right', 
							'theme_location' => 'main-nav'
					)); ?>
	
				</div> <!-- .c-nav -->


				<div class="c-menu-toggle js-menu-toggle">
					<span></span><span></span><span></span>
				</div>

			</div>
		</div> <!-- .c-header -->


		<div class="c-nav-mobile">

			<div class="c-nav-mobile__header">
				<a href="/" class="c-nav-mobile__header-logo">
					<img src="<?=$admin_logo ?>" alt="<?php echo bloginfo('name'); ?>">
				</a> <!-- .logo -->

				<button class="c-nav-mobile__header-close active js-menu-toggle">
					<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L18 18" stroke="#0F3E3A" stroke-width="2"/>
					<path d="M18 1L1 18" stroke="#0F3E3A" stroke-width="2"/>
					</svg>
				</button>
			</div>


			<div class="c-nav-mobile__menu">
				<?php wp_nav_menu(array(
						'container' => false, 
						'menu' => 'Mobile Nav', 
						'theme_location' => 'main-nav'
				)); ?>
			</div>

			<div class="c-social">
				<?php if ($admin_link_ig) : ?>
				<a href="<?php echo $admin_link_ig; ?>"><i class="icon-instagram"></i></a>
				<?php endif; ?>		
				<?php if ($admin_link_fb) : ?>
				<a href="<?php echo $admin_link_fb ?>"><i class="icon-facebook-f"></i></a>
				<?php endif; ?>	
				<?php if ($admin_link_li) : ?>
				<a href="<?php echo $admin_link_li; ?>"><i class="icon-linkedin"></i></a>
				<?php endif; ?>	
				<?php if ($admin_link_tt) : ?>
				<a href="<?php echo $admin_link_tt; ?>"><i class="icon-twitter"></i></a>
				<?php endif; ?>		
			</div> <!-- .c-social -->


		</div> <!-- .c-mobile-nav -->
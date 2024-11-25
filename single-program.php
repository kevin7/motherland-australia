<?php
$admin_logo = get_field('admin_login_logo', 'option');
$admin_logo_mobile = get_field('admin_mobile_logo', 'option');
$admin_tracking_header = get_field('admin_tracking_header', 'option');

//if (!is_user_logged_in()) wp_redirect('/login/?referrer=' . get_the_permalink(), 302)

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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
		<?php wp_head(); ?>

		<?php echo $admin_tracking_header ?>
	
	</head>
	<body <?php body_class(implode(' ', siteClasses()) . ' program'); ?> itemscope itemtype="http://schema.org/WebPage">
        
        <?php
            $title = get_the_title();
            $caption = get_field('caption');
        ?>
        <div class="container">

            <div class="c-program">

                <div class="c-program__mobile">
                    <a href="/">
                        <img src="<?=$admin_logo_mobile ?>" alt="<?php echo bloginfo('name'); ?>">
                    </a>

                    <button class="js-program-menu"></button>
                </div>


                <div class="c-program__side">

                    <button class="js-program-close"></button>

                    <div class="c-program__sidewrap">

                        <a href="/" class="logo">
                            <img src="<?=$admin_logo['url'] ?>" alt="<?php echo bloginfo('name'); ?>">
                        </a> <!-- .logo -->

                        <div class="c-program__nav">

                            <ul id="js-menu-access" data-pid="<?=get_the_ID()?>">
                                <li style="position:relative">
                                    <div class="c-preloader__loader">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="c-program__content">
                                    
                    <div class="c-program__header">
                        <figcaption><?=$caption?></figcaption>
                        <h1><?=$title;?></h1>
                    </div>

                    <?php
                        if( have_rows('layout') ):
                            $path = get_template_directory() . '/template-parts/program/';
                            while ( have_rows('layout') ) : the_row();

                                switch(get_row_layout()) {
                                    case 'image-content':
                                        include $path . 'image-content.php';
                                        break;
                                    case 'resources' :
                                        include $path . 'resources.php';
                                        break;
                                    case 'video-cover' :
                                        include $path . 'video-cover.php';
                                        break;
                                    case 'banner' :
                                        include $path . 'banner.php';
                                        break;
                                    case 'cta' :
                                        include $path . 'cta.php';
                                        break;
                                    case 'line' :
                                        include $path . 'line.php';
                                        break;
                                }
                            endwhile;
                        endif;
                    ?>

                </div>
            </div>
        </div>
		
	    <?php wp_footer(); ?>
    </body>
</html> 
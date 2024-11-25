<?php
$admin_logo = get_field('admin_logo', 'option');
$admin_logo_mobile = get_field('admin_mobile_logo', 'option');
$admin_tracking_header = get_field('admin_tracking_header', 'option');

if (!is_user_logged_in()) wp_redirect('/login/?referrer=' . get_the_permalink(), 302)

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
            $week = get_field('week');
            $hero_video = get_field('hero_video');
            $hero_video_image = get_field('hero_video_image');
            $content_enable = get_field('content_enable');
            $content_video = get_field('content_video');
            $content_video_image = get_field('content_video_image');
            $content_title = get_field('coontent_title');
            $content = get_field('content');
            $content_link = get_field('content_link');
            $notice_show = get_field('notice_show');
            $notice = get_field('notice');
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
                            <img src="<?=$admin_logo ?>" alt="<?php echo bloginfo('name'); ?>">
                        </a> <!-- .logo -->

                        <div class="c-program__nav">
                            <ul>
                                <?php if ( have_rows('navigation') ) : ?>
                                
                                    <?php while( have_rows('navigation') ) : 
                                            the_row(); 
                                            $week = get_sub_field('week');
                                            $program = get_sub_field('program');    
                                            $url = get_the_permalink($program->ID);
                                            $title = $program->post_title;
                                            $locked = get_sub_field('locked');
                                        ?>
                                
                                        <?php the_sub_field('sub_field_name'); ?>
                                        <li>
                                            <a href="<?=$locked ? '#' : $url?>" class="<?=$locked ? 'locked' : ''?>">
                                                <figcaption>Week <?=$week?></figcaption>
                                                <?php if (!$locked) :  ?>
                                                    <span><?=$title?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                
                                    <?php endwhile; ?>
                                
                                <?php endif; ?>
                                
                                <li class="logout">
                                    <a href="<?php echo wp_logout_url( '/login/'); ?>">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="c-program__content">
                
                    
                    <div class="c-program__header">
                        <figcaption>Week <?=$week?></figcaption>
                        <h1><?=$title;?></h1>
                    </div>

                    <?php if ($hero_video) :  ?>
                    <div class="c-program__video">
                        <a href="<?=$hero_video?>" class="play-button link-video">
                            <div class="c-lazy-wrapper" style="padding-bottom:56%;">
                                <img data-src="<?=$hero_video_image['url']?>" alt="" class="lazy">
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="c-program__content-wrap">

                        <?php if ($content_enable) :  ?>
                        <div class="c-program__feature">

                            <h2><?=$content_title?></h2>

                            <div class="image">
                                <a href="<?=$content_video?>" class="play-button link-video">
                                    <div class="c-lazy-wrapper" style="padding-bottom:60%;">
                                        <img data-src="<?=$content_video_image['url']?>" alt="" class="lazy">
                                    </div>
                                </a>
                            </div>
                            <div class="content">
                                <h2><?=$content_title?></h2>
                                <?php if ($content) :  ?>
                                    <?=$content?>
                                <?php endif; ?>

                                <?php if ($content_link) :  ?>
                                    <a class="link" href="<?=$content_link['url']?>" target="<?=$content_link['target']?>">
                                        <span>
                                            <i class="svg-globe"></i>
                                            <?=$content_link['title']?>
                                        </span>
                                        <i class="svg-external"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endif; ?>


                        <div class="c-prog-items">
                            <h2>Worksheets</h2>

                            <?php if ( have_rows('worksheets') ) : ?>
                                <div class="c-prog-items__grid">
                                <?php while( have_rows('worksheets') ) : 
                                        the_row(); 
                                        $type = get_sub_field('type');
                                        $icon = get_sub_field('icon');
                                        $link = get_sub_field('link');
                                        $file = get_sub_field('file');
                                        $url = '';
                                        $title = '';
                                        
                                        
                                        if ($type == 'link') {
                                            $url = $link['url'];
                                            $title = $link['title'];
                                        } elseif ($type == 'file') {
                                            $url = $file['url'];
                                            $title = $file['caption'];
                                        }
                                        
                                    ?>
                                    <?php if ($url && $title) :  ?>
                                    <a href="<?=$url?>" class="c-prog-item">
                                        <span>
                                            <i class="svg-<?=$icon?>"></i>
                                            <?=$title?>
                                        </span>
                                        <i class="svg-external"></i>
                                    </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="c-prog-items">
                            <h2>Resources</h2>

                            <?php if ( have_rows('resources') ) : ?>
                                <div class="c-prog-items__grid two">
                                <?php while( have_rows('resources') ) : 
                                        the_row(); 
                                        $type = get_sub_field('type');
                                        $icon = get_sub_field('icon');
                                        $link = get_sub_field('link');
                                        $file = get_sub_field('file');
                                        $url = '';
                                        $title = '';
                                        
                                        
                                        if ($type == 'link') {
                                            $url = $link['url'];
                                            $title = $link['title'];
                                        } elseif ($type == 'file') {
                                            $url = $file['url'];
                                            $title = $file['caption'];
                                        }
                                        
                                    ?>
                                    <?php if ($url && $title) :  ?>
                                    <a href="<?=$url?>" class="c-prog-item" target="_blank">
                                        <span>
                                            <i class="svg-<?=$icon?>"></i>
                                            <?=$title?>
                                        </span>
                                        <i class="svg-external"></i>
                                    </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <?php if ($notice_show) :  ?>
                            <div class="c-notice">
                                <div>
                                    <?=$notice?>
                                </div>
                                <i class="svg-external-pink"></i>
                            </div>
                        <?php endif; ?>

                    </div>


                </div>
            </div>
        </div>
		
	    <?php wp_footer(); ?>
    </body>
</html> 
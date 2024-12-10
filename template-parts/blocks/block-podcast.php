<?php
/**
 * Block Name: 
 *
 */

$subtitle = get_field('subtitle');
$title = get_field('title');
$show_podcast_links = get_field('show_podcast_links');
$show_contact_links = get_field('show_contact_links');
$show_pink_line = get_field('show_pink_line');
$content = get_field('content');

$widget = get_field('admin_link_spotify_widget', 'option');
$admin_link_spotify = get_field('admin_link_spotify', 'option');
$admin_link_itunes = get_field('admin_link_itunes', 'option');
$admin_link_google = get_field('admin_link_google', 'option');
$admin_link_stitcher = get_field('admin_link_stitcher', 'option');


?>
<div class="b-podcast <?php echo $show_pink_line ? 'b-podcast--line' : ''; ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="podcast" data-aos="fade-up">

    <div class="o-wrapper">
        <div class="b-podcast__wrapper">        
            <div class="b-podcast__content">

                <div class="b-podcast__header">
                    <div class="b-podcast__header-subtitle"><?php echo $subtitle; ?></div>
                    <h3><?php echo $title; ?></h3>
                </div>

                <div class="b-podcast__widget">
                    <?php echo $widget; ?>
                </div>

                <?php if ($show_podcast_links) : ?>
                <div class="b-podcast__links">
                    <?php if ($admin_link_itunes) : ?>
                        <a href="<?php echo $admin_link_itunes ?>" target="_blank">Listen on Apple <i class="icon-apple"></i></a>
                    <?php endif; ?>
                    <?php if ($admin_link_spotify) : ?>
                        <a href="<?php echo $admin_link_spotify  ?>" target="_blank">Listen on Spotify <i class="icon-spotify"></i></a>
                    <?php endif; ?>
                    <?php if ($admin_link_google) : ?>
                        <a href="<?php echo $admin_link_google ?>" target="_blank">Listen on Google <i class="icon-google"></i></a>
                    <?php endif; ?>
                    <?php if ($admin_link_stitcher) : ?>
                        <a href="<?php echo $admin_link_stitcher ?>" target="_blank">Listen on Stitcher <i class="icon-headphones"></i></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($show_contact_links) : ?>
                <div class="b-podcast__shortcuts">
                    <?php if ( have_rows('links') ) : ?>
                        <?php while( have_rows('links') ) : 
                                the_row(); 
                                $subtitle = get_sub_field('subtitle');
                                $title = get_sub_field('title');
                                $link = get_sub_field('link');
                        ?>
                    
                            <div class="b-podcast__shortcuts-item">
                                <a href="<?php echo $link; ?>">
                                    <span><?php echo $subtitle; ?></span>
                                    <b><?php echo $title; ?></b>
                                </a>
                            </div>
                    
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>      
    </div>

    <?php if ($show_pink_line) : ?>
    <div class="b-podcast__line">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/body-line.svg" >
    </div>                        
    <?php endif; ?>

</div>


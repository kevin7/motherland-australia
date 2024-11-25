<?php
/**
 * Block Name: Image header
 *
 */

$title = get_field('title');
$content = get_field('content');
$link = make_link('link', 'c-link');
$image = get_field('image');
$video_loop = get_field('video_loop');
$youtube_link = get_field('youtube_link');

?>
<div class="b-home-header b-home-header u-hero-pt <?php echo !$image ? 'b-home-header--text' : '' ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

    <div class="b-home-header__bg js-rellax" data-rellax-speed="5"></div>
    <div class="b-home-header__line">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/hero-line.svg" >
    </div>

    <div class="o-wrapper">
        <div class="b-home-header__wrapper">
            <div class="b-home-header__content">
                <h1><?php echo str_replace('[steph]', '<i class="steph"></i>', $title); ?></h1>
                <p>
                    <?php echo $content; ?>
                </p>
                <?php if ($link) : ?>
                    <?php render('link', $link);  ?>
                <?php endif; ?>
            </div>

            <?php if ($image) : ?>
            <div class="b-home-header__image">
                <div class="js-rellax" data-rellax-speed="2" data-rellax-xs-speed="1" data-rellax-mobile-speed="1">
                    <div class="c-lazy-wrapper" style="padding-bottom:<?=($image['height'] / $image['width']) * 100?>%">
                        <img class="c-image lazy" data-src="<?php echo $image['url'] ?>" alt="<?php echo strip_tags($title); ?>">
                        <?php if ($video_loop) : ?>
                        <div class="c-frame">
                            <video src="<?=$video_loop['url']?>" muted autoplay playsinline loop></video>
                            <a href="<?=$youtube_link?>" class="link-video">
                                <span></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>


<?php
$type = get_sub_field('type');
$video = get_sub_field('video');

$video_file = get_sub_field('file');
$video_url = get_sub_field('video_url');
$video_loop = get_sub_field('video_loop');
$video_autoplay = get_sub_field('video_autoplay');

// If it's youtube, make sure the URL is the long version
if (strpos($video_url, 'youtu') !== false) {
    $ytID = getYoutubeID($video_url);
    $video_url = 'https://www.youtube.com/watch?v=' . $ytID;
}
?>
<div class="c-blog-video-block">
    <div class="o-wrapper" data-aos="fade-up">
        <div class="c-blog-video-block__wrapper">
        <?php if ($type == 'embed') : ?>
            <div class="c-video-responsive">
                <?= $video ?>
            </div>
        <?php else: ?>
            <div class="c-video">
                <div class="c-video-responsive">
                    <video src="<?=$video_file?>" muted playsinline <?=$video_loop ? 'loop' : ''?> <?=$video_autoplay ? 'autoplay' : ''?> poster="<?=$image['url'] ? $image['sizes']['hero'] : ''?>"></video>
                </div>
                <div class="c-video-controls">
                    <?php if ($video_url) : ?>
                    <a href="<?=$video_url?>" class="full js-video-full"><span>Full video</span></a>
                    <?php endif; ?>
                    <button class="pause js-video-pause <?=!$video_autoplay ? 'active' : ''?>"><span><?=$video_autoplay ? 'Pause' : 'Play' ?></span></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
    </div>
</div>

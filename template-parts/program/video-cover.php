<?php
$video = get_sub_field('video');
$image = get_sub_field('image');
?>
<div class="c-program__block pad-small">
    <?php if ($video || isset($video_image['url'])) :  ?>
        <div class="p-video">
            <?php if ($video) :  ?>
            <a href="<?=$video?>" class="play-button link-video">
            <?php endif;?>
                <div class="c-lazy-wrapper" style="padding-bottom:56%;">
                    <img data-src="<?=$image['url']?>" alt="" class="lazy">
                </div>
            <?php if ($video) :  ?>
            </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
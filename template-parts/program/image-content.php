<?php
 $video = get_sub_field('video');
 $image = get_sub_field('image');
 $title = get_sub_field('title');
 $content = get_sub_field('content');
 $link = get_sub_field('link');
?>
<div class="c-program__block pad-large">

    <div class="p-feature">

        <h2><?=$title?></h2>

        <div class="image">
            <?php if ($video) :  ?>
            <a href="<?=$video?>" class="play-button link-video">
            <?php endif; ?>
                <div class="c-lazy-wrapper" style="padding-bottom:60%;">
                    <?php if (isset($image['url'])) :  ?>
                    <img data-src="<?=$image['sizes']['large']?>" alt="" class="lazy">
                    <?php endif; ?>
                </div>
            <?php if ($video) :  ?>
            </a>
            <?php endif ;?>
        </div>
        <div class="content">
            <?php if ($title) :  ?>
                <h2><?=$title?></h2>
            <?php endif; ?>
            <?php if ($content) :  ?>
                <?=$content?>
            <?php endif; ?>

            <?php if ($link) :  ?>
                <a class="link" href="<?=$link['url']?>" target="<?=$link['target']?>">
                    <span>
                        <i class="svg-globe"></i>
                        <?=$link['title']?>
                    </span>
                    <i class="svg-external"></i>
                </a>
            <?php endif; ?>

        </div>
    </div>
    
</div>
<?php
$title = str_replace(['[', ']'], ['<b>', '</b>'], get_sub_field('title'));
$subtitle = get_sub_field('subtitle');
$content = get_sub_field('content');
$image = get_sub_field('image');
$remove_ipb = get_sub_field('remove_ipb');
$small_gap = get_sub_field('small_gap');
$aspect_ratio = 100;
if (isset($image['width']) && isset($image['height'])) {
    $aspect_ratio = ($image['height'] / $image['width']) * 100;
}
?>
<div class="c-program__block pad-large <?=$small_gap ? 'small-gap' : ''?>">

    <div class="p-imgcont <?=$remove_ipb ? 'img-bottom' : ''?>">

        <div class="image">
            <div class="c-lazy-wrapper" style="padding-bottom:<?=$aspect_ratio?>%;">
                <?php if (isset($image['url'])) :  ?>
                <img data-src="<?=$image['sizes']['large']?>" alt="" class="lazy">
                <?php endif; ?>
            </div>
        </div>
        <div class="content">
            <div>
                <?php if ($title) :  ?>
                    <h3 class="title"><?=$title?></h3>
                <?php endif; ?>
                <?php if ($subtitle) :  ?>
                    <h3 class="subtitle"><?=$subtitle?></h3>
                <?php endif; ?>
            </div>

            <div>
                <?php if ($content) :  ?>
                    <div class="content-text">
                        <?=$content?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
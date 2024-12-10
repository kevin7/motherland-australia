<?php

$image = get_sub_field('image');

if(isset( $image['height'] ) || isset( $image['width'])) {
        
    $aspect_ratio = ($image['height'] / $image['width']) * 100;
    
}

?>

<div class="c-layout-image-block">
    <div class="o-wrapper" data-aos="fade-up">

        <div class="c-layout-image-block__wrapper <?=$type?>">
            <?php if($image['url']) : ?>
                <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
                    <img
                        class="c-image c-layout-image-block__image lazy <?= (isset($image['classes']) ? $image['classes'] : false )?>"
                        data-src="<?= $image['url']; ?>"
                        alt="<?= $image['alt'] ?>"
                    >
                </div>
                <?php if($image['caption']): ?>
                    <span class="c-caption"><?= $image['caption']; ?></span>
                <?php endif;?>
            <?php endif; ?>
        </div>

    </div>
</div>

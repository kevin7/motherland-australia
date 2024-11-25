<?php

$image_left = get_sub_field('image_left');
$image_right = get_sub_field('image_right');

?>

<div class="c-layout-images-block">
    <div class="o-wrapper">

        <div class="c-layout-images-block__wrapper">

            <div class="c-layout-images-block__left" data-aos="fade-up">
                <?php if($image_left['url']) : ?>
                    <div class="c-lazy-wrapper" style="padding-bottom: 140%">
                        <img
                            class="c-image c-layout-images-block__image lazy <?= (isset($image_left['classes']) ? $image_left['classes'] : false )?>"
                            data-src="<?= $image_left['sizes']['images-pt'] ?>"
                            alt="<?= $image_left['alt'] ?>"
                        >
                    </div>
                    <?php if($image_left['caption']): ?>
                        <span class="c-caption"><?= $image_left['caption']; ?></span>
                    <?php endif;?>
                <?php endif; ?>
            </div>

            <div class="c-layout-images-block__right" data-aos="fade-up" data-aos-delay="300">
                <?php if($image_right['url']) :  ?>
                    <div class="c-lazy-wrapper" style="padding-bottom: 140%">
                        <img
                            class="c-image c-layout-images-block__image lazy <?= (isset($image_right['classes']) ? $image_right['classes'] : false )?>"
                            data-src="<?= $image_right['sizes']['images-pt'] ?>"
                            alt="<?= $image_right['alt'] ?>"
                        >
                    </div>
                    <?php if($image_right['caption']): ?>
                        <span class="c-caption"><?= $image_right['caption']; ?></span>
                    <?php endif;?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

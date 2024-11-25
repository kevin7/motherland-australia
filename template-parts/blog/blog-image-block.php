<?php

$image = get_sub_field('image');

?>

<div class="c-blog-image-block">
    <div class="o-wrapper">
        <div class="o-layout o-layout--center">
            <div class="o-layout__item u-1/2@desktop">
                <div class="c-blog-image-block__wrapper">
                    <?php if($image['url']) : ?>
                        <?php
                        if(isset( $image['sizes']['post-height'] ) || isset( $image['sizes']['post-width'])) {
                            $aspect_ratio = ( $image['sizes']['post-height'] / $image['sizes']['post-width']) * 100;
                        } else {
                            $aspect_ratio = 100;
                        };
                        ?>
                        <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
                            <img
                                class="c-image c-blog-image-block__image lazy <?= (isset($image['classes']) ? $image['classes'] : false )?>"
                                data-src="<?= $image['sizes']['post'] ?>"
                                alt="<?= $image['alt'] ?>"
                                title="<?= $image['title'] ?>"
                                width="<?= $image['sizes']['post-width']?>"
                                height="<?= $image['sizes']['post-height'] ?>"

                            >
                        </div>
                        <?php if($image['caption']): ?>
                            <span class="c-blog-image-block__caption"><span>Above:</span> <?= $image['caption']; ?></span>
                        <?php endif;?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

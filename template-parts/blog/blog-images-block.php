<?php

$image_left = get_sub_field('image_left');
$image_right = get_sub_field('image_right');

?>

<div class="c-blog-images-block" data-sidebar-scroll-image>
   <div class="o-wrapper">
       <div class="o-layout o-layout--huge  o-layout--middle">
           <div class="o-layout__item u-1/2@desktop">
               <div class="c-blog-images-block-image__wrapper">
                    <?php if($image_left['url']) : ?>
                        <?php
                        if(isset( $image_left['sizes']['portrait-height']) || isset( $image_left['sizes']['portrait-width'])) {
                            $aspect_ratio = ( $image_left['sizes']['portrait-height'] / $image_left['sizes']['portrait-width']) * 100;
                        } else {
                            $aspect_ratio = 100;
                        };
                        ?>
                        <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
                            <img
                                class="c-image c-blog-images-block__image lazy <?= (isset($image_left['classes']) ? $image_left['classes'] : false )?>"
                                data-src="<?= $image_left['sizes']['post'] ?>"
                                alt="<?= $image_left['alt'] ?>"
                                title="<?= $image_left['title'] ?>"
                                width="<?= $image_left['sizes']['portrait-width']?>"
                                height="<?= $image_left['sizes']['portrait-height'] ?>"

                            >
                        </div>
                        <?php if($image_left['caption']): ?>
                            <span class="c-blog-image-block__caption"><span>Above:</span> <?= $image_left['caption']; ?></span>
                        <?php endif;?>
                    <?php endif; ?>
                </div>
           </div>
           <div class="o-layout__item u-1/2@desktop">
               <div class="c-blog-images-block-image__wrapper">
                   <?php if($image_right['url']) : ?>
                       <?php
                       if(isset( $image_right['sizes']['portrait-height']) || isset( $image_right['sizes']['portrait-width'])) {
                           $aspect_ratio = ( $image_right['sizes']['portrait-height'] / $image_right['sizes']['portrait-width']) * 100;
                       } else {
                           $aspect_ratio = 100;
                       };
                       ?>
                       <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
                           <img
                               class="c-image c-blog-images-block__image lazy <?= (isset($image_right['classes']) ? $image_right['classes'] : false )?>"
                               data-src="<?= $image_right['sizes']['post'] ?>"
                               alt="<?= $image_right['alt'] ?>"
                               title="<?= $image_right['title'] ?>"
                               width="<?= $image_right['sizes']['portrait-width']?>"
                               height="<?= $image_right['sizes']['portrait-height'] ?>"

                           >
                       </div>
                       <?php if($image_right['caption']): ?>
                           <span class="c-blog-image-block__caption"><span>Above:</span> <?= $image_right['caption']; ?></span>
                       <?php endif;?>
                   <?php endif; ?>
               </div>
           </div>
       </div>
    </div>
</div>

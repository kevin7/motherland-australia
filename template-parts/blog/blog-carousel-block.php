<?php
$images = get_sub_field('images');
?>

<?php if($images): ?>
    <div class="c-blog-carousel-block">
        <div class="o-wrapper">
            <div class="o-layout o-layout--center">
                <div class="o-layout__item u-1/2@desktop">
                    <div class="c-blog-carousel-block-carousel" data-carousel='{"wrapAround": false, "cellAlign": "left", "contain" : true, "dragThreshold": 5, "draggable": true, "prevNextButtons": true, "pageDots": false}'>
                        <?php foreach ($images as $image) : ?>
                            <div class="c-blog-carousel-block-carousel__item" data-carousel-slide>
                                <?php if($image['url']) : ?>
                                    <?php
                                    if(isset( $image['sizes']['post-height']) || isset( $image['sizes']['post-width'])) {
                                        $aspect_ratio = ( $image['sizes']['post-height'] / $image['sizes']['post-width']) * 100;
                                    } else {
                                        $aspect_ratio = 100;
                                    };
                                    ?>
                                    <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
                                        <img
                                            class="c-image c-blog-carousel-block__image lazy <?= (isset($image['classes']) ? $image['classes'] : false )?>"
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
                        <?php endforeach; ?>
                        <span class="c-blog-carousel-block-carousel__count" data-carousel-count></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

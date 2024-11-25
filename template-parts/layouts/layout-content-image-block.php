<?php
$title = get_sub_field('title');
$content = get_sub_field('content');
$image = get_sub_field('image');
$position = get_sub_field('position');
$link = make_sub_link('link', 'c-link c-link--move');
?>

<div class="c-cont-image c-cont-image--<?php echo $position ?>" data-aos="fade-up">
    <div class="o-wrapper">
        <div class="c-cont-image__wrapper">
            <div class="c-cont-image__image">
                <?php if($image['url']) : ?>
                <?php
                    if(isset( $image['sizes']['large-height'] ) || isset( $image['sizes']['large-width'])) {
                        $aspect_ratio = ( $image['sizes']['large-height'] / $image['sizes']['large-width']) * 100;
                    } else {
                        $aspect_ratio = 100;
                    };
                ?>
                <div class="c-lazy-wrapper" style="padding-bottom: <?=$aspect_ratio?>%">
                <img
                    class="c-image lazy <?= (isset($image['classes']) ? $image['classes'] : false )?>"
                    data-src="<?= $image['sizes']['large'] ?>"
                    alt="<?= $image['alt'] ?>"
                >
                </div>
                <?php if($image['caption']): ?>
                    <span class="c-caption"><?= $image['caption']; ?></span>
                <?php endif;?>
                <?php endif; ?>

            </div>
            <div class="c-cont-image__content">


                <?php if ($title) : ?>
                <h3><?php echo $title; ?></h3>
                <?php endif; ?>

                <div class="c-cont-image__content-wrapper">
                    <div class="c-editor-cont"><?php echo $content; ?></div>
                    
                    <?php if ($link) : ?>
                        <div class="c-cont-image__buttons">
                        <?php render('link', $link);  ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>

</div>


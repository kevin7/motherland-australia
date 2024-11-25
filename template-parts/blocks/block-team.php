<?php
$title = get_field('title');
$content = get_field('content');
?>

<div class="b-team <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">
    <div class="o-wrapper">
        <div class="b-team__header">
            <?php if ($title) : ?>
            <h2><?php echo str_replace('[steph]', '<i class="steph"></i>', $title); ?></h2>
            <?php endif; ?>
            <div class="u-mb-5"><?php echo $content; ?></div>
        </div>
        <div class="b-team__members">
            <?php if ( have_rows('team') ) : ?>
            
                <?php while( have_rows('team') ) : the_row(); 
                    $name = get_sub_field('name');
                    $position = get_sub_field('position');
                    $thumbnail = get_sub_field('thumbnail');
                    $cover = get_sub_field('cover');
                    $content = get_sub_field('content');
                    ?>
                    
                    <div class="c-member">
                        <?php if($thumbnail['url']) : ?>
                        <div class="c-lazy-wrapper">
                        <img
                            class="c-image lazy <?= (isset($thumbnail['classes']) ? $thumbnail['classes'] : false )?>"
                            data-src="<?= $thumbnail['url'] ?>"
                            alt="<?= $thumbnail['alt'] ?>"

                        >
                            <div class="c-member__content">
                                <div class="c-member__content-name">
                                    <?=$name?>
                                </div>
                                <div class="c-member__content-pos">
                                    <?=$position?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>   
                        <div class="c-member-popup__markup">
                            <div class="c-member-popup__image">
                                <?php if($cover['url']) : ?>
                                <div class="c-lazy-wrapper">
                                <img
                                    class="c-image  desktop <?= (isset($cover['classes']) ? $cover['classes'] : false )?>"
                                    src="<?= $cover['url'] ?>"
                                    alt="<?= $cover['alt'] ?>"
                                >
                                <img
                                    class="c-image mobile <?= (isset($thumbnail['classes']) ? $thumbnail['classes'] : false )?>"
                                    src="<?= $thumbnail['url'] ?>"
                                    alt="<?= $thumbnail['alt'] ?>"
                                >
                                </div>
                                <?php endif; ?>  
                            </div>
                            <div class="c-member-popup__content">
                                <div class="c-member-popup__content-title">
                                    <?=$name?>
                                </div>
                                <div class="c-member-popup__content-pos">
                                    <?=$position?>
                                </div>
                                <div class="c-member-popup__content-main">
                                    <?=$content?>
                                </div>
                            </div>
                        </div>             
                    </div>
            
                <?php endwhile; ?>
            
            <?php endif; ?>
            
        </div>
    </div>
</div>



<div class="c-member-popup">
    <div class="c-member-popup__overlay"></div>
    <div class="c-member-popup__container">
        <div class="c-member-popup__close"></div>
        <div class="c-member-popup__dump">
        
        </div>
    </div>
</div>
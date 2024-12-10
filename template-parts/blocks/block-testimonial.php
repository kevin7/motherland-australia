<?php
/**
 * Block Name: Testimonial
 *
 */

$title = get_field('title');
$button = make_link('button', 'c-button c-button--primary');
$show_pink_line = get_field('show_pink_line');
$hide_stars = get_field('hide_stars');
?>
<div class="b-tests  <?php echo $hide_stars ? 'b-tests--hide' : ''; ?> <?php echo $show_pink_line ? 'b-tests--line' : ''; ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">

    <?php if ($show_pink_line) : ?>
    <div class="b-tests__line">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/body-line.svg" >
    </div>                        
    <?php endif; ?>

    <div class="o-wrapper">
        <div class="b-tests__wrapper">        
            <div class="b-tests__header">
                <h3 class="u-h2"><?php echo $title; ?></h3>
            </div>
            <div class="b-tests__carousel" data-carousel='{"pageDots": false, "cellAlign": "left", "contain": false, "wrapAround": false, "prevNextButtons": true, "dragThreshold": 10, "draggable": true, "variableWidth": true}'>
                <?php if ( have_rows('tests') ) : ?>
                
                    <?php while( have_rows('tests') ) : the_row(); ?>
                
                        <div class="b-tests__item" data-carousel-slide>
                            <div class="b-tests__item-wrapper">
                                <div class="b-tests__item-title">
                                    "<?php the_sub_field('title'); ?>"
                                </div>
                                <div class="b-tests__item-rates"></div>
                                <div class="b-tests__item-content">
                                    <?php the_sub_field('content'); ?>
                                </div>
                                <div class="b-tests__item-name">
                                    <?php the_sub_field('name'); ?>
                                </div>
                            </div>
                        </div>
                
                    <?php endwhile; ?>
                
                <?php endif; ?>
                
            </div>

            <?php if ($button) : ?>
            <div class="b-tests__button">
                <?php render('link', $button); ?>
            </div>
            <?php endif; ?>

        </div>      
    </div>

</div>


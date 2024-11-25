<?php
/**
 * Block Name: Link Carousel
 *
 */
?>
<div class="b-link-carousel <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">

    <div class="o-wrapper"> 
        <div class="b-link-carousel__overflow">

            <div class="b-link-carousel__slider">

                <div class="b-link-carousel__images" data-carousel='{"pageDots": false, "cellAlign": "left", "contain": false, "wrapAround": false, "prevNextButtons": true, "dragThreshold": 10, "draggable": true, "variableWidth": true}'>

                    <?php if ( have_rows('items') ) : ?>
                    
                        <?php while( have_rows('items') ) : 
                                the_row(); 
                                $image = get_sub_field('image');
                                $link = make_sub_link('link', 'c-link');
                        ?>
                    
                            <div class="b-link-carousel__images-item" data-carousel-slide>
                                <div class="b-link-carousel__images-wrapper">
                                    <div class="b-link-carousel__images-bg lazy" data-bg="<?php echo $image; ?>"></div>
                                    <div class="b-link-carousel__images-content">
                                        <h6><?php the_sub_field('title'); ?></h6>
                                        <p><?php the_sub_field('desc'); ?></p>
                                        <?php render('link', $link); ?>
                                    </div>
                                </div>
                            </div>
                    
                        <?php endwhile; ?>
                    
                    <?php endif; ?>
                    

                </div>

            </div>
        </div>
    </div>

</div>


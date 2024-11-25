
<?php
    // Related post
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'post__not_in' => array($current_id)
    );

    $related_query = new WP_Query( $args );
?>

<div class="c-blog-single__related">
    <?php if( $related_query->have_posts() ) : ?>
        <h6>Related articles</h6>
        <div class="c-blog-related__items c-blog-related--small c-blog-related__carousel" data-carousel-toggle="990" data-carousel-toggle-options='{"pageDots": false, "cellAlign": "left", "contain": true, "prevNextButtons": false, "dragThreshold": 10, "draggable": true, "variableWidth": true}'>
            <?php 
                while ($related_query->have_posts()) : 
                    $related_query->the_post(); 
                    $image = get_field('post_image');
            ?>	
                <div class="c-blog-related__item">
                    <div class="c-blog-related__item-wrapper">
                        <div class="c-blog-related__item-image lazy" data-bg="<?php echo $image['sizes']['thumbnail'] ?>"></div>
                        <div class="c-blog-related__item-content">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <p><?php the_field('post_reading'); ?> min read &bull; <?php echo get_the_date(); ?></p>
                        </div>
                    </div>
                </div>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>      

    <?php endif; ?>
</div>
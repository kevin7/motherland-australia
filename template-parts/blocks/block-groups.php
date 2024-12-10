<?php
/**
 * Block Name: Waitlist
 *
 */

 $content = get_field('content');
 $price = get_field('price');
 $caption = get_field('caption');
 $form_id = get_field('gf_form_waitlist', 'option');

?>
<div class="b-waitlist b-group-listing <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="waitlist" data-aos="fade-up">

    <div class="o-wrapper">
        <div class="b-waitlist__wrapper">   

            <div class="b-waitlist__header">
                <div class="b-waitlist__header-content">
                    <?php echo $content; ?>
                </div>
                <div class="b-waitlist__price">
                    <div class="b-waitlist__price-value">
                        <span>$</span>
                        <b><?php echo $price; ?></b>
                    </div>
                    <div class="b-waitlist__price-caption">
                        <?php echo $caption; ?>
                    </div>
                </div>
            </div>

            <?php if ( have_rows('groups') ) : ?>
            
                <?php while( have_rows('groups') ) : the_row(); 
                        $title = get_sub_field('title');
                        $desc = get_sub_field('desc');
                        $groupIDs = get_sub_field('groups');

                        $args = array(
                            'post_type' => 'group',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'post__in' => $groupIDs,
                            'orderby' => 'menu_order',
                            'order' => 'asc'
                        );
                        
                        $groups = new WP_QUERY($args);
                        $total = $groups->found_posts;
                        
                    ?>
            
                    <div class="b-group-listing__row">
                        <?php if ($title) :  ?>
                            <h4><?=$title?></h4>
                        <?php endif; ?>
                        <?php if ($desc) :  ?>
                            <p><?=$desc?></p>
                        <?php endif; ?>


                        <?php if ($groups->have_posts()) : ?>    
                            <div class="b-groups horizontal">
                                <?php $x=0; while ($groups->have_posts()) : 
                                    $groups->the_post(); 
                                    $id = get_the_ID();
                                    $title = get_the_title();
                                    $desc = get_field('group_desc', $id); 
                                    $status = get_field('group_status', $id);
                                    $startdate = get_field('group_start_date', $id);
                                    $waitlist_segment_id = get_field('waitlist_segment_id', $id);
                                    $en_status = getEnrolmentStatus($id);
                                ?>
                                <div class="b-groups__item <?php echo $x==0 ? 'first' : '' ?> item-<?=$x?> <?php echo $x == $total - 1 ? 'last' : ''; ?>">
                                    <div class="b-groups__line"></div>
                                    <div class="b-groups__item-content">
                                        <div class="b-groups__item-name">
                                            <span>Commence date:</span>
                                            <?php if ($startdate) : ?>
                                            <div class="b-groups__item-date">
                                                <?=$startdate; ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="b-groups__modal-content">
                                                <h3><?php echo $title; ?></h3>
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-groups__item-action">

                                        <?php if ($status == 'Enrolment' && $en_status['status']) : ?>

                                            <a href="/payment/?gid=<?php echo $id ?>" class="c-button c-button--primary">Enrol now <i class="icon-plus"></i></a>

                                        <?php else : ?>    
                                            <a href="#join-waitlist" data-modal-open class="c-button c-button--primary js-show-waitlist" data-segment="<?php echo $waitlist_segment_id;?>" data-group="<?php echo $id ?>" data-groupname="<?=$title?>">Join the waitlist <i class="icon-plus"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $x+=1; endwhile; wp_reset_postdata(); ?>
                            </div>
                        
                        <?php endif; ?>


                    </div>
            
                <?php endwhile; ?>
            
            <?php endif; ?>
            

        </div>      
    </div>

</div>



<div id="join-waitlist" class="modal-hider">
    <div class="c-waitlist">
        <div class="c-waitlist__content" id="js-waitlist-content">
            
        </div>
        <div class="c-waitlist__forms">

            <?php echo do_shortcode("[gravityform id='{$form_id}' ajax='true' title='false']") ?>              

        </div>
    </div>
</div>
<?php
$path = get_template_directory() . '/template-parts/layouts/';

// Post meta
$post_image = get_field('event_image');
$post_title = get_the_title();
$url = get_the_permalink();

$image = get_field('event_image');
$date =  date('jS M Y', strtotime(get_field('event_date')));
$time =  get_field('event_time');
$location =  get_field('event_location');
$cost = get_field('event_cost');
$cost_note = get_field('event_cost_note');
$event_embed = get_field('event_embed');

$cta_title = get_field('cta_title');
$cta_desc = get_field('cta_desc');

// Get category link
$current_id = get_the_ID();
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div class="c-blog-hero u-hero-pt">

    <div class="c-blog-hero__bg js-rellax" data-rellax-speed="5"></div>

    <div class="o-wrapper">
        <div class="c-blog-hero__wrapper">
            <div class="c-blog-hero__content">
                <h1><?=$post_title?></h1>

                <div class="c-event__content-info">
                    <div class="c-event__content-item">
                        <div class="c-event__content-item-label">
                            Date and time
                        </div>
                        <div class="c-event__content-item-value">
                            <?=$date?> <?=$time ? ' - ' . $time : ''?> 
                        </div>
                    </div>
                    <div class="c-event__content-item">
                        <div class="c-event__content-item-label">
                            Location
                        </div>
                        <div class="c-event__content-item-value">
                            <?=$location?>
                        </div>
                    </div>
                </div>

            </div>

            <?php if ($post_image) : ?>
            <div class="c-blog-hero__image">
                <div class="js-rellax" data-rellax-speed="2" data-rellax-xs-speed="1" data-rellax-mobile-speed="1">
                <div class="c-lazy-wrapper">
                    <img  src="<?php echo $post_image['url'] ?>" alt="<?php echo strip_tags($title); ?>">
                </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>


    <div class="c-blog-single">
        <div class="c-blog-single__body">

            <div class="c-layout-text-block">
                <div class="o-wrapper">
                    <div class="c-layout-text-block__wrapper">
                        <div class="c-layout-text-block__description c-editor-cont aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                            <?php the_content() ?>   

                            <?php if ($cost) : ?>
                            <div class="c-event-cost">
                                <div class="c-event-cost__price">
                                    <span>Cost</span>
                                    <strong><?=$cost?></strong>
                                </div>
                                <?php if ($cost_note) :  ?>
                                <div class="c-event-cost__note">
                                    <?=$cost_note?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php if ($event_embed) : ?>
            <div class="o-wrapper">
                <script async defer src="https://www.trybooking.com/widget.js"></script>
                <div class="tryb-widget" data-type="fullEmbed" data-eid="<?=$event_embed?>"></div>
            </div>
            <?php endif; ?>

            <?php if ($cta_title || $cta_desc) : ?>
            <div class="c-event-page__cta">
                <div class="c-event-page__cta-title">
                    <?=$cta_title?>
                </div>
                <p><?=$cta_desc?></p>
            </div>
            <?php endif; ?>
                     
        </div>
    </div>


    <div class="c-blog-single__social">
        <div class="o-wrapper">
            <div class="c-blog-single__social-wrapper">
                <?php include get_template_directory() . '/template-parts/blog/share-links.php'; ?>   
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>


<?php
    $args = [
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in' => array($current_id)
    ];
    $related_query = new WP_QUERY($args);
?>

<?php if ($related_query->have_posts()) : ?>
<div class="c-blog-related">
    <div class="o-wrapper">
        <div class="c-blog-related__wrapper">
            <div class="c-blog-related__title">More events</div>
            <div class="c-posts">

                <?php while ($related_query->have_posts()) : 
                        $related_query->the_post(); 
                        $id = get_the_ID();
                        $link = get_the_permalink();
                        $title = get_the_title();
                        $image = get_field('event_image', $id);
                        $date =  date('jS M Y', strtotime(get_field('event_date', $id)));
                        $time =  get_field('event_time', $id);
                        $location =  get_field('event_location', $id);
                 ?>
                 <?php include get_template_directory() . '/template-parts/event-item.php'; ?>
                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>

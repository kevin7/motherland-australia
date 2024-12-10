<?php
$content = get_field('desc');
$title = get_field('title');

$args = [
    'post_type' => 'event',
    'post_status' => 'publish',
    'posts_per_page' => -1
];

$the_query = new WP_QUERY($args);
?>

<div class="b-image-header b-events__header u-hero-pt b-image-header--text">
    <div class="b-image-header__bg js-rellax" data-rellax-speed="5"></div>

    <div class="o-wrapper">
        <div class="b-image-header__wrapper">
            <div class="b-image-header__content">
                <h1><?php echo str_replace('[steph]', '<i class="steph"></i>', $title); ?></h1>
                <p>
                    <?php echo $content; ?>
                </p>
            </div>

        </div>
    </div>
</div>

<div class="b-events">    
    <div class="o-wrapper">
        <div class="b-events__wrapper">        
           <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : 
                            $the_query->the_post();
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
                <?php else: ?>
                    <div class="alert">We don't have any events at the moment. Please check back again later.</div>
                <?php endif; ?>
        </div>      
    </div>

</div>
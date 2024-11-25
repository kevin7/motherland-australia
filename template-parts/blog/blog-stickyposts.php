<?php
$stickies = get_option( 'sticky_posts' );

if (count($stickies) >= 3) :

    $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'desc',
        'posts_per_page' => 3,
        'post__in' => $stickies
    ];
    $the_query = new WP_Query($args);
    $stickies = [];

    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $id = get_the_ID();

            $stickies[] = array(
                'title' => get_the_title(),
                'desc' => get_field('post_desc', $id),
                'date' => strtotime(get_the_date()),
                'image' => get_field('post_image', $id),
                'link' => get_the_permalink()
            );

        } wp_reset_postdata();
    }
?>

<div class="b-stickypost">
    <div class="o-wrapper">        
        <div class="b-stickypost__wrapper">            

            <?php $x=0; foreach ($stickies as $p) : ?>

                <?php if ($x == 0) : ?>
                    <div class="b-stickypost__left">
                        <?php $class="c-post--thumb"; include get_template_directory() . '/template-parts/post-item.php'; ?>
                    </div>
                <?php endif; ?>

                <?php if ($x == 1) : ?>
                    <div class="b-stickypost__right">
                        <?php $class="c-post--side"; include get_template_directory() . '/template-parts/post-item.php'; ?>
                <?php endif; ?>

                <?php if ($x == 2) : ?>
                        <?php $class="c-post--side"; include get_template_directory() . '/template-parts/post-item.php'; ?>
                    </div>
                <?php endif; ?>

            <?php $x++; endforeach; ?>

        </div>
    </div>
</div>
<?php endif; ?>
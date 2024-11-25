<?php
$path = get_template_directory() . '/template-parts/layouts/';

// Post meta
$post_image = get_field('post_image');
$post_title = get_the_title();
$post_subtitle = get_field('post_desc');
$post_content = get_field('post_content');
$url = get_the_permalink();

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
                <div class="c-blog-hero__content-date">
                    <?=date('jS F', strtotime(get_the_date()))?>
                </div>
                <h1><?=$post_title?></h1>
                <p>
                    <?php echo $post_subtitle; ?>
                </p>
            </div>

            <?php if ($post_image) : ?>
            <div class="c-blog-hero__image">
                <div class="js-rellax" data-rellax-speed="2" data-rellax-xs-speed="1" data-rellax-mobile-speed="1">
                <div class="c-lazy-wrapper">
                    <img  src="<?php echo $post_image['sizes']['post'] ?>" alt="<?php echo strip_tags($title); ?>">
                </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>

    <div class="c-blog-single">
        <div class="c-blog-single__body">
            <?php include $path . 'flexible-content.php'; ?>                
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
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1
    ];
    $related_query = new WP_QUERY($args);
?>

<?php if ($related_query->have_posts()) : ?>
<div class="c-blog-related">
    <div class="o-wrapper">
        <div class="c-blog-related__wrapper">
            <div class="c-blog-related__title">Read more</div>
            <div class="c-posts">

                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                
                        $id = get_the_ID();
                        $p = [];
                        $p['title'] = get_the_title();
                        $p['desc'] = get_field('post_desc', $id);
                        $p['date'] = strtotime(get_the_date());
                        $p['image'] = get_field('post_image', $id);
                        $p['link'] = get_the_permalink();
                        $class = '';
                ?>	

                <div class="c-post c-post--default">
                    <div class="c-post__wrapper lazy" data-bg="<?=$p['image'] ? $p['image']['url'] : ''?>">
                    </div>
                    <div class="c-post__content">
                        <div class="c-post__content-date">
                            <?php if ($class == 'c-post--thumb') : ?>
                                <?=date('jS F', $p['date'])?>
                            <?php else: ?>
                                <?=get_time_ago($p['date']); ?>
                            <?php endif; ?>
                        </div>        
                        <a href="<?=$p['link']?>" class="c-post__content-title">
                            <?=$p['title']?>
                        </a>        
                        <div class="c-post__content-desc">
                            <?=$p['desc']?>
                        </div>        
                    </div>
                </div>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>

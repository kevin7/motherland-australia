<?php
    $subHero = true;
    $tax = get_queried_object();
    $page_for_posts = get_option( 'page_for_posts' );
    $posts_per_page = get_option( 'posts_per_page' );
    $title = get_field('admin_news_title', 'option');
    $subtitle = get_field('admin_news_content', 'option');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    if ( is_category() ) {
        $subtitle = 'Category: ' . single_cat_title( '', false );;
        $taxid = $tax->term_id;
    } elseif ( is_tag() ) {
        $subtitle = 'Tag: ' . single_tag_title( '', false );;
        $taxid = $tax->term_id;
    } elseif ( is_author() ) {
        $subtitle = 'Author: ' . ucwords(get_the_author());;
    } elseif ( is_post_type_archive() ) {
        $subtitle = 'Archive: ' . post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $subtitle = 'Taxonomy: ' . single_term_title( '', false );
        $taxid = $tax->term_id;
    }

    $cats = get_categories(array('hide_empty' => false));

?>
<?php get_header(); ?>


<?php 
$post = get_post($page_for_posts);
$blocks = parse_blocks($post->post_content);
foreach( $blocks as $block ) {
    echo render_block( $block );
}
?>

<?php include get_template_directory() . '/template-parts/blog/blog-stickyposts.php'; ?>



<div class="c-blog-list <?=count($stickies) >=3 ? '' : 'c-blog-list--nos'?>">
    <div class="o-wrapper">


        <div class="c-blog-list__wrapper">
            <div class="c-posts">
            <?php while (have_posts()) : the_post(); 
            
                $id = get_the_ID();
                $p = [];
                $p['title'] = get_the_title();
                $p['desc'] = get_field('post_desc', $id);
                $p['date'] = strtotime(get_the_date());
                $p['image'] = get_field('post_image', $id);
                $p['link'] = get_the_permalink();
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
        
        </div> <!-- .blog-list__wrapper -->
        
        <div class="c-blog-list__pages" id="js-filter-pagination">
            <?php base_post_navi(); ?>
        </div>


    </div>
</div>

<?php get_footer(); ?>

<?php
/**
 * Block Name: Image header
 *
 */

$title = get_field('title');
$content = get_field('content');
$link = make_link('link', 'c-link');
$images = get_field('images');

?>
<div class="b-image-header village u-hero-pt <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

    <div class="b-image-header__bg js-rellax" data-rellax-speed="8"></div>
    <div class="b-image-header__line">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/hero-line.svg" >
    </div>

    <div class="o-wrapper">
        <div class="b-image-header__wrapper">
            <div class="b-image-header__content">
                <h1><?php echo $title; ?></h1>
                <p>
                    <?php echo $content; ?>
                </p>
                <?php if ($link) : ?>
                    <?php render('link', $link);  ?>
                <?php endif; ?>
            </div>

            <div class="b-image-header__image">
                
                <div class="b-village">
                  <?php $x=1; foreach( $images as $image ): ?>
                  <div class="b-village__item b-village__item-<?php echo $x; ?>">
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  </div>
                  <?php $x++; endforeach; ?>
                </div>

            </div>
        </div>
    </div>

</div>



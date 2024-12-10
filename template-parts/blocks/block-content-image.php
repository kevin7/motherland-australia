<?php
/**
 * Block Name: Content & Image
 *
 */

$subtitle = get_field('sub_title');
$title = get_field('title');
$content = get_field('content');
$image = get_field('image');
$position = get_field('position');
$bg_color = get_field('bg_color');
$no_spacing = get_field('no_spacing');
$color = $bg_color == 'red' ? 'secondary' : 'primary';
$link = make_link('link', 'c-link');
?>

<div class="b-cont-image b-cont-image--<?php echo $position ?> c-bg-color--<?php echo $bg_color; ?> <?php echo $no_spacing ? 'u-pb-0' : ''; ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">

    <div class="b-cont-image__wrapper o-wrapper">
        <div class="b-cont-image__image">
            <?php if($image['url']) : ?>
            <?php
                if(isset( $image['height'] ) || isset( $image['width'])) {
                    $aspect_ratio = ( $image['height'] / $image['width']) * 100;
                } else {
                    $aspect_ratio = 100;
                };
            ?>
            <div class="c-lazy-wrapper" style="padding-bottom: <?= $aspect_ratio ?>%">
            <img
                class="c-image lazy <?= (isset($image['classes']) ? $image['classes'] : false )?>"
                data-src="<?= $image['url'] ?>"
                alt="<?= $image['alt'] ?>"
                title="<?= $image['title'] ?>"
                width="<?= $image['width']?>"
                height="<?= $image['height'] ?>"

            >
            </div>
            <?php endif; ?>
        </div>
        <div class="b-cont-image__content">
            <?php if ($title) : ?>
            <h2><?php echo str_replace('[steph]', '<i class="steph"></i>', $title); ?></h2>
            <?php endif; ?>
            <div class="u-mb-5"><?php echo $content; ?></div>
            <?php if ($link) : ?>
                <?php render('link', $link);  ?>
            <?php endif; ?>
        </div>
    </div>

</div>


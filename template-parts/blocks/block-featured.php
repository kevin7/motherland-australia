<?php
/**
 * Block Name: Featured
 *
 */

$title = get_field('title');
$images = get_field('images');
?>
<div class="b-featured <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

<div class="o-wrapper">
    <div class="b-featured__wrapper">        
        <div class="b-featured__content">
            <h5><?php echo $title; ?></h5>

            <div class="b-featured__gallery">

                <?php foreach( $images as $image ): ?>
                <div class="b-featured__gallery-item">
                    <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>      
</div>

</div>


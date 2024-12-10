<?php
/**
 * Block Name: Content Editor
 *
 */

$content = get_field('content');
$width = get_field('width');

?>
<div class="b-cont-editor b-cont-editor--<?php echo $width ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">

    <div class="b-cont-editor__wrapper o-wrapper">        
        <div class="b-cont-editor__content">
            <?php echo $content; ?>
        </div>
    </div>

</div>


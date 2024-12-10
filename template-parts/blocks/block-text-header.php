<?php
/**
 * Block Name: Text Header
 *
 */

$title = get_field('title');
$content = get_field('content');

?>
<div class="b-text-header u-hero-pt <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">
    <div class="o-wrapper">
        <div class="b-page-hero__wrapper">        
            
            <h1 class="u-h2"><?php echo $title; ?></h1>
            <?php if ($content) : ?>
            <p><?php echo $content; ?></p>
            <?php endif; ?>
        
        </div>
    </div>

</div>


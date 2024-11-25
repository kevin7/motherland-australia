<?php
/**
 * Block Name: 
 *
 */

$admin_link_ig = get_field('admin_link_ig', 'option');
$admin_ig_shortcode = get_field('admin_ig_shortcode', 'option');
$button_label = get_field('button_label');

?>
<div class="b-instagram <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

  <div class="o-wrapper">
    <div class="b-instagram__wrapper">        
        <div class="b-instagram__content">
          <a href="<?php echo $admin_link_ig; ?>" class="c-button c-button--primary"><?php echo $button_label; ?> <i class="icon-instagram"></i></a>
            <?php echo $content; ?>
        </div>
    </div>      
  </div>

  <div class="b-instagram__feed">
    <?php echo do_shortcode($admin_ig_shortcode); ?>
  </div>

</div>


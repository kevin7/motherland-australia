<?php
/**
 * Block Name: Stats
 *
 */

$content = get_field('content');
$footnote = get_field('Footnote');
?>
<div class="b-stats <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">

  <div class="o-wrapper">
    <div class="b-stats__wrapper">        
        <div class="b-stats__content u-h3">
            <?php echo $content; ?>
        </div>
        <div class="b-stats__items">
          <?php if ( have_rows('stats') ) : ?>
          
            <?php while( have_rows('stats') ) : the_row(); ?>
          
              <div class="b-stats__item">
                <div class="b-stats__item-value">
                  <b><?php the_sub_field('percentage'); ?></b>
                  <span>%</span>
                </div>
                <div class="b-stats__item-caption">
                  <?php the_sub_field('caption'); ?>
                </div>
              </div>
          
            <?php endwhile; ?>
          
          <?php endif; ?>
          
        </div>
        <div class="b-stats__footnote">
          <?php echo $footnote; ?>
        </div>
    </div>      
  </div>

</div>


<?php
/**
 * Block Name: FAQs
 *
 */

$cats = get_field('category')

?>
<div class="b-faqs <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="acf-block-<?php echo $block['id']; ?>">

  <div class="b-faqs__wrapper o-wrapper">
      <div class="b-faqs__left">
        <?php foreach ($cats as $t) : ?>
            
          <?php
            $args = array(
              'posts_per_page' => '-1',
              'post_type' => 'faq',
              'post_status' => 'publish',
              'orderby' => 'menu_order',
              'order' => 'ASC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'faq-category',
                  'field'    => 'term_id',
                  'terms'    => $t->term_id,
                )
              )
            );
            $the_query = new WP_QUERY($args);		

            if ($the_query->have_posts()) :  
          ?>

          <div class="b-faqs__block <?php echo strtolower($t->slug); ?>" id="<?php echo $t->slug; ?>" data-target="#<?php echo $t->slug; ?>">
          <h3><?php echo $t->name; ?></h3>
          
          <ul class="accordion" id="section-<?php echo $t->slug; ?>">
          <?php $y=1; while ($the_query->have_posts()) : 	$the_query->the_post(); ?>  
            <li>
              <div class="accordion__title">
                <?php the_title(); ?>
              </div>
              <div class="accordion__content">
                <?php the_content(); ?>
              </div>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>	
          </ul>
          </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

  </div>

</div>


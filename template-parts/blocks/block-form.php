<?php
/**
 * Block Name: Content Editor
 *
 */

$content = get_field('content');
$width = get_field('width');
$form = get_field('gf_form');

?>
<div class="b-cont-editor b-induction b-cont-editor--<?php echo $width ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

    <div class="b-cont-editor__wrapper o-wrapper">        
        <div class="b-cont-editor__content">
            <?php echo $content; ?>


            <div class="b-induction__form">
              <?php echo do_shortcode("[gravityform id='{$form}' ajax='true' title='false' field_values='group={$gid}&group_name={$group->post_title}&first_name={$firstname}&last_name={$lastname}&email={$email}']") ?>
            </div>
        </div>

    </div>

</div>


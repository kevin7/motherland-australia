<?php
/**
 * Block Name: Content Editor
 *
 */

$content = get_field('content');
$width = get_field('width');
$form = get_field('gf_form');

$user = wp_get_current_user();
$user_meta = get_user_meta( $user->ID );
$gid = 0;

$induction_status = isset($user_meta['user_induction']) ? $user_meta['user_induction'][0] : false;

$email = urlencode($user->user_email);
$firstname = urlencode($user_meta['first_name'][0]);
$lastname =  urlencode($user_meta['last_name'][0]);

// Get group details for display
if (isset($user_meta['user_group'][0])) {
    $gid = $user_meta['user_group'][0];

    global $wpdb;
    $query = $wpdb->prepare(
        "
            SELECT *
            FROM $wpdb->posts
            WHERE ID = %d
            AND post_status = 'publish'
            AND post_type = 'group'
        ",
        $gid
    );
    $group = $wpdb->get_row($query);
}

// Overrride status if it's admin
if (is_user_logged_in() && check_user_role(array('administrator'))) {
    $induction_status = null;
}


?>
<div class="b-cont-editor b-induction b-cont-editor--<?php echo $width ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

    <div class="b-cont-editor__wrapper o-wrapper">        
        <div class="b-cont-editor__content">
            <?php echo $content; ?>


            <div class="b-induction__form">
                <?php if (!$induction_status) : ?>
                    <?php echo do_shortcode("[gravityform id='{$form}' ajax='true' title='false' field_values='group={$gid}&group_name={$group->post_title}&first_name={$firstname}&last_name={$lastname}&email={$email}']") ?>
                <?php else: ?>
                    <div class="c-alert">
                        <i class="icon icon-info-circle"></i>
                    <p>You've already submitted your induction. For any enquiries, please do not hesitate to <a href="/contact">contact us</a>.</p></div>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>


<?php
/**
 * Block Name: Payment
 *
 */

$gid = isset($_GET['gid']) ? $_GET['gid'] : false;
$title = get_field('title');
$content = get_field('content');
$title_closed = get_field('title_closed');
$content_closed = get_field('content_closed');
$width = get_field('width');
$form = get_field('gf_form_payment', 'option');
$en_status = getEnrolmentStatus($gid);

if (is_user_logged_in() && check_user_role(array('administrator'))) {
    $en_status['status'] = true;
}

$seat_limit = get_field('group_en_seats', $gid);
$type = get_field('group_status', $gid);

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
?>

<?php if (!$en_status['status']) : ?>

        
    <div class="b-text-header u-hero-pt" data-en-status="<?php echo $en_status; ?>">
        <div class="o-wrapper">
            <div class="b-page-hero__wrapper">        
                
                <h1 class="u-h2"><?php echo $title_closed; ?></h1>
                <?php if ($content_closed) : ?>
                <p><?php echo str_replace('{group_name}', $group->post_title, $content_closed); ?></p>
                <?php endif; ?>

                <?php if (is_user_logged_in() && check_user_role(array('administrator')) && $type == 'Enrolment') : ?>
                    <p><b>Only visible to admin:</b> Seat limit: <?php echo $seat_limit ?>, Enrolled: <?php echo $en_status['current']; ?> </p>
                <?php endif; ?>
            
            </div>
        </div>

    </div>



<?php else: ?>


    <div class="b-text-header u-hero-pt">
        <div class="o-wrapper">
            <div class="b-page-hero__wrapper">        
                
                <h1 class="u-h2"><?php echo $title; ?></h1>
                <?php if ($content) : ?>
                <p><?php echo str_replace('{group_name}', $group->post_title, $content); ?></p>
                <?php endif; ?>
                <?php if (is_user_logged_in() && check_user_role(array('administrator'))) : ?>
                    <p><b>Only visible to admin:</b> Seat limit: <?php echo $seat_limit ?>, Enrolled: <?php echo $en_status['current']; ?> </p>
                <?php endif; ?>
            
            </div>
        </div>

    </div>

    <div class="b-cont-editor b-cont-editor--md <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

        <div class="b-cont-editor__wrapper o-wrapper">        
            <div class="b-cont-editor__content">

                <?php if (!$gid || !$group) : ?>

                    <div class="alert alert--warning">
                        Error: Invalid payment URL
                    </div>

                <?php else : 
                    
                        $enrolment_segment_id = get_field('enrolment_segment_id', $group->ID);
                        $startdate = get_field('group_en_start', $group->ID);
                    ?>
                    <div class="b-content-editor__form">
                        <?php echo do_shortcode("[gravityform id='{$form}' ajax='true' title='false' field_values='group_name=Enrolment: {$group->post_title}&group={$group->ID}&segment={$enrolment_segment_id}&startdate={$startdate}']") ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>

<?php endif; ?>
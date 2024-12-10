<?php
$subtitle = get_sub_field('subtitle');
$lead = get_sub_field('lead');
$content = get_sub_field('content');
$link = make_sub_link('link', 'c-link c-link--move');
?>

<div class="b-text-blocks c-block-gap">
    <div class="o-wrapper">

        <div class="b-text-blocks__wrapper">

            <div class="b-text-blocks__left" data-aos="fade-up">
                <?php if ($subtitle) : ?>
                <div class="b-text-blocks__subtitle">
                    <?=$subtitle?>
                </div>
                <?php endif; ?>

                <?php if ($lead) : ?>
                <h3 class="u-h4"><?php echo $lead; ?></h3>
                <?php endif; ?>
            </div>

            <div class="b-text-blocks__right" data-aos="fade-up" data-aos-delay="300">
                <div class="c-editor-cont">
                    <?php echo $content; ?>
                </div>
                <div class="b-text-blocks__button">
                    <?php if ($link) : ?>
                        <?php render('link', $link);  ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>


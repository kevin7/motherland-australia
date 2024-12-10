<?php
$title = get_field('title');
$content = get_field('content');
$button = make_link('link', 'c-button c-button--primary');
$account = get_field('account_content');
$footnote_content = get_field('footnote_content');
$footnote_image = get_field('footnote_image');
?>

<div class="b-donation <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-up">
    <div class="o-wrapper">
        <div class="b-donation__wrapper">

            <?php if ($title) : ?>
                <h1><?=$title?></h1>
            <?php endif; ?>

            <?php if ($content) : ?>
                <div class="b-donation__content">
                    <?=$content?>
                </div>
            <?php endif; ?>

            <?php if ($button) : ?>
                <div class="b-donation__button">
                    <?=render('link', $button)?>
                </div>
            <?php endif; ?>

            <?php if ($account) : ?>
                <div class="b-donation__account">
                <?=$account?>
                </div>
            <?php endif; ?>

        </div>


        <?php if ($footnote_content && $footnote_image) : ?>
            <div class="b-donation__footnote">
                <div class="b-donation__footnote-image">
                    <img src="<?=$footnote_image['url']?>" alt="<?=$footnote_image['alt']?>">
                </div>
                <div class="b-donation__footnote-content">
                    <?=$footnote_content?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>


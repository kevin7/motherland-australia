<?php

$description = get_sub_field('description');
$link = make_sub_link('link', 'c-link c-link--secondary');

?>
<div class="c-blog-grey-text-block__wrapper">
    <div class="o-wrapper">
        <div class="o-layout o-layout--center">
            <div class="o-layout__item u-1/2@desktop">
                <div class="c-blog-grey-text-block">
                    <div class="c-blog-grey-text-block__description"><?= $description ?></div>
                    <?php if($link->url): ?>
                        <?php render('link', $link); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

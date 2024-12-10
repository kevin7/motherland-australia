<?php

$title = get_sub_field('title');
$content = get_sub_field('content');
?>
<div class="c-layout-text-block">
    <div class="o-wrapper">
        <div class="c-layout-text-block__wrapper">
            <?php if ($title) : ?>
            <h2 class="c-layout-text-block__title" data-aos="fade-up"><?= $title ?></h2>
            <?php endif; ?>
            <div class="c-layout-text-block__description c-editor-cont" data-aos="fade-up" data-aos-delay="300"><?= $content ?></div>
        </div>
    </div>
</div>

<?php

$title = get_sub_field('title');
$content = get_sub_field('content');
$section_id = $title ? ' id="'.preg_replace('/[^a-zA-Z]/', '', strtolower($title)).'"' : '';

?>
<div <?= $section_id ?> class="c-blog-text-block" data-section>
    <div class="o-wrapper">
        <div class="o-layout o-layout--center">
            <div class="o-layout__item u-1/2@desktop">
                <h2 class="c-blog-text-block__title"><?= $title ?></h2>
                <div class="c-blog-text-block__description"><?= $content ?></div>
            </div>
        </div>
    </div>
</div>

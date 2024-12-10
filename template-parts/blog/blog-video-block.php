<?php

$title = get_sub_field('title');
$video = get_sub_field('video');
$description = get_sub_field('description');

?>
<div class="c-blog-video-block">
    <div class="o-wrapper">
        <div class="o-layout o-layout--center">
            <div class="o-layout__item u-1/2@desktop">
                <div class="c-video-responsive">
<!--                    <span class="c-blog-video-block__title">--><?//= $title ?><!--</span>-->
                    <?= $video ?>
                </div>
                <?php if($description) : ?>
                    <div class="c-accordion">
                        <div class="c-accordion__item" data-accordion data-accordion-active-class="c-accordion__item--is-active">
                            <div class="c-accordion__header" data-accordion-toggle>Video Transcript</div>
                            <div class="c-accordion__content" data-accordion-content >
                                <div class="o-type--wysiwyg">
                                    <?= $description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

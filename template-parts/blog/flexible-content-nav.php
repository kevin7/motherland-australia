<?php if(isset($items)) : ?>
    <div class="c-expandable-block">
        <ul class="c-text-block-nav">
            <?php
            foreach ($items as $item) :
                if ($item->layout === 'text_block') : ?>
                    <?php $section_id = preg_replace('/[^a-zA-Z]/', '', strtolower($item->content->title)); ?>
                    <?php if(!empty($item->content->title)): ?>
                        <li class="c-text-block-nav__item">
                            <a href="#<?= $section_id ?>" class="c-text-block-nav__link" data-scroll-to="<?= $section_id ?>">
                                <span><?= $item->content->title ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif;
                endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


<div class="c-text-block-title-wrapper">
    <?php if( have_rows('flexible_content') ): ?>
        <div class="c-text-block-title-wrapper__title">In this article</div>
        <div class="c-expandable-block c-expandable-block--menu">
            <div>
                <ul>
                <?php
                    while ( have_rows('flexible_content') ) : the_row();
                        if (get_row_layout() === 'text_block') : 
                            
                            $title = get_sub_field('title');
                            $icon = get_sub_field('icon');
                        ?>
                            <?php $section_id = preg_replace('/[^a-zA-Z]/', '', strtolower($title)); ?>
                            <?php if(!empty($title)): ?>
                                <li class="c-text-block-title">
                                    <a data-scroll-to="<?= $section_id ?>">
                                        <?php if(!empty($title)): ?>
                                            <span class="c-text-block-title__item">
                                                <?php if($icon): ?>
                                                    <img src="<?= $icon['url'] ?>"
                                                         alt="<?= $iicon['alt'] ?>"
                                                         title="<?= $icon['alt'] ?>"
                                                         width="<?= $icon['width'] ?>"
                                                         height="<?= $icon['height'] ?>"
                                                    >
                                                <?php endif; ?>
                                                <span class="c-text-block-title__title">
                                                    <?= $title ?>
                                                </span>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif;
                    endwhile; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>



<?php
$title = get_sub_field('title');
$content = get_sub_field('content');
$button = render_sub_link('button', 'c-button c-button--primary');
?>
<div class="c-program__block c-bg-color--green">

    <div class="p-cta">
        <?php if ($title) :  ?>
            <h4><?=$title?></h4>
        <?php endif; ?>
        <?php if ($content) :  ?>
            <?=$content?>
        <?php endif; ?>
        <?php if ($button) :  ?>
            <?=$button?>
        <?php endif; ?>
    </div>

</div>
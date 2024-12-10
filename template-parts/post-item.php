<div class="c-post <?=$class?>">
    <div class="c-post__wrapper lazy" data-bg="<?=$p['image'] ? $p['image']['url'] : ''?>">
    </div>
    <div class="c-post__content">
        <div class="c-post__content-date">
            <?php if ($class == 'c-post--thumb') : ?>
                <?=date('jS F', $p['date'])?>
            <?php else: ?>
                <?=get_time_ago($p['date']); ?>
            <?php endif; ?>
        </div>        
        <a href="<?=$p['link']?>" class="c-post__content-title">
            <?=$p['title']?>
        </a>        
        <div class="c-post__content-desc">
            <?=$p['desc']?>
        </div>        
    </div>
</div>
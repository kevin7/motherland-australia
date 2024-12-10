
<div class="c-event">
    <div class="c-event__image">
        <div class="c-lazy-wrapper">
            <?php if (isset($image['url'])) : ?>
            <img data-src="<?=$image['url']?>" class="lazy">
            <?php endif; ?>
        </div>
    </div>
    <div class="c-event__content">
        <div class="c-event__content-wrapper">
            <a href="<?=$link?>" class="c-event__content-title">
                <?=the_title();?>
            </a>
            <div class="c-event__content-info">
                <div class="c-event__content-item">
                    <div class="c-event__content-item-label">
                        Date and time
                    </div>
                    <div class="c-event__content-item-value">
                        <?=$date?> <?=$time ? ' - ' . $time : ''?> 
                    </div>
                </div>
                <div class="c-event__content-item">
                    <div class="c-event__content-item-label">
                        Location
                    </div>
                    <div class="c-event__content-item-value">
                        <?=$location?>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-event__content-button">
            <a href="<?=$link?>" class="c-button c-button--primary">View event</a>
        </div>
    </div>
</div>
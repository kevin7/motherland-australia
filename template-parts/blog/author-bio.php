<div class="c-post-author">
    <?php if ($author['user_avatar']): ?>
        <div class="c-post-author__image">
            <?= $author['user_avatar'] ?>
        </div>
    <?php endif; ?>
    <div class="c-post-author__author-details">
        <h4>
            <a href="<?= get_author_posts_url($author['ID']); ?>">About <?= $author['display_name'] ?></a>
        </h4>

        <div class="c-post-author__details">
            <span><?=$author->role ?></span>
        </div>

        <div class="c-post-author__bio">
            <?= $author['user_description'] ?>
        </div>

        <a href="<?= get_author_posts_url($author['ID']); ?>" class="c-link c-link--primary">
            More articles <?= $author['display_name'] ?>
        </a>
    </div>
</div>


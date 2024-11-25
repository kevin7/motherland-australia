<?php
global $post;
?>
<div class="c-share-links">
    <div class="c-share-links__label">
        Share this <?= $post->post_type == 'event' ? 'event' : 'article'?>
    </div>
    <ul class="c-share-links__items">
        <li>
            <a href="https://twitter.com/share?url=<?=urlencode($url) ?>"
               target="_blank">
                <i class="icon-twitter"></i>
            </a>
        </li>
        <li>
            <a href="http://www.facebook.com/sharer.php?u=<?=urlencode($url) ?>"
               target="_blank">
                <i class="icon-facebook-f"></i>
            </a>
        </li>
        <li>
            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=urlencode($url) ?>" target="_blank">
                <i class="icon-linkedin"></i>
            </a>
        </li>
        <li>
            <a data-copy-url="<?=$url ?>">
                <i class="icon-link"></i>
                <div class="c-share-links-copy__message">Link copied</div>
            </a>
        </li>
    </ul>
</div>

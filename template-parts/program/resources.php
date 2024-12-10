<?php
$title = get_sub_field('title');
$notice_show = get_sub_field('notice_show');
$notice = get_sub_field('notice');
$display = get_sub_field('display');
?>
<div class="c-program__block pad-large">

    <div class="c-prog-items">
        <?php if ($title) :  ?>
            <h2><?=$title?></h2>
        <?php endif; ?>

        <?php if ( have_rows('resources') ) : ?>
            <div class="c-prog-items__grid <?=$display?>">
            <?php while( have_rows('resources') ) : 
                    the_row(); 
                    $type = get_sub_field('type');
                    $icon = get_sub_field('icon');
                    $link = get_sub_field('link');
                    $file = get_sub_field('file');
                    $url = '';
                    $title = '';
                    
                    
                    if ($type == 'link') {
                        $url = $link['url'];
                        $title = $link['title'];
                    } elseif ($type == 'file') {
                        $url = $file['url'];
                        $title = $file['caption'];
                    }
                    
                ?>
                <?php if ($url && $title) :  ?>
                <a href="<?=$url?>" class="c-prog-item" target="_blank">
                    <span>
                        <i class="svg-<?=$icon?>"></i>
                        <?=$title?>
                    </span>
                    <i class="svg-external"></i>
                </a>
                <?php endif; ?>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>


    <?php if ($notice_show) :  ?>
        <div class="c-notice">
            <div>
                <?=$notice?>
            </div>
            <i class="svg-external-pink"></i>
        </div>
    <?php endif; ?>
        
</div>
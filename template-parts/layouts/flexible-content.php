<?php

$path = get_template_directory() . '/template-parts/layouts/';

if( have_rows('flexible_content') ):
    
    while ( have_rows('flexible_content') ) : the_row();

        switch(get_row_layout()) {
            case 'text_block':
                include $path . 'layout-text-block.php';
                break;
            case 'image_block' :
                include $path . 'layout-image-block.php';
                break;
            case 'images_block' :
                include $path . 'layout-images-block.php';
                break;
            case 'video_block' :
                include $path . 'layout-video-block.php';
                break;
            case 'content_image_block' :
                include $path . 'layout-content-image-block.php';
                break;
            case 'quote_block' :
                include $path . 'layout-quote-block.php';
                break;
            case 'title_content_block' :
                include $path . 'layout-title-content-block.php';
                break;

        }
    endwhile;
endif;


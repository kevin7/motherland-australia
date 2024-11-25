<?php

$path = get_template_directory() . '/template-parts/blog/';

if( have_rows('flexible_content') ):
    
    while ( have_rows('flexible_content') ) : the_row();

        switch(get_row_layout()) {
            case 'text_block':
                include $path . 'blog-text-block.php';
                break;
            case 'grey_text_block':
                include $path . 'blog-grey-text-block.php';
                break;
            case 'image_block' :
                include $path . 'blog-image-block.php';
                break;
            case 'images_block' :
                include $path . 'blog-images-block.php';
                break;
            case 'video_block' :
                include $path . 'blog-video-block.php';
                break;
            case 'carousel_block' :
                include $path . 'blog-carousel-block.php';
                break;

        }
    endwhile;
endif;


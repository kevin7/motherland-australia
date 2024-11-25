<?php

// --------------------------------------------
// Shortcode
// --------------------------------------------

function menus_shortcode( $atts, $content = null ) {
    
        
  if ( have_rows('admin_menus', 'option') ) {
    $html = '<div class="c-menu-links">';
    
    while( have_rows('admin_menus', 'option')) {
        the_row(); 
        $file = get_sub_field('file');
        $label = get_sub_field('label');
          
        $html .= '<a href="' . $file . '" class="c-menu-link" target="_blank"><span>'. $label .'</span> <i class=" icon-arrow-to-bottom"></i></a>';

    }
    $html .= '</div>';
  }

      return $html;
  }
  add_shortcode( 'menus', 'menus_shortcode' );
  
  
  

// --------------------------------------------
// Retrieve WP feature image
// --------------------------------------------
function getPostImage($id=false, $size='single-post-thumbnail') {

    if (!$id) $id = get_the_ID();

    if (@has_post_thumbnail( $id ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
        return $image[0];
    } else {
        return false;
    }
}


// --------------------------------------------
// Pagination
// --------------------------------------------

function base_post_navi() {
    global $wp_query;
    $bignum = 999999999;
    if ( $wp_query->max_num_pages <= 1 )
      return;
    echo '<nav class="pagination">';
    echo paginate_links( array(
      'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'       => '',
      'current'      => max( 1, get_query_var('paged') ),
      'total'        => $wp_query->max_num_pages,
      'prev_text'    => '<i class="icon-angle-left"></i>',
      'next_text'    => '<i class="icon-angle-right"></i>',
      'type'         => 'list',
      'end_size'     => 3,
      'mid_size'     => 3
    ) );
    echo '</nav>';
  } /* end page navi */
  
  function base_cpt_navi($max_num_pages) {
    global $wp_query;
    $bignum = 999999999;
  
    if ( $max_num_pages <= 1 )
      return;
    echo '<nav class="pagination">';
    echo paginate_links( array(
      'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'       => '',
      'current'      => max( 1, get_query_var('paged') ),
      'total'        => $max_num_pages,
      'prev_text'    => '<i class="icon-left"></i>',
      'next_text'    => '<i class="icon-right"></i>',
      'type'         => 'list',
      'end_size'     => 3,
      'mid_size'     => 3
    ) );
    echo '</nav>';
  } /* end page navi */
  
  
  // Numeric Page Navi (built into the theme by default)
  function base_ajax_post_navi($max_num_pages, $paged) {
      global $wp_query;
      $bignum = 999999999;
    
      if ( $max_num_pages <= 1 )
        return;
      echo '<nav class="pagination">';
      echo paginate_links( array(
        'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
        'format'       => '',
        'current'      => max( 1, $paged ),
        'total'        => $max_num_pages,
        'prev_text'    => '<i class="icon-left-open-big"></i>',
        'next_text'    => '<i class="icon-right-open-big"></i>',
        'type'         => 'list',
        'end_size'     => 3,
        'mid_size'     => 3
      ) );
      echo '</nav>';
    } /* end page navi */
  


    function get_time_ago( $time )
    {
        $time_difference = time() - $time;
    
        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );
    
        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;
    
            if( $d >= 1 )
            {
                $t = round( $d );
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }    



function get_youtube_thumbnail($youtube_url) {
    // Parse the URL and retrieve the 'v' parameter for YouTube video ID
    parse_str(parse_url($youtube_url, PHP_URL_QUERY), $url_params);
    
    // Check if the video ID (v parameter) exists
    if (isset($url_params['v'])) {
        $video_id = $url_params['v'];
    } else {
        // For URLs that may be shortened or in the 'youtu.be' format
        $path = parse_url($youtube_url, PHP_URL_PATH);
        $video_id = ltrim($path, '/');
    }

    // Return the thumbnail URL using the extracted video ID
    return "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";
}
    
<?php

// --------------------------------------------
// Theme supports
// --------------------------------------------

// Sidebars & Widgetizes Areas
function base_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
} 



// --------------------------------------------
// Image sizes
// --------------------------------------------
add_image_size('post', 865, 535, true);
add_image_size('post-thumbnail', 510, 375, true);
add_image_size('event', 500, 655, true);
add_image_size('carousel', 700, 620, true);
add_image_size('hero', 1440, 785, true);

// Add the media select drop down in admin
add_filter( 'image_size_names_choose', 'base_custom_image_sizes' );
function base_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'post' => __('865px by 535px'),
        'post-thumbnail' => __('510px by 375px'),
        'square' => __('600px by 600px'),
        'square-small' => __('250px by 250px'),
        'hero' => __('1440px by 785px')
    ) );
}


// --------------------------------------------
// This removes the annoying […] to a Read More link
// --------------------------------------------
add_filter('excerpt_more','base_excerpt_more',11);

// Changing excerpt more
function base_excerpt_more($more) {
	global $post;
	remove_filter('excerpt_more', 'base_excerpt_more'); 
	return '...';
}  




// --------------------------------------------------
// Add wrapper around iframe embed
// --------------------------------------------------

add_filter('embed_oembed_html', function($html)
{
    return '<div class="c-video-responsive">' . $html . '</div>';
}, 99, 4);


// --------------------------------------------
// Control the lenght of excerpt
// --------------------------------------------
function custom_excerpt_length( $length ) {
	global $post;
  
	if ($post->post_type == 'post') {
	  return 20;
	} else if ($post->post_type == 'people') {
	  return 25;
	}
  }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );  



// --------------------------------------------------
// CPT add class active
// --------------------------------------------------
add_filter('nav_menu_css_class', function($classes, $item)
{
    $post_type = get_post_type();
    if ($item->attr_title != '' && $item->attr_title == $post_type) {
        array_push($classes, 'active');
    };

    return $classes;
}, 10, 2);




function siteClasses() {

	global $post;
	$classes = [];
    $isLogin = false;

	$blocks = parse_blocks( get_the_content() );

    foreach ($blocks as $block) {
        if ($block['blockName'] == 'acf/login' || $block['blockName'] == 'acf/reset') {
            $isLogin = true;
        }
    }

    if ($isLogin) $classes[] = ' page-login ';

	return $classes;
  
  }

  function is_blog () {
	return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}


add_filter( 'gettext', 'register_text' );
add_filter( 'ngettext', 'register_text' );
function register_text( $translated ) {
    $translated = str_ireplace(
        'Username or Email Address',
        'Email Address',
        $translated
    );
    return $translated;
}

function no_wordpress_errors(){
	return 'Unable to login, please ensure your email and password are entered correctly.';
}
add_filter( 'login_errors', 'no_wordpress_errors' );


// show admin bar only for admins and editors
if (check_user_role(array('subscriber'))) {
	add_filter('show_admin_bar', '__return_false');
}


function checkLoginStatus() {
	if (!is_user_logged_in()) {
		$url = get_the_permalink();
		wp_redirect("/wp-login.php?redirect_to={$url}");
		die();
	}
}


function getEnrolmentStatus($groupID) {

	$form_id = get_field('gf_form_payment', 'option');
	$type = get_field('group_status', $groupID);
	$seat_limit = get_field('group_en_seats', $groupID);
	$start_date = get_field('group_en_start', $groupID);

	if ($type == 'Waitlist') return false;

	$search_criteria = array(
		'status'        => 'active',
		'start_date' 	=> $start_date,
		'field_filters' => array(
			array(
				'key'   => 15,
				'value' => $groupID
			),
			array(
				'key'   => 'payment_status',
				'value' => 'Paid'
			)
		)
	);

	$current_total = GFAPI::count_entries( $form_id, $search_criteria );

	$data = array(
		'current' => $current_total,
		'limit' => $seat_limit
	);

	if ($current_total >= $seat_limit) {
		$data['status'] = false;
		return $data;
	} else {
		$data['status'] = true;
		return $data;
	}
}


add_action( 'pre_get_posts', 'custom_post_archive_changes' );
function custom_post_archive_changes( $query ) {
	if ( is_home() && $query->is_main_query() ) {

		// exclude sticky posts from main news page
		$stickies = get_option("sticky_posts");
		$query->set( 'post__not_in', $stickies );

	}
}

?>
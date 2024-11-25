<?php
/*
This file handles the admin area and functions. You can use this file to make changes to the dashboard.
*/


add_action('after_setup_theme', function()
{

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );


	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Nav', 'base' ),   // main nav in header
			'footer-nav' => __( 'Footer Nav', 'base' ),
			'top-nav' => __( 'Top Nav', 'base' ),
			'bottom-nav' => __( 'Bottom Nav', 'base' ),
			'footer-links' => __( 'Footer Links', 'base' )
		)
	);

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(125, 125, true);

    	// --------------------------------------------
	// Image sizes
	// --------------------------------------------
	add_image_size('post', 825, 705, true);

});


// --------------------------------------------
// Disable default dashboard widgets
// --------------------------------------------
add_action( 'wp_dashboard_setup', 'base_disable_default_dashboard_widgets' );
function base_disable_default_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_quick_press']);    // News Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //
}


// --------------------------------------------
// Custom Login Page
// --------------------------------------------
function base_login_css() {
	wp_enqueue_style( 'base_login_css', get_template_directory_uri() . '/dist/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function base_login_url() {  return home_url(); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'base_login_css', 10 );
add_filter( 'login_headerurl', 'base_login_url' );


// --------------------------------------------
// Custom Backend Footer
// --------------------------------------------
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );
function bones_custom_admin_footer() {
	echo '';
}




// --------------------------------------------
// Enables the Excerpt meta box in Page edit screen
// --------------------------------------------
add_action( 'init', 'base_add_excerpt_support_for_pages' );
function base_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

// --------------------------------------------
// Make block editor full width
// --------------------------------------------
add_action('admin_head', 'base_admin_custom_css');
function base_admin_custom_css() {
  echo '<style>
    .wp-block {
      max-width:90%;
	}
    .acf-fields > .acf-field-message {
        padding:0;
		background:#000;
    }
    .acf-fields > .acf-field-message .acf-label {
        margin:0;
    }
    .acf-fields > .acf-field-message h3 {
        margin:0;
        color:#fff;
    }
    .acf-flexible-content .layout .acf-fc-layout-handle {
        color:#fff;
        background-color:#000;
    }
    .acf-icon.-clear {
        background-color:#fff;
    }
  </style>';
}





// Show extra group field in User page

add_action('show_user_profile', 'mysite_show_extra_profile_fields');
add_action('edit_user_profile', 'mysite_show_extra_profile_fields');
add_action('personal_options_update', 'mysite_save_extra_profile_fields');
add_action('edit_user_profile_update', 'mysite_save_extra_profile_fields');
add_action('manage_users_custom_column', 'mysite_custom_columns', 15, 3);
add_filter('manage_users_columns', 'mysite_columns', 15, 1);

function mysite_show_extra_profile_fields($user) {
	print('<h3>Extra profile information</h3>');
  
	print('<table class="form-table">');
  
	$meta_number = 0;
	$custom_meta_fields = mysite_custom_define();
	foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	  $meta_number++;
	  print('<tr>');
	  print('<th><label for="' . $meta_field_name . '">' . $meta_disp_name . '</label></th>');
	  print('<td>');
	  print('<input type="text" name="' . $meta_field_name . '" id="' . $meta_field_name . '" value="' . esc_attr( get_the_author_meta($meta_field_name, $user->ID ) ) . '" class="regular-text" /><br />');
	  print('<span class="description"></span>');
	  print('</td>');
	  print('</tr>');
	}
	print('</table>');
}

function mysite_save_extra_profile_fields($user_id) {

	if (!current_user_can('edit_user', $user_id))
	  return false;
  
	$meta_number = 0;
	$custom_meta_fields = mysite_custom_define();
	foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	  $meta_number++;
	  update_usermeta( $user_id, $meta_field_name, $_POST[$meta_field_name] );
	}
}

function mysite_custom_define() {
	$custom_meta_fields = array();
	$custom_meta_fields['user_group'] = 'Group ID';
	$custom_meta_fields['user_induction'] = 'Induction status';
	return $custom_meta_fields;
}

function mysite_columns($defaults) {
	$meta_number = 0;
	$custom_meta_fields = mysite_custom_define();
	foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	  $meta_number++;
	  $defaults[('mysite-usercolumn-' . $meta_number . '')] = __($meta_disp_name, 'user-column');
	}
	return $defaults;
  }
  
  function mysite_custom_columns($value, $column_name, $id) {
	$meta_number = 0;
	$custom_meta_fields = mysite_custom_define();
	foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	  $meta_number++;
	  if( $column_name == ('mysite-usercolumn-' . $meta_number . '') ) {
		return get_the_author_meta($meta_field_name, $id );
	  }
	}
  }




add_filter('manage_group_posts_columns', 'set_custom_edit_group_columns');

function set_custom_edit_group_columns($columns) {

    unset($columns['date']);

    $columns['group_id'] = 'Group ID';
    $columns['date'] = 'Date';

    return $columns;
}

add_action('manage_group_posts_custom_column' , 'custom_group_column', 10, 2);

function custom_group_column($column, $post_id) {
    switch ($column) {
        case 'group_id':
            echo $post_id;
            break;
    }
}
?>

<?php

// Block subscriber to access wp-admin
add_action( 'init', function() {

    $url = get_field('admin_user_redirection', 'option');

	if ( is_admin() && is_user_logged_in() && check_user_role(array('subscriber') )) {
		wp_redirect( $url );
		die();
	}
});

function check_user_role($roles, $user_id = null) {
    if ($user_id) $user = get_userdata($user_id);
    else $user = wp_get_current_user();
    if (empty($user)) return false;

    foreach ($user->roles as $role) {
        if (in_array($role, $roles)) {
            return true;
        }
    }
    return false;
}


/****************** Base ******************/
// Foundation
require_once( 'includes/tidy.php' );
require_once( 'includes/cms.php' );
require_once( 'includes/blocks.php' );
require_once( 'includes/cpt.php' );
require_once( 'includes/theme.php' );
require_once( 'includes/tinymce.php' );

// Custom
require_once( 'includes/walker.php' );
require_once( 'includes/custom.php' );
require_once( 'includes/ajax.php' );

// Plugins
require_once( 'includes/acf.php' );
require_once( 'includes/gf.php' );

/****************** Theme specific setup ******************/

// --------------------------------------------
// Custom Post Types
// --------------------------------------------
function base_cpt() {
    // add_cpt(cpt_name, label_single, label_plural, extra_settings)
    // add_cpt_tax(tax_name, cpt_names, label_single, label_plural)

    $args = [
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'page-attributes', 'editor'),
        'public' => true
    ];
    add_cpt('event', 'Event', 'Events', $args);

    $args = [
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'page-attributes', 'editor')
    ];
    add_cpt('group', 'Group', 'Groups', $args);
    //add_cpt_tax('age', ['group'], 'Age', 'Age');

    $args = [
        'menu_icon' => 'dashicons-testimonial',
        'supports' => array('title', 'page-attributes', 'editor')
    ];
    add_cpt('faq', 'FAQ', 'FAQs', $args);
    add_cpt_tax('faq-category', ['faq'], 'FAQ Category', 'FAQ Categories');

}

// --------------------------------------------
// Gutenberg Blocks
// --------------------------------------------
function base_blocks() {
    add_block('home-header', 'Home Header');
    add_block('image-header', 'Image Header');
    add_block('village-header', 'Village Header');
    add_block('text-header', 'Text Header');
    add_block('content-image', 'Content & Image');
    add_block('link-carousel', 'Link Carousel');
    add_block('content-stats', 'Content & Stats');
    add_block('content-editor', 'Content Editor');
    add_block('podcast', 'Podcast');
    add_block('instagram', 'Instagram');
    add_block('featured', 'Featured');
    add_block('testimonial', 'Testimonial');
    add_block('waitlist', 'Waitlist & Enrollment');
    add_block('faqs', 'FAQs');
    add_block('payment', 'Payment');
    add_block('payment-test', 'Payment - Testing');
    add_block('induction', 'Induction');
    add_block('team', 'Team');
    add_block('donation', 'Donation');
    add_block('events', 'Events');
    add_block('form', 'Form');
    add_block('groups', 'Group Listing');
    add_block('login', 'Login');
    add_block('reset', 'Reset Password');
}

add_filter( 'https_local_ssl_verify', '__return_true' );

/**
* The snippets below use 30 seconds for testing. If they help, try lowering the value.
* If you are still getting cURL timeouts after raising the timeout to 30 seconds, your host must investigate the issue further.
*/

// Setting a custom timeout value for cURL. Using a high value for priority to ensure the function runs after any other added to the same action hook.
add_action('http_api_curl', 'sar_custom_curl_timeout', 9999, 1);
function sar_custom_curl_timeout( $handle ){
	curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 30 ); // 30 seconds.
	curl_setopt( $handle, CURLOPT_TIMEOUT, 30 ); // 30 seconds.
}

// // Setting custom timeout for the HTTP request
add_filter( 'http_request_timeout', 'sar_custom_http_request_timeout', 9999 );
function sar_custom_http_request_timeout( $timeout_value ) {
	return 30; // 30 seconds.
}

// // Setting custom timeout in HTTP request args
add_filter('http_request_args', 'sar_custom_http_request_args', 9999, 1);
function sar_custom_http_request_args( $r ){
	$r['timeout'] = 30; // 30 seconds.
	return $r;
}


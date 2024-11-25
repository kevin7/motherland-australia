<?php


// --------------------------------------------
// Allow editor syle
// --------------------------------------------
add_editor_style( get_stylesheet_directory_uri() . '/dist/css/editor.css' );


// --------------------------------------------
// Button for tinymce
// --------------------------------------------

add_action( 'after_setup_theme', 'shortcodes_button_setup' );

if ( ! function_exists( 'shortcodes_button_setup' ) ) {
    function shortcodes_button_setup() {
        add_action( 'init', 'shortcodes_button' );
    }
}

if ( ! function_exists( 'shortcodes_button' ) ) {
    function shortcodes_button() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', 'add_shortcodes_button' );
        add_filter( 'mce_buttons_2', 'register_shortcodes_button' );
    }
}

if ( ! function_exists( 'add_shortcodes_button' ) ) {
    function add_shortcodes_button( $plugin_array ) {
        $plugin_array['shortcodes_button'] = get_template_directory_uri().'/dist/js/editor.js';
        return $plugin_array;
    }
}

if ( ! function_exists( 'register_shortcodes_button' ) ) {
    function register_shortcodes_button( $buttons ) {
        array_push( $buttons, 'instagram', 'facebook', 'button' , 'menu' );
        return $buttons;
    }
}

if ( ! function_exists( 'mce_buttons' ) ) {
    add_filter( 'mce_buttons', 'fb_mce_editor_buttons' );
    function fb_mce_editor_buttons( $buttons ) {
        array_shift( $buttons ); // remove format select
        array_unshift( $buttons, 'styleselect' ); // add style select
        return $buttons;
    }
}

// --------------------------------------------
// Add custom format to Classoc editor
// --------------------------------------------
add_filter( 'tiny_mce_before_init', function ( array $settings = [] ) {

	$formats = [];
	if ( ! empty( $settings['style_formats'] ) && is_string( $settings['style_formats'] ) ) {
			$formats = json_decode( $settings['style_formats'] );
			if ( ! is_array( $formats ) ) {
					$formats = [];
			}
	}
	
	$formats[] = [
		'title'  => 'Paragraph',
		'block' => 'p',
	];

	$formats[] = [
		'title'  => 'Large Paragraph',
		'block' => 'p',
		'classes' => 'lead'
	];

	$formats[] = [
		'title'  => 'Cursive',
		'block' => 'p',
		'classes' => 'cursive'
	];

	$formats[] = [
		'title'  => 'Highlight',
		'block' => 'p',
		'classes' => 'highlight'
	];

	$formats[] = [
		'title'  => 'Heading 1',
		'block' => 'h1',
	];

	$formats[] = [
		'title'  => 'Heading 2',
		'block' => 'h2',
	];

	$formats[] = [
		'title'  => 'Heading 3',
		'block' => 'h3',
	];

	$formats[] = [
		'title'  => 'Heading 4',
		'block' => 'h4',
	];

	$formats[] = [
		'title'  => 'Heading 5',
		'block' => 'h5',
	];

	$formats[] = [
		'title'  => 'Heading 6',
		'block' => 'h6',
	];

	$settings['style_formats'] = json_encode( $formats );

	return $settings;
} );



/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {
    if($post_type == 'post') {
        return false;
    }

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );
<?php
/*
ACF specific functions & Hook
*/

// --------------------------------------------
// Add Theme settings in admin
// --------------------------------------------
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme settings',
		'menu_title'	=> 'Theme settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}





// --------------------------------------------
// Link Component functions
// --------------------------------------------
function render_link($field_name = 'link', $classes = '', $post_id = null)
{
    $link = get_field($field_name, $post_id);
    if (!$link) {
        return false;
    }

    $html = "<a class='{$classes}' href='{$link['url']}' target='{$link['target']}' ><span>{$link['title']}</span></a>";
    return $html;
}
function render_sub_link($field_name = 'link', $classes = '')
{
    $link = get_sub_field($field_name);
    if (!$link) {
        return false;
    }

    $html = "<a class='{$classes}' href='{$link['url']}' ><span>{$link['title']}</span></a>";
    return $html;
}



function make_link($field_name = 'link', $classes = '', $post_id = null)
{

    $link = get_field($field_name, $post_id);

    if (!$link) {
        return null;
    }

    if ($link['link_type'] == 'none') {
        return null;
    }

    $link = format_link($link, $classes);

    return $link;
}

function make_sub_link($field_name = 'link', $classes = '')
{
    if (!get_sub_field($field_name)) {
        return null;
    }

    $link = format_link(get_sub_field($field_name), $classes);

    return $link;
}


function format_link($link, $classes = '')
{
    $formatted_link = new \stdClass();

    $formatted_link->target = $link['link_target'];
    $formatted_link->type = $link['link_type'];
    $formatted_link->text = $link['link_text'];
    $formatted_link->scroll_to = $link['link_scroll'];
    $formatted_link->url = null;
    if(isset($link['link_' . $link['link_type']])) {
        $formatted_link->url = $link['link_' . $link['link_type']];
    }
    $formatted_link->attributes = '';
    $formatted_link->classes = $classes;

    switch($formatted_link->type) {

        case "scroll":
        $formatted_link->attributes = "data-scroll-to=" . str_replace('#', '', $formatted_link->scroll_to);
        break;   

        case "modal":
        $formatted_link->attributes = "data-modal-open";
        break;   

        case "url" :    
        if($formatted_link->target) {
            $formatted_link->attributes = "target='_blank'";
        }
        break;

        case "file" :    
        if($formatted_link->target) {
            $formatted_link->attributes = "target='_blank'";
        }
        break;      
    }

    return $formatted_link;
}

/**
 * Render template part, exposing variables as needed.
 *
 * @param string $slug
 * @param array $params
 * @param bool $output
 *
 * @return mixed
 */
function render($slug, $params = null, $output = true)
{
    if (!$output) {
        ob_start();
    }

    if (!$template_file = locate_template("template-parts/{$slug}.php", false, false)) {
        trigger_error(sprintf("Error locating %s for inclusion", $slug), E_USER_ERROR);
    }

    if ($params) {
        if (is_object($params)) {
            $params = (array) $params;
        }
        extract($params, EXTR_OVERWRITE);
    }

    require($template_file);

    if (!$output) {
        return ob_get_clean();
    }
}



// --------------------------------------------
// Populate ACF select field options with Gravity Forms forms
// --------------------------------------------
function acf_populate_gf_forms_ids( $field ) {
    if ( class_exists( 'GFFormsModel' ) && is_admin()) {
        $choices = [];
        $choices[] = 'Select a form';
        foreach ( \GFFormsModel::get_forms() as $form ) {
            $choices[ $form->id ] = $form->title;
        }
        $field['choices'] = $choices;
    }
    return $field;
}

add_filter( 'acf/load_field/name=sub_popup', 'acf_populate_gf_forms_ids' );
add_filter( 'acf/load_field/name=gf_form', 'acf_populate_gf_forms_ids' );
add_filter( 'acf/load_field/name=gf_form_waitlist', 'acf_populate_gf_forms_ids' );
add_filter( 'acf/load_field/name=gf_form_payment', 'acf_populate_gf_forms_ids' );
    
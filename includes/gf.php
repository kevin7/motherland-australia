<?php
/*
Gravity Form specific functions & Hook
*/

// --------------------------------------------
// Remove GF top validation message
// --------------------------------------------
add_filter( 'gform_validation_message', 'prefix_gf_empty_validation_message', 10, 2 );
function prefix_gf_empty_validation_message( $message, $form ) {
  return "";
}

// --------------------------------------------
// Use HTML5 markup
// --------------------------------------------
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {

    $label = $form['button']['text'];

    return "<button class='c-button c-button--primary button gform_button' id='gform_submit_button_{$form['id']}'><span>{$label}</span></button>";
}




// --------------------------------------------
// Auto generate username
// --------------------------------------------
add_filter( 'gform_username_6', 'auto_username', 10, 4 );
function auto_username( $username, $feed, $form, $entry ) {
    GFCommon::log_debug( __METHOD__ . '(): running.' );
    
    
    $username = strtolower( sanitize_title(rgar( $entry, '11' ) . rgar( $entry, '12' )));
  
    if ( empty( $username ) ) {
        GFCommon::log_debug( __METHOD__ . '(): Value for username is empty.' );
        return $username;
    }
  
    if ( ! function_exists( 'username_exists' ) ) {
        require_once( ABSPATH . WPINC . '/registration.php' );
    }
  
    if ( username_exists( $username ) ) {
        GFCommon::log_debug( __METHOD__ . '(): Username already exists, generating a new one.' );
        $i = 2;
        while ( username_exists( $username . $i ) ) {
            $i++;
        }
        $username = $username . $i;
        GFCommon::log_debug( __METHOD__ . '(): New username: ' . $username );
    };
  
    return $username;
}



// --------------------------------------------
// Payment form: Add group to user
// --------------------------------------------
add_action( 'gform_user_registered', 'add_custom_user_meta', 10, 4 );
function add_custom_user_meta( $user_id, $feed, $entry, $user_pass ) {
    update_user_meta( $user_id, 'user_group', rgar( $entry, '15' ) );

    $entry['payment_status'] = 'Paid';
    GFAPI::update_entry($entry);

    die();

}

// --------------------------------------------
// Induction form: Mark user as completed induction
// --------------------------------------------
add_action( 'gform_after_submission_8', 'mark_induction', 10, 2 );
function mark_induction() {
    $user = wp_get_current_user();
    update_user_meta( $user->ID, 'user_induction', 1 );
}

// --------------------------------------------
// Payment form: Update payment status for coupon user
// --------------------------------------------
// add_filter( 'gform_payment_status', 'change_payment_status', 10, 3 );
// function change_payment_status( $payment_status, $form, $entry ){
//     echo '<h2>Payment status</h2>';
//     print_r($payment_status);
//     echo '<h2>Form</h2>';
//     print_r($form);
//     echo '<h2>Entry</h2>';
//     print_r($entry);

//     die();
//     return $payment_status;
// }
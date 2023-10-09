<?php

/*
Plugin Name: Business Name Suggestion
Plugin URI: https://example.com/business-name-suggestion
Description: Generates a business name suggestion based on user feedback.
Version: 1.0
Author: Your Name
Author URI: https://example.com
*/

// Add shortcode for the form
function bns_shortcode() {
    ob_start();
?>
    <form id="bns-form">
        <label for="feedback">What type of business are you starting?</label>
        <input type="text" id="feedback" name="feedback" required>
        <button type="submit">Generate Name</button>
    </form>
    <div id="bns-result"></div>
<?php
    return ob_get_clean();
}
add_shortcode( 'bns', 'bns_shortcode' );

// Add AJAX handler for generating name
function bns_generate_name() {
    $feedback = $_POST['feedback'];
    
    // You can replace this with your own logic for generating a name
    $name = ucfirst($feedback) . ' Co.';
    
    echo $name;
    wp_die();
}
add_action('wp_ajax_bns_generate_name', 'bns_generate_name');
add_action('wp_ajax_nopriv_bns_generate_name', 'bns_generate_name');

// Enqueue scripts
function bns_enqueue_scripts() {
    wp_enqueue_script('bns-script', plugin_dir_url( __FILE__ ) . 'script.js', array( 'jquery' ), '1.0', true);
    wp_localize_script('bns-script', 'bns_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('bns_generate_name')
    ));
}
add_action('wp_enqueue_scripts', 'bns_enqueue_scripts');

?>

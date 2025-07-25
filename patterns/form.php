<?php
/**
 * Block Pattern for a simple form with AJAX submission.
 * This pattern includes a form that submits data via AJAX and displays the result.
 * It also includes an admin page to view and manage the submitted data.
 * 
 * @package blockhive
 */
/**
 * Title: Form Pattern
 * Slug: my-theme/form-field
 * Categories: form
 * Description: A simple form with AJAX submission and admin page for data management.
 * Viewport width: 1600
 */

 // AJAX handler for form submission
 add_action('wp_ajax_sdp_submit_form', 'blockhive_sdp_handle_ajax_submission');
 add_action('wp_ajax_nopriv_sdp_submit_form', 'blockhive_sdp_handle_ajax_submission');

 function blockhive_sdp_handle_ajax_submission() {
    // Sanitize input
    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate
    if (empty($name) || !is_email($email) || empty($message)) {
        wp_send_json_error(['message' => 'All fields are required.']);
        exit;
    }

    // Insert into DB
    global $wpdb;
    $table_name = $wpdb->prefix . 'simple_data';
    $result = $wpdb->insert($table_name, [
        'name'    => $name,
        'email'   => $email,
        'message' => $message
    ]);

    // Handle DB errors
    if ($result === false) {
        wp_send_json_error(['message' => 'Database error: ' . $wpdb->last_error]);
        exit;
    }

    // Success
    wp_send_json_success(['message' => 'Data Sent Succesfully!']);
    exit;
 }

 // The form markup for the block pattern.
 // This static HTML block will be inserted into the editor.
?>
<!-- wp:html -->
<form id="simple-data-form" style="margin-bottom: 20px;">
    <label for="name" style="display: block; margin-bottom: 5px;">Name:</label>
    <input type="text" id="name" name="name" style="width: 100%; max-width: 300px; padding: 8px; margin-bottom: 10px;" required>

    <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
    <input type="email" id="email" name="email" style="width: 100%; max-width: 300px; padding: 8px; margin-bottom: 10px;" required>

    <label for="message" style="display: block; margin-bottom: 5px;">Message:</label>
    <textarea id="message" name="message" style="width: 100%; max-width: 300px; padding: 8px; margin-bottom: 10px;" required></textarea>

    <button type="submit" style="padding: 10px 20px; background: #0073aa; color: #fff; border: none; cursor: pointer;">Submit</button>
</form>
<div id="sdp-message"></div>
<!-- /wp:html -->



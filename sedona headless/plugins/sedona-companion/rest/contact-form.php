<?php
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/contact-form-info-post', [
        'methods' => 'POST',
        'callback' => 'handle_contact_form_submission',
        'permission_callback' => '__return_true', // Public endpoint
    ]);
});

function handle_contact_form_submission($request) {
    $data = $request->get_json_params();

    // Log data to PHP error log
    error_log(print_r($data, true));

    // Optional: Save to database or send email
    // wp_insert_post([...]) or wp_mail(...)

    return [
        'success' => true,
        'message' => 'Contact form submitted successfully! I am from backend',
        'received' => $data // Return received data
    ];
}

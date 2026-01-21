<?php
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/comment-submit', [
        'methods' => 'POST',
        'callback' => 'handle_comment_submission',
        'permission_callback' => '__return_true', // public
    ]);
});

function handle_comment_submission($request) {
    $data = $request->get_json_params();

    if (!isset($data['comment'], $data['name'], $data['email'])) {
        return [
            'success' => false,
            'message' => 'Missing required fields.'
        ];
    }

    // Insert comment
    $commentdata = [
        'comment_post_ID' => $data['postId'],
        'comment_author' => sanitize_text_field($data['name']),
        'comment_author_email' => sanitize_email($data['email']),
        'comment_author_url' => esc_url($data['website'] ?? ''),
        'comment_content' => sanitize_textarea_field($data['comment']),
        'comment_approved' => 1, // auto approve
    ];

    $comment_id = wp_insert_comment($commentdata);

    if ($comment_id) {
        return [
            'success' => true,
            'message' => 'Comment submitted successfully!'
        ];
    }

    return [
        'success' => false,
        'message' => 'Failed to submit comment.'
    ];
}

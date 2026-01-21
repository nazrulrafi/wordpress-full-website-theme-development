<?php
// Add custom roles
function rethouse_add_roles() {
    add_role('agent', 'Agent', [
        'read' => true,
        'edit_posts' => true,
        'upload_files' => true,
    ]);

    add_role('agency', 'Agency', [
        'read' => true,
        'edit_posts' => true,
        'upload_files' => true,
        'publish_posts' => true,
    ]);
}
register_activation_hook(__FILE__, 'rethouse_add_roles');

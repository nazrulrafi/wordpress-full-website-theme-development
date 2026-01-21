<?php
/**
 * Plugin Name: Agent Contact
 * Description: Adds Properties, Agents, and Agencies CPT with frontend dashboards.
 * Version: 1.0
 * Author: Nazrul Rafi
 */

if (!defined('ABSPATH')) exit;

// Create database table on plugin activation
register_activation_hook(__FILE__, function() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'agent_contact';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        phone varchar(50) NOT NULL,
        email varchar(255) NOT NULL,
        message text NOT NULL,
        agent_name varchar(255) NOT NULL,
        agency_name varchar(255) NOT NULL,
        property_id bigint(20) NOT NULL,
        property_name varchar(255) NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
});

// Add menu item
add_action('admin_menu', function() {
    add_menu_page(
        'Agent Contact',
        'Agent Contact',
        'manage_options',
        'agent-contact',
        'agent_contact_page_callback',
        'dashicons-phone',
        20
    );
});

// Callback for admin page
function agent_contact_page_callback() {
    global $wpdb;

    // Handle bulk delete
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && !empty($_POST['contact'])) {
        check_admin_referer('bulk-contacts');
        $ids = array_map('absint', $_POST['contact']);
        $wpdb->query("DELETE FROM {$wpdb->prefix}agent_contact WHERE id IN (" . implode(',', $ids) . ")");
    }

    // Fetch data
    $table = new ContactAgent();
    $table->set_data($wpdb->get_results("SELECT * FROM {$wpdb->prefix}agent_contact ORDER BY submitted_at DESC", ARRAY_A));

    echo '<div class="wrap"><h2>Agent Contact</h2>';
    ?>
    <form method="post">
        <?php wp_nonce_field('bulk-contacts'); ?>
        <?php $table->prepare_items(); $table->display(); ?>
    </form>
    <div id="edit-contact-modal" style="display:none;">
        <div class="modal-content">
            <h3>Edit Contact</h3>
            <form id="edit-contact-form">
                <input type="hidden" name="id" id="edit-contact-id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" id="edit-phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" id="edit-message" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('edit-contact-modal').style.display='none';">Cancel</button>
            </form>
        </div>
    </div>
    <style>
        #edit-contact-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; }
        .modal-content { background: #fff; padding: 20px; border-radius: 5px; width: 400px; }
        .form-group { margin-bottom: 15px; }
        .form-control { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 15px; margin-right: 10px; }
        .btn-primary { background: #0073aa; color: #fff; border: none; }
        .btn-secondary { background: #ccc; color: #000; border: none; }
    </style>
    <?php
    echo '</div>';
}

// Include required files
require_once plugin_dir_path(__FILE__) . 'inc/contactAgent.php';

// Enqueue scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('agent-contact-ajax', plugin_dir_url(__FILE__) . 'js/script.js', [], '1.0', true);
    wp_localize_script('agent-contact-ajax', 'agentContact', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('agent_contact_nonce')
    ]);
});
add_action('admin_enqueue_scripts', function($hook) {
    if ($hook !== 'toplevel_page_agent-contact') return;
    wp_enqueue_script('agent-contact-admin', plugin_dir_url(__FILE__) . 'js/script.js', [], '1.0', true);
    wp_localize_script('agent-contact-admin', 'agentContact', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('agent_contact_nonce')
    ]);
});

// AJAX handlers
add_action('wp_ajax_agent_contact_submit', 'agent_contact_submit');
add_action('wp_ajax_nopriv_agent_contact_submit', 'agent_contact_submit');
function agent_contact_submit() {
    check_ajax_referer('agent_contact_nonce', 'nonce');
    global $wpdb;
    $data = [
        'name' => sanitize_text_field($_POST['name']),
        'phone' => sanitize_text_field($_POST['phone']),
        'email' => sanitize_email($_POST['email']),
        'message' => sanitize_textarea_field($_POST['message']),
        'agent_name' => sanitize_text_field($_POST['agentName']),
        'agency_name' => sanitize_text_field($_POST['agencyName']),
        'property_id' => absint($_POST['propertyId']),
        'property_name' => sanitize_text_field(get_the_title(absint($_POST['propertyId'])))
    ];
    $wpdb->insert($wpdb->prefix . 'agent_contact', $data);
    wp_send_json_success(['message' => 'Message sent successfully!']);
}

add_action('wp_ajax_agent_contact_delete', 'agent_contact_delete');
function agent_contact_delete() {
    check_ajax_referer('agent_contact_nonce', 'nonce');
    global $wpdb;
    $id = absint($_POST['id']);
    $wpdb->delete($wpdb->prefix . 'agent_contact', ['id' => $id]);
    wp_send_json_success(['message' => 'Contact deleted successfully!']);
}

add_action('wp_ajax_agent_contact_edit', 'agent_contact_edit');
function agent_contact_edit() {
    check_ajax_referer('agent_contact_nonce', 'nonce');
    global $wpdb;
    $id = absint($_POST['id']);
    $data = [
        'name' => sanitize_text_field($_POST['name']),
        'phone' => sanitize_text_field($_POST['phone']),
        'email' => sanitize_email($_POST['email']),
        'message' => sanitize_textarea_field($_POST['message'])
    ];
    $wpdb->update($wpdb->prefix . 'agent_contact', $data, ['id' => $id]);
    wp_send_json_success(['message' => 'Contact updated successfully!']);
}

add_action('wp_ajax_agent_contact_get', 'agent_contact_get');
function agent_contact_get() {
    check_ajax_referer('agent_contact_nonce', 'nonce');
    global $wpdb;
    $id = absint($_POST['id']);
    $contact = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}agent_contact WHERE id = %d", $id), ARRAY_A);
    wp_send_json_success($contact);
}
?>
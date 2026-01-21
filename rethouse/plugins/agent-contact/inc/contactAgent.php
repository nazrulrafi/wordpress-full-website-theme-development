<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class ContactAgent extends WP_List_Table {
    function __construct($args = []) {
        parent::__construct([
            'singular' => 'contact',
            'plural' => 'contacts',
            'ajax' => false
        ]);
    }

    function set_data($data) {
        $this->items = $data;
    }

    function get_columns() {
        return [
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'agent-contact'),
            'phone' => __('Phone', 'agent-contact'),
            'email' => __('Email', 'agent-contact'),
            'message' => __('Message', 'agent-contact'),
            'agent_name' => __('Agent Name', 'agent-contact'),
            'agency_name' => __('Agency Name', 'agent-contact'),
            'property_name' => __('Property Name', 'agent-contact'),
            'submitted_at' => __('Submitted At', 'agent-contact'),
            'actions' => __('Actions', 'agent-contact')
        ];
    }

    function get_bulk_actions() {
        return ['delete' => __('Delete', 'agent-contact')];
    }

    function column_cb($item) {
        return sprintf('<input type="checkbox" name="contact[]" value="%s" />', $item['id']);
    }

    function column_actions($item) {
        return sprintf(
            '<a href="#0" class="edit-contact" data-id="%s">Edit</a> | <a href="#0" class="delete-contact" data-id="%s">Delete</a>',
            $item['id'], $item['id']
        );
    }

    function column_default($item, $column_name) {
        return esc_html($item[$column_name]);
    }

    function prepare_items() {
        $this->_column_headers = [$this->get_columns(), [], $this->get_bulk_actions()];
        $per_page = 20;
        $current_page = $this->get_pagenum();
        $total_items = count($this->items);
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page' => $per_page
        ]);
        $this->items = array_slice($this->items, ($current_page - 1) * $per_page, $per_page);
    }
}
?>
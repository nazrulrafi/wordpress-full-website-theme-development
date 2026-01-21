<?php
if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class AgentContact extends WP_List_Table{
    function __construct($args = array()) {
        parent::__construct($args);
    }

    function set_data($data) {
        $this->items = $data;
    }
    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'rethouse-companion'),
            'phone' => __('Phone', 'rethouse-companion'),
            'email' => __('Email', 'rethouse-companion'),
            'message' => __('Message', 'rethouse-companion'),
            'agent_name' => __('Agent Name', 'rethouse-companion'),
            'agency_name' => __('Agency Name', 'rethouse-companion'),
            'property_name' => __('Property Name', 'rethouse-companion'),
        );
        return $columns;
    }
    function prepare_items() {
        $this->_column_headers = array($this->get_columns());
    }
    function column_default($item, $column_name) {
        return $item[$column_name];
    }
}


<?php
class HeaderMenu extends Walker_Nav_Menu {
    // Start <li>
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Add Bootstrap class for parent menu items
        $has_children = in_array('menu-item-has-children', $classes);
        $class_names  = $has_children ? 'nav-item dropdown' : 'nav-item';

        $output .= '<li class="' . esc_attr($class_names) . '">';

        // Link attributes
        $atts = [];
        $atts['class'] = $has_children ? 'nav-link dropdown-toggle' : 'nav-link';
        $atts['href']  = !empty($item->url) ? $item->url : '';
        if ($has_children) {
            $atts['data-toggle'] = 'dropdown';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
        }

        $output .= '<a' . $attributes . '>' . esc_html($item->title) . '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

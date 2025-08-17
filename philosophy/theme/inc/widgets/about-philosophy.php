<?php
class Philosophy_About_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
                'philosophy_about_widget',
                __('About Philosophy', 'philosophy'),
                ['description' => __('Displays About Philosophy info with social links', 'philosophy')]
        );
    }

    // Widget admin form
    public function form($instance) {
        $title       = !empty($instance['title']) ? $instance['title'] : '';
        $description = !empty($instance['description']) ? $instance['description'] : '';
        $facebook    = !empty($instance['facebook']) ? $instance['facebook'] : '';
        $twitter     = !empty($instance['twitter']) ? $instance['twitter'] : '';
        $instagram   = !empty($instance['instagram']) ? $instance['instagram'] : '';
        $pinterest   = !empty($instance['pinterest']) ? $instance['pinterest'] : '';
        ?>
        <p>
            <label>Title:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label>Description:</label>
            <textarea class="widefat" rows="4" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <p>
            <label>Facebook URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo esc_attr($facebook); ?>">
        </p>
        <p>
            <label>Twitter URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo esc_attr($twitter); ?>">
        </p>
        <p>
            <label>Instagram URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo esc_attr($instagram); ?>">
        </p>
        <p>
            <label>Pinterest URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo esc_attr($pinterest); ?>">
        </p>
        <?php
    }

    // Save widget form values
    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title']       = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_textarea_field($new_instance['description']) : '';
        $instance['facebook']    = (!empty($new_instance['facebook'])) ? esc_url_raw($new_instance['facebook']) : '';
        $instance['twitter']     = (!empty($new_instance['twitter'])) ? esc_url_raw($new_instance['twitter']) : '';
        $instance['instagram']   = (!empty($new_instance['instagram'])) ? esc_url_raw($new_instance['instagram']) : '';
        $instance['pinterest']   = (!empty($new_instance['pinterest'])) ? esc_url_raw($new_instance['pinterest']) : '';
        return $instance;
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];

        // Title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
        }

        // Description
        if (!empty($instance['description'])) {
            echo '<p>' . esc_html($instance['description']) . '</p>';
        }

        // Social links
        echo '<ul class="about__social">';
        if (!empty($instance['facebook'])) {
            echo '<li><a href="'.esc_url($instance['facebook']).'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
        }
        if (!empty($instance['twitter'])) {
            echo '<li><a href="'.esc_url($instance['twitter']).'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
        }
        if (!empty($instance['instagram'])) {
            echo '<li><a href="'.esc_url($instance['instagram']).'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
        }
        if (!empty($instance['pinterest'])) {
            echo '<li><a href="'.esc_url($instance['pinterest']).'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
        }
        echo '</ul>';

        echo $args['after_widget'];
    }

}
?>

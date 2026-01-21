<?php
class Footer_Info_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'footer_info_widget',
            __('Footer Info Widget', 'mytheme'),
            array( 'description' => __( 'Shows logo, description, and contact info in footer', 'mytheme' ) )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // ✅ Get widget ID from $args
        $widget_id = $args['widget_id'];

        // ✅ Get ACF image field for this widget
        $image = get_field('footer_widget_img', 'widget_' . $widget_id);

        // Debug (optional):
        // echo "<p style='color:#fff;'>"; var_dump($image); echo "</p>";

        if ($image) {
            // If field returns ID
            if (is_numeric($image)) {
                $imgUrl = wp_get_attachment_image_url($image, 'full');
            }
            // If field returns array
            elseif (is_array($image) && isset($image['url'])) {
                $imgUrl = $image['url'];
            }
            // If field returns URL
            else {
                $imgUrl = $image;
            }

            ?>
            <figure>
                <img src="<?= esc_url($imgUrl); ?>" alt="Footer Logo" class="logo-footer">
            </figure>
            <?php
        }

        ?>
        <p><?php echo !empty($instance['description']) ? esc_html($instance['description']) : 'Add your footer description here.'; ?></p>

        <ul class="list-unstyled mb-0 mt-3">
            <?php if (!empty($instance['address'])) : ?>
                <li><b><i class="fa fa-map-marker"></i></b><span><?php echo esc_html($instance['address']); ?></span></li>
            <?php endif; ?>
            <?php if (!empty($instance['phone1'])) : ?>
                <li><b><i class="fa fa-phone-square"></i></b><span><?php echo esc_html($instance['phone1']); ?></span></li>
            <?php endif; ?>
            <?php if (!empty($instance['phone2'])) : ?>
                <li><b><i class="fa fa-phone-square"></i></b><span><?php echo esc_html($instance['phone2']); ?></span></li>
            <?php endif; ?>
            <?php if (!empty($instance['email'])) : ?>
                <li><b><i class="fa fa-headphones"></i></b><span><?php echo esc_html($instance['email']); ?></span></li>
            <?php endif; ?>
            <?php if (!empty($instance['hours'])) : ?>
                <li><b><i class="fa fa-clock-o"></i></b><span><?php echo esc_html($instance['hours']); ?></span></li>
            <?php endif; ?>
        </ul>

        <?php
        echo $args['after_widget'];
    }


    public function form( $instance ) {
        $description = !empty($instance['description']) ? $instance['description'] : '';
        $address     = !empty($instance['address']) ? $instance['address'] : '';
        $phone1      = !empty($instance['phone1']) ? $instance['phone1'] : '';
        $phone2      = !empty($instance['phone2']) ? $instance['phone2'] : '';
        $email       = !empty($instance['email']) ? $instance['email'] : '';
        $hours       = !empty($instance['hours']) ? $instance['hours'] : '';
        ?>

        <p><label>Description:</label><textarea class="widefat" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($description); ?></textarea></p>
        <p><label>Address:</label><input class="widefat" type="text" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo esc_attr($address); ?>"></p>
        <p><label>Phone 1:</label><input class="widefat" type="text" name="<?php echo $this->get_field_name('phone1'); ?>" value="<?php echo esc_attr($phone1); ?>"></p>
        <p><label>Phone 2:</label><input class="widefat" type="text" name="<?php echo $this->get_field_name('phone2'); ?>" value="<?php echo esc_attr($phone2); ?>"></p>
        <p><label>Email:</label><input class="widefat" type="email" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo esc_attr($email); ?>"></p>
        <p><label>Opening Hours:</label><input class="widefat" type="text" name="<?php echo $this->get_field_name('hours'); ?>" value="<?php echo esc_attr($hours); ?>"></p>

        <?php
    }
}

// Register widget
function register_footer_info_widget() {
    register_widget( 'Footer_Info_Widget' );
}
add_action( 'widgets_init', 'register_footer_info_widget' );


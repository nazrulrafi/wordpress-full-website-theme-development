<?php
$gallery = get_field('gallery_post'); // ACF gallery field (return array of IDs)

?>

<div class="s-content__slider slider">
    <div class="slider__slides">
        <?php foreach ( $gallery as $image_id ) :
            // Get URLs for different sizes
            $thumb   = wp_get_attachment_image_url( $image_id, 'full' );   // adjust size name
            ?>
            <div class="slider__slide">
                <img
                    src="<?= esc_url($thumb) ?>"
                    alt=""
                    style="width: 100%"
                >
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .slick-slider .slick-dots{
        margin-top: -5rem!important;
    }
</style>
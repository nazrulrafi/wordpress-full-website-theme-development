<?php
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
if ( $thumbnail ) : ?>
    <div class="s-content__post-thumb">
        <img style="width: 100%" src="<?= esc_url($thumbnail[0]) ?>"
             srcset="<?= esc_url($thumbnail[0]) ?>"
             alt="">
    </div>
<?php endif; ?>

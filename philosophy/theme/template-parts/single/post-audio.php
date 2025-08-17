<?php
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$audio = get_field('audio', $post->ID);

?>

<div class="s-content__post-thumb">
    <img src="<?= esc_url($thumbnail[0]) ?>"
         srcset="<?= esc_url($thumbnail[0]) ?>"
         style="width: 100%" alt="" >

    <div class="audio-wrap">
        <audio id="player2" src="<?= $audio?>" width="100%" height="42" controls="controls"></audio>
    </div>
</div>

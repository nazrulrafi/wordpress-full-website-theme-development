<?php
$video_url = get_field('video_url', $post->ID);
?>
<div class="video-container">
    <iframe src="<?= $video_url?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
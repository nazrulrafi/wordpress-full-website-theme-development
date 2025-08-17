<?php
$title = get_the_title($post->ID);
$link = get_field('link', $post->ID);
?>
<article class="masonry__brick entry format-link" data-aos="fade-up">

    <div class="entry__thumb">
        <div class="link-wrap">
            <p><?= $title?></p>
            <cite>
                <a target="_blank" href="<?= $link?>"><?= $link?></a>
            </cite>
        </div>
    </div>

</article> <!-- end article -->
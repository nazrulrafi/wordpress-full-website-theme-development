<?php
$quote = get_field('quote', $post->ID);
$name = get_field('name', $post->ID);

?>
<article class="masonry__brick entry format-quote" data-aos="fade-up">

    <div class="entry__thumb">
        <blockquote>
            <p><?= $quote?></p>

            <cite><?= $name?></cite>
        </blockquote>
    </div>

</article> <!-- end article -->
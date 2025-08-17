<?php
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'philosophy-thumb-square' );
$title = get_the_title($post->ID);
$content = get_the_content($post->ID);
$excerpt = wp_trim_words( $content, 30,'...' );
$permalink= get_the_permalink($post->ID);
$date = get_the_date('F j, Y', $post->ID);
$categories = get_the_category($post->ID);
$audio = get_field('audio', $post->ID);

?>
<article class="masonry__brick entry format-audio" data-aos="fade-up">

    <div class="entry__thumb">
        <a href="<?= $permalink?>" class="entry__thumb-link">
            <img src="<?= esc_url($thumbnail[0]) ?>" srcset="<?= esc_url($thumbnail[0]) ?>" alt="">
        </a>
        <div class="audio-wrap">
            <audio id="player" src="<?= $audio?>" width="100%" height="42" controls="controls"></audio>
        </div>
    </div>

    <div class="entry__text">
        <div class="entry__header">
            <div class="entry__date">
                <a href="<?= $permalink?>" ><?= $date?></a>
            </div>
            <h1 class="entry__title"><a href="<?= $permalink?>" ><?= $title?></a></h1>

        </div>
        <div class="entry__excerpt">
            <p>
                <?= $excerpt?>
            </p>
        </div>
        <div class="entry__meta">
            <span class="entry__meta-links">
                <span class="entry__meta-links">
                 <?php
                 if ( $categories ) {
                     shuffle($categories);
                     $random_cats = array_slice($categories, 0, 2);
                     foreach ( $random_cats as $cat ) {
                         // Use category ID to get the correct URL
                         $cat_link = get_category_link( $cat->term_id );
                         echo '<a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat->name ) . '</a>';
                     }
                 }
                 ?>

                </span>

            </span>
        </div>
    </div>

</article> <!-- end article -->
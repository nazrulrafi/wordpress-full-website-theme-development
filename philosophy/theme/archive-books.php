<?php
get_header();
?>


    <!-- s-content
    ================================================== -->
    <section class="s-content">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                    <h1><?php __("ALl Books","philosophy")?></h1>
            </div>
        </div>




        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>

                <?php
                while ( have_posts() ) :
                    the_post();
                    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'philosophy-book-image' );
                    $author = get_field('author_name');
                    $title = get_the_title($post->ID);
                    $permalink = get_the_permalink($post->ID);
                ?>
                    <article class="masonry__brick entry format-standard aos-init aos-animate" data-aos="fade-up" style="position: absolute; left: 50%; top: 1526px;">

                        <div class="entry__thumb">
                            <a href="<?= $permalink?>" class="entry__thumb-link">
                                <img src="<?= esc_url($thumbnail[0])?>" srcset="<?= esc_url($thumbnail[0])?>" alt="">
                            </a>
                        </div>

                        <div class="entry__text">
                            <div class="entry__header">
                                <div class="entry__date">
                                    <a href="<?= $permalink?>"><?= $author?></a>
                                </div>
                                <h1 class="entry__title"><a href="<?= $permalink?>"><?= $title?></a></h1>

                            </div>
                        </div>

                    </article>

                <?php
                endwhile;
                ?>

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        <?php
                        global $wp_query;

                        $big = 999999999; // unlikely integer

                        $current = max(1, get_query_var('paged'));
                        $total   = $wp_query->max_num_pages;

                        // Previous page
                        if ($current > 1) {
                            echo '<li><a class="pgn__prev" href="' . get_pagenum_link($current - 1) . '">Prev</a></li>';
                        } else {
                            echo '<li><span class="pgn__prev disabled">Prev</span></li>';
                        }

                        // Page links
                        for ($i = 1; $i <= $total; $i++) {
                            if ($i == $current) {
                                echo '<li><span class="pgn__num current">' . $i . '</span></li>';
                            } elseif ($i <= 5 || $i == $total) { // show first 5 and last page
                                echo '<li><a class="pgn__num" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
                            } elseif ($i == 6) {
                                echo '<li><span class="pgn__num dots">…</span></li>';
                            }
                        }

                        // Next page
                        if ($current < $total) {
                            echo '<li><a class="pgn__next" href="' . get_pagenum_link($current + 1) . '">Next</a></li>';
                        } else {
                            echo '<li><span class="pgn__next disabled">Next</span></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->


    <!-- s-extra
    ================================================== -->
<?php
get_template_part('template-parts/parts/sec', 'extra');
?>

<?php
get_footer();
?>
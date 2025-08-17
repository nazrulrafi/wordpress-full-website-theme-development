<?php
    get_header();
?>





<!-- s-content
================================================== -->
<section class="s-content">

    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="grid-sizer"></div>

           <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/post-formats/post', get_post_format() );
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
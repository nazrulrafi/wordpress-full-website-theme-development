<?php
get_header();
?>

<!-- s-content
================================================== -->
<section class="s-content">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">

            <?php if ( have_posts() ) : ?>
                <h1>You are searching : <?php echo esc_html( get_search_query() ); ?></h1>
            <?php else : ?>
                <h1>No results found for: <?php echo esc_html( get_search_query() ); ?></h1>
            <?php endif; ?>

        </div>
    </div>

    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/post-formats/post', get_post_format() );
                endwhile;
            endif;
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

                    $current = max( 1, get_query_var('paged') );
                    $total   = $wp_query->max_num_pages;

                    // Previous page
                    if ( $current > 1 ) {
                        echo '<li><a class="pgn__prev" href="' . get_pagenum_link( $current - 1 ) . '">Prev</a></li>';
                    } else {
                        echo '<li><span class="pgn__prev disabled">Prev</span></li>';
                    }

                    // Page links
                    for ( $i = 1; $i <= $total; $i++ ) {
                        if ( $i == $current ) {
                            echo '<li><span class="pgn__num current">' . $i . '</span></li>';
                        } elseif ( $i <= 5 || $i == $total ) { // show first 5 and last page
                            echo '<li><a class="pgn__num" href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
                        } elseif ( $i == 6 ) {
                            echo '<li><span class="pgn__num dots">…</span></li>';
                        }
                    }

                    // Next page
                    if ( $current < $total ) {
                        echo '<li><a class="pgn__next" href="' . get_pagenum_link( $current + 1 ) . '">Next</a></li>';
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
get_template_part( 'template-parts/parts/sec', 'extra' );
?>

<?php
get_footer();
?>

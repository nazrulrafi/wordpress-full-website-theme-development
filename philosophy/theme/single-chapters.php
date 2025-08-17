<?php
get_header();
?>

    <!-- s-content
    ================================================== -->
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $title = get_the_title($post->ID);
        $content = get_the_content($post->ID);
        $permalink = get_the_permalink($post->ID);
        ?>

        <section class="s-content s-content--narrow s-content--no-padding-bottom chapter-content-main">
            <div class="row">
                <div class="col-twelve">
                    <article class="row format-standard chapter-content-wrap">
                        <div class="left-content">
                            <div class="s-content__header chapter-header-wrap col-full">
                                <h1 class="s-content__header-title">
                                    <?=$title ?>
                                </h1>
                            </div>
                            <div class="col-full s-content__main">
                                <h5 class="book-summary">Chapter Summary</h5>
                                <?= $content ?>

                            </div>
                        </div>
                        <div class="right-content">

                            <h5 class="book-summary">Book Name & Image</h5>

                            <?php
                            // Get the current chapter's linked book
                            $book_id = get_field('book_name'); // returns WP_Post object

                            if ( $book_id ) :
                                $book_name = get_the_title($book_id);
                                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($book_id), 'philosophy-book-image');
                                $permalink = get_permalink($book_id);
                                ?>
                                <p><strong>Book:</strong> <?php echo esc_html($book_name); ?></p>
                                <div class="s-content__media col-full" style="margin-top: 0">
                                    <?php
                                    if ( $thumbnail ) : ?>
                                        <div class="s-content__post-thumb">
                                            <a href="<?=$permalink?>">
                                                <img style="width: 250px" src="<?= esc_url($thumbnail[0]) ?>"
                                                     srcset="<?= esc_url($thumbnail[0]) ?>"
                                                     alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div style="text-align: center; margin: 20px 0">
                                        <a class="btn btn--primary full-width" href="/blog">Buy From Amazone</a>
                                    </div>
                                </div>


                                <h5 class="book-summary">Book Chapters</h5>
                                <ul class="book-chapter" >
                                    <?php
                                    // Query all chapters of this book
                                    $chapters = new WP_Query([
                                            'post_type'      => 'chapters',
                                            'posts_per_page' => -1,
                                            'meta_query'     => [
                                                    [
                                                            'key'     => 'book_name',   // ACF field name
                                                            'value'   => $book_id,
                                                            'compare' => '='
                                                    ]
                                            ],
                                            'orderby'        => 'menu_order',
                                            'order'          => 'ASC'
                                    ]);

                                    if ( $chapters->have_posts() ) :
                                        $i = 1;
                                        while ( $chapters->have_posts() ) : $chapters->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo $i . '. ' . get_the_title(); ?>
                                                </a>
                                            </li>
                                            <?php
                                            $i++;
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        echo '<li>No chapters found for this book.</li>';
                                    endif;
                                    ?>
                                </ul>

                            <?php else : ?>
                                <p>No book assigned for this chapter.</p>
                            <?php endif; ?>

                        </div>
                    </article>
                </div>
            </div>
        </section> <!-- s-content -->

    <?php
    endwhile;
endif;
?>

    <!-- s-extra
    ================================================== -->
<?php
get_template_part('template-parts/parts/sec', 'extra');
?>


<?php
get_footer();
?>
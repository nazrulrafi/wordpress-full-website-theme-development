<?php
get_header();
?>

    <!-- s-content
    ================================================== -->
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'philosophy-book-image');
        $title = get_the_title($post->ID);
        $content = get_the_content($post->ID);
        $permalink = get_the_permalink($post->ID);
        ?>

        <section class="s-content s-content--narrow s-content--no-padding-bottom book-content-main">
            <div class="row">
                <div class="col-twelve">
                    <article class="row format-standard book-content-wrap">
                        <div class="left-content">
                            <div class="s-content__media col-full">
                                <?php
                                if ( $thumbnail ) : ?>
                                    <div class="s-content__post-thumb">
                                        <img src="<?= esc_url($thumbnail[0]) ?>"
                                             srcset="<?= esc_url($thumbnail[0]) ?>"
                                             alt="">
                                    </div>
                                <?php endif; ?>
                                <div style="text-align: center; margin-top: 20px">
                                    <a class="btn btn--primary full-width" href="/blog">Buy From Amazone</a>
                                </div>
                            </div>
                        </div>
                        <div class="right-content">
                            <div class="s-content__header book-header-wrap col-full">
                                <h1 class="s-content__header-title">
                                    <?=$title ?>
                                </h1>
                            </div>
                            <div class="col-full s-content__main">
                                <h5 class="book-summary">Book Summary</h5>
                                <?php echo wp_kses_post($content); ?>

                                <h5 class="book-summary">Book Chapters</h5>
                                <ul class="book-chapter">
                                    <?php
                                    // Get current book ID
                                    $book_id = get_the_ID();

                                    // Query chapters where book_name field matches this book
                                    $chapters = new WP_Query([
                                            'post_type'      => 'chapters',
                                            'posts_per_page' => -1,
                                            'meta_query'     => [
                                                    [
                                                            'key'     => 'book_name',   // ACF field name
                                                            'value'   => $book_id,
                                                            'compare' => '='
                                                    ]
                                            ]
                                    ]);

                                    if ( $chapters->have_posts() ) :
                                        $i=1;
                                        while ( $chapters->have_posts() ) : $chapters->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                        $title = get_the_title();
                                                        echo "$i. $title";
                                                    ?>
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
                                <h5 class="book-summary">Writer Info</h5>
                                <?php
                                $author_name     = get_field('author_name', get_the_ID());
                                $author_img_id   = get_field('author_image', get_the_ID());
                                $author_img_url  = $author_img_id ? wp_get_attachment_image_src($author_img_id, 'full')[0] : '';
                                $about_author    = get_field('about_author', get_the_ID());
                                ?>

                                <div class="writter-info-wrap">
                                    <div class="author-img-wrap">
                                        <?php if ($author_img_url): ?>
                                            <img src="<?php echo esc_url($author_img_url); ?>" alt="<?php echo esc_attr($author_name); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="author-about">
                                        <h4 class="author-name">
                                            <a href="javascript:void(0)">
                                                <?php echo esc_html($author_name); ?>
                                            </a>
                                        </h4>

                                        <?php if ($about_author): ?>
                                            <p><?php echo esc_html($about_author); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                            </div>
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
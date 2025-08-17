<section class="s-extra">

    <div class="row top">

        <div class="col-eight md-six tab-full popular">
            <h3>Popular Posts</h3>

            <div class="block-1-2 block-m-full popular__posts">
                <?php
                $popular_posts = new WP_Query([
                    'posts_per_page' => 6,
                    'orderby'        => 'comment_count',
                    'order'          => 'DESC',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => ['post-format-quote'],
                            'operator' => 'NOT IN'
                        ]
                    ]
                ]);

                if ($popular_posts->have_posts()) :
                    while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>

                        <article class="col-block popular__post">

                            <a href="<?php the_permalink(); ?>" class="popular__thumb">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('thumbnail'); // you can change size
                                } else { ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbs/small/default.jpg" alt="<?php the_title_attribute(); ?>">
                                <?php } ?>
                            </a>

                            <h5>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>

                            <section class="popular__meta">
                <span class="popular__author">
                    <span>By</span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a>
                </span>
                                <span class="popular__date">
                    <span>on</span>
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date('M d, Y'); ?>
                    </time>
                </span>
                            </section>

                        </article>

                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div> <!-- end popular_posts -->
        </div> <!-- end popular -->

        <div class="col-four md-six tab-full about">
            <?php if (is_active_sidebar('about-philosophy')) : ?>
                    <?php dynamic_sidebar('about-philosophy'); ?>
            <?php endif; ?>

        </div> <!-- end about -->

    </div> <!-- end row -->

    <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <?php
                $tags = get_tags([
                    'hide_empty' => false, // show all tags, even with 0 posts
                    'orderby'    => 'name',
                    'order'      => 'ASC'
                ]);

                if ($tags) {
                    foreach ($tags as $tag) {
                        $tag_link = get_tag_link($tag->term_id);
                        echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a> ';
                    }
                }
                ?>
            </div>


            <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap -->

</section> <!-- end s-extra -->
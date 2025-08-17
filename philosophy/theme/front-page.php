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
            // Custom WP_Query to get latest 15 posts
            $front_posts = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 15,
            ]);

            if ($front_posts->have_posts()) :
                while ($front_posts->have_posts()) : $front_posts->the_post();
                    get_template_part('template-parts/post-formats/post', get_post_format());
                endwhile;
            else :
                echo '<p>No posts found.</p>';
            endif;

            wp_reset_postdata();
            ?>

        </div> <!-- end masonry -->
        <div style="text-align: center;">
            <a class="btn btn--primary" href="/blog">All Blogs</a>
        </div>

    </div> <!-- end masonry-wrap -->

</section> <!-- s-content -->

<!-- s-extra
================================================== -->
<?php get_template_part('template-parts/parts/sec', 'extra'); ?>

<?php get_footer(); ?>

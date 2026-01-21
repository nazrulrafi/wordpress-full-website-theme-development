<?php
get_header();
?>
    <div class="bg-theme-overlay" style='background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/bg.jpg")'>
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-capitalize text-white ">Blog list</h2>
                        <ul class="list-inline ">
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    home
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    Blog
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    Blog list
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>


    <!-- BLOG -->
<section>
    <div class="container">
        <div class="row">
            <!-- BLOG START -->
            <div class="col-lg-8">
                <div class="row">
                    <?php
                        while ( have_posts() ) : the_post();
                            $title = get_the_title();
                            $content = get_the_content();
                            $trim_content = wp_trim_words($content, 20,"...");
                            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'post-thumb');
                            $categories = get_the_category(get_the_ID());
                            $permalink = get_the_permalink();

                            $author_id = get_the_author_meta('ID');
                            $author_name = get_the_author_meta('display_name',$author_id); // current post's author
                            $author_url = get_author_posts_url($author_id);
                            $author_avatar = get_avatar_url($author_id, 64); // 64px size

                            ?>
                            <div class="col-md-6 col-lg-6">
                                <div class="blog__grid mt-0">
                                    <!-- BLOG  -->
                                    <div class="card__image">
                                        <div class="card__image-header h-250">
                                            <img src="<?= $thumb_url?>" alt=""
                                                 class="img-fluid w100 img-transition">
                                            <div class="info"> <?= $categories[0]->name?></div>
                                        </div>
                                        <div class="card__image-body">
                                            <!-- <span class="badge badge-secondary p-1 text-capitalize mb-3">May 08, 2019
                                            </span> -->
                                            <h6 class="text-capitalize">
                                                <a href="<?= $permalink?>"><?=$title?> </a>
                                            </h6>
                                            <p class=" mb-0">
                                                <?=$trim_content?>

                                            </p>

                                        </div>
                                        <div class="card__image-footer">
                                            <figure>
                                                <img src="<?=$author_avatar?>" alt=""
                                                     class="img-fluid rounded-circle">
                                            </figure>
                                            <ul class="list-inline my-auto">
                                                <li class="list-inline-item">
                                                    <a href="<?= $author_url?>">
                                                        <?= $author_name?>
                                                    </a>

                                                </li>

                                            </ul>
                                            <ul class="list-inline my-auto ml-auto">
                                                <li class="list-inline-item">
                                                    <a href="<?= $permalink?>" class="btn btn-sm btn-primary "><small
                                                                class="text-white ">read more <i
                                                                    class="fa fa-angle-right ml-1"></i></small></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- END BLOG -->
                                </div>
                            </div>
                        <?php
                        endwhile;
                    ?>

                </div>
                <div class="pagination">
                    <?php
                    // Pagination
                    the_posts_pagination([
                            'mid_size' => 2,
                            'prev_text' => __('Prev', 'textdomain'),
                            'next_text' => __('Next', 'textdomain'),
                    ]);
                    ?>
                </div>
                <?php
                    wp_reset_postdata();
                ?>
            </div>
            <!-- END BLOG  -->

            <!-- WIDGET BLOG -->
            <div class="col-lg-4">
                <div class="sticky-top">
                    <aside>
                        <div class="widget__sidebar mt-0">
                            <div class="widget__sidebar__header">
                                <h6 class="text-capitalize">Search</h6>
                            </div>
                            <div class="widget__sidebar__body">
                                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                                    <div class="input-group">
                                        <input type="search"
                                               class="form-control"
                                               placeholder="Search article..."
                                               value="<?php echo get_search_query(); ?>"
                                               name="s"
                                               title="Search for:">
                                        <span class="input-group-btn">
                        <button type="submit" class="btn-search btn"><i class="fa fa-search"></i></button>
                    </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </aside>

                    <aside>
                        <div class="widget__sidebar">
                            <div class="widget__sidebar__header">
                                <h6 class="text-capitalize">category</h6>
                            </div>
                            <div class="widget__sidebar__body">
                                <ul class="list-unstyled">
                                    <?php
                                        $categories = get_categories();
                                        foreach ($categories as $category) {
                                            $category_name = $category->cat_name;
                                            $category_link = get_category_link($category->cat_ID);
                                            $category_count  = $category->count;
                                            ?>
                                                <li>
                                                    <a href="<?= $category_link?>" class="text-capitalize">
                                                        <?= $category_name?>
                                                        <span class="badge badge-primary"><?= $category_count?></span>
                                                    </a>
                                                </li>
                                            <?php
                                        }
                                    ?>

                                </ul>
                            </div>

                        </div>
                    </aside>
                    <aside>
                        <div class="widget__sidebar">
                            <div class="widget__sidebar__header">
                                <h6 class="text-capitalize">recents news</h6>
                            </div>
                            <div class="widget__sidebar__body">
                                <?php
                                    $args = [
                                            'posts_per_page' => 5, // Number of posts
                                            'post_type'      => 'post', // Post type
                                            'orderby'        => 'date',
                                            'order'          => 'DESC'
                                    ];

                                    $recent_posts = new WP_Query($args);
                                    if ($recent_posts->have_posts()) {
                                        while ($recent_posts->have_posts()) {
                                            $recent_posts->the_post();
                                            $title = get_the_title();
                                            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                            $date = get_the_date('M d, Y');
                                            $permalink = get_the_permalink();
                                            ?>
                                            <div class="widget__sidebar__body-img">
                                                <img src="<?=$thumb_url?>" alt="" class="img-fluid">
                                                <div class="widget__sidebar__body-heading">
                                                    <a href="<?=$permalink?>">
                                                        <h6 class="text-capitalize">
                                                            <?= $title?>
                                                        </h6>
                                                    </a>
                                                </div>
                                                <span class="badge badge-secondary p-1 text-capitalize mb-1"><?= $date?></span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </aside>
                    <aside>
                        <div class="widget__sidebar">
                            <div class="widget__sidebar__header">
                                <h6 class="text-capitalize">tags</h6>
                            </div>
                            <div class="widget__sidebar__body">
                                <div class="blog__tags p-0">
                                    <ul class="list-inline">
                                        <?php
                                            $tags = get_tags();
                                            foreach ($tags as $tag) {
                                                $tag_link = get_tag_link($tag->term_id);
                                                $tag_name   = $tag->name;
                                                ?>
                                                <li class="list-inline-item">
                                                    <a href="<?= $tag_link?>">
                                                        <?= $tag_name?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        ?>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </aside>
                </div>
            </div>
            <!-- END WIDGET BLOG -->
        </div>
    </div>
</section>
<!-- END LISTING LIST -->


<?php

get_template_part("template-parts/common/cta");
?>

<!-- Footer  -->
<?php
get_footer();
?>
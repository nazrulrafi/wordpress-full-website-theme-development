<?php
    get_header();
?>
<!-- BREADCRUMB -->
<div class="bg-theme-overlay">
    <section class="section__breadcrumb ">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-capitalize text-white">blog single</h2>
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                home
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                blog
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                blog single
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- END BREADCRUMB -->
<div class="clearfix"></div>

<!-- LISTING LIST -->
<section>
    <div class="container">
        <div class="row">
            <?php
                while ( have_posts() ) : the_post();
                    $permalink = get_permalink();
                    $title = get_the_title();
                    $content = get_the_content();
                    $content = apply_filters('the_content', $content);
                    $author = get_the_author_meta("ID");
                    $author_name = get_the_author_meta("display_name", $author);
                    $author_image = get_avatar_url($author, "large");
                    $category = get_the_category();
                    $image = get_the_post_thumbnail_url(get_the_ID(), "full");
                    $author_posts = get_author_posts_url($author);
                    $date = get_the_date('F d, Y');
                    $tags = get_the_tags();
                    $author_bio = get_the_author_meta('description', $author); // Bio

                    ?>
                    <div class="col-lg-8">
                        <div class="single__blog-detail">
                            <h1>
                                <?= $title ?>
                            </h1>

                            <div class="single__blog-detail-info">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <figure class="image-profile">
                                            <img src="<?= $author_image?>" class="img-fluid" alt="">
                                        </figure>
                                    </li>
                                    <li class="list-inline-item">

                                    <span>
                                        by
                                    </span>
                                        <a href="<?=$author_posts?>">
                                            <?= $author_name ?>,
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        <?= $date?>
                                    </span>
                                    </li>

                                    <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        in
                                    </span>
                                        <?php
                                        $categories = get_the_category(get_the_ID());

                                        if (!empty($categories)) {
                                            $count = 0;
                                            foreach ($categories as $category) {
                                                $count++;
                                                $name = $category->name;
                                                $link = get_category_link($category->term_id);
                                                ?>
                                                <a href="<?= esc_url($link) ?>"><?= esc_html($name) ?></a>
                                                <?php
                                                if ($count < 3 && $count < count($categories)) {
                                                    echo ', ';
                                                }
                                                if ($count == 3) break;
                                            }
                                        }
                                        ?>

                                    </li>
                                </ul>
                            </div>
                            <figure>
                                <img src="<?= $image?>" class="img-fluid" alt="">
                            </figure>

                            <div class="drop-cap">
                               <?=$content?>
                            </div>



                            <!-- TAGS -->
                            <div class="blog__tags mb-4">
                                <ul class="list-inline">
                                    <?php
                                        foreach ($tags as $tag) {
                                            $tag_link = get_tag_link($tag->term_id);
                                            $tag_name = $tag->name;
                                    ?>
                                            <li class="list-inline-item">
                                                <a href="<?=$tag_link?>">
                                                    <?= $tag_name?>
                                                </a>
                                            </li>
                                   <?php
                                        }
                                    ?>

                                </ul>
                            </div>
                            <!-- END TAGS -->

                            <!-- AUTHOR -->
                            <!-- Profile author -->
                            <div class="wrap__profile">
                                <div class="wrap__profile-author">
                                    <figure>
                                        <img src="<?=$author_image?>" alt="" class="img-fluid img-circle">
                                    </figure>
                                    <div class="wrap__profile-author-detail">
                                        <div class="wrap__profile-author-detail-name">author</div>
                                        <h5><?= $author_name?></h5>
                                        <p><?= $author_bio?></p>
                                        <ul class="list-inline">
                                            <?php
                                            $user_id = get_the_author_meta('ID');
                                            $socials = ['facebook','instagram','twitter','telegram','linkedin'];

                                            foreach ($socials as $social) {
                                                $url = get_user_meta($user_id, $social, true);

                                                if ($url) { // Only show if URL exists
                                                    ?>
                                                    <li class="list-inline-item">
                                                        <a href="<?= esc_url($url) ?>" target="_blank" class="btn btn-social btn-social-o <?= $social ?>">
                                                            <i class="fa fa-<?= $social ?>"></i>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- END AUTHOR -->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single_navigation-prev">
                                        <?php
                                            $prev_post = get_previous_post();
                                            if ($prev_post){
                                                $prev_title = get_the_title( $prev_post->ID );
                                                $prev_permalink = get_permalink( $prev_post->ID );
                                                ?>
                                                <a href="<?= $prev_permalink?>">
                                                    <span>previous post</span>
                                                    <?= $prev_title?>
                                                </a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single_navigation-next text-left text-md-right">
                                        <?php
                                        $next_post = get_next_post();
                                        if ($next_post){
                                            $next_title = get_the_title( $next_post->ID );
                                            $next_permalink = get_permalink( $next_post->ID );
                                            ?>
                                            <a href="<?= esc_url($next_permalink) ?>">
                                                <span>Next Post</span>
                                                <?= esc_html($next_title) ?>
                                            </a>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <!-- COMMENTS -->
                            <?php
                            if ( have_comments() || comments_open() ) {
                                comments_template();
                            }
                            ?>

                            <!-- END COMMENTS -->
                        </div>
                    </div>
                <?php
                endwhile;
            ?>

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
        </div>
        <!-- END WIDGET BLOG -->
    </div>
</section>
<!-- END LISTING LIST -->




<!-- Footer  -->
<?php
get_template_part("template-parts/common/cta");
?>

<?php
get_footer();
?>
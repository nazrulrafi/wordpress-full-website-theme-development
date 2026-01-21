
<!-- BLOG -->
<section class="blog__home bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="title__head">
                    <h2 class="text-center text-capitalize">
                        lastest news
                    </h2>
                    <p class="text-center text-capitalize">Find Of The Most Popular Real Estate Company All Around
                        Indonesia.</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <?php
            $args = [
                    'posts_per_page' => 3, // Number of posts
                    'post_type'      => 'post', // Post type
                    'orderby'        => 'date',
                    'order'          => 'DESC'
            ];

            $recent_posts = new WP_Query($args);
            if ($recent_posts->have_posts()) {
                while ($recent_posts->have_posts()) {
                    $recent_posts->the_post();
                    $title = get_the_title();
                    $content = get_the_content();
                    $trim_content = wp_trim_words($content, 20,"...");
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'post-thumb');
                    $categories = get_the_category(get_the_ID());
                    $permalink = get_the_permalink();
                    $date = get_the_date('M d, Y');
                    $author_id = get_the_author_meta('ID');
                    $author_name = get_the_author_meta('display_name',$author_id); // current post's author
                    $author_url = get_author_posts_url($author_id);
                    $author_avatar = get_avatar_url($author_id, 64); // 64px size

                    ?>
                    <div class="col-md-4">
                        <!-- BLOG  -->
                        <div class="card__image">
                            <div class="card__image-header h-250">
                                <img src="<?= $thumb_url?>" alt="" class="img-fluid w100 img-transition">
                                <div class="info"> event</div>
                            </div>
                            <div class="card__image-body">
                                 <span class="badge badge-secondary p-1 text-capitalize mb-3"><?= $date?> </span>
                                <h6 class="text-capitalize">
                                    <a href="<?= $permalink?>"><?= $title?></a>
                                </h6>
                                <p class=" mb-0">
                                    <?= $trim_content?>
                                </p>

                            </div>
                            <div class="card__image-footer">
                                <figure>
                                    <img src="<?= $author_avatar?>" alt="" class="img-fluid rounded-circle">
                                </figure>
                                <ul class="list-inline my-auto">
                                    <li class="list-inline-item ">
                                        <a href="<?=$author_url?>">
                                            <?=$author_name?>
                                        </a>

                                    </li>

                                </ul>
                                <ul class="list-inline my-auto ml-auto">
                                    <li class="list-inline-item ">
                                        <a href="<?= $permalink?>" class="btn btn-sm btn-primary "><small class="text-white ">read more <i
                                                        class="fa fa-angle-right ml-1"></i></small></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- END BLOG -->
                    </div>
                    <?php
                    };
                }
            ?>


        </div>
    </div>
</section>
<!-- END BLOG -->
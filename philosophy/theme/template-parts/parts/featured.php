<?php
$args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'meta_key'       => 'is_featured',
        'meta_value'     => '1',
);

$featured_query = new WP_Query($args);

if($featured_query->have_posts()): ?>
    <div class="pageheader-content row">
        <div class="col-full">
            <div class="featured">
                <?php
                $count = 0;
                while($featured_query->have_posts()): $featured_query->the_post();
                    $count++;
                    $thumb = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $author_id = get_the_author_meta('ID');
                    $author_avatar = get_avatar_url($author_id);
                    $category = get_the_category();
                    $cat_name = $category ? $category[0]->name : '';
                    $cat_link = $category ? get_category_link($category[0]->term_id) : '#';
                    $post_link = get_permalink();
                    $post_title = get_the_title();
                    $date = get_the_date('F d, Y');
                    ?>

                    <?php if($count == 1): ?>
                        <div class="featured__column featured__column--big">
                            <div class="entry" style="background-image:url('<?php echo esc_url($thumb); ?>');">
                                <div class="entry__content">
                                    <span class="entry__category"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></span>
                                    <h1><a href="<?php echo esc_url($post_link); ?>" title=""><?php echo esc_html($post_title); ?></a></h1>
                                    <div class="entry__info">
                                        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="entry__profile-pic">
                                            <img class="avatar" src="<?php echo esc_url($author_avatar); ?>" alt="">
                                        </a>
                                        <ul class="entry__meta">
                                            <li><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php the_author(); ?></a></li>
                                            <li><?php echo esc_html($date); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if($count == 2): ?><div class="featured__column featured__column--small"><?php endif; ?>
                        <div class="entry" style="background-image:url('<?php echo esc_url($thumb); ?>');">
                            <div class="entry__content">
                                <span class="entry__category"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></span>
                                <h1><a href="<?php echo esc_url($post_link); ?>" title=""><?php echo esc_html($post_title); ?></a></h1>
                                <div class="entry__info">
                                    <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="entry__profile-pic">
                                        <img class="avatar" src="<?php echo esc_url($author_avatar); ?>" alt="">
                                    </a>
                                    <ul class="entry__meta">
                                        <li><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php the_author(); ?></a></li>
                                        <li><?php echo esc_html($date); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php if($count == 3): ?></div><?php endif; ?>
                    <?php endif; ?>

                <?php endwhile; wp_reset_postdata(); ?>
            </div> <!-- end featured -->
        </div> <!-- end col-full -->
    </div>
<?php endif; ?>

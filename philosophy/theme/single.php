<?php
get_header();
?>

<!-- s-content
================================================== -->
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $title = get_the_title($post->ID);
        $content = get_the_content($post->ID);
        $excerpt = wp_trim_words($content, 30, '...');
        $permalink = get_the_permalink($post->ID);
        $date = get_the_date('F j, Y', $post->ID);
        $categories = get_the_category($post->ID)

?>

<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-standard">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
               <?=$title ?>
            </h1>
            <ul class="s-content__header-meta">
                <li class="date"><?= $date?></li>
                <li class="cat">
                    In
                    <?php
                    $categories = get_the_category(); // Get categories
                    if ( $categories ) {
                        foreach ( $categories as $cat ) {
                            // Build URL using slug
                            $cat_url = home_url( '/category/' . $cat->slug . '/' );
                            echo '<a href="' . esc_url( $cat_url ) . '">' . esc_html($cat->name) . '</a> ';
                        }
                    }
                    ?>
                </li>

            </ul>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <?php
                $format = get_post_format(); // returns false for standard
                if ( $format ) {
                    // Load specific format template
                    get_template_part( 'template-parts/single/post', $format );
                } else {
                    // Standard post fallback
                    get_template_part( 'template-parts/single/post' );
                }
            ?>

        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">
            <?= $content ?>

            <p class="s-content__tags">
                <span>Post Tags</span>

                <span class="s-content__tag-list">
                          <?php
                          $post_tags = get_the_tags();
                          if ( $post_tags ) {
                              foreach ( $post_tags as $tag ) {
                                  echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a> ';
                              }
                          } else {
                              echo 'No tags';
                          }
                          ?>
                    </span>
            </p> <!-- end s-content__tags -->

            <?php
            $author_id = get_the_author_meta('ID');
            $facebook  = get_field('facebook', 'user_' . $author_id);
            $twitter   = get_field('twitter', 'user_' . $author_id);
            $instagram = get_field('instagram', 'user_' . $author_id);
            $googleplus = get_field('googleplus', 'user_' . $author_id);
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_desc = get_the_author_meta('description', $author_id);
            $author_avatar = get_avatar_url($author_id, ['size' => 150]);
            ?>

            <div class="s-content__author">
                <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">

                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                            <?php echo esc_html($author_name); ?>
                        </a>
                    </h4>

                    <?php echo wp_kses_post($author_desc); ?>

                    <ul class="s-content__author-social" style="margin-top: 15px">
                        <?php if($facebook): ?>
                            <li><a href="<?php echo esc_url($facebook); ?>" target="_blank">Facebook</a></li>
                        <?php endif; ?>
                        <?php if($twitter): ?>
                            <li><a href="<?php echo esc_url($twitter); ?>" target="_blank">Twitter</a></li>
                        <?php endif; ?>
                        <?php if($googleplus): ?>
                            <li><a href="<?php echo esc_url($googleplus); ?>" target="_blank">GooglePlus</a></li>
                        <?php endif; ?>
                        <?php if($instagram): ?>
                            <li><a href="<?php echo esc_url($instagram); ?>" target="_blank">Instagram</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>


            <div class="s-content__pagenav">
                <div class="s-content__nav">

                    <?php
                    $prev_post = get_previous_post();
                    if ( $prev_post ) :
                        ?>
                        <div class="s-content__prev">
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" rel="prev">
                                <span>Previous Post</span>
                                <?php echo get_the_title( $prev_post->ID ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $next_post = get_next_post();
                    if ( $next_post ) :
                        ?>
                        <div class="s-content__next">
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="next">
                                <span>Next Post</span>
                                <?php echo get_the_title( $next_post->ID ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div> <!-- end s-content__pagenav -->


        </div> <!-- end s-content__main -->

    </article>


    <!-- comments
    ================================================== -->
    <?php
        if (!post_password_required()){
            comments_template();
        }
    ?>



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
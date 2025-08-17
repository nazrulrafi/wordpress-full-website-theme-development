<?php
/**
 * Template Name: About Page
 * Description: A custom template for the About page
 */
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
$infos = get_field("about_contents");

?>
<section class="s-content s-content--narrow">

    <div class="row">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?= $title?>
            </h1>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <div class="s-content__post-thumb">
                <img src="<?= esc_url($thumbnail[0]) ?>"
                     srcset="<?= esc_url($thumbnail[0]) ?>"
                     style="width: 100%" alt="" >
            </div>
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">
            <?= $content ?>

            <div class="row block-1-2 block-tab-full" style="margin-top: 40px">
                <?php
                    foreach ($infos as $info) {
                        ?>
                        <div class="col-block">
                            <h3 class="quarter-top-margin"><?= $info["title"]?></h3>
                            <p><?= $info["description"]?></p>
                        </div>
                        <?php
                    }

                ?>

            </div>


        </div> <!-- end s-content__main -->

    </div> <!-- end row -->

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
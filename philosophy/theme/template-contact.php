<?php
/**
 * Template Name: Contact Page
 * Description: A custom template for the contact page
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
        $gmap = get_field("gmap");
        $infos = get_field("contact_infos");
        $contact_form_shortcode = get_field("contact_form_shortcode");

        ?>
        <!-- s-content
   ================================================== -->
        <section class="s-content s-content--narrow">

            <div class="row">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        <?= $title?>
                    </h1>
                </div> <!-- end s-content__header -->

                <div class="s-content__media col-full">
                    <div id="map-wrap">
                        <iframe src="<?= $gmap?>"  style="width:100%;height:100%;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> <!-- end s-content__media -->

                <div class="col-full s-content__main">

                    <?= $content ?>

                    <div class="row">
                        <?php
                        foreach ($infos as $info) {
                            ?>
                            <div class="col-six tab-full">
                                <h3><?= $info["title"]?></h3>

                              <?= $info["description"]?>

                            </div>
                            <?php
                        }

                        ?>
                    </div> <!-- end row -->

                    <h3>Say Hello.</h3>
                    <?php
                        echo $contact_form_shortcode;
                    ?>



                </div> <!-- end s-content__main -->

            </div> <!-- end row -->

        </section> <!-- s-content --> <!-- s-content -->
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
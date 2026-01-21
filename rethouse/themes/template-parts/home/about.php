<!-- ABOUT -->
<?php
$about_info = get_field('about_info');
?>
<section class="home__about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="title__leading">
                    <!-- <h6 class="text-uppercase">trusted By thousands</h6> -->
                    <h2 class="text-capitalize"><?=$about_info["title"]?></h2>
                    <?php
                        $content = apply_filters('the_content', $about_info["description"]);
                        echo $content;
                    ?>
                    <a href="<?=$about_info["about_info_link"]?>" class="btn btn-primary mt-3 text-capitalize"> read more
                        <i class="fa fa-angle-right ml-3 "></i></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__image">
                    <div class="about__image-top">
                        <div class="about__image-top-hover">
                            <img src="<?= wp_get_attachment_image_src($about_info["about_info_img_one"],"full")[0] ?>" alt="" class="img-fluid">
                        </div>

                    </div>
                    <div class="about__image-bottom">
                        <div class="about__image-bottom-hover">
                            <img src="<?= wp_get_attachment_image_src($about_info["about_info_img_two"],"full")[0] ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END ABOUT -->
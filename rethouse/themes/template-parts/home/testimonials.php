<!-- TESTIMONIAL -->
<?php
    $testimonials = get_field("testimonials");
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="title__head">
                    <h2 class="text-center text-capitalize">
                        <?= $testimonials["title"] ?>
                    </h2>
                    <p class="text-center text-capitalize"><?= $testimonials["description"]?></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="testimonial owl-carousel owl-theme">
            <?php
                foreach ($testimonials["testimonial_item"] as $testimonial) {
                    $img_url = wp_get_attachment_image_src($testimonial["testimonial_img"], "full");
                    ?>
                    <!-- TESTIMONIAL -->
                    <div class="item testimonial__block">
                        <div class="testimonial__block-card bg-reviews">
                            <p>
                                <?= $testimonial["content"]?>
                            </p>
                        </div>
                        <div class="testimonial__block-users">
                            <div class="testimonial__block-users-img">
                                <img src="<?= $img_url[0]?>" alt="" class="img-fluid">
                            </div>
                            <div class="testimonial__block-users-name">
                                <?= $testimonial["name"]?> <br>
                                <span><?= $testimonial["designation"]?></span>
                            </div>
                        </div>
                    </div>
                    <!-- END TESTIMONIAL -->
                    <?php
                }
            ?>


        </div>
    </div>
</section>
<!-- END TESTIMONIAL -->

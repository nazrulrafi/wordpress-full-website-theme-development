<!-- CAROUSEL HOMEPAGE 3 -->
<div class="homepage__property bg-light">
    <div class="homepage__property-carousel owl-carousel owl-theme">
        <?php
            $banner_slider = get_field('banner_slider');
            foreach ($banner_slider as $banner) {
                $image_url = wp_get_attachment_image_url($banner['banner_image'], 'full');
                $title = $banner['banner_title'];
                $subtitle = $banner['banner_subtitle'];
                $description = $banner['banner_desvription'];
                $link = $banner['banner_link'];
                ?>
                <div class="item">
                    <a href="<?= esc_url($link) ?>">
                        <div class="tc-image-caption4">
                            <img src="<?= $image_url?>" alt="img1">
                            <div class="caption">
                                <h6 class="text-uppercase text-white"><?= $subtitle?></h6>
                                <h2 class="text-capitalize"><?= $title?></h2>
                                <p><?= $description?></p>
                            </div>
                        </div>
                    </a>
                </div>

                <?php
            }
        ?>

    </div>

</div>
<!-- END CAROUSEL HOMEPAGE 3 -->
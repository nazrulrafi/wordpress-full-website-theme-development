<!-- POPULAR CITY -->
<section class="popular__city-large">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="title__head">
                    <h2 class="text-center text-capitalize">
                        popular city
                    </h2>
                    <p class="text-center text-capitalize">Find Properties In These Cities.</p>
                </div>
            </div>

        </div>
        <div class="row">
            <?php
                $locations = get_terms("location");

                foreach ($locations as $location) {
                    $image_id = get_field('property_location_img', $location->taxonomy . '_' . $location->term_id);
                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                    ?>
                    <div class="col-md-6 col-lg-3">
                        <!-- CARD IMAGE -->
                        <a href="/properties">
                            <div class="card__image-hover-style-v3">
                                <div class="card__image-hover-style-v3-thumb h-230">
                                    <img src="<?= $image_url?>" alt="" class="img-fluid w-100">
                                </div>
                                <div class="overlay">
                                    <div class="desc">
                                        <h6 class="text-capitalize"><?= $location->name?></h6>
                                        <p class="text-capitalize"><?= $location->count?> properties</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</section>
<!-- END POPULAR CITY -->
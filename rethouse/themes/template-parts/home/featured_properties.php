<!-- FEATURED PROPERTIES -->
<section class="featured__property bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="title__head">
                    <h2 class="text-center text-capitalize">
                        featured properties
                    </h2>
                    <p class="text-center text-capitalize">handpicked exclusive properties by our team.</p>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="featured__property-carousel owl-carousel owl-theme">
                    <?php
                        $args = [
                                'post_type'      => 'properties',
                                'posts_per_page' => -1,
                                'meta_query'     => [
                                        [
                                                'key'     => 'is_home_featured', // your ACF field
                                                'value'   => '1',               // assuming 1 = true
                                                'compare' => '='
                                        ]
                                ]
                        ];
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $all_images= get_field("all_images");
                                $feature_image = wp_get_attachment_image_src( $all_images["feature_image"] ,"full");
                                $property_display_title = get_field("property_display_title");
                                $property_address = get_field("property_address");
                                $permalink = get_permalink();

                                $peroperty_meta_info = get_field("peroperty_meta_info");;
                                $total_price = $peroperty_meta_info["total_price"];
                                $bedrooms= $peroperty_meta_info["bedrooms"];
                                $bathrooms = $peroperty_meta_info["bathrooms"];
                                $total_room = $peroperty_meta_info["total_room"];
                                $property_type = $peroperty_meta_info["property_type"];
                                $property_status = $peroperty_meta_info["property_status"];
                                $total_area = $peroperty_meta_info["total_area"];
                                $get_agent = get_field("select_agent");
                    ?>
                                <div class="item">
                                    <!-- ONE -->
                                    <div class="card__image card__box">
                                        <div class="card__image-header h-250">
                                            <div class="ribbon text-capitalize">featured</div>
                                            <img src="<?=  $feature_image[0]?>" alt=""
                                                 class="img-fluid w100 img-transition">
                                            <div class="info"> <?=$property_status?></div>
                                        </div>
                                        <div class="card__image-body">
                                            <span class="badge badge-primary text-capitalize mb-2"><?= $property_type?></span>
                                            <h6 class="text-capitalize">
                                                <a href="<?=$permalink?>"><?=$property_display_title?></a>
                                            </h6>

                                            <p class="text-capitalize">
                                                <i class="fa fa-map-marker"></i>
                                                <?=$property_address?>
                                            </p>
                                            <ul class="list-inline card__content">
                                                <li class="list-inline-item">
                                                            <span>
                                                                baths <br>
                                                                <i class="fa fa-bath"></i> <?= $bathrooms?>
                                                            </span>
                                                </li>
                                                <li class="list-inline-item">
                                                            <span>
                                                                beds <br>
                                                                <i class="fa fa-bed"></i> <?=$bedrooms?>
                                                            </span>
                                                </li>
                                                <li class="list-inline-item">
                                                            <span>
                                                                rooms <br>
                                                                <i class="fa fa-inbox"></i> <?=$total_room?>
                                                            </span>
                                                </li>
                                                <li class="list-inline-item">
                                                            <span>
                                                                area <br>
                                                                <i class="fa fa-map"></i> <?=$total_area?> sq ft
                                                            </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card__image-footer">
                                            <figure>
                                                <?php
                                                $imgId = get_field("agent_image",$get_agent);
                                                $img_url = wp_get_attachment_image_src( $imgId ,"full");
                                                $permalink = get_permalink($get_agent);
                                                ?>
                                                <img src="<?= $img_url[0]?>" alt="" class="img-fluid rounded-circle">
                                            </figure>
                                            <ul class="list-inline my-auto">
                                                <li class="list-inline-item">
                                                    <a href="<?=$permalink?>">
                                                        <?php
                                                        $name = get_the_title($get_agent);
                                                        echo $name;
                                                        ?>
                                                    </a>

                                                </li>

                                            </ul>
                                            <ul class="list-inline my-auto ml-auto">
                                                <li class="list-inline-item">

                                                    <h6 class="text-primary">$<?php echo number_format($total_price)?></h6>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                   <?php
                            }
                        }
                    wp_reset_postdata();
                    ?>


                </div>
            </div>
        </div>

    </div>
</section>
<!-- END FEATURED PROPERTIES -->
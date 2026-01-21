<?php
add_action('wp_ajax_filter_properties', 'filter_properties_callback');
add_action('wp_ajax_nopriv_filter_properties', 'filter_properties_callback');

function filter_properties_callback() {
    // Base query
    $args = [
        'post_type'      => 'properties',
        'posts_per_page' => -1,
        'meta_query'     => [],
        'tax_query'      => []
    ];

    // --------------------------
    // Sanitize filters
    // --------------------------
    $location = sanitize_text_field($_POST['location'] ?? '');
    $property_status = sanitize_text_field($_POST['property_status'] ?? '');
    $property_type = sanitize_text_field($_POST['property_type'] ?? '');
    $total_area = sanitize_text_field($_POST['total_area'] ?? '');
    $bedrooms = sanitize_text_field($_POST['bedrooms'] ?? '');
    $bathrooms = sanitize_text_field($_POST['bathrooms'] ?? '');
    $price_min = sanitize_text_field($_POST['price_min'] ?? '');
    $price_max = sanitize_text_field($_POST['price_max'] ?? '');
    $features= sanitize_text_field($_POST['features'] ?? '');


    if ($location) {
        $args['tax_query'][] = [
            'taxonomy' => 'location',
            'field'    => 'slug',
            'terms'    => $location
        ];
    }

    if ($property_status) {
        $args['meta_query'][] = [
            'key'   => 'peroperty_meta_info_property_status',
            'value' => $property_status
        ];
    }
    if ($property_type) {
        $args['meta_query'][] = [
            'key'   => 'peroperty_meta_info_property_type',
            'value' => $property_type
        ];
    }
    if ($total_area) {
        $args['meta_query'][] = [
            'key'   => 'peroperty_meta_info_total_area',
            'value' => $total_area
        ];
    }
    if ($bedrooms) {
        $args['meta_query'][] = [
            'key'   => 'peroperty_meta_info_bedrooms',
            'value' => $bedrooms
        ];
    }
    if ($bathrooms) {
        $args['meta_query'][] = [
            'key'   => 'peroperty_meta_info_bathrooms',
            'value' => $bathrooms
        ];
    }
    // Price range filter
    if ($price_min || $price_max) {
        $args['meta_query'][] = [
            'key'     => 'peroperty_meta_info_total_price',
            'value'   => [$price_min, $price_max],
            'type'    => 'NUMERIC',
            'compare' => 'BETWEEN'
        ];
    }

    if (!empty($features)) {
        $features = explode(',', $features);
        foreach ($features as $feature) {
            $args['meta_query'][] = [
                'key'     => 'peroperty_meta_info_features',
                'value'   => $feature,
                'compare' => 'LIKE'
            ];
        }
    }
    // --------------------------
    // Execute query
    // --------------------------
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        ?>
        <div class="row">
            <?php
            while ( $query->have_posts() ) : $query->the_post();
                $all_images = get_field("all_images");
                $feature_image = wp_get_attachment_image_src($all_images["feature_image"], "full");
                $property_display_title = get_field("property_display_title");
                $property_address = get_field("property_address");
                $permalink = get_permalink();

                $peroperty_meta_info = get_field("peroperty_meta_info");
                $total_price = $peroperty_meta_info["total_price"];
                $bedrooms = $peroperty_meta_info["bedrooms"];
                $bathrooms = $peroperty_meta_info["bathrooms"];
                $total_room = $peroperty_meta_info["total_room"];
                $property_type = $peroperty_meta_info["property_type"];
                $property_status = $peroperty_meta_info["property_status"];
                $total_area = $peroperty_meta_info["total_area"];
                $get_agent = get_field("select_agent");
                ?>
                <div class="col-md-6 col-lg-6">
                    <div class="card__image card__box-v1">
                        <div class="card__image-header h-250 img-space">
                            <img src="<?=$feature_image[0]?>" alt="" class="img-fluid w100 img-transition">
                            <div class="info"> <?=$property_status?></div>
                        </div>
                        <div class="card__image-body">
                            <span class="badge badge-primary text-capitalize mb-2"><?= $property_type ?></span>
                            <h6 class="text-capitalize">
                                <a href="<?=$permalink?>"><?=$property_display_title?></a>
                            </h6>

                            <p class="text-capitalize">
                                <i class="fa fa-map-marker"></i> <?=$property_address?>
                            </p>
                            <ul class="list-inline card__content">
                                <li class="list-inline-item">
                                <span>
                                    baths <br>
                                    <i class="fa fa-bath"></i> <?= $bathrooms ?>
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
                                $imgId = get_field("agent_image", $get_agent);
                                $img_url = wp_get_attachment_image_src($imgId, "full");
                                $permalink = get_permalink($get_agent);
                                ?>
                                <img src="<?= $img_url[0]?>" alt="" class="img-fluid rounded-circle">
                            </figure>
                            <ul class="list-inline my-auto">
                                <li class="list-inline-item">
                                    <a href="<?=$permalink?>">
                                        <?= get_the_title($get_agent); ?>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-inline my-auto ml-auto">
                                <li class="list-inline-item">
                                    <h6 class="text-primary">$<?= number_format($total_price) ?></h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php
    else :
        echo '<p>No properties found.</p>';
    endif;

    wp_reset_postdata();
    wp_die();


}


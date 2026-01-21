<?php
get_header();
?>

<?php
while (have_posts()) : the_post();

    $display_name = get_field("agent_display_name");
    $address = get_field("agent_address");
    $agency_img = wp_get_attachment_image_src( get_field("agent_image") ,"full");
    $office = get_field("agent_office");
    $mobile = get_field("agent_mobile");
    $fax = get_field("agent_fax");
    $email = get_field("agent_email");
    $content = apply_filters('the_content', get_the_content());
    $social_links = get_field("agent_social_links");
    ?>
    <!-- BREADCRUMB -->
    <div class="bg-theme-overlay" style='background-image: url("<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>")'>
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-capitalize text-white ">agent detail</h2>
                        <ul class="list-inline ">
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    home
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    agent
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white">
                                    agent detail
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>

    <!-- LISTING LIST -->
    <section class="profile__agents">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row no-gutters">
                        <div class="col-lg-12 cards mt-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <a href="#" class="profile__agency-logo">
                                        <img src="<?= $agency_img[0]?>" alt="" class="img-fluid">
                                        <div class="total__property-agent">20 listing</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-6 my-auto">
                                    <div class="profile__agency-info">
                                        <h5 class="text-capitalize">
                                            <a href="#" target="_blank"><?= $display_name?></a>
                                        </h5>
                                        <p class="text-capitalize mb-1"><?= $address?></p>

                                        <ul class="list-unstyled mt-2">
                                            <li>
                                                <a href="#" class="text-capitalize"><span><i class="fa fa-building"></i> office :</span> <?= $office?></a>
                                            </li>
                                            <li><a href="#" class="text-capitalize"><span><i class="fa fa-phone"></i> mobile :</span> <?= $mobile?></a></li>
                                            <li><a href="#" class="text-capitalize"><span><i class="fa fa-fax"></i> fax : </span> <?= $fax?></a></li>
                                            <li><a href="#" class="text-capitalize"><span><i class="fa fa-envelope"></i> email :</span>
                                                    <?= $email?></a></li>
                                        </ul>
                                        <p class="mb-0 mt-3">
                                            <a href="<?= $social_links['agent_facebook']?>">
                                                <button class="btn btn-social btn-social-o facebook mr-1">
                                                    <i class="fa fa-facebook-f"></i>
                                                </button>
                                            </a>
                                            <a href="<?= $social_links['agent_twitter']?>">
                                                <button class="btn btn-social btn-social-o twitter mr-1">
                                                    <i class="fa fa-twitter"></i>
                                                </button>
                                            </a>
                                            <a href="<?= $social_links['agent_linkedin']?>">
                                                <button class="btn btn-social btn-social-o linkedin mr-1">
                                                    <i class="fa fa-linkedin"></i>
                                                </button>
                                            </a>
                                            <a href="<?= $social_links['agent_instagram']?>">
                                                <button class="btn btn-social btn-social-o instagram mr-1">
                                                    <i class="fa fa-instagram"></i>
                                                </button>
                                            </a>
                                            <a href="<?= $social_links['agent_youtube']?>">
                                                <button class="btn btn-social btn-social-o youtube mr-1">
                                                    <i class="fa fa-youtube"></i>
                                                </button>
                                            </a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- LOCATION -->
                    <div class="single__detail-features tabs__custom">
                        <h5 class="text-capitalize detail-heading ">Agent details</h5>
                        <!-- FILTER VERTICAL -->
                        <ul class="nav nav-pills myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active pills-tab-one" data-toggle="pill" href="#pills-tab-one" role="tab"
                                   aria-controls="pills-tab-one" aria-selected="true">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pills-tab-two" data-toggle="pill" href="#pills-tab-two" role="tab"
                                   aria-controls="pills-tab-two" aria-selected="false">
                                    Listing</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pills-tab-one" role="tabpanel" aria-labelledby="pills-tab-one">
                                <div class="single__detail-desc">
                                    <h5 class="text-capitalize detail-heading">Hi, nice to meet you</h5>
                                    <div class="show__more">
                                        <?php
                                        echo $content;
                                        ?>
                                        <a href="javascript:void(0)" class="show__more-button ">read more</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab-two" role="tabpanel" aria-labelledby="pills-tab-two">
                                <?php
                                $agent_id = get_the_ID();
                                $args = array(
                                        "post_type" => "properties",
                                        "posts_per_page" => 10,
                                        "meta_query" => array(
                                                array(
                                                        'key'     => 'select_agent', // ACF field key
                                                        'value'   => $agent_id,
                                                        'compare' => '='
                                                )
                                        )
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()){
                                    while ($query->have_posts()){
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
                                        $agent_display_name = get_field("agent_display_name", $get_agent);
                                        $agent_link = get_permalink( $get_agent);
                                        $agent_img = wp_get_attachment_image_src( get_field("agent_image",$get_agent) ,"full");
                                        $content = get_the_content();
                                        $trim_content = wp_trim_words($content, 10,"...");
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="<?=$permalink?>">
                                                                    <!--                                                                        <div class="ribbon text-capitalize">sold out</div>-->
                                                                    <img src="<?=$feature_image[0]?>" alt="" class="img-fluid w100 img-transition">
                                                                    <div class="info"><?=$property_status?></div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span class="badge badge-primary text-capitalize mb-2"><?=$property_type?></span>
                                                                <h6>
                                                                    <a href="<?= $permalink?>"><?=$property_display_title?></a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!--                                                                        <p class="text-capitalize">-->

                                                                    <!--                                                                        </p>-->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        <?= $property_address?>
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">
                                                                            <span>
                                                                                baths <br>
                                                                                <i class="fa fa-bath"></i> <?=$bathrooms?>
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
                                                                                <i class="fa fa-inbox"></i> <?= $total_room?>
                                                                            </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                            <span>
                                                                                area <br>
                                                                                <i class="fa fa-map"></i> <?= $total_area?> sq ft
                                                                            </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="<?= $agent_img[0]?>" alt="" class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="<?=$agent_link?>">
                                                                            <?=$agent_display_name?>
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$<?=number_format($total_price)?></h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php
                                    }
                                    wp_reset_postdata();
                                }
                                ?>

                                <div class="clearfix"></div>
                            </div>



                        </div>
                        <!-- END FILTER VERTICAL -->
                    </div>
                    <!-- END LOCATION -->
                </div>
                <div class="col-lg-4">
                    <div class="sticky-top">
                        <!-- FORM FILTER -->
                        <div class="products__filter mb-30">
                            <div class="products__filter__group">
                                <div class="products__filter__header">
                                    <h5 class="text-center text-capitalize">Contact Form</h5>
                                </div>
                                <div class="products__filter__body">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email (Optional)</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Your message</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>

                                </div>
                                <div class="products__filter__footer">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary text-capitalize btn-block"> submit <i
                                                class="fa fa-paper-plane ml-1"></i></button>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- END FORM FILTER -->
                        <!-- ARCHIVE CATEGORY -->
                        <aside class=" wrapper__list__category">
                            <!-- CATEGORY -->
                            <div class="widget widget__archive">
                                <div class="widget__title">
                                    <h5 class="text-dark mb-0 text-center">Categories Property</h5>
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            apartement
                                            <span class="badge badge-primary">14</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            villa
                                            <span class="badge badge-primary">4</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            family house
                                            <span class="badge badge-primary">2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            modern villa
                                            <span class="badge badge-primary">8</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            town house
                                            <span class="badge badge-primary">10</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-capitalize">
                                            office
                                            <span class="badge badge-primary">12</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END CATEGORY -->
                        </aside>
                        <!-- End ARCHIVE CATEGORY -->

                        <div class="download mb-0">
                            <h5 class="text-center text-capitalize">Property Attachments</h5>
                            <div class="download__item">
                                <a href="#" target="_blank"><i class="fa fa-file-pdf-o mr-3" aria-hidden="true"></i>Download Document.Pdf</a>
                            </div>
                            <div class="download__item">
                                <a href="#" target="_blank"><i class="fa fa-file-word-o mr-3" aria-hidden="true"></i>Presentation
                                    2016-17.Doc</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- END LISTING LIST -->

<?php
endwhile;
?>
<?php
get_template_part("template-parts/common/cta");
?>

<?php
get_footer();
?>
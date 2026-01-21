<?php
get_header();
?>

<?php
while (have_posts()) : the_post();
    $all_images= get_field("all_images");
    $cover_img = wp_get_attachment_image_src( $all_images["cover_image"] ,"full");
    $property_display_title = get_field("property_display_title");
    $property_address = get_field("property_address");
    $monthly_price= get_field("monthly_price");
    $content = apply_filters('the_content', get_the_content());

    $peroperty_meta_info = get_field("peroperty_meta_info");
    $propertyId = $peroperty_meta_info["property_id"];
    $garage = $peroperty_meta_info["garage"];
    $total_price = $peroperty_meta_info["total_price"];
    $garage_size= $peroperty_meta_info["garage_size"];
    $property_size= $peroperty_meta_info["property_size"];
    $year_built= $peroperty_meta_info["year_built"];
    $bedrooms= $peroperty_meta_info["bedrooms"];
    $bathrooms = $peroperty_meta_info["bathrooms"];
    $property_type = $peroperty_meta_info["property_type"];
    $property_status = $peroperty_meta_info["property_status"];
    $total_area = $peroperty_meta_info["total_area"];
    $features = $peroperty_meta_info["features"];

    $floor_plan = get_field("floor_plan");

    $property_video = get_field("property_video_sec");

    $location_gmap = get_field("location_gmap");


    ?>
    <!-- BREADCRUMB -->
    <div class="bg-theme-overlay" style='background-image: url("<?= $cover_img[0] ?>")'>
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-capitalize text-white ">property detail</h2>
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
                                    property detail
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>

    <!-- SINGLE DETAIL -->
    <section class="single__Detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- SLIDER IMAGE DETAIL -->
                    <div class="slider__image__detail-large owl-carousel owl-theme">
                        <?php
                            $gallery = $all_images["gallery_image"];
                            foreach ($gallery as $single_image) {
                                $img = wp_get_attachment_image_src( $single_image ,"full");
                                ?>
                                <div class="item">
                                    <div class="slider__image__detail-large-one">
                                        <img src="<?= $img[0]?>" alt="" class="img-fluid w-100 img-transition">
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>

                    <div class="slider__image__detail-thumb owl-carousel owl-theme">
                        <?php
                            $gallery = $all_images["gallery_image"];
                            foreach ($gallery as $single_image) {
                                $img = wp_get_attachment_image_src( $single_image ,"full");
                        ?>
                                <div class="item">
                                    <div class="slider__image__detail-thumb-one">
                                        <img src="<?= $img[0]?>" alt="" class="img-fluid w-100 img-transition">
                                    </div>
                                </div>  
                       <?php
                        }
                        ?>
                    </div>
                    <!-- END SLIDER IMAGE DETAIL -->
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="single__detail-title mt-4">
                                <h3 class="text-capitalize"><?= $property_display_title?></h3>
                                <p> <?= $property_address?></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="single__detail-price mt-4">
                                <h3 class="text-capitalize text-gray">$<?=$monthly_price?>/mo</h3>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="badge badge-primary p-2 rounded"><i
                                                    class="fa fa-print"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="badge badge-primary p-2 rounded"><i
                                                    class="fa fa-exchange"></i></a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#" class="badge badge-primary p-2 rounded"><i
                                                    class="fa fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- DESCRIPTION -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single__detail-desc">
                                <h6 class="text-capitalize detail-heading">description</h6>
                                <div class="show__more">
                                    <?= $content?>

                                    <a href="javascript:void(0)" class="show__more-button ">read more</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <!-- PROPERTY DETAILS SPEC -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">property details</h6>
                                <!-- INFO PROPERTY DETAIL -->
                                <div class="property__detail-info">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Property ID:</b> <?=$propertyId?></li>
                                                <li><b>Price:</b> $<?= number_format($total_price)?>/li>
                                                <li><b>Property Size:</b> <?= $property_size?> Sq Ft</li>
                                                <li><b>Bedrooms:</b> <?= $bedrooms?></li>
                                                <li><b>Bathrooms:</b> <?= $bathrooms?></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Garage:</b> <?= $garage?></li>
                                                <li><b>Garage Size:</b> <?= $garage_size?> SqFt</li>
                                                <li><b>Year Built:</b> <?= $year_built?></li>
                                                <li><b>Property Type:</b> <?= $property_type?></li>
                                                <li><b>Property Status:</b> <?= $property_status?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6 class="text-primary">Additional details</h6>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Property ID:</b> RV151</li>
                                                <li><b>Price:</b> $484,400</li>
                                                <li><b>Property Size:</b> 1466 Sq Ft</li>
                                                <li><b>Bedrooms:</b> 4</li>
                                                <li><b>Bathrooms:</b> 2</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Garage:</b> 1</li>
                                                <li><b>Garage Size:</b> 458 SqFt</li>
                                                <li><b>Year Built:</b> 2019-01-09</li>
                                                <li><b>Property Type:</b> Full Family Home</li>
                                                <li><b>Property Status:</b> For rent</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <!-- END INFO PROPERTY DETAIL -->
                            </div>
                            <!-- END PROPERTY DETAILS SPEC -->
                            <div class="clearfix"></div>

                            <!-- FEATURES -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">features</h6>
                                <ul class="list-unstyled icon-checkbox">
                                    <?php
                                    foreach ($features as $feature) {
                                        echo "<li>$feature</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- END FEATURES -->

                            <!-- FLOR PLAN -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">floor plan</h6>
                                <!-- FLOR PLAN IMAGE -->
                                <div id="accordion" class="floorplan" role="tablist">
                                    <?php
                                        $items = $floor_plan["floor_plan_items"];
                                        foreach ($items as $key=>$item) {
                                            $img = wp_get_attachment_image_src( $item["image"] ,"full");
                                            $show = $key == 0? "show":"";
                                            ?>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <a class="text-capitalize" data-toggle="collapse" href="#collapse-<?=$key?>" aria-expanded="true"
                                                       aria-controls="collapse-<?=$key?>">
                                                       <?= $item["title"]?> <span class="badge badge-light rounded p-1 ml-2"><?= $item["subtitle"]?></span>
                                                    </a>
                                                </div>
                                                <div id="collapse-<?=$key?>" class="collapse <?=$show?>" role="tabpanel" aria-labelledby="headingOne"
                                                     data-parent="#accordion">
                                                    <div class="card-body">
                                                        <figure>
                                                            <img src="<?= $img[0]?>" alt="" class="img-fluid">
                                                        </figure>
                                                        <?= $item["description"]?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>



                                </div>
                            </div>
                            <!-- END FLOR PLAN -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">property video</h6>
                                <div class="single__detail-features-video">
                                    <figure class=" mb-0">
                                        <div class="home__video-area text-center">
                                            <?php
                                                $property_video_overlay = $property_video["property_video_overlay"];
                                                $overlay = wp_get_attachment_image_src($property_video_overlay, "full");
                                            ?>
                                            <img src="<?= $overlay[0]?>" alt="" class="img-fluid">
                                            <a href="<?= $property_video["property_video"]?>" class="play-video-1 ">
                                                <i class="icon fa fa-play text-white"></i>
                                            </a>
                                        </div>

                                    </figure>
                                </div>
                            </div>

                            <!-- LOCATION -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">location</h6>
                                <!-- FILTER VERTICAL -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-map-location-tab" data-toggle="pill" href="#pills-map-location" role="tab"
                                           aria-controls="pills-map-location" aria-selected="true">
                                            <i class="fa fa-map-marker"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-street-view-tab" data-toggle="pill" href="#pills-street-view" role="tab"
                                           aria-controls="pills-street-view" aria-selected="false">
                                            <i class="fa fa-street-view "></i></a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-map-location" role="tabpanel"
                                         aria-labelledby="pills-map-location-tab">
                                        <div id="map-canvas">
                                            <iframe class="h600 w100"
                                                    src="<?=$location_gmap?>"
                                                    style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-street-view" role="tabpanel" aria-labelledby="pills-street-view-tab">
                                        <iframe class="h600 w100"
                                                src="<?=$location_gmap?>"
                                                style="border:0;" allowfullscreen></iframe>
                                    </div>


                                </div>
                                <!-- END FILTER VERTICAL -->
                            </div>
                            <!-- END LOCATION -->


                            <!-- NEARBY -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">what's nearby</h6>
                                <div class="single__detail-features-nearby">
                                    <h6 class="text-capitalize"><span>
                                            <i class="fa fa-building "></i></span>education</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span>Eladia's Kids</span>
                                            <p>2.5 km</p>
                                        </li>
                                        <li>
                                            <span>Brooklyn Brainery</span>
                                            <p>3.5 km</p>

                                        </li>
                                        <li>
                                            <span>Wikdom Senior High Scool</span>
                                            <p>2.5 km</p>
                                        </li>

                                    </ul>

                                    <h6 class="text-capitalize"><span><i class="fa fa-ambulance"></i></span>health &
                                        medical
                                    </h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span>Eladia's Kids</span>
                                            <p>2.5 km</p>
                                        </li>
                                        <li>
                                            <span>Brooklyn Brainery</span>
                                            <p>3.5 km</p>

                                        </li>
                                        <li>
                                            <span>Wikdom Senior High Scool</span>
                                            <p>2.5 km</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END NEARBY -->


                        </div>
                    </div>
                    <!-- END DESCRIPTION -->
                </div>
                <div class="col-lg-4">

                    <!-- FORM FILTER -->
                    <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">
                                <h5 class="text-center text-capitalize">simulation calculator</h5>
                            </div>
                            <div class="products__filter__body">
                                <div class="form-group">
                                    <label>Sale Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" id="salePrice" class="form-control" placeholder="130000">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Down Payment</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" id="downPayment" class="form-control" placeholder="6000">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Long Term (Years)</label>
                                    <select id="loanYears" class="select_option wide">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Interest Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input type="number" id="interestRate" class="form-control" placeholder="10">
                                    </div>
                                </div>
                            </div>

                            <div class="products__filter__footer">
                                <div class="form-group mb-0">
                                    <button id="calculateBtn" class="btn btn-primary text-capitalize btn-block">
                                        Calculate <i class="fa fa-calculator ml-1"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="result" class="mt-3 text-center font-weight-bold"></div>
                        </div>
                    </div>

                    <!-- END FORM FILTER -->
                    <div class="sticky-top">
                        <!-- PROFILE AGENT -->
                        <div class="profile__agent mb-30">
                            <div class="profile__agent__group">

                                <div class="profile__agent__header">
                                    <?php
                                        $agent_id = get_field("select_agent"); // Get selected agent ID
                                        $agent_name= get_field("agent_display_name",$agent_id);
                                        $agent_mobile= get_field("agent_mobile",$agent_id);
                                        $agent_img = wp_get_attachment_image_src( get_field("agent_image",$agent_id) ,"full");
                                        $agency = get_field('select_agency', $agent_id);

                                        if (is_object($agency)) {
                                            $agency_name = get_the_title($agency->ID);
                                        } elseif (is_int($agency)) {
                                            $agency_name = get_the_title($agency);
                                        } else {
                                            $agency_name = 'No Agency';
                                        }
                                    ?>
                                    <div class="profile__agent__header-avatar">
                                        <figure>
                                            <img src="<?=$agent_img[0]?>" alt="" class="img-fluid">
                                        </figure>

                                        <ul class="list-unstyled mb-0">

                                            <li>
                                                <h5 class="text-capitalize"><?= $agent_name?></h5>


                                            </li>
                                            <li><a href="tel:123456"><i class="fa fa-phone-square mr-1"></i><?=$agent_mobile?></a></li>
                                            <li><a href="javascript:void(0)"><i class=" fa fa-building mr-1"></i> <?= $agency_name?></a>
                                            </li>
                                            <li> <a href="javascript:void(0)" class="text-primary">View My Listing</a></li>
                                        </ul>


                                    </div>

                                </div>
                                <div class="profile__agent__body">
                                    <div id="acf-response"></div>

                                    <form id="agentContactForm">
                                        <input type="hidden" name="agentName" value="<?= esc_attr($agent_name) ?>">
                                        <input type="hidden" name="agencyName" value="<?= esc_attr($agency_name) ?>">
                                        <input type="hidden" name="propertyId" value="<?= get_the_ID() ?>">

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                        </div>

                                        <div class="form-group mb-0">
                                            <textarea name="message" class="form-control" rows="5" placeholder="I'm interested in this property" required></textarea>
                                        </div>

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Send Message <i class="fa fa-paper-plane ml-1"></i>
                                            </button>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>
                        <!-- END PROFILE AGENT -->
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

            <!-- SIMILIAR PROPERTY -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="similiar__item">
                        <h6 class="text-capitalize detail-heading">
                            similiar properties
                        </h6>
                        <div class="similiar__property-carousel owl-carousel owl-theme">
                            <?PHP
                            $args = [
                                    'posts_per_page' => 5, // Number of posts
                                    'post_type'      => 'properties', // Post type
                                    'orderby'        => 'date',
                                    'order'          => 'DESC'
                            ];
                            $query = new Wp_Query($args);
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
            <!-- END SIMILIAR PROPERTY -->
        </div>
    </section>
    <!-- END SINGLE DETAIL -->

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
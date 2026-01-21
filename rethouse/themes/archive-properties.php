<?php
    get_header();
?>
<div class="bg-theme-overlay" style='background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/bg.jpg")'>
    <section class="section__breadcrumb ">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-capitalize text-white ">Property list</h2>
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                home
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                Property
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-white">
                                Property list
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>

<!-- LISTING LIST -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="sticky-top">
                    <?php
                    get_template_part('template-parts/common/property_filter');

                    ?>
                    <!-- ARCHIVE CATEGORY -->
                    <div class=" wrapper__list__category">
                        <!-- CATEGORY -->
                        <div class="widget widget__archive">
                            <div class="widget__title">
                                <h5 class="text-dark mb-0 text-center">Categories Property</h5>
                            </div>
                            <ul class="list-unstyled">
                                <?php
                                $terms = get_terms([
                                        'taxonomy' => 'property_category',
                                        'hide_empty' => false,
                                ]);
                                foreach ($terms as $term) {
                                    $link = get_term_link($term);
                                    ?>
                                    <li>
                                        <a href="javascript:void(0)" class="text-capitalize">
                                            <?= $term->name ?>
                                            <span class="badge badge-primary"><?= $term->count?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                        <!-- END CATEGORY -->
                    </div>
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
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs__custom-v2">
                            <!-- FILTER VERTICAL -->

                            <div id="property_list_wrap">
                                <div>
                                    <div class="row">
                                    <?php
                                        while ( have_posts() ) : the_post();
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
                                        <div class="col-md-6 col-lg-6">
                                            <div class="card__image card__box-v1">
                                                <div class="card__image-header h-250 img-space">

                                                    <img src="<?=$feature_image[0]?>" alt="" class="img-fluid w100 img-transition">
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
                                        endwhile;
                                    ?>

                                    </div>

                                    <div class="cleafix"></div>
                                </div>



                            </div>
                            <!-- END FILTER VERTICAL -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!-- END LISTING LIST -->

<?php
get_template_part("template-parts/common/cta");
?>

<?php
    get_footer();
?>
<?php
    get_header();
?>

<div class="bg-theme-overlay" style='background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/bg.jpg")'>
    <section class="section__breadcrumb ">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-capitalize text-white ">agent list</h2>
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
                                agent list
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
<section>
    <div class="profile__agency">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- FORM FILTER -->
                    <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">

                                <h5 class="text-center text-capitalize">find agents</h5>
                            </div>
                            <div class="products__filter__body">
                                <div class="form-group">
                                    <label>All Categories</label>
                                    <select class="select_option wide">
                                        <option data-display="All Categories">All Categories</option>

                                        <option>Apartment</option>
                                        <option>Bungalow</option>
                                        <option>Condo</option>
                                        <option>House</option>
                                        <option>Land</option>
                                        <option>Single Family</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>All Cities</label>
                                    <select class="select_option wide">
                                        <option data-display="All City">All Cities</option>
                                        <option>Atlanta</option>
                                        <option>Florida</option>
                                        <option>Los Angeles</option>
                                        <option>Miami</option>
                                        <option>New York</option>
                                        <option>Orlando</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- END FORM FILTER -->
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
                <div class="col-lg-8">
                    <div class="row">
                        <?php
                            while ( have_posts() ) : the_post();
                                $permalink = get_permalink();
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
                            <div class="col-lg-6 mb-5">
                                    <div class="cards mt-0">
                                        <div class="profile__agency-header">
                                            <a href="<?= $permalink?>" class="profile__agency-logo">
                                                <img src="<?= $agency_img[0]?>" alt="" class="img-fluid">
                                                <div class="total__property-agent">20 listing</div>
                                            </a>
                                        </div>
                                        <div class="profile__agency-body">
                                            <div class="profile__agency-info">
                                                <h5 class="text-capitalize">
                                                    <a href="<?= $permalink?>" target="_blank"><?=$display_name?></a>
                                                </h5>
                                                <p class="text-capitalize mb-1"><?= $address?></p>
                                                <ul class="list-unstyled mt-2">
                                                    <li><a href="#" class="text-capitalize"><span><i class="fa fa-building"></i> office :</span>
                                                        <?= $office?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="text-capitalize"><span><i class="fa fa-phone"></i> mobile :</span> <?= $mobile?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="text-capitalize"><span><i class="fa fa-fax"></i> fax : </span><?= $fax?></a>
                                                    </li>
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
                         <?php
                            endwhile;
                        ?>

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
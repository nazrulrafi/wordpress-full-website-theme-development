<?php
/*
Template Name: About
*/

get_header();
?>
<?php
    $cover_img = get_field('cover_image');
    $cover_img = wp_get_attachment_image_src($cover_img, 'full');

    $basic_info = get_field('basic_info');
    $title  = $basic_info["title"];
    $sub_title  = $basic_info["sub_title"];
    $description  = $basic_info["description"];
    $image_one = wp_get_attachment_image_src($basic_info["image_one"], 'full');
    $image_two = wp_get_attachment_image_src($basic_info["image_two"], 'full');


    $partner_info = get_field('partner_info');

    $team_info= get_field('team_info');
?>
<div class="bg-theme-overlay" style='background-image: url("<?php echo $cover_img[0]; ?>")'>
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


<!-- ABOUT -->
<section class="home__about bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="title__leading">
                   <h6 class="text-uppercase"><?= $sub_title?></h6>
                    <h2 class="text-capitalize"><?= $title?></h2>
                    <?php
                       echo $description
                    ?>
                    <a href="#" class="btn btn-primary mt-3 text-capitalize"> read more
                        <i class="fa fa-angle-right ml-3 "></i></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__image">
                    <div class="about__image-top">
                        <div class="about__image-top-hover">
                            <img src="<?= $image_one[0]?>" alt="" class="img-fluid">
                        </div>

                    </div>
                    <div class="about__image-bottom">
                        <div class="about__image-bottom-hover">
                            <img src="<?= $image_two[0]?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END ABOUT -->



<section class="projects__partner ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="title__head">
                    <h2 class="text-center text-capitalize"><?= $partner_info["title"]?></h2>
                    <p class="text-center text-capitalize"><?= $partner_info["description"]?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="projects__partner-logo">
                    <ul class="list-inline mb-0">
                        <?php
                            foreach ($partner_info["images"] as $partner) {
                                    $img_url = wp_get_attachment_image_src($partner, 'full');
                                ?>
                                <li class="list-inline-item">
                                    <img src="<?= $img_url[0]?>" alt="" class="img-fluid">
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR TEAM -->
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="title__head">
                    <h2 class="text-center text-capitalize">
                        <?= $team_info["title"]?>
                    </h2>
                    <p class="text-center text-capitalize"><?=$team_info["description"]?></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <?php
                $member_details = $team_info["partner_details"];
                foreach ($member_details as $member) {
                    $name = $member["name"];
                    $designation = $member["designation"];
                    $member_img = $member["member_img"];
                    $memberImgUrl = wp_get_attachment_image_src($member_img, 'full');
                    ?>
                    <div class="col-md-4">
                        <div class="wrap-agent">
                            <div class="team-member">
                                <div class="team-img">
                                    <img alt="team member" class="img-fluid w-100" src="<?= $memberImgUrl[0]?>">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <h5>
                                            Hi There !
                                        </h5>
                                        <p>
                                            I am Senior Agent Property
                                        </p>
                                        <a class="btn btn-primary" href="#">
                                            Agent Profile
                                        </a>
                                    </div>
                                    <ul class="list-inline s-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-facebook">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-twitter">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-google-plus">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="team-title">
                                    <h6><?= $name?></h6>
                                    <span><?= $designation?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>

        </div>
    </div>
</section>
<!-- END TEAM -->

<?php
get_template_part("template-parts/common/cta");
?>

<?php
get_footer();
?>

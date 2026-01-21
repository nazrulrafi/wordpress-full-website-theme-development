<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    wp_head();
    ?>

<body>
<!-- NAVBAR TOP -->
<div class="topbar d-none d-sm-block">
    <div class="container ">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="topbar-left">
                    <div class="topbar-text">
                        <?php echo date_i18n('l, F j, Y'); ?>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="list-unstyled topbar-right">
<!--                    <ul class="topbar-link">-->
<!--                        <li><a href="#" title="">Career</a></li>-->
<!--                        <li><a href="#" title="">Contact Us</a></li>-->
<!--                        <li><a href="#" title="">Login / Register</a></li>-->
<!--                    </ul>-->
                    <ul class="topbar-sosmed">
                        <?php
                        $facebook  = get_theme_mod('facebook_link');
                        $twitter   = get_theme_mod('twitter_link');
                        $instagram = get_theme_mod('instagram_link');
                        ?>

                        <?php if ($facebook) : ?>
                            <li>
                                <a href="<?php echo esc_url($facebook); ?>" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($twitter) : ?>
                            <li>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($instagram) : ?>
                            <li>
                                <a href="<?php echo esc_url($instagram); ?>" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END NAVBAR TOP -->
<nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
    <div class="container">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php
                $logo_id =get_theme_mod("custom_logo");
                $logo_url = wp_get_attachment_image_src($logo_id,"full");
            ?>
            <img src="<?= $logo_url[0]?>" alt="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav99">
            <?php
            if (has_nav_menu('main_menu')) {
                wp_nav_menu([
                        'theme_location' => 'main_menu',
                        'menu_class'     => 'navbar-nav mx-auto',
                        'container'      => false,
                        'walker'         => new HeaderMenu()
                ]);
            }
            ?>

            <!-- Search bar.// -->
            <ul class="navbar-nav">
                <li>
                    <a href="#" class="btn btn-primary text-capitalize" data-bs-toggle="modal" data-bs-target="#addListing">
                        <i class="fa fa-plus-circle mr-1"></i> add listing</a>
                </li>
            </ul>
            <!-- Search content bar.// -->
            <div class="top-search navigation-shadow">
                <div class="container">
                    <div class="input-group ">
                        <form action="#">

                            <div class="row no-gutters mt-3">
                                <div class="col">
                                    <input class="form-control border-secondary border-right-0 rounded-0" type="search"
                                           value="" placeholder="Search " id="example-search-input4">
                                </div>
                                <div class="col-auto">
                                    <a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"
                                       href="/search-result.html">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Search content bar.// -->
        </div> <!-- navbar-collapse.// -->
    </div>
</nav>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php
    wp_head();
    ?>

</head>

<body id="top">

<!-- pageheader
================================================== -->
<section class="s-pageheader <?php echo is_front_page() ? 's-pageheader--home' : ''; ?>">

    <header class="header">
        <div class="header__content row">

            <div class="header__logo">
                <a class="logo" href="<?php echo esc_url( home_url('/') ); ?>">
                    <?php
                    if ( function_exists('the_custom_logo') && has_custom_logo() ) {
                        the_custom_logo(); // will output the uploaded logo
                    } else {
                        // fallback: site name as text
                        echo '<h1>' . get_bloginfo('name') . '</h1>';
                    }
                    ?>
                </a>
            </div>
            <!-- end header__logo -->

            <ul class="header__social">
                <?php if ( get_theme_mod('facebook_link') ) : ?>
                    <li><a href="<?php echo esc_url( get_theme_mod('facebook_link') ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <?php endif; ?>

                <?php if ( get_theme_mod('twitter_link') ) : ?>
                    <li><a href="<?php echo esc_url( get_theme_mod('twitter_link') ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <?php endif; ?>

                <?php if ( get_theme_mod('instagram_link') ) : ?>
                    <li><a href="<?php echo esc_url( get_theme_mod('instagram_link') ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <?php endif; ?>

                <?php if ( get_theme_mod('pinterest_link') ) : ?>
                    <li><a href="<?php echo esc_url( get_theme_mod('pinterest_link') ); ?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <?php endif; ?>
            </ul>
            <!-- end header__social -->

            <a class="header__search-trigger" href="#0"></a>

            <div class="header__search">

                <?php get_search_form(); ?>


                <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

            </div>  <!-- end header__search -->


            <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

            <nav class="header__nav-wrap">

                <h2 class="header__nav-heading h6">Site Navigation</h2>

                <?php
                    if (has_nav_menu('primary_menu')){
                        $main_menu = wp_nav_menu( array(
                                'theme_location'  => 'primary_menu',  // your registered menu
                                'container'       => false,           // no wrapping <div>
                                'menu_class'      => 'header__nav',   // ul class
                                'menu_id'         => 'mainmenu',   // ul class
                                'echo'            => false,

                        ) );
                        $main_menu = str_replace('menu-item-has-children', 'has-children', $main_menu);
                        echo $main_menu;
                    }
                ?>


                <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end header__nav-wrap -->

        </div> <!-- header-content -->
    </header> <!-- header -->
    <?php if (  is_front_page() ) : ?>
        <div class="homepage-only">
            <!-- Your content here -->
            <?php
            get_template_part('template-parts/parts/featured');
            ?>
        </div>
    <?php endif; ?>


</section> <!-- end s-pageheader -->
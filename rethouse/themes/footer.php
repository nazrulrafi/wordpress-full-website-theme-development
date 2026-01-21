<!-- Footer  -->
<footer>
    <div class="wrapper__footer bg-theme-footer"
         style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg18.jpg');">
        <div class="container">
            <div class="row">
                <!-- ADDRESS -->
                <div class="col-md-4">
                    <?php if ( is_active_sidebar( 'footer_widget' ) ) : ?>
                        <?php dynamic_sidebar( 'footer_widget' ); ?>
                    <?php endif; ?>

                </div>
                <!-- END ADDRESS -->

                <!-- QUICK LINKS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">Quick Links</h4>
                        <div class="link__category-two-column">
                            <?php
                            if (has_nav_menu('quick_links')) {
                                wp_nav_menu([
                                        'theme_location' => 'quick_links',
                                        'menu_class'     => 'list-unstyled',
                                        'container'      => false,          // remove extra <div>
                                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>', // clean ul/li only
                                ]);
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <!-- END QUICK LINKS -->


                <!-- NEWSLETTERS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">follow us </h4>
                        <p class="mb-2">
                            Follow us and stay in touch to get the latest news
                        </p>
                        <p>
                            <?php
                            $facebook  = get_theme_mod('facebook_link');
                            $twitter   = get_theme_mod('twitter_link');
                            $instagram = get_theme_mod('instagram_link');
                            ?>
                            <?php
                                if ($facebook){
                                ?>
                                    <a href="<?= $facebook?>">
                                        <button class="btn btn-social btn-social-o facebook mr-1">
                                            <i class="fa fa-facebook-f"></i>
                                        </button>
                                    </a>
                            <?php
                                }
                            ?>
                            <?php
                            if ($twitter){
                                ?>
                                <a href="<?= $twitter?>">
                                    <button class="btn btn-social btn-social-o twitter mr-1">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                </a>
                                <?php
                            }
                            ?>
                            <?php
                            if ($instagram){
                                ?>
                                <a href="<?= $instagram?>">
                                    <button class="btn btn-social btn-social-o instagram mr-1">
                                        <i class="fa fa-instagram"></i>
                                    </button>
                                </a>
                                <?php
                            }
                            ?>

                        </p>

                        <br>
                        <h4 class="footer-title">newsletter</h4>
                        <!-- Form Newsletter -->
                        <div class="widget__form-newsletter ">
                            <p>

                                Don’t miss to subscribe to our news feeds, kindly fill the form below
                            </p>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" placeholder="Your email address">

                                <button class="btn btn-primary btn-block text-capitalize" type="button">subscribe

                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END NEWSLETTER -->
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="bg__footer-bottom-v1">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6">
                        <span>
                            © 2020 Rethouse Real Estate - Premium real estate & theme &amp; theme by
                            <a href="#">retenvi.com</a>
                        </span>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="#">
                                privacy
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                contact
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                about
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                faq
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer  -->
</footer>

<?php

get_template_part("template-parts/modal/add-listing");
?>
<!-- SCROLL TO TOP -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TO TOP -->
<?php
wp_footer();
?>

</html>
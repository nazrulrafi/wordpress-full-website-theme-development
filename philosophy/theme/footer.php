
<!-- s-footer
================================================== -->
<footer class="s-footer">

    <div class="s-footer__main">
        <div class="row">

            <div class="col-two md-four mob-full s-footer__sitelinks">

                <h4>Quick Links</h4>
                <?php
                    if (has_nav_menu('quick_links')) {
                        wp_nav_menu(array(
                                'theme_location' => 'quick_links',
                            'container' => false,
                            'menu_class' => 's-footer__linklist',
                        ));
                    }
                ?>


            </div> <!-- end s-footer__sitelinks -->

            <div class="col-two md-four mob-full s-footer__archives">

                <h4>Archives</h4>

                <ul class="s-footer__linklist">
                    <?php
                        wp_get_archives( array(
                                'type'            => 'monthly',   // monthly, yearly, daily
                                'limit'           => 6,           // number of months to show
                                'format'          => 'html',      // output as <li><a>...</a></li>
                                'before'          => '<li>',      // opening tag for each item
                                'after'           => '</li>',     // closing tag for each item
                        ) );
                    ?>
                </ul>

            </div>
            <!-- end s-footer__archives -->

            <div class="col-two md-four mob-full s-footer__social">

                <h4>Social</h4>

                <ul class="s-footer__linklist">
                    <?php
                    $socials = array(
                            'facebook_link'   => 'Facebook',
                            'instagram_link'  => 'Instagram',
                            'twitter_link'    => 'Twitter',
                            'pinterest_link'  => 'Pinterest',
                            'googleplus_link' => 'Google+',
                            'linkedin_link'   => 'LinkedIn'
                    );

                    foreach ($socials as $id => $label) {
                        $link = get_theme_mod($id);
                        if ($link) {
                            echo '<li><a href="' . esc_url($link) . '" target="_blank">' . esc_html($label) . '</a></li>';
                        }
                    }
                    ?>
                </ul>


            </div> <!-- end s-footer__social -->

            <div class="col-five md-full end s-footer__subscribe">

                <h4>Our Newsletter</h4>

                <p>Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa consequatur occaecati.</p>

                <div class="subscribe-form">
                    <form id="mc-form" class="group" novalidate="true">

                        <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">

                        <input type="submit" name="subscribe" value="Send">

                        <label for="mc-email" class="subscribe-message"></label>

                    </form>
                </div>

            </div> <!-- end s-footer__subscribe -->

        </div>
    </div> <!-- end s-footer__main -->

    <div class="s-footer__bottom">
        <div class="row">
            <div class="col-full">
                <div class="s-footer__copyright">
                    <span>© Copyright <a target="_blank" href="https://nazrulrafi.com/">nazrul rafi</a></span>

                </div>

                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"></a>
                </div>
            </div>
        </div>
    </div> <!-- end s-footer__bottom -->

</footer> <!-- end s-footer -->


<!-- preloader
================================================== -->
<div id="preloader">
    <div id="loader">
        <div class="line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>


<!-- Java Script
================================================== -->
<?php
wp_footer();
?>

</body>

</html>
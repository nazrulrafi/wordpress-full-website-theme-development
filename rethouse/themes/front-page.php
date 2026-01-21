<?php
get_header();
?>


<?php get_template_part("template-parts/home/banner_slider"); ?>

    <div class="clearfix"></div>

<?php

get_template_part("template-parts/home/popular_city");
get_template_part("template-parts/home/featured_properties");
get_template_part("template-parts/home/about");
get_template_part("template-parts/home/partners");
get_template_part("template-parts/home/testimonials");
get_template_part("template-parts/home/blog");
get_template_part("template-parts/common/cta");
?>

<?php
get_footer();
?>
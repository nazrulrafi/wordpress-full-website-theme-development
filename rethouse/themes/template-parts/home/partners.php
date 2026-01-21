<?php
    $partner_image = get_field('partner_image');

?>
<section class="projects__partner bg-light ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="title__head">
                    <h2 class="text-center text-capitalize"><?= $partner_image["title"]?></h2>
                    <p class="text-center text-capitalize"><?= $partner_image["description"]?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="projects__partner-logo">
                    <ul class="list-inline mb-0">
                        <?php
                            $images = $partner_image["partner_img"];
                           foreach ($images as $image) {
                               $img_url = wp_get_attachment_image_src($image, "full");
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
<!-- FORM FILTER -->
<?php
$group_field_object = get_field_object('peroperty_meta_info');

if( $group_field_object && isset($group_field_object['sub_fields']) ) {
    $sub_fields = $group_field_object['sub_fields'];

    // Helper to get a sub-field by name
    function get_sub_field_choices($sub_fields, $name){
        foreach($sub_fields as $sub){
            if($sub['name'] === $name){
                return $sub['choices'] ?? [];
            }
        }
        return [];
    }
}

// Property Status
$status_choices = get_sub_field_choices($sub_fields, 'property_status');
// Property Type
$type_choices = get_sub_field_choices($sub_fields, 'property_type');
// Total Area
$area_choices = get_sub_field_choices($sub_fields, 'total_area');
// Bedrooms
$bed_choices = get_sub_field_choices($sub_fields, 'bedrooms');
// Bathrooms
$bath_choices = get_sub_field_choices($sub_fields, 'bathrooms');
?>

<div class="products__filter mb-30">
    <div class="products__filter__group">
        <div class="products__filter__header">

            <h5 class="text-center text-capitalize">property filter</h5>
        </div>
        <div class="products__filter__body">
            <div class="form-group">
                <!-- Property Status -->
                <select  name="property_status" id="property_status">
                    <option value="">Property Status</option>
                    <?php foreach($status_choices as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <!-- Property Type -->
                <select  name="property_type" id="property_type">
                    <option value="">Property Type</option>
                    <?php foreach($type_choices as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <!-- Total Area -->
                <select  name="total_area" id="total_area">
                    <option value="">Area From</option>
                    <?php foreach($area_choices as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <select  name="location" id="location">
                    <option value="">Locations</option>
                    <?php
                    $locations = get_terms(['taxonomy' => 'location', 'hide_empty' => false]);
                    foreach($locations as $loc){
                        echo '<option value="'.esc_attr($loc->slug).'">'.esc_html($loc->name).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <!-- Bedrooms -->
                <select  name="bedrooms" id="bedrooms">
                    <option value="">Bedrooms</option>
                    <?php foreach($bed_choices as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <!-- Bathrooms -->
                    <select  name="bathrooms" id="bathrooms">
                        <option value="">Bathrooms</option>
                        <?php foreach($bath_choices as $value => $label): ?>
                            <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php
            $args = [
                    'post_type'      => 'properties', // your CPT
                    'posts_per_page' => -1,
                    'fields'         => 'ids',      // only get post IDs
            ];

            $posts = get_posts($args);
            $prices = []; // initialize empty array

            if (!empty($posts)) {
                foreach ($posts as $post_id) {
                    $meta = get_field('peroperty_meta_info', $post_id); // get the group field
                    if (!empty($meta) && isset($meta['total_price']) && is_numeric($meta['total_price'])) {
                        $prices[] = intval($meta['total_price']);
                    }
                }
            }
            $price_min = !empty($prices) ? min($prices) : 0;
            $price_max = !empty($prices) ? max($prices) : 1000000; // fallback max
            ?>

            <div class="form-group">
                <label class="mb-3">Price Range</label>
                <div id="price-slider"></div>
                <input type="hidden" id="price_min" name="price_min" value="<?php echo esc_attr($price_min); ?>">
                <input type="hidden" id="price_max" name="price_max" value="<?php echo esc_attr($price_max); ?>">
                <p class="mt-2">
                    Selected:
                    <span id="price-range-text">
                        <?php
                        echo '$' . number_format($price_min) . ' - $' . number_format($price_max);
                        ?>
                    </span>
                </p>
            </div>



            <div class="form-group mb-0 mt-2">

                <a class="btn btn-outline-primary btn-block text-capitalize advanced-filter" data-toggle="collapse"
                   href="#multiCollapseExample1" aria-controls="multiCollapseExample1"><i
                        class="fa fa-plus-circle"></i> advanced
                    filter
                </a>

                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <?php
                    // Get the group field object
                    $group_field_object = get_field_object('peroperty_meta_info');

                    $features = [];
                    if( $group_field_object && isset($group_field_object['sub_fields']) ){
                        // Loop sub-fields to find 'features'
                        foreach($group_field_object['sub_fields'] as $sub_field){
                            if($sub_field['name'] === 'features'){ // the sub-field key
                                $features = $sub_field['choices'] ?? []; // get choices for checkbox or select
                                break;
                            }
                        }
                    }
                    ?>

                    <div class="advancedfilter">
                        <?php foreach($features as $value => $label): ?>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="features[]" value="<?php echo esc_attr($value); ?>" id="feature-<?php echo esc_attr($value); ?>">
                                <label for="feature-<?php echo esc_attr($value); ?>" class="label-brand text-capitalize"><?php echo esc_html($label); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>


                </div>
            </div>
        </div>
<!--        <div class="products__filter__footer">-->
<!--            <div class="form-group mb-0">-->
<!--                <button class="btn btn-primary text-capitalize btn-block"><i class="fa fa-search ml-1"></i> search-->
<!--                    property </button>-->
<!---->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
<!-- END FORM FILTER -->

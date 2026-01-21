document.addEventListener('DOMContentLoaded', function() {

    // --------------------------
    // Price Slider Initialization
    // --------------------------
    var slider = document.getElementById('price-slider');
    if(slider){
        var min = parseInt(document.getElementById('price_min').value) || 0;
        var max = parseInt(document.getElementById('price_max').value) || 1000000;

        noUiSlider.create(slider, {
            start: [min, max],
            connect: true,
            step: 1000,
            range: { 'min': min, 'max': max },
            format: {
                to: value => Math.round(value),
                from: value => Number(value)
            }
        });

        slider.noUiSlider.on('update', function(values){
            document.getElementById('price_min').value = values[0];
            document.getElementById('price_max').value = values[1];
            document.getElementById('price-range-text').textContent =
                '$' + Number(values[0]).toLocaleString() + ' - $' + Number(values[1]).toLocaleString();
        });
    }

    // --------------------------
    // AJAX Fetch Properties
    // --------------------------
    function fetchProperties() {
        var data = {
            action: 'filter_properties',
            property_status: document.getElementById('property_status')?.value || '',
            property_type: document.getElementById('property_type')?.value || '',
            total_area: document.querySelector('[name="total_area"]')?.value || '',
            bedrooms: document.querySelector('[name="bedrooms"]')?.value || '',
            bathrooms: document.querySelector('[name="bathrooms"]')?.value || '',
            location: document.querySelector('[name="location"]')?.value || '',
            features: Array.from(document.querySelectorAll('input[name="features[]"]:checked')).map(el => el.value),
            price_min: document.getElementById('price_min')?.value || '',
            price_max: document.getElementById('price_max')?.value || ''
        };

        fetch(rethouse_ajax.ajaxurl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(data)
        })
            .then(res => res.text())
            .then(html => {
               document.getElementById('property_list_wrap').innerHTML = html;
            })
            .catch(err => console.error(err));
    }

    // --------------------------
    // Filter Selects & Change Events
    // --------------------------
    let filterIds = ['property_status', 'property_type', 'total_area', 'location', 'bedrooms', 'bathrooms'];

    filterIds.forEach(id => {
        let selectEl = document.getElementById(id);
        if (!selectEl) return;
        selectEl.addEventListener('change', fetchProperties);
    });

    // --------------------------
    // Features Checkboxes
    // --------------------------
    document.querySelectorAll('input[name="features[]"]').forEach(cb => {
        cb.addEventListener('change', fetchProperties);
    });

    // --------------------------
    // Price Slider Change
    // --------------------------
    if(slider && slider.noUiSlider){
        slider.noUiSlider.on('change', fetchProperties);
    }

});

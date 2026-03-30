document.addEventListener('DOMContentLoaded', function () {

    const slider = document.getElementById('price-slider');
    

    if (!slider) return;

    const url = new URL(window.location.href);

    let min = url.searchParams.get('min_price') || 0;
    let max = url.searchParams.get('max_price') || 500;

    noUiSlider.create(slider, {
        start: [min, max],
        connect: true,
        step: 1,
        range: {
            'min': parseFloat(price_range.min),
            'max': parseFloat(price_range.max)
        }
    });

    const priceText = document.getElementById('filter-price-range');

    slider.noUiSlider.on('update', function (values) {
        priceText.innerHTML = `Br ${Math.round(values[0])} - Br ${Math.round(values[1])}`;
    });

    slider.noUiSlider.on('change', function (values) {

        const newUrl = new URL(window.location.href);

        newUrl.searchParams.set('min_price', Math.round(values[0]));
        newUrl.searchParams.set('max_price', Math.round(values[1]));

        window.location.href = newUrl.toString();
    });

});

/**
 * Reset pagination to page 1 whenever filters change
 */
jQuery(document).ready(function ($) {

    $('.filter-category, #price-slider').on('change', function () {

        const url = new URL(window.location.href);

        // REMOVE pagination
        url.searchParams.delete('paged');

        // ALSO remove /page/x/ from URL (important)
        url.pathname = url.pathname.replace(/\/page\/\d+\//, '/');

        // Categories
        let categories = [];
        $('.filter-category:checked').each(function () {
            categories.push($(this).val());
        });

        if (categories.length > 0) {
            url.searchParams.set('category', categories.join(','));
        } else {
            url.searchParams.delete('category');
        }

        // Price
        if (typeof price_range !== "undefined") {
            url.searchParams.set('min_price', price_range[0]);
            url.searchParams.set('max_price', price_range[1]);
        }

        // 🔥 Redirect
        window.location.href = url.toString();
    });

});
document.addEventListener('DOMContentLoaded', function () {

    // CLEAN ALL FIX
    const cleanBtn = document.querySelector('.sidebar-filter-clear');

    if (cleanBtn) {
        cleanBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Force full reload to shop page (no params)
            window.location.href = this.href;
        });
    }

    function updateFilters(param, value, isChecked) {
        const url = new URL(window.location.href);
        let values = url.searchParams.get(param);

        values = values ? values.split(',') : [];

        if (isChecked) {
            if (!values.includes(value)) values.push(value);
        } else {
            values = values.filter(v => v !== value);
        }

        if (values.length > 0) {
            url.searchParams.set(param, values.join(','));
        } else {
            url.searchParams.delete(param);
        }

        window.location.href = url.toString();
    }

    // CATEGORY
    document.querySelectorAll('.filter-category').forEach(el => {
        el.addEventListener('change', function () {
            updateFilters('category', this.value, this.checked);
        });
    });

    // BRAND
    document.querySelectorAll('.filter-brand').forEach(el => {
        el.addEventListener('change', function () {
            updateFilters('brand', this.value, this.checked);
        });
    });

});
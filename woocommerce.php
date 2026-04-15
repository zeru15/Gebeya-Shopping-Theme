<?php
defined("ABSPATH") || exit;
/* Single Product Page */
if (is_product()) {
    wc_get_template_part('content', 'single-product');
    return;
}
?>

<?php get_header() ?>

<main class="main">

    <!-- PAGE HEADER -->
    <div class="page-header text-center"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">
                <?php woocommerce_page_title(); ?>
                <span>Shop</span>
            </h1>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </nav>



    <div class="page-content">
        <div class="container">
            <div class="row">

                <!-- MAIN SHOP -->
                <div class="col-lg-9">

                    <!-- TOOLBAR -->
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <?php woocommerce_result_count(); ?>
                        </div>
                        <div class="toolbox-right">
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>

                    <div class="woocommerce-notices-wrapper"></div>

                    <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    // If filtering is active → force page 1
                    if (
                        isset($_GET['category']) ||
                        isset($_GET['brand']) ||
                        isset($_GET['min_price']) ||
                        isset($_GET['max_price'])
                    ) {
                        $paged = 1;
                    }

                    // Apply to main query
                    set_query_var('paged', $paged);
                    ?>

                    <!-- PRODUCTS (WooCommerce Loop Injected Here) -->
                    <?php if (have_posts()): ?>

                        <?php do_action('woocommerce_before_shop_loop'); ?>

                        <div class="products mb-3">
                            <div class="row justify-content-center">

                                <?php while (have_posts()):
                                    the_post(); ?>
                                    <?php wc_get_template_part('content', 'product'); ?>
                                <?php endwhile; ?>

                            </div>
                        </div>

                        <?php do_action('woocommerce_after_shop_loop'); ?>

                    <?php else: ?>
                        <?php do_action('woocommerce_no_products_found'); ?>
                    <?php endif; ?>

                    <?php
                    global $wp_query;

                    $total_pages = $wp_query->max_num_pages;
                    $current_page = max(1, get_query_var('paged'));

                    if ($total_pages > 1): ?>

                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">

                                <!-- PREV -->
                                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link page-link-prev"
                                        href="<?php echo ($current_page > 1) ? get_pagenum_link($current_page - 1) : '#'; ?>"
                                        aria-label="Previous" <?php echo ($current_page == 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                    </a>
                                </li>

                                <!-- PAGE NUMBERS -->
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>" <?php echo ($i == $current_page) ? 'aria-current="page"' : ''; ?>>
                                        <a class="page-link" href="<?php echo get_pagenum_link($i); ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <!-- TOTAL -->
                                <li class="page-item-total">of <?php echo $total_pages; ?></li>

                                <!-- NEXT -->
                                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link page-link-next"
                                        href="<?php echo ($current_page < $total_pages) ? get_pagenum_link($current_page + 1) : '#'; ?>"
                                        aria-label="Next">
                                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>

                            </ul>
                        </nav>

                    <?php endif; ?>

                </div>

                <!-- SIDEBAR -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">

                        <!-- CLEAN -->
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>?clear_filters=1"
                                class="sidebar-filter-clear">
                                Clean All
                            </a>
                        </div>

                        <!-- Filter For Categories -->
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                        ]);
                        ?>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1">Category</a>
                            </h3>

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">

                                        <?php foreach ($categories as $cat): ?>

                                            <?php
                                            $checked = (isset($_GET['category']) && $_GET['category'] == $cat->slug) ? 'checked' : '';
                                            ?>

                                            <?php
                                            $selected_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : [];
                                            ?>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input filter-category"
                                                        value="<?php echo esc_attr($cat->slug); ?>"
                                                        id="cat-<?php echo $cat->term_id; ?>" <?php checked(in_array($cat->slug, $selected_categories)); ?>>

                                                    <label class="custom-control-label"
                                                        for="cat-<?php echo $cat->term_id; ?>">
                                                        <?php echo $cat->name; ?>
                                                    </label>

                                                </div>

                                                <span class="item-count"><?php echo $cat->count; ?></span>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter for Brands -->
                        <?php
                        $brands = get_terms([
                            'taxonomy' => 'pa_brand',
                            'hide_empty' => true,
                        ]);
                        ?>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4">Brand</a>
                            </h3>

                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">

                                        <?php foreach ($brands as $brand): ?>

                                            <?php
                                            $checked = (isset($_GET['brand']) && $_GET['brand'] == $brand->slug) ? 'checked' : '';
                                            ?>

                                            <?php
                                            $selected_brands = isset($_GET['brand']) ? explode(',', $_GET['brand']) : [];
                                            ?>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input filter-brand"
                                                        value="<?php echo esc_attr($brand['slug']); ?>"
                                                        id="brand-<?php echo $brand['term_id']; ?>" <?php checked(in_array($brand['slug'], $selected_brands)); ?>>

                                                    <label class="custom-control-label"
                                                        for="brand-<?php echo $brand['term_id']; ?>">
                                                        <?php echo $brand['name']; ?>
                                                    </label>

                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Slider -->
                        <div class="filter-price">
                            <div class="filter-price-text">
                                Price Range:
                                <span id="filter-price-range"></span>
                            </div>

                            <div id="price-slider"></div>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </div>

</main>

<?php get_footer() ?>
<?php

/**
 * Template Name: Homepage Template
 */

get_header();

?>

<main class="main">
    <?php
    $slides = json_decode(get_theme_mod('gebeyashoptheme_slider'), true);

    if (!empty($slides)):
        ?>

        <div class="intro-slider-container">
            <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
            "nav": false,
            "responsive": {
                "992": {
                    "nav": true
                }
            }
        }'>

                <?php foreach ($slides as $slide): ?>

                    <div class="intro-slide" style="background-image: url(<?php echo esc_url($slide['image'] ?? ''); ?>);">

                        <div class="container intro-content">
                            <div class="row">
                                <div class="col-auto offset-lg-3 intro-col">

                                    <!-- 🔹 Title 1 -->
                                    <?php if (!empty($slide['title1'])): ?>
                                        <h3 class="intro-subtitle">
                                            <?php echo $slide['title1']; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <!-- 🔹 Title 2 -->
                                    <h1 class="intro-title">
                                        <?php echo $slide['title2'] ?? ''; ?>

                                        <span>

                                            <?php if (!empty($slide['regular_price'])): ?>
                                                <sup class="font-weight-light line-through">
                                                    <?php echo esc_html($slide['regular_price']); ?>
                                                </sup>
                                            <?php endif; ?>

                                            <?php if (!empty($slide['sale_price'])): ?>
                                                <span class="text-primary">
                                                    <?php echo esc_html($slide['sale_price']); ?>
                                                </span>
                                            <?php endif; ?>

                                        </span>
                                    </h1>

                                    <!-- 🔹 Button -->
                                    <a href="<?php echo esc_url($slide['link'] ?? '#'); ?>" class="btn btn-outline-primary-2">

                                        <span><?php _e('Shop Now', 'gebeyashoptheme'); ?></span>
                                        <i class="icon-long-arrow-right"></i>

                                    </a>

                                </div>
                            </div>
                        </div>

                    </div><!-- End .intro-slide -->

                <?php endforeach; ?>

            </div><!-- End .owl-carousel -->

            <span class="slider-loader"></span>

        </div><!-- End .intro-slider-container -->

    <?php endif; ?><!-- End .intro-slider-container -->

    <div class="mb-4"></div><!-- End .mb-2 -->

    <?php
    $selected = get_theme_mod('gebeyashoptheme_selected_categories');

    if ($selected):

        $category_ids = explode(',', $selected);

        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'include' => $category_ids,
            'orderby' => 'include',
            'hide_empty' => false,
        ));
        ?>

        <div class="container">
            <h2 class="title text-center mb-2"><?php _e('Explore Popular Categories', 'gebeyashoptheme'); ?></h2>

            <div class="cat-blocks-container">
                <div class="row">

                    <?php foreach ($categories as $category):

                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);

                        if (!$image) {
                            $image = wc_placeholder_img_src();
                        }
                        ?>

                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="cat-block">
                                <figure>
                                    <span>
                                        <img src="<?php echo esc_url($image); ?>"
                                            alt="<?php echo esc_attr($category->name); ?>">
                                    </span>
                                </figure>

                                <h3 class="cat-block-title">
                                    <?php echo esc_html($category->name); ?>
                                </h3>
                            </a>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    <?php endif; ?><!-- End .container -->

    <div class="mb-2"></div><!-- End .mb-2 -->


    <?php

    // Banner 1
    $banner1_title1 = get_theme_mod('gebeyashoptheme_banner1_title1');
    $banner1_title2 = get_theme_mod('gebeyashoptheme_banner1_title2');
    $banner1_title3 = get_theme_mod('gebeyashoptheme_banner1_title3');
    $banner1_btn_link = get_theme_mod('gebeyashoptheme_banner1_button_link');
    $banner1_btn_text = get_theme_mod('gebeyashoptheme_banner1_button_text');
    $banner1_image = get_theme_mod('gebeyashoptheme_banner1_image');

    // Banner 2
    $banner2_title1 = get_theme_mod('gebeyashoptheme_banner2_title1');
    $banner2_title2 = get_theme_mod('gebeyashoptheme_banner2_title2');
    $banner2_title3 = get_theme_mod('gebeyashoptheme_banner2_title3');
    $banner2_btn_link = get_theme_mod('gebeyashoptheme_banner2_button_link');
    $banner2_btn_text = get_theme_mod('gebeyashoptheme_banner2_button_text');
    $banner2_image = get_theme_mod('gebeyashoptheme_banner2_image');

    // Banner 3
    $banner3_title1 = get_theme_mod('gebeyashoptheme_banner3_title1');
    $banner3_title2 = get_theme_mod('gebeyashoptheme_banner3_title2');
    $banner3_title3 = get_theme_mod('gebeyashoptheme_banner3_title3');
    $banner3_btn_link = get_theme_mod('gebeyashoptheme_banner3_button_link');
    $banner3_btn_text = get_theme_mod('gebeyashoptheme_banner3_button_text');
    $banner3_image = get_theme_mod('gebeyashoptheme_banner3_image');

    // Banner 4
    $banner4_title1 = get_theme_mod('gebeyashoptheme_banner4_title1');
    $banner4_title2 = get_theme_mod('gebeyashoptheme_banner4_title2');
    $banner4_title3 = get_theme_mod('gebeyashoptheme_banner4_title3');
    $banner4_btn_link = get_theme_mod('gebeyashoptheme_banner4_button_link');
    $banner4_btn_text = get_theme_mod('gebeyashoptheme_banner4_button_text');
    $banner4_image = get_theme_mod('gebeyashoptheme_banner4_image');

    // Banner 5
    $banner5_title1 = get_theme_mod('gebeyashoptheme_banner5_title1');
    $banner5_title2 = get_theme_mod('gebeyashoptheme_banner5_title2');
    $banner5_title3 = get_theme_mod('gebeyashoptheme_banner5_title3');
    $banner5_btn_link = get_theme_mod('gebeyashoptheme_banner5_button_link');
    $banner5_btn_text = get_theme_mod('gebeyashoptheme_banner5_button_text');
    $banner5_image = get_theme_mod('gebeyashoptheme_banner5_image');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="<?php echo esc_url($banner1_image) ?>" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white"><a href="#"><?php echo $banner1_title1 ?></a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a
                                href="#"><?php echo $banner1_title2 ?><br><span><?php echo $banner1_title3 ?></span></a>
                        </h3><!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner1_btn_link) ?>"
                            class="banner-link"><?php echo $banner1_btn_text ?><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-3 -->

            <div class="col-sm-6 col-lg-3 order-lg-last">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="<?php echo esc_url($banner2_image) ?>" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white"><a href="#"><?php echo ($banner2_title1) ?></a>
                        </h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a
                                href="#"><?php echo $banner2_title2 ?><br><span><?php echo $banner2_title3 ?></span></a>
                        </h3><!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner2_btn_link) ?>"
                            class="banner-link"><?php echo $banner2_btn_text ?><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-3 -->

            <div class="col-lg-6">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="<?php echo esc_url($banner3_image) ?>" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white d-none d-sm-block"><a
                                href="#"><?php echo $banner3_title1 ?></a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#"><?php echo $banner3_title2 ?>
                                <br><span><?php echo $banner3_title3 ?></span></a></h3><!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner3_btn_link) ?>"
                            class="banner-link"><?php echo $banner3_btn_text ?><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="bg-light pt-3 pb-5">
        <?php
        $selected_categories = get_theme_mod('gebeyashoptheme_hot_deals_categories');

        $category_ids = [];

        if (!empty($selected_categories)) {
            $category_ids = explode(',', $selected_categories);
        }
        ?>

        <div class="container">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left">
                    <h2 class="title">Hot Deals Products</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">

                        <!-- ALL TAB -->
                        <li class="nav-item">
                            <a class="nav-link active" id="hot-all-link" data-toggle="tab" href="#hot-all-tab"
                                role="tab" aria-controls="hot-all-tab" aria-selected="true">All</a>
                        </li>

                        <?php if (!empty($category_ids)): ?>
                            <?php foreach ($category_ids as $cat_id):
                                $cat = get_term($cat_id, 'product_cat');
                                if (!$cat || is_wp_error($cat))
                                    continue;

                                $slug = 'hot-' . $cat->slug;
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="<?php echo $slug; ?>-link" data-toggle="tab"
                                        href="#<?php echo $slug; ?>-tab" role="tab" aria-controls="<?php echo $slug; ?>-tab"
                                        aria-selected="false">
                                        <?php echo esc_html($cat->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </ul>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="tab-content tab-content-carousel">

                <!-- ALL TAB CONTENT -->
                <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel"
                    aria-labelledby="hot-all-link">

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {"items":2},
                        "480": {"items":2},
                        "768": {"items":3},
                        "992": {"items":4},
                        "1280": {"items":5, "nav": true}
                    }
                }'>

                        <?php
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 10,
                            'post_status' => 'publish',
                        );

                        if (!empty($category_ids)) {
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $category_ids,
                                ),
                            );
                        }

                        $query = new WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                global $product;
                                ?>

                                <div class="product">
                                    <figure class="product-media">

                                        <?php if ($product->is_on_sale()): ?>
                                            <span class="product-label label-sale">Sale</span>
                                        <?php endif; ?>

                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'); ?>"
                                                alt="<?php the_title(); ?>" class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                    wishlist</span></a>
                                            <a href="#" class="btn-product-icon btn-compare"
                                                title="Compare"><span>Compare</span></a>
                                            <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                                                    view</span></a>
                                        </div><!-- End .product-action-vertical -->

                                        <div class="product-action">
                                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                class="btn-product btn-cart add_to_cart_button ajax_add_to_cart"
                                                data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                                                data-quantity="1" rel="nofollow">
                                                <span>add to cart</span>
                                            </a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <?php
                                            $terms = get_the_terms(get_the_ID(), 'product_cat');
                                            if ($terms && !is_wp_error($terms)) {
                                                echo '<a href="' . get_term_link($terms[0]) . '">' . $terms[0]->name . '</a>';
                                            }
                                            ?>
                                        </div><!-- End .product-cat -->

                                        <h3 class="product-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="product-price">
                                            <?php echo $product->get_price_html(); ?>
                                        </div><!-- End .product-price -->

                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val"
                                                    style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                                </div>
                                            </div>
                                            <span class="ratings-text">( <?php echo $product->get_review_count(); ?> Reviews
                                                )</span>
                                        </div><!-- End .rating-container -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->

                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->


                <!-- CATEGORY TABS -->
                <?php if (!empty($category_ids)): ?>
                    <?php foreach ($category_ids as $cat_id):

                        $cat = get_term($cat_id, 'product_cat');
                        if (!$cat || is_wp_error($cat))
                            continue;

                        $slug = 'hot-' . $cat->slug;
                        ?>

                        <div class="tab-pane p-0 fade" id="<?php echo $slug; ?>-tab" role="tabpanel"
                            aria-labelledby="<?php echo $slug; ?>-link">

                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                                data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {"items":2},
                            "480": {"items":2},
                            "768": {"items":3},
                            "992": {"items":4},
                            "1280": {"items":5, "nav": true}
                        }
                    }'>

                                <?php
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 10,
                                    'post_status' => 'publish',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $cat_id,
                                        ),
                                    ),
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()):
                                    while ($query->have_posts()):
                                        $query->the_post();
                                        global $product;
                                        ?>

                                        <div class="product">
                                            <figure class="product-media">

                                                <?php if ($product->is_on_sale()): ?>
                                                    <span class="product-label label-sale">Sale</span>
                                                <?php endif; ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'); ?>"
                                                        alt="<?php the_title(); ?>" class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                            wishlist</span></a>
                                                    <a href="#" class="btn-product-icon btn-compare"
                                                        title="Compare"><span>Compare</span></a>
                                                    <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                                                            view</span></a>
                                                </div>

                                                <div class="product-action">
                                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                        class="btn-product btn-cart add_to_cart_button ajax_add_to_cart"
                                                        data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                        data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                                                        data-quantity="1" rel="nofollow">
                                                        <span>add to cart</span>
                                                    </a>
                                                </div>

                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <?php
                                                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                                                    if ($terms && !is_wp_error($terms)) {
                                                        echo '<a href="' . get_term_link($terms[0]) . '">' . $terms[0]->name . '</a>';
                                                    }
                                                    ?>
                                                </div>

                                                <h3 class="product-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="product-price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>

                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val"
                                                            style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                                        </div>
                                                    </div>
                                                    <span class="ratings-text">( <?php echo $product->get_review_count(); ?> Reviews
                                                        )</span>
                                                </div>

                                            </div>
                                        </div>

                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>

                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->

                    <?php endforeach; ?>
                <?php endif; ?>

            </div><!-- End .tab-content -->
        </div><!-- End .container --><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-5 -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container electronics">
        <?php
        $section_title = get_theme_mod('gebeyashoptheme_home_category1_title');
        $raw_ids = get_theme_mod('gebeyashoptheme_home_category1_categories');
        $category_ids = array_filter(array_map('intval', explode(',', $raw_ids)));
        ?>
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title"><?php echo esc_html($section_title ? $section_title : 'Category'); ?></h2>
            </div>

            <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">

                    <!-- ALL TAB -->
                    <li class="nav-item">
                        <a class="nav-link active" id="cat1-all-link" data-toggle="tab" href="#cat1-all-tab" role="tab">
                            All
                        </a>
                    </li>

                    <!-- CATEGORY TABS -->
                    <?php if (!empty($category_ids)): ?>
                        <?php foreach ($category_ids as $cat_id):
                            $term = get_term($cat_id, 'product_cat');
                            if (is_wp_error($term) || !$term)
                                continue;
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" id="cat1-<?php echo $cat_id; ?>-link" data-toggle="tab"
                                    href="#cat1-<?php echo $cat_id; ?>-tab" role="tab">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
            </div>
        </div>

        <div class="tab-content tab-content-carousel">

            <!-- ALL PRODUCTS TAB -->
            <div class="tab-pane p-0 fade show active" id="cat1-all-tab" role="tabpanel">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{"nav":false,"dots":true,"margin":20,"loop":false,"responsive":{"0":{"items":2},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1280":{"items":5,"nav":true}}}'>

                    <?php
                    $args = [
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                    ];

                    // Only apply category filter IF categories exist
                    if (!empty($category_ids)) {
                        $args['tax_query'] = [
                            [
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $category_ids,
                            ]
                        ];
                    }

                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()):
                            $query->the_post();
                            global $product;
                            ?>

                            <div class="product">
                                <figure class="product-media">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo woocommerce_get_product_thumbnail(); ?>
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></a>
                                        <a href="#" class="btn-product-icon btn-compare"><span>Compare</span></a>
                                        <a href="#" class="btn-product-icon btn-quickview"><span>Quick view</span></a>
                                    </div>

                                    <div class="product-action">
                                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                            class="btn-product btn-cart" title="Add to cart">
                                            <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                                        </a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <?php echo wc_get_product_category_list($product->get_id()); ?>
                                    </div>

                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            $title = get_the_title();
                                            $words = explode(' ', $title);
                                            if (count($words) > 7) {
                                                $title = implode(' ', array_slice($words, 0, 7)) . '...';
                                            }
                                            echo esc_html($title);
                                            ?>
                                        </a>
                                    </h3>

                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val"
                                                style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                            </div>
                                        </div>
                                        <span class="ratings-text">(<?php echo $product->get_review_count(); ?> Reviews)</span>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>

                </div>
            </div>

            <!-- CATEGORY TABS CONTENT -->
            <?php foreach ($category_ids as $cat_id):
                $term = get_term($cat_id, 'product_cat');
                if (!$term)
                    continue;
                ?>

                <div class="tab-pane p-0 fade" id="cat1-<?php echo $cat_id; ?>-tab" role="tabpanel">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{"nav":false,"dots":true,"margin":20,"loop":false,"responsive":{"0":{"items":2},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1280":{"items":5,"nav":true}}}'>

                        <?php
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => 10,
                            'tax_query' => [
                                [
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $cat_id,
                                ]
                            ]
                        ];
                        $query = new WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                global $product;
                                ?>

                                <div class="product">
                                    <figure class="product-media">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo woocommerce_get_product_thumbnail(); ?>
                                        </a>

                                        <div class="product-action">
                                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                class="btn-product btn-cart">
                                                <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                                            </a>
                                        </div>
                                    </figure>

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <?php echo wc_get_product_category_list($product->get_id()); ?>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                $title = get_the_title();
                                                $words = explode(' ', $title);
                                                if (count($words) > 7) {
                                                    $title = implode(' ', array_slice($words, 0, 7)) . '...';
                                                }
                                                echo esc_html($title);
                                                ?>
                                            </a>
                                        </h3>

                                        <div class="product-price">
                                            <?php echo $product->get_price_html(); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner banner-overlay banner-overlay-light">
                    <a href="#">
                        <img src="<?php echo esc_url($banner4_image) ?>" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle d-none d-sm-block"><a href="#"><?php echo $banner4_title1 ?></a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title"><a href="#"><?php echo $banner4_title2 ?><br><span
                                    class="text-primary"><?php echo $banner4_title3 ?></span></a></h3>
                        <!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner4_btn_link) ?>"
                            class="banner-link banner-link-dark"><?php echo $banner4_btn_text ?><i
                                class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-6 -->

            <div class="col-lg-6">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="<?php echo esc_url($banner5_image) ?>" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white  d-none d-sm-block"><a
                                href="#"><?php echo $banner5_title1 ?></a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#"><?php echo $banner5_title2 ?>
                                <br><span><?php echo $banner5_title3 ?></span></a></h3><!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner5_btn_link) ?>"
                            class="banner-link"><?php echo $banner5_btn_text ?><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-1"></div><!-- End .mb-1 -->


    <div class="container furniture">
        <?php
        $title = get_theme_mod('gebeyashoptheme_home_category2_title');

        $raw_ids = get_theme_mod('gebeyashoptheme_home_category2_categories');
        $category_ids = array_filter(array_map('intval', explode(',', $raw_ids)));
        ?>
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title"><?php echo esc_html($title ? $title : 'Furniture'); ?></h2>
            </div>

            <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="furn-new-link" data-toggle="tab" href="#furn-new-tab"
                            role="tab">All</a>
                    </li>

                    <?php if (!empty($category_ids)): ?>
                        <?php foreach ($category_ids as $cat_id):
                            $term = get_term($cat_id, 'product_cat');
                            if (is_wp_error($term) || !$term)
                                continue;
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" id="furn-<?php echo $cat_id; ?>-link" data-toggle="tab"
                                    href="#furn-<?php echo $cat_id; ?>-tab" role="tab">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
            </div>
        </div>

        <div class="tab-content tab-content-carousel">

            <!-- ALL TAB -->
            <div class="tab-pane p-0 fade show active" id="furn-new-tab" role="tabpanel">

                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {"items":2},
                        "480": {"items":2},
                        "768": {"items":3},
                        "992": {"items":4},
                        "1280": {"items":5,"nav": true}
                    }
                 }'>

                    <?php
                    $args = [
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ];

                    if (!empty($category_ids)) {
                        $args['tax_query'] = [
                            [
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $category_ids,
                            ]
                        ];
                    }

                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()):
                            $query->the_post();
                            global $product;
                            ?>

                            <div class="product">
                                <figure class="product-media">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo woocommerce_get_product_thumbnail(); ?>
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></a>
                                        <a href="#" class="btn-product-icon btn-compare"
                                            title="Compare"><span>Compare</span></a>
                                        <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                                                view</span></a>
                                    </div>

                                    <div class="product-action">
                                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                            class="btn-product btn-cart" title="Add to cart">
                                            <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                                        </a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <?php echo wc_get_product_category_list($product->get_id()); ?>
                                    </div>

                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            $t = get_the_title();
                                            $words = explode(' ', $t);
                                            if (count($words) > 7) {
                                                $t = implode(' ', array_slice($words, 0, 7)) . '...';
                                            }
                                            echo esc_html($t);
                                            ?>
                                        </a>
                                    </h3>

                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val"
                                                style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                            </div>
                                        </div>
                                        <span class="ratings-text">( <?php echo $product->get_review_count(); ?> Reviews
                                            )</span>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>

                </div>
            </div>

            <!-- CATEGORY TABS -->
            <?php if (!empty($category_ids)): ?>
                <?php foreach ($category_ids as $cat_id):
                    $term = get_term($cat_id, 'product_cat');
                    if (is_wp_error($term) || !$term)
                        continue;
                    ?>

                    <div class="tab-pane p-0 fade" id="furn-<?php echo $cat_id; ?>-tab" role="tabpanel">

                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                            data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {"items":2},
                            "480": {"items":2},
                            "768": {"items":3},
                            "992": {"items":4},
                            "1280": {"items":5,"nav": true}
                        }
                     }'>

                            <?php
                            $query = new WP_Query([
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $cat_id,
                                    ]
                                ]
                            ]);

                            if ($query->have_posts()):
                                while ($query->have_posts()):
                                    $query->the_post();
                                    global $product;
                                    ?>

                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo woocommerce_get_product_thumbnail(); ?>
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                        wishlist</span></a>
                                                <a href="#" class="btn-product-icon btn-compare"
                                                    title="Compare"><span>Compare</span></a>
                                                <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                                                        view</span></a>
                                            </div>

                                            <div class="product-action">
                                                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                    class="btn-product btn-cart" title="Add to cart">
                                                    <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                                                </a>
                                            </div>
                                        </figure>

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <?php echo wc_get_product_category_list($product->get_id()); ?>
                                            </div>

                                            <h3 class="product-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $t = get_the_title();
                                                    $words = explode(' ', $t);
                                                    if (count($words) > 7) {
                                                        $t = implode(' ', array_slice($words, 0, 7)) . '...';
                                                    }
                                                    echo esc_html($t);
                                                    ?>
                                                </a>
                                            </h3>

                                            <div class="product-price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>

                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val"
                                                        style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                                    </div>
                                                </div>
                                                <span class="ratings-text">( <?php echo $product->get_review_count(); ?> Reviews
                                                    )</span>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>

                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container">
        <h2 class="title title-border mb-5">Shop by Brands</h2><!-- End .title -->
        <div class="owl-carousel mb-5 owl-simple" data-toggle="owl" data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 30,
                    "loop": false,
                    "responsive": {
                        "0": {"items":2},
                        "420": {"items":3},
                        "600": {"items":4},
                        "900": {"items":5},
                        "1024": {"items":6},
                        "1280": {"items":6,"nav": true,"dots": false}
                    }
                }'>

            <?php
            // Get all product_brand terms
            $brands = get_terms(array(
                'taxonomy' => 'product_brand',
                'hide_empty' => false, // set true if you want only brands with products
            ));

            if (!is_wp_error($brands) && !empty($brands)) {
                foreach ($brands as $brand) {
                    // Get brand thumbnail (if using WooCommerce Brands plugin)
                    $brand_thumb_id = get_term_meta($brand->term_id, 'thumbnail_id', true);
                    $brand_thumb_url = $brand_thumb_id ? wp_get_attachment_url($brand_thumb_id) : get_template_directory_uri() . '/assets/images/brands/default.png';
                    ?>
                    <a href="<?php echo esc_url(get_term_link($brand)); ?>" class="brand">
                        <img src="<?php echo esc_url($brand_thumb_url); ?>" alt="<?php echo esc_attr($brand->name); ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->

    <div class="cta cta-horizontal cta-horizontal-box bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2xl-5col">
                    <h3 class="cta-title text-white">Join Our Newsletter</h3><!-- End .cta-title -->
                    <p class="cta-desc text-white">Subcribe to get information about products and coupons</p>
                    <!-- End .cta-desc -->
                </div><!-- End .col-lg-5 -->

                <div class="col-3xl-5col">
                    <form action="#">
                        <div class="input-group">
                            <input type="email" class="form-control form-control-white"
                                placeholder="Enter your Email Address" aria-label="Email Adress" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-white-2" type="submit"><span>Subscribe</span><i
                                        class="icon-long-arrow-right"></i></button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div><!-- End .col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->

    <div class="blog-posts bg-light pt-4 pb-7">
        <div class="container">
            <h2 class="title">From Our Blog</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                },
                                "1280": {
                                    "items":4,
                                    "nav": true, 
                                    "dots": false
                                }
                            }
                        }'>
                <?php
                // Query recent posts
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 10, // Number of posts to display
                    'post_status' => 'publish',
                ));

                if ($recent_posts->have_posts()):
                    while ($recent_posts->have_posts()):
                        $recent_posts->the_post();
                        // Get post thumbnail or fallback image
                        $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/assets/images/demos/demo-13/blog/default.jpg';
                        ?>
                        <article class="entry">
                            <figure class="entry-media">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-meta">
                                    <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>,
                                    <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->
</main><!-- End .main -->

<?php get_footer(); ?>
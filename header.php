<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap eCommerce Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content=" - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">

    <!-- Vendor CSS -->
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/plugins/jquery.countdown.css">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/css/plugins/nouislider/nouislider.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/skins/skin-demo-13.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/demos/demo-13.css">

    <?php wp_head(); ?>
</head>

<body>

    <?php
    $header_logo = get_theme_mod('header_logo');
    $header_phone = get_theme_mod('header_phone');
    $header_signin_text = get_theme_mod('header_signin_text');
    $header_signin_link = get_theme_mod('header_signin_link');
    ?>


    <div class="page-wrapper">
        <header class="header header-10 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel: <?php echo $header_phone ?>"><i class="icon-phone"></i>Call:
                            <?php echo $header_phone ?></a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>

                                    <li class="login">
                                        <a href="#signin-modal"
                                            data-toggle="modal"><?php echo $header_signin_text ?></a>
                                    </li>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <!-- Logo -->
                        <div class="logo">
                            <?php if ($header_logo): ?>
                                <a href="<?php echo esc_url(site_url()); ?>" class="logo">
                                    <img src="<?php echo $header_logo ?>" alt=" Logo" width="65" height="25">
                                </a>
                            <?php else: ?>
                                <a href="index.html" class="logo">
                                    <h1><?php bloginfo('name'); ?></h1>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <?php
                        $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
                        $current_cat = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';
                        ?>

                        <div
                            class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">

                            <a href="#" class="search-toggle" role="button">
                                <i class="icon-search"></i>
                            </a>

                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">

                                <div class="header-search-wrapper search-wrapper-wide">

                                    <!-- Category Dropdown -->
                                    <div class="select-custom">
                                        <select name="product_cat">

                                            <option value="">
                                                <?php _e('All Departments', 'gebeyashoptheme'); ?>
                                            </option>

                                            <?php
                                            $terms = get_terms([
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => true,
                                            ]);

                                            foreach ($terms as $term) {

                                                $selected = ($current_cat === $term->slug) ? 'selected' : '';

                                                echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>'
                                                    . esc_html($term->name) .
                                                    '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <!-- Search Input -->
                                    <label for="search-products" class="sr-only">
                                        <?php _e('Search', 'gebeyashoptheme'); ?>
                                    </label>

                                    <input type="search" class="form-control" name="s" id="search-products"
                                        placeholder="<?php _e('Search products...', 'gebeyashoptheme'); ?>"
                                        value="<?php echo esc_attr($search_query); ?>" required>

                                    <!-- Required -->
                                    <input type="hidden" name="post_type" value="product">

                                    <button class="btn btn-primary" type="submit">
                                        <i class="icon-search"></i>
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>

                    <div class="header-right">
                        <div class="header-dropdown-link">


                            <?php
                            $cart_count = WC()->cart->get_cart_contents_count();
                            ?>

                            <div class="dropdown cart-dropdown">

                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="dropdown-toggle"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-display="static">

                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count"><?php echo esc_html($cart_count); ?></span>
                                    <span class="cart-txt"><?php _e('Cart', 'gebeyashoptheme'); ?></span>
                                </a>

                                <?php if ($cart_count > 0): ?>

                                    <div class="dropdown-menu dropdown-menu-right">

                                        <div class="dropdown-cart-products">

                                            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):

                                                $product = $cart_item['data'];
                                                $product_id = $cart_item['product_id'];

                                                if (!$product || !$product->exists())
                                                    continue;

                                                $product_link = $product->get_permalink();
                                                ?>

                                                <div class="product">

                                                    <div class="product-cart-details">
                                                        <h4 class="product-title">
                                                            <a href="<?php echo esc_url($product_link); ?>">
                                                                <?php echo esc_html($product->get_name()); ?>
                                                            </a>
                                                        </h4>

                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">
                                                                <?php echo esc_html($cart_item['quantity']); ?>
                                                            </span>
                                                            x <?php echo wc_price($product->get_price()); ?>
                                                        </span>
                                                    </div>

                                                    <figure class="product-image-container">
                                                        <a href="<?php echo esc_url($product_link); ?>" class="product-image">
                                                            <?php echo $product->get_image('thumbnail'); ?>
                                                        </a>
                                                    </figure>

                                                    <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                                                        class="btn-remove"
                                                        title="<?php _e('Remove Product', 'gebeyashoptheme'); ?>">
                                                        <i class="icon-close"></i>
                                                    </a>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                        <!-- Total -->
                                        <div class="dropdown-cart-total">
                                            <span><?php _e('Total', 'gebeyashoptheme'); ?></span>
                                            <span class="cart-total-price">
                                                <?php echo WC()->cart->get_cart_total(); ?>
                                            </span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="dropdown-cart-action">
                                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-primary">
                                                <?php _e('View Cart', 'gebeyashoptheme'); ?>
                                            </a>

                                            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                                class="btn btn-outline-primary-2">
                                                <span><?php _e('Checkout', 'gebeyashoptheme'); ?></span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        </div>

                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown show is-on" data-visible="true">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true" data-display="static"
                                title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu <?php if(is_front_page()) {?> show <?php } ?>">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">

                                        <?php
                                        echo wp_nav_menu(array(
                                            'theme_location' => 'categories_menu',
                                            'container' => false,
                                            'menu_class' => false,
                                            'menu_id' => false,
                                            'depth' => 3,
                                            'items_wrap' => '%3$s',
                                            'walker' => new Gebeyashoptheme_Megamenu_Walker(),
                                        ));
                                        ?>

                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .col-lg-3 -->
                    <div class="header-center">
                        <nav class="main-nav">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary_menu', // make sure you registered this location
                                'container' => false,      // no additional container
                                'menu_class' => 'menu',     // ul class
                                'menu_id' => false,
                                'depth' => 4,          // to include 3 levels
                            ));
                            ?>
                        </nav>
                    </div><!-- End .col-lg-9 -->
                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i>
                        <p>Clearance Up to 30% Off</span></p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->
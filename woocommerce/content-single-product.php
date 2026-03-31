<?php get_header();

global $product;

defined('ABSPATH') || exit;
$product_id = get_the_ID();

$product = wc_get_product($product_id);

$main_image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();

$comments = get_comments(array(
    'post_id' => $product->get_id(),
    'status' => 'approve',
));
?>

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">

            <!-- 🔹 Breadcrumb -->
            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php _e('Home', 'gebeyashoptheme'); ?>
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                        <?php _e('Products', 'gebeyashoptheme'); ?>
                    </a>
                </li>

                <?php
                // Product categories
                $terms = get_the_terms(get_the_ID(), 'product_cat');

                if (!empty($terms) && !is_wp_error($terms)) {
                    $term = $terms[0];

                    echo '<li class="breadcrumb-item">
                        <a href="' . esc_url(get_term_link($term)) . '">'
                        . esc_html($term->name) .
                        '</a>
                     </li>';
                }
                ?>

                <li class="breadcrumb-item active" aria-current="page">
                    <?php the_title(); ?>
                </li>

            </ol>

            <!-- 🔹 Prev / Next -->
            <nav class="product-pager ml-auto" aria-label="Product">

                <?php
                $prev_post = get_previous_post(true, '', 'product_cat');
                $next_post = get_next_post(true, '', 'product_cat');
                ?>

                <!-- Prev -->
                <?php if ($prev_post): ?>
                    <a class="product-pager-link product-pager-prev"
                        href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"
                        aria-label="<?php _e('Previous', 'gebeyashoptheme'); ?>">

                        <i class="icon-angle-left"></i>
                        <span><?php _e('Prev', 'gebeyashoptheme'); ?></span>
                    </a>
                <?php endif; ?>

                <!-- Next -->
                <?php if ($next_post): ?>
                    <a class="product-pager-link product-pager-next"
                        href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"
                        aria-label="<?php _e('Next', 'gebeyashoptheme'); ?>">

                        <span><?php _e('Next', 'gebeyashoptheme'); ?></span>
                        <i class="icon-angle-right"></i>
                    </a>
                <?php endif; ?>

            </nav>

        </div>
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">

                                <!-- 🔹 Main Image -->
                                <figure class="product-main-image">

                                    <?php
                                    if ($main_image_id) {

                                        $main_image = wp_get_attachment_image_src($main_image_id, 'full');
                                        ?>

                                        <img id="product-zoom" src="<?php echo esc_url($main_image[0]); ?>"
                                            data-zoom-image="<?php echo esc_url($main_image[0]); ?>"
                                            alt="<?php echo esc_attr(get_the_title()); ?>">

                                    <?php } ?>

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>

                                </figure>

                                <!-- 🔹 Thumbnail Gallery -->
                                <div id="product-zoom-gallery" class="product-image-gallery">

                                    <?php
                                    // Main image as first thumbnail
                                    if ($main_image_id) {
                                        $thumb = wp_get_attachment_image_src($main_image_id, 'thumbnail');
                                        ?>

                                        <a class="product-gallery-item active" href="#"
                                            data-image="<?php echo esc_url($main_image[0]); ?>"
                                            data-zoom-image="<?php echo esc_url($main_image[0]); ?>">

                                            <img src="<?php echo esc_url($thumb[0]); ?>" alt="product image">

                                        </a>

                                    <?php }

                                    // Gallery images
                                    if (!empty($gallery_image_ids)):

                                        foreach ($gallery_image_ids as $image_id):

                                            $image_full = wp_get_attachment_image_src($image_id, 'full');
                                            $image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail');
                                            ?>

                                            <a class="product-gallery-item" href="#"
                                                data-image="<?php echo esc_url($image_full[0]); ?>"
                                                data-zoom-image="<?php echo esc_url($image_full[0]); ?>">

                                                <img src="<?php echo esc_url($image_thumb[0]); ?>" alt="product image">

                                            </a>

                                        <?php endforeach;

                                    endif;
                                    ?>

                                </div><!-- End .product-image-gallery -->

                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <!-- ===================== -->
                    <!-- 🔹 PRODUCT DETAILS -->
                    <!-- ===================== -->
                    <div class="col-md-6">
                        <div class="product-details">

                            <!-- Title -->
                            <h1 class="product-title"><?php the_title(); ?></h1>

                            <!-- Ratings -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val"
                                        style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                                    </div>
                                </div>

                                <a class="ratings-text" href="#reviews">
                                    (<?php echo $product->get_review_count(); ?>
                                    <?php _e('Reviews', 'gebeyashoptheme'); ?>)
                                </a>
                            </div>

                            <!-- Price -->
                            <div class="product-price">
                                <?php echo $product->get_price_html(); ?>
                            </div>

                            <!-- Short Description -->
                            <div class="product-content">
                                <?php echo apply_filters('woocommerce_short_description', get_the_excerpt()); ?>
                            </div>

                            <!-- ===================== -->
                            <!-- 🔥 ADD TO CART (SMART) -->
                            <!-- ===================== -->
                            <div class="product-details-action">

                                <?php if ($product->is_type('simple')): ?>

                                    <form class="cart" method="post" enctype="multipart/form-data">

                                        <div class="details-filter-row details-row-size">
                                            <label><?php _e('Qty:', 'gebeyashoptheme'); ?></label>

                                            <div class="product-details-quantity">
                                                <?php woocommerce_quantity_input(); ?>
                                            </div>
                                        </div>

                                        <button type="submit" name="add-to-cart"
                                            value="<?php echo esc_attr($product->get_id()); ?>"
                                            class="btn-product btn-cart">
                                            <span><?php _e('Add to cart', 'gebeyashoptheme'); ?></span>
                                        </button>

                                    </form>

                                <?php elseif ($product->is_type('variable')): ?>

                                    <?php
                                    // Uses Woo default variation form (KEEP THIS)
                                    woocommerce_template_single_add_to_cart();
                                    ?>

                                <?php elseif ($product->is_type('external')): ?>

                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                        class="btn-product btn-cart" target="_blank" rel="nofollow">
                                        <span><?php echo $product->single_add_to_cart_text(); ?></span>
                                    </a>

                                <?php endif; ?>

                                <!-- Wishlist / Compare -->
                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist">
                                        <span><?php _e('Add to Wishlist', 'gebeyashoptheme'); ?></span>
                                    </a>

                                    <a href="#" class="btn-product btn-compare">
                                        <span><?php _e('Add to Compare', 'gebeyashoptheme'); ?></span>
                                    </a>
                                </div>

                            </div>

                            <!-- ===================== -->
                            <!-- 🔹 FOOTER -->
                            <!-- ===================== -->
                            <div class="product-details-footer">

                                <!-- Categories -->
                                <div class="product-cat">
                                    <span><?php _e('Category:', 'gebeyashoptheme'); ?></span>
                                    <?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
                                </div>

                                <!-- Share -->
                                <div class="social-icons social-icons-sm">
                                    <span class="social-label"><?php _e('Share:', 'gebeyashoptheme'); ?></span>

                                    <?php
                                    $url = urlencode(get_permalink());
                                    $title = urlencode(get_the_title());
                                    ?>

                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
                                        target="_blank" class="social-icon">
                                        <i class="icon-facebook-f"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>"
                                        target="_blank" class="social-icon">
                                        <i class="icon-twitter"></i>
                                    </a>

                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $url; ?>"
                                        target="_blank" class="social-icon">
                                        <i class="icon-pinterest"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                            role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab"
                            aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab"
                            role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                            role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                        aria-labelledby="product-desc-link">
                        <div class="product-desc-content">

                            <h3><?php _e('Product Information', 'gebeyashoptheme'); ?></h3>

                            <?php
                            // Full product description (main editor content)
                            $description = get_the_content();

                            if (!empty($description)) {
                                echo apply_filters('the_content', $description);
                            } else {
                                // 🔥 Fallback if no description
                                echo '<p>' . __('No product description available.', 'gebeyashoptheme') . '</p>';
                            }
                            ?>

                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                        aria-labelledby="product-info-link">
                        <div class="product-desc-content">

                            <h3><?php _e('Information', 'gebeyashoptheme'); ?></h3>

                            <?php
                            // 🔹 Short description fallback (optional intro text)
                            $short_desc = $product->get_short_description();

                            if (!empty($short_desc)) {
                                echo apply_filters('woocommerce_short_description', $short_desc);
                            } else {
                                echo '<p>' . __('No additional information available.', 'gebeyashoptheme') . '</p>';
                            }
                            ?>


                            <h3><?php _e('Additional Information', 'gebeyashoptheme'); ?></h3>

                            <ul>
                                <?php
                                // 🔹 Product attributes (THIS IS THE MAIN PART)
                                $attributes = $product->get_attributes();

                                if (!empty($attributes)):

                                    foreach ($attributes as $attribute):

                                        // Skip hidden attributes
                                        if ($attribute->get_visible()):

                                            $name = wc_attribute_label($attribute->get_name());

                                            if ($attribute->is_taxonomy()) {
                                                // Taxonomy attributes (global attributes like Size, Color)
                                                $terms = wc_get_product_terms(
                                                    $product->get_id(),
                                                    $attribute->get_name(),
                                                    array('fields' => 'names')
                                                );

                                                $value = implode(', ', $terms);

                                            } else {
                                                // Custom attributes
                                                $value = implode(', ', $attribute->get_options());
                                            }
                                            ?>

                                            <li>
                                                <strong><?php echo esc_html($name); ?>:</strong>
                                                <?php echo esc_html($value); ?>
                                            </li>

                                            <?php
                                        endif;

                                    endforeach;

                                else:
                                    ?>

                                    <li><?php _e('No attributes available.', 'gebeyashoptheme'); ?></li>

                                <?php endif; ?>
                            </ul>


                            <h3><?php _e('Size', 'gebeyashoptheme'); ?></h3>

                            <p>
                                <?php
                                // 🔹 Try to specifically get "Size" attribute if exists
                                $size = $product->get_attribute('pa_size');

                                if ($size) {
                                    echo esc_html($size);
                                } else {
                                    _e('Not specified', 'gebeyashoptheme');
                                }
                                ?>
                            </p>

                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">

                            <!-- 🔹 Delivery -->
                            <h3>
                                <?php echo esc_html(get_theme_mod('gebeyashoptheme_delivery_title', 'Delivery')); ?>
                            </h3>

                            <p>
                                <?php echo wp_kses_post(get_theme_mod('gebeyashoptheme_delivery_text')); ?>

                                <br>

                                <a href="<?php echo esc_url(get_theme_mod('gebeyashoptheme_delivery_link', '#')); ?>">
                                    <?php _e('Delivery information', 'gebeyashoptheme'); ?>
                                </a>
                            </p>

                            <!-- 🔹 Returns -->
                            <h3>
                                <?php echo esc_html(get_theme_mod('gebeyashoptheme_returns_title', 'Returns')); ?>
                            </h3>

                            <p>
                                <?php echo wp_kses_post(get_theme_mod('gebeyashoptheme_returns_text')); ?>

                                <br>

                                <a href="<?php echo esc_url(get_theme_mod('gebeyashoptheme_returns_link', '#')); ?>">
                                    <?php _e('Returns information', 'gebeyashoptheme'); ?>
                                </a>
                            </p>

                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">

                            <h3>
                                <?php
                                printf(
                                    __('Reviews (%d)', 'gebeyashoptheme'),
                                    $product->get_review_count()
                                );
                                ?>
                            </h3>

                            <?php if ($comments): ?>

                                <?php foreach ($comments as $comment):

                                    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                                    $rating_percent = ($rating / 5) * 100;
                                    ?>

                                    <div class="review">
                                        <div class="row no-gutters">

                                            <!-- LEFT -->
                                            <div class="col-auto">
                                                <h4>
                                                    <a href="#">
                                                        <?php echo esc_html($comment->comment_author); ?>
                                                    </a>
                                                </h4>

                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val"
                                                            style="width: <?php echo esc_attr($rating_percent); ?>%;"></div>
                                                    </div>
                                                </div>

                                                <span class="review-date">
                                                    <?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')) . ' ' . __('ago', 'gebeyashoptheme'); ?>
                                                </span>
                                            </div>

                                            <!-- RIGHT -->
                                            <div class="col">

                                                <h4>
                                                    <?php
                                                    // Optional: use first few words as title
                                                    echo esc_html(wp_trim_words($comment->comment_content, 5));
                                                    ?>
                                                </h4>

                                                <div class="review-content">
                                                    <p><?php echo esc_html($comment->comment_content); ?></p>
                                                </div>

                                                <!-- Optional static actions -->
                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful</a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p><?php _e('No reviews yet.', 'gebeyashoptheme'); ?></p>

                            <?php endif; ?>

                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="product.html">
                            <img src="assets/images/products/product-4.jpg" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Women</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil skirt</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $60.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
                            </a>
                            <a href="#">
                                <img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                            </a>

                            <a href="#">
                                <img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-out">Out of Stock</span>
                        <a href="product.html">
                            <img src="assets/images/products/product-6.jpg" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jackets</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">$120.00</span>
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 6 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-top">Top</span>
                        <a href="product.html">
                            <img src="assets/images/products/product-11.jpg" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Shoes</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Light brown studded Wide fit wedges</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $110.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 1 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="assets/images/products/product-11-thumb.jpg" alt="product desc">
                            </a>
                            <a href="#">
                                <img src="assets/images/products/product-11-2-thumb.jpg" alt="product desc">
                            </a>

                            <a href="#">
                                <img src="assets/images/products/product-11-3-thumb.jpg" alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="assets/images/products/product-10.jpg" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jumpers</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Yellow button front tea top</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $56.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 0 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="assets/images/products/product-7.jpg" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jeans</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Blue utility pinafore denim dress</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $76.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php get_footer(); ?>
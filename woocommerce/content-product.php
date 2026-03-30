<?php
defined('ABSPATH') || exit;
global $product;
?>

<div class="col-6 col-md-4 col-lg-4 col-xl-3">

    <div class="product product-7 text-center">

        <figure class="product-media">

            <?php if ($product->is_on_sale()): ?>
                <span class="product-label label-new">New</span>
            <?php endif; ?>

            <?php if (!$product->is_in_stock()): ?>
                <span class="product-label label-out">Out of Stock</span>
            <?php endif; ?>

            <a href="<?php the_permalink(); ?>">
                <?php echo woocommerce_get_product_thumbnail(); ?>
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable">
                    <span>add to wishlist</span>
                </a>
                <a href="#" class="btn-product-icon btn-quickview">
                    <span>Quick view</span>
                </a>
                <a href="#" class="btn-product-icon btn-compare">
                    <span>Compare</span>
                </a>
            </div>

            <div class="product-action">
                <?php
                $classes = implode(' ', array_filter(array(
                    'btn-product',
                    'btn-cart',
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    'product_type_' . $product->get_type(),
                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                )));

                echo sprintf(
                    '<a href="%s" data-quantity="1" class="%s" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">
        <span>%s</span>
    </a>',
                    esc_url($product->add_to_cart_url()),
                    esc_attr($classes),
                    esc_attr($product->get_id()),
                    esc_attr($product->get_sku()),
                    esc_attr($product->add_to_cart_description()),
                    esc_html($product->add_to_cart_text())
                );
                ?>
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
                        $title = implode('', array_slice($words, 0, 7)) . '...';
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
                    <div class="ratings-val" style="width: <?php echo ($product->get_average_rating() / 5) * 100; ?>%;">
                    </div>
                </div>
                <span class="ratings-text">
                    (<?php echo $product->get_review_count(); ?> Reviews)
                </span>
            </div>

        </div>

    </div>

</div>
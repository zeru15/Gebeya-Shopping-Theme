<?php
/**
 * Change default wordpress post per page number from 10 to 6
 */
function gebeya_modify_posts_per_page($query)
{

    if (!is_admin() && $query->is_main_query()) {

        // Blog page
        if (is_home() || is_archive()) {
            $query->set('posts_per_page', 6);
        }
    }
}
add_action('pre_get_posts', 'gebeya_modify_posts_per_page');

/**
 * Custom Walker Class
 */
class Gebeyashoptheme_Megamenu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        // Level 0 (Electronics)
        if ($depth == 0) {
            $has_children = !empty($args->has_children) ? ' sf-with-ul' : '';
            $output .= '<li class="megamenu-container">';
            $output .= '<a class="' . $has_children . '" href="' . esc_url($item->url) . '">'
                . esc_html($item->title) . '</a>';
        }

        // Level 1 (Menu Titles)
        elseif ($depth == 1) {
            $output .= '<div class="col-md-6">';
            $output .= '<div class="menu-title">' . esc_html($item->title) . '</div>';
        }

        // Level 2 (Actual Links)
        elseif ($depth == 2) {
            $output .= '<li><a href="' . esc_url($item->url) . '">'
                . esc_html($item->title) . '</a></li>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($depth == 1) {
            $output .= '</div>'; // close column
        }

        if ($depth == 0) {
            $output .= '</li>'; // close parent
        }
    }

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Level 0 → megamenu wrapper
        if ($depth == 0) {
            $output .= '
            <div class="megamenu">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="menu-col">
                            <div class="row">';
        }

        // Level 1 → UL for links
        elseif ($depth == 1) {
            $output .= '<ul>';
        }
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        // Close UL
        if ($depth == 1) {
            $output .= '</ul>';
        }

        // Close megamenu
        elseif ($depth == 0) {
            $output .= '
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="banner banner-overlay">
                            <a href="#" class="banner banner-menu">
                                <img src="' . get_template_directory_uri() . '/assets/images/demos/demo-13/menu/banner-1.jpg" alt="Banner">
                            </a>
                        </div>
                    </div>

                </div>
            </div>';
        }
    }
}


/**
 * Register Navigation Menus
 */
function gebeyashoptheme_register_menus()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'gebeyashoptheme'),
        'categories_menu' => __('Categories Menu', 'gebeyashoptheme'),
        'footer_menu_1' => __('Footer Menu 1', 'gebeyashoptheme'),
        'footer_menu_2' => __('Footer Menu 2', 'gebeyashoptheme'),
        'footer_menu_3' => __('Footer Menu 3', 'gebeyashoptheme'),
    ));
}

add_action('after_setup_theme', 'gebeyashoptheme_register_menus');

/**
 * Header Customizer Settings
 */

function gebeyashoptheme_customize_register($wp_customize)
{

    // Section: Header Settings
    $wp_customize->add_section('gebeyashoptheme_header_settings', array(
        'title' => __('Header Settings', 'gebeyashoptheme'),
        'priority' => 30,
    ));

    // 🔹 Logo
    $wp_customize->add_setting('header_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'header_logo',
        array(
            'label' => __('Logo', 'gebeyashoptheme'),
            'section' => 'gebeyashoptheme_header_settings',
        )
    ));

    // 🔹 Phone Number
    $wp_customize->add_setting('header_phone', array(
        'default' => '+251 900 000 000',
    ));

    $wp_customize->add_control('header_phone', array(
        'label' => __('Phone Number', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_header_settings',
        'type' => 'text',
    ));

    // 🔹 Sign In Text
    $wp_customize->add_setting('header_signin_text', array(
        'default' => 'Sign In',
    ));

    $wp_customize->add_control('header_signin_text', array(
        'label' => __('Sign In Text', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_header_settings',
        'type' => 'text',
    ));

    // 🔹 Sign In Link
    $wp_customize->add_setting('header_signin_link', array(
        'default' => '#',
    ));

    $wp_customize->add_control('header_signin_link', array(
        'label' => __('Sign In Link', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_header_settings',
        'type' => 'url',
    ));
}

add_action('customize_register', 'gebeyashoptheme_customize_register');


/**
 * Footer Customizer Settings
 */
function gebeyashoptheme_footer_customizer($wp_customize)
{

    // 🔹 Section: Footer Settings
    $wp_customize->add_section('gebeyashoptheme_footer_settings', array(
        'title' => __('Footer Settings', 'gebeyashoptheme'),
        'priority' => 40,
    ));

    // =========================
    // 🔸 Footer Logo
    // =========================
    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'footer_logo',
        array(
            'label' => __('Footer Logo', 'gebeyashoptheme'),
            'section' => 'gebeyashoptheme_footer_settings',
        )
    ));

    // =========================
    // 🔸 Footer Description
    // =========================
    $wp_customize->add_setting('footer_description', array(
        'default' => '',
    ));

    $wp_customize->add_control('footer_description', array(
        'label' => __('Footer Description', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_footer_settings',
        'type' => 'textarea',
    ));

    // =========================
    // 🔸 Footer Question
    // =========================
    $wp_customize->add_setting('footer_question', array(
        'default' => 'Got Questions? Call us 24/7',
    ));

    $wp_customize->add_control('footer_question', array(
        'label' => __('Footer Question Text', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_footer_settings',
        'type' => 'text',
    ));

    // =========================
    // 🔸 Footer Phone
    // =========================
    $wp_customize->add_setting('footer_phone', array(
        'default' => '+251 900 000 000',
    ));

    $wp_customize->add_control('footer_phone', array(
        'label' => __('Footer Phone', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_footer_settings',
        'type' => 'text',
    ));

    // =========================
    // 🔸 Copyright
    // =========================
    $wp_customize->add_setting('footer_copyright', array(
        'default' => '© ' . date('Y') . ' Gebeya. All Rights Reserved.',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label' => __('Copyright Text', 'gebeyashoptheme'),
        'section' => 'gebeyashoptheme_footer_settings',
        'type' => 'text',
    ));

    // =========================
// 🔸 Payment Image
// =========================
    $wp_customize->add_setting('payment_image');

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'payment_image',
        array(
            'label' => __('Payment Image', 'gebeyashoptheme'),
            'section' => 'gebeyashoptheme_footer_settings',
        )
    ));

    // =========================
    // 🔸 Social Links
    // =========================

    $socials = ['facebook', 'twitter', 'instagram', 'youtube', 'pinterest'];

    foreach ($socials as $social) {

        $wp_customize->add_setting("footer_{$social}_link", array(
            'default' => '',
        ));

        $wp_customize->add_control("footer_{$social}_link", array(
            'label' => ucfirst($social) . ' ' . __('Link', 'gebeyashoptheme'),
            'section' => 'gebeyashoptheme_footer_settings',
            'type' => 'url',
        ));
    }
}

add_action('customize_register', 'gebeyashoptheme_footer_customizer');


/**
 * Registering Sidebars For Blog Page
 */
function gebeyashoptheme_register_sidebars()
{

    register_sidebar(array(
        'name' => __('Blog Sidebar', 'gebeyashoptheme'),
        'id' => 'blog-sidebar',
        'description' => __('Widgets for Blog Sidebar', 'gebeyashoptheme'),

        // 🔥 Match your HTML structure
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',

        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'gebeyashoptheme_register_sidebars');


/**
 * Registering Widgets For Blog Page
 */
function gebeyashoptheme_register_widgets()
{
    register_widget('Gebeyashoptheme_Search_Widget');
    register_widget('Gebeyashoptheme_Categories_Widget');
    register_widget('Gebeyashoptheme_Popular_Posts_Widget');
    register_widget('Gebeyashoptheme_Banner_Widget');
    register_widget('Gebeyashoptheme_Tags_Widget');
}
add_action('widgets_init', 'gebeyashoptheme_register_widgets');


/**
 * Search Widget
 */
class Gebeyashoptheme_Search_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'gebeyashoptheme_search',
            __('Gebeya Search Widget', 'gebeyashoptheme')
        );
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="widget widget-search">
            <h3 class="widget-title"><?php _e('Search', 'gebeyashoptheme'); ?></h3>
            <?php get_search_form(); ?>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

/**
 * Categories Widget
 */
class Gebeyashoptheme_Categories_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'gebeyashoptheme_categories',
            __('Gebeya Categories Widget', 'gebeyashoptheme')
        );
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="widget widget-cats">
            <h3 class="widget-title"><?php _e('Categories', 'gebeyashoptheme'); ?></h3>
            <ul>
                <?php
                $categories = get_categories();

                foreach ($categories as $cat) {
                    echo '<li>
                        <a href="' . esc_url(get_category_link($cat->term_id)) . '">'
                        . esc_html($cat->name) .
                        '<span>' . esc_html($cat->count) . '</span>
                        </a>
                    </li>';
                }
                ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

/**
 * Popular posts Widget
 */
class Gebeyashoptheme_Popular_Posts_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'gebeyashoptheme_popular_posts',
            __('Gebeya Popular Posts Widget', 'gebeyashoptheme')
        );
    }

    function widget($args, $instance)
    {

        $query = new WP_Query(array(
            'posts_per_page' => 4,
            'orderby' => 'date'
        ));

        echo $args['before_widget'];
        ?>
        <div class="widget">
            <h3 class="widget-title"><?php _e('Popular Posts', 'gebeyashoptheme'); ?></h3>

            <ul class="posts-list">
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <li>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </figure>

                        <div>
                            <span><?php echo esc_html(get_the_date()); ?></span>
                            <h4>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </div>
                    </li>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

/**
 * Tags Widget
 */
class Gebeyashoptheme_Tags_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'gebeyashoptheme_tags',
            __('Gebeya Tags Widget', 'gebeyashoptheme')
        );
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="widget">
            <h3 class="widget-title"><?php _e('Browse Tags', 'gebeyashoptheme'); ?></h3>

            <div class="tagcloud">
                <?php
                $tags = get_tags();

                foreach ($tags as $tag) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">'
                        . esc_html($tag->name) . '</a>';
                }
                ?>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

/**
 * Banner Widget
 */
class Gebeyashoptheme_Banner_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'gebeyashoptheme_banner',
            __('Banner Widget', 'gebeyashoptheme')
        );
    }

    // 🔹 Admin Form
    function form($instance)
    {

        $title = $instance['title'] ?? '';
        $image = $instance['image'] ?? '';
        $link = $instance['link'] ?? '';
        $target = $instance['target'] ?? '';
        ?>

        <p>
            <label><?php _e('Title:', 'gebeyashoptheme'); ?></label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label><?php _e('Image URL:', 'gebeyashoptheme'); ?></label>
            <input class="widefat" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr($image); ?>">
        </p>

        <p>
            <label><?php _e('Banner Link:', 'gebeyashoptheme'); ?></label>
            <input class="widefat" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo esc_attr($link); ?>">
        </p>

        <p>
            <input type="checkbox" <?php checked($target, 'on'); ?> name="<?php echo $this->get_field_name('target'); ?>">
            <label><?php _e('Open in new tab', 'gebeyashoptheme'); ?></label>
        </p>

        <?php
    }

    // 🔹 Save Data
    function update($new, $old)
    {

        return array(
            'title' => sanitize_text_field($new['title']),
            'image' => esc_url_raw($new['image']),
            'link' => esc_url_raw($new['link']),
            'target' => isset($new['target']) ? 'on' : ''
        );
    }

    // 🔹 Frontend Output
    function widget($args, $instance)
    {

        $title = $instance['title'] ?? '';
        $image = $instance['image'] ?? '';
        $link = $instance['link'] ?? '#';
        $target = (!empty($instance['target'])) ? ' target="_blank"' : '';

        if (empty($image))
            return;

        echo $args['before_widget'];
        ?>

        <div class="widget widget-banner-sidebar">

            <?php if (!empty($title)): ?>
                <div class="banner-sidebar-title">
                    <?php echo esc_html($title); ?>
                </div>
            <?php endif; ?>

            <div class="banner-sidebar banner-overlay">
                <a href="<?php echo esc_url($link); ?>" <?php echo $target; ?>>
                    <img src="<?php echo esc_url($image); ?>" alt="banner">
                </a>
            </div>

        </div>

        <?php
        echo $args['after_widget'];
    }
}

/**
 * Adding Woocommerce Support
 */
function gebeyashoptheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');

    // Product gallery features
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'gebeyashoptheme_add_woocommerce_support');

/**
 * Remove Woocommerce Default Wrapper
 */
// function gebeyashoptheme_remove_wc_wrapper() {
//     remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//     remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
// }
// add_action('wp', 'gebeyashoptheme_remove_wc_wrapper');

// ADD your wrapper
// add_action('woocommerce_before_shop_loop', function() {
//     echo '<div class="products mb-3">';
//     echo '<div class="row justify-content-center">';
// }, 20);

// add_action('woocommerce_after_shop_loop', function() {
//     echo '</div></div>';
// }, 20);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove default WooCommerce pagination
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);


/**
 * Registering Sidebars For Shop Page
 */
function gebeyashoptheme_widgets_init()
{
    register_sidebar(array(
        'name' => 'Shop Sidebar',
        'id' => 'shop-sidebar',
        'before_widget' => '<div class="widget widget-collapsible">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'gebeyashoptheme_widgets_init');


/**
 * Query Filter Products
 */
add_action('woocommerce_product_query', function ($q) {

    $tax_query = [];

    // CATEGORY
    if (!empty($_GET['category'])) {
        $categories = explode(',', sanitize_text_field($_GET['category']));
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $categories,
        ];
    }

    // BRAND
    if (!empty($_GET['brand'])) {
        $brands = explode(',', sanitize_text_field($_GET['brand']));
        $tax_query[] = [
            'taxonomy' => 'pa_brand',
            'field' => 'slug',
            'terms' => $brands,
        ];
    }

    if (!empty($tax_query)) {
        $q->set('tax_query', $tax_query);
    }

    // ✅ PRICE FILTER
    if (isset($_GET['min_price']) || isset($_GET['max_price'])) {

        $meta_query = $q->get('meta_query');

        $min = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
        $max = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 999999;

        $meta_query[] = [
            'key' => '_price',
            'value' => [$min, $max],
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ];

        $q->set('meta_query', $meta_query);
    }

});

/**
 * Enqueue shop.js for filter
 */
function gebeyashoptheme_scripts()
{

    if (is_shop() || is_product_taxonomy()) {
        wp_enqueue_script(
            'shop-filters',
            get_template_directory_uri() . '/assets/js/shop.js',
            [],
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'gebeyashoptheme_scripts');

/**
 * Adding Slider
 */
function theme_scripts()
{
    wp_enqueue_style('nouislider-css', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css');
    wp_enqueue_script('nouislider-js', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js', [], null, true);

    wp_enqueue_script('custom-filter', get_template_directory_uri() . '/assets/js/filter.js', ['nouislider-js'], null, true);


    global $wpdb;

    $min_price = $wpdb->get_var("
    SELECT MIN(meta_value+0)
    FROM {$wpdb->postmeta}
    WHERE meta_key = '_price'
");

    $max_price = $wpdb->get_var("
    SELECT MAX(meta_value+0)
    FROM {$wpdb->postmeta}
    WHERE meta_key = '_price'
");


    wp_localize_script('custom-filter', 'price_range', [
        'min' => $min_price,
        'max' => $max_price,
    ]);

}
add_action('wp_enqueue_scripts', 'theme_scripts');


/**
 * Prevent WordPress redirecting incorrectly
 */
add_filter('redirect_canonical', function ($redirect_url, $requested_url) {
    if (is_shop() && (isset($_GET['category']) || isset($_GET['min_price']))) {
        return false;
    }
    return $redirect_url;
}, 10, 2);

add_action('pre_get_posts', function ($query) {

    if (!is_admin() && $query->is_main_query() && is_shop()) {

        if (
            isset($_GET['category']) ||
            isset($_GET['brand']) ||
            isset($_GET['min_price']) ||
            isset($_GET['max_price'])
        ) {
            $query->set('paged', 1);
        }

    }
});
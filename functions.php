<?php

/**
 * Custom Walker Class
 */
class Gebeya_Megamenu_Walker extends Walker_Nav_Menu
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
function gebeya_register_menus()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'gebeyashoptheme'),
        'categories_menu' => __('Categories Menu', 'gebeyashoptheme'),
        'footer_menu_1' => __('Footer Menu 1', 'gebeyashoptheme'),
        'footer_menu_2' => __('Footer Menu 2', 'gebeyashoptheme'),
        'footer_menu_3' => __('Footer Menu 3', 'gebeyashoptheme'),
    ));
}

add_action('after_setup_theme', 'gebeya_register_menus');

/**
 * Header Customizer Settings
 */

function gebeya_customize_register($wp_customize)
{

    // Section: Header Settings
    $wp_customize->add_section('gebeya_header_settings', array(
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
            'section' => 'gebeya_header_settings',
        )
    ));

    // 🔹 Phone Number
    $wp_customize->add_setting('header_phone', array(
        'default' => '+251 900 000 000',
    ));

    $wp_customize->add_control('header_phone', array(
        'label' => __('Phone Number', 'gebeyashoptheme'),
        'section' => 'gebeya_header_settings',
        'type' => 'text',
    ));

    // 🔹 Sign In Text
    $wp_customize->add_setting('header_signin_text', array(
        'default' => 'Sign In',
    ));

    $wp_customize->add_control('header_signin_text', array(
        'label' => __('Sign In Text', 'gebeyashoptheme'),
        'section' => 'gebeya_header_settings',
        'type' => 'text',
    ));

    // 🔹 Sign In Link
    $wp_customize->add_setting('header_signin_link', array(
        'default' => '#',
    ));

    $wp_customize->add_control('header_signin_link', array(
        'label' => __('Sign In Link', 'gebeyashoptheme'),
        'section' => 'gebeya_header_settings',
        'type' => 'url',
    ));
}

add_action('customize_register', 'gebeya_customize_register');
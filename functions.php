<?php

function wpb_custom_new_menu()
{
    register_nav_menu('my-custom-menu', __('My Custom Menu'));
}
add_action('init', 'wpb_custom_new_menu');




add_action('after_setup_theme', 'vluxe_supports');
function vluxe_supports()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('promotions', 600, 438);
    add_theme_support('menus');
    add_theme_support('woocommerce');
    register_nav_menu('main_nav', 'Navigation en-tête');
    register_nav_menu('magasin', 'Compte et panier');

    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets'
        ]
    );
}


//nav_menu_submenu_css_class
add_filter('nav_menu_css_class', 'vluxe_menu_class', 10, 4);
function vluxe_menu_class($classes)
{
    unset($classes);
    $classes[] = 'nav__menu--item';
    return $classes;
}

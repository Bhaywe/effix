<?php

add_action('after_setup_theme', 'effix_supports');
function effix_supports()
{
     add_theme_support('automatic-feed-links');
     add_theme_support('title-tag');
     add_theme_support('post-thumbnails');
     add_theme_support('menus');
     register_nav_menu('main_nav', 'Navigation');

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
add_filter('nav_menu_css_class', 'effix_menu_class', 10, 4);
function vluxe_menu_class($classes)
{
     unset($classes);
     $classes[] = 'nav__menu--item center';
     return $classes;
}

add_action('wp_enqueue_scripts', 'enqueue_styles_effix');
function enqueue_styles_crm()
{
     wp_enqueue_style('style-style', get_template_directory_uri() . '/css/style.css');
}

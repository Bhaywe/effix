<?php

add_action('wp_enqueue_scripts', 'enqueue_styles_effix');
function enqueue_styles_effix()
{
     wp_enqueue_style('style-principal', get_template_directory_uri() . '/css/main.css');
     wp_enqueue_style('style-effix', get_template_directory_uri() . '/style.css');
}

add_action('after_setup_theme', 'effix_supports');
function effix_supports()
{
     add_theme_support('automatic-feed-links');
     add_theme_support('title-tag');
     add_theme_support('post-thumbnails');
     add_theme_support('woocommerce');
     add_theme_support('menus');
     register_nav_menu('main_nav', 'Navigation');
     register_nav_menu('login_nav', 'Login');

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

add_action('widgets_init', 'contact_form');
function contact_form()
{
     register_sidebar(array(
          'name' => 'Formulaire de contact',
          'id' => 'contact-form',
     ));
}

add_action('widgets_init', 'newsletter_form');
function newsletter_form()
{
     register_sidebar(array(
          'name' => 'Formulaire infolettre',
          'id' => 'newsletter-form',
     ));
}

function woocommerce_menu()
{
     $menu = [
          'dashboard'              => __('Compte', 'woocommerce'),
          'orders'                 => __('Commandes', 'woocommerce'),
          'edit-account'           => __('Détails du compte', 'woocommerce'),
     ];
     return $menu;
}

add_filter('woocommerce_account_menu_items', 'woocommerce_menu');

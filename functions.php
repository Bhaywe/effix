<?php

function wpb_custom_new_menu()
{
    register_nav_menu('main_nav', __('My Custom Menu'));
}
add_action('init', 'wpb_custom_new_menu');


add_action('after_setup_theme', 'effix_supports');
function effix_supports()
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


/**
 * Ajout du rôle abonné à l'achat de l'Abonnement
 */
add_action('woocommerce_order_status_processing', 'change_role_on_purchase');
function change_role_on_purchase($order_id)
{

    $order = new WC_Order($order_id);
    $items = $order->get_items();

    foreach ($items as $item) {
        $product_name = $item['name'];
        $product_id = $item['product_id'];
        $product_variation_id = $item['variation_id'];

        if ($order->user_id > 0 && $product_id == '12') {
            update_user_meta($order->user_id, 'paying_customer', 1);
            $user = new WP_User($order->user_id);

            // Add role
            $user->add_role('subscriber');
        }
    }
}

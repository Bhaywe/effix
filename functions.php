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


// Changer le role de customer pour subscriber
// lorsque le produit est acheté.
add_action('woocommerce_order_status_processing', 'change_role_on_purchase');
function change_role_on_purchase($order_id)
{
    $order = new WC_Order($order_id);
    $items = $order->get_items();

    foreach ($items as $item) {
        $product_name = $item['name'];
        $product_id = $item['product_id'];
        $product_variation_id = $item['variation_id'];

        if ($order->user_id > 0 && $product_id == '10') {
            update_user_meta($order->user_id, 'paying_customer', 1);
            $user = new WP_User($order->user_id);

            // Remove role
            $user->remove_role('customer');

            // Add role
            $user->add_role('subscriber');
        }
    }
}


add_action('init', 'update_subscription_effix');
function update_subscription_effix()
{
    //verify each order subscription for expiration date.
    $orders = wc_get_orders(array('numberposts' => -1));

    foreach ($orders as $order) {


        //-------------------------------------------------
        //--------------- testing date --------------------


        // echo "ID de la commande " . $order->get_id() . '<br><br>';

        // echo "Date de creation" . $order->order_date . '<br><br>';

        // echo "date d'expiration" . $expirationDate . '<br><br>';

        // echo "current time" . date('Y-m-d H:i:s', strtotime('+1 year', current_time('timestamp'))) . '<br><br>';

        // echo "<hr>";


        //-------------------------------------------------
        //--------------- testing date --------------------

        //Id du client de la commande
        $order_customer_id  = $order->get_customer_id();

        //Date d'achat de la commande 
        $created_date = $order->order_date;

        //Conversion de la date en Unix timestamp
        $timestampConvert = strtotime($created_date);

        //Ajout un an à la date d'achat du produit
        $expirationDate = date('Y-m-d g:i:s', strtotime('+1 year', $timestampConvert));

        //Conversion de la date d'expiration en Unix timestamp
        $expirationTime = strtotime($expirationDate);

        //-------------------------------------------------
        //obtenir l'id de la commande
        $order_id = $order->get_id(); // The order_id

        // get an instance of the WC_Order object
        $order_item = wc_get_order($order_id);

        // Get the order items , specifically product_id
        foreach ($order_item->get_items() as $item_id => $item) {
            //Get the product_id
            $product_id = $item->get_product_id();
        }
        //-------------------------------------------------

        //Vérification de la date actuelle avec la date d'expiration
        if ($product_id === 10 && current_time('timestamp') <= $expirationTime) {
            // Fetch the WP_User object of our user.
            $get_customer_id = new WP_User($order_customer_id);

            // Replace the current role with 'customer'
            $get_customer_id->set_role('subscriber');
        } else {
            // Fetch the WP_User object of our user.
            $get_customer_id = new WP_User($order_customer_id);

            // Replace the current role with 'customer'
            $get_customer_id->set_role('customer');
        }



        // lorsque le current time arrive à 1 semaine de l'Expriration on
        // envoie un courriel de rapel de l'Expiration de l'abonnement.
        // $to = 'sendto@example.com';
        // $subject = 'The subject';
        // $body = 'The email body content';
        // $headers = array('Content-Type: text/html; charset=UTF-8');
        // wp_mail( $to, $subject, $body, $headers );


    }
}

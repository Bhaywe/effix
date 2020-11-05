<?php

namespace Effix\Subscription;

use WP_User;
use WC_Order;

class Purchase
{
    public function __construct()
    {
        add_action('woocommerce_order_status_processing', [$this, 'change_role_on_purchase']);
    }

    /**
     * [change_role_on_purchase description]
     *
     * @param   [type]  $order_id  [$order_id description]
     *
     * @return  [type]             [return description]
     */
    public function change_role_on_purchase($order_id)
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
}

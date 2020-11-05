<?php

namespace Effix\Subscription;

use WP_User;
use DateTime;

class Update
{

    public function __construct()
    {
        // $this->update_subscription_effix();
        add_action('cron_job_effix', 'update_subscription_effix');

        $timestamp = new DateTime('now');
        wp_schedule_event($timestamp, 'daily', [$this, 'update_subscription_effix']);
    }

    /**
     * [update_subscription_effix description]
     *
     * @return  [type]  [return description]
     */
    public function update_subscription_effix()
    {
        //verify each order subscription for expiration date.
        $orders = wc_get_orders(array('numberposts' => -1));

        foreach ($orders as $order) {
            //Id du client de la commande
            $order_customer_id  = $order->get_customer_id();

            //Date d'achat de la commande 
            $created_date = date('Y-m-d H:i:s', $order->get_date_created()->getOffsetTimestamp());

            //Date d'achat de la commande 
            //return the timestamp for the WordPress time zone that’s currently set.
            echo date('Y-m-d H:i:s', $order->get_date_created()->getOffsetTimestamp()) . '<br>';

            //Conversion de la date en Unix timestamp
            $timestampConvert = strtotime($created_date);

            //Ajout un an à la date d'achat du produit
            $expirationDate = date('Y-m-d H:i:s', strtotime('+1 year', $timestampConvert));

            //Conversion de la date d'expiration en Unix timestamp
            $expirationTime = strtotime($expirationDate);

            // Fetch the WP_User object of our user from customer_id order
            $get_customer_id = new WP_User($order_customer_id);

            //------------------- testing date ------------------------
            // echo "ID de la commande " . $order->get_id() . '<br><br>';
            // echo "Date de creation" . $order->order_date . '<br><br>';
            // echo "date d'expiration" . $expirationDate . '<br><br>';
            // echo "current time" . date('Y-m-d H:i:s', strtotime('+1 year', current_time('timestamp'))) . '<br><br>';
            // echo "<hr>";
            //------------------- testing date ------------------------

            //-------------------------------------------------
            //obtenir l'id de la commande
            $order_id = $order->get_id();
            $order_item = wc_get_order($order_id);

            // Get the order items , specifically product_id
            foreach ($order_item->get_items() as $item_id => $item) {
                //Get the product_id
                $product_id = $item->get_product_id();
            }
            //-------------------------------------------------

            //Vérification de la date actuelle avec la date d'expiration
            if ($product_id === 10 && current_time('timestamp') <= $expirationTime) {
                // Replace the current role with 'customer'
                $get_customer_id->set_role('subscriber');
            } else {
                $get_customer_id->set_role('customer');
            }

            //----------- Test date expiration reminder ---------------
            // echo 'reminder: ' . $reminder_date . '<br>';
            // echo 'expiration date: ' . $expirationDate . '<br><br>';
            // echo '<hr>';
            //echo $user_email;
            //---------------------------------------------------------

            // Date reminde pour le renouvellement une semaine avant la date d'expiration
            $reminder_date = date('Y-m-d H:i:s', strtotime('+1 year -7 days', $timestampConvert));
            $reminder_time = strtotime($reminder_date); // date format unix timestamp

            $user_info = get_userdata($order_customer_id); //donné de l'utilisateur
            $user_id = $user_info->ID;
            $user_email = $user_info->user_email; // email utilisateur
            $user_roles = $user_info->roles; // role utilisateur
            $link_site = get_site_url(); // url du site

            // var_dump($user_info);
            // var_dump($user_roles);
            // echo in_array('subscriber', $user_roles);

            ###var_dump('potatoooo');
            //Envoie du courriel de renouvellement lorsqu'on atteint la date du reminder
            if ($product_id === 10 && current_time('timestamp') >= $reminder_time && in_array('subscriber', $user_roles) && $user_id === $order_customer_id) {
                $to = $user_email;
                $subject = 'Renouvellement de votre abonnement Effix';
                $body = 'Votre abonnement Effix expirera le' . $expirationDate . 'Il vous sera possible de vous réabonner lorsque l\'expiration de celui-ci sera atteinte. Pour tout autre information veuillez nous contacter sur' . '<a href="' . $link_site . '"> Effix </a>';
                $headers = array('Content-Type: text/html; charset=UTF-8');
                wp_mail($to, $subject, $body, $headers);
            }
            // var_dump(wp_mail($to, $subject, $body, $headers));
        }
    }
}

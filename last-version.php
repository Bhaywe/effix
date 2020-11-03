//customer_id
// change date format in minute or sec


// Loop through each WC_Order object
add_action('init', 'test');
function test()
{
//verify each order subscription for expiration date.
$orders = wc_get_orders(array('numberposts' => -1));

foreach ($orders as $order) {
echo $order->get_id() . '<br>';
echo $order->get_customer_id() . '<br>';
echo $order->get_status() . '<br>';

//Id du client de la commande
$order_customer_id = $order->get_customer_id();

//Date d'achat de la commande
$created_date = $order->get_date_created();

//Conversion de la date en Unix timestamp
$timestampConvert = strtotime($created_date);

//Ajout un an à la date d'achat du produit
$expirationDate = date('Y-m-d', strtotime('+10 minutes', $timestampConvert));

//Conversion de la date d'expiration en Unix timestamp
$expirationTime = strtotime($expirationDate);

// $the_user = get_user_by('id', $oder_customer_id); // 54 is a user ID
// echo $the_user->user_email;

// $order_item_id = 15;
// $item = new WC_Order_Item_Product($order_item_id);
// $product_id = $item->get_product_id();
// echo $product_id;


$order_item = wc_get_order($order->get_id());
var_dump($order_item);


// Compare date, but need to modify a specific user when due date
//-------------------------------------------------------------
//-------------------------------------------------------------

//Vérification de la date actuelle avec la date d'expiration
//Si la date actuelle atteint la date d'expiration
if (current_time('timestamp') >= $expirationTime) {
// Fetch the WP_User object of our user.
$get_customer_id = new WP_User($order_customer_id);

// Replace the current role with 'customer' role
$get_customer_id->set_role('customer');
}

//-------------------------------------------------------------
//-------------------------------------------------------------
}
}

//find product id in the list of product order

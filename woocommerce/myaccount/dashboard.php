<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>



<!-- <h2 class="heading-secondary">
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses(__('Bonjour %1$s ', 'woocommerce'), $allowed_html),
		esc_html($current_user->display_name) . '<a class="btn btn--light btn--dash" href="%2$s">Déconnexion</a>',
		esc_url(wc_logout_url())
	);
	?>
</h2> -->

<h2 class="heading-secondary woocommerce__account">
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses(__('Bonjour %1$s <a href="%2$s">Déconnexion</a>', 'woocommerce'), $allowed_html),
		esc_html($current_user->display_name),
		esc_url(wc_logout_url())
	);
	?>
</h2>

<?php
do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation u-margin-top-special">
	<ul>
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<li class="woocommerce__nav <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

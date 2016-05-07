<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<p><?php _e( 'To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'teo' ); ?></p>

	<p class="form-row form-row-first"><label for="orderid"><?php _e( 'Order ID', 'teo' ); ?></label> <input class="input-text form-control" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'teo' ); ?>" /></p>
	<p class="form-row form-row-last"><label for="order_email"><?php _e( 'Billing Email', 'teo' ); ?></label> <input class="input-text form-control" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'teo' ); ?>" /></p>
	<div class="clear"></div>

	<p class="form-row"><input type="submit" class="button btn btn-default" name="track" value="<?php _e( 'Track', 'teo' ); ?>" /></p>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>
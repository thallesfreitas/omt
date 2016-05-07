<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $teo_songs, $teo_songs_count;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;
?>

<div class="col-lg-2 col-md-3 col-sm-6">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    <?php wc_get_template_part( 'content-product', 'single' ); ?>
</div>
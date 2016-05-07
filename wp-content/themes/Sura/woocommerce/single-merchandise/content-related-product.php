<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;
?>

<div class="col-sm-4">
    <?php wc_get_template_part( 'content-merchandise', 'product' ); ?>
</div>
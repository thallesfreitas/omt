<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="product-info info-hidden">
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<?php if($key == 'description' || $key == 'additional_information') continue; ?>
			<h5><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></h5>
			<div class="text">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
			<a href="#" class="more">
                <i class="fa fa-plus"></i>
            </a>
            <a href="#" class="close">
                <i class="fa fa-close"></i>
            </a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
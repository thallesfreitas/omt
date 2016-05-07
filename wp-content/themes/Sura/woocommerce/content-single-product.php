<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $teo_songs, $teo_songs_count;

//player info
$files = get_post_meta($post->ID, '_downloadable_files', true);
if(!isset($files) || $files == '' ) {
	wc_get_template_part('content', 'single-merchandise');
}
else {
	wc_get_template_part('content', 'single-song');
}
?>

<?php do_action( 'woocommerce_after_single_product' ); ?>

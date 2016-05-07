<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>
<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-danger"><?php echo wp_kses_post( $message ); ?></li></div>
<?php endforeach; ?>

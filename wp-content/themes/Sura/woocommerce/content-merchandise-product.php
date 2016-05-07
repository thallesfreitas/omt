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

global $product, $woocommerce_loop, $teo_songs, $teo_songs_count;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;

$categories = get_the_terms( $product->id, 'product_cat' );
$category = array();
if ( $categories && ! is_wp_error( $categories ) ) {
    foreach($categories as $cat) {
        $category = array($cat->name, $cat->term_id);
        break;
    }
}

$image = wp_get_attachment_url( get_post_thumbnail_id($product->id) );
$thumb = teo_resize($image, 372, 412, true, true);

$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {
    foreach ( $attachment_ids as $attachment_id ) {
        $url = wp_get_attachment_url( $attachment_id );
        $thumb2 = teo_resize($url, 372, 412, true, true);
        break;
    }
}

if(!isset($thumb2) || $thumb2 == '') {
    $thumb2 = $thumb;
}
?>

<div class="product">
    <?php if(count($category) == 2) { ?>
        <a href="<?php echo get_term_link($category[1], 'product_cat');?>" class="name"><?php echo $category[0];?></a>
    <?php } ?>
    
    <figure class="with-title-effect">
        <?php if($thumb != '') { ?>
            <img src="<?php echo $thumb;?>" alt="<?php the_title();?>" class="main">
            <img src="<?php echo $thumb2;?>" alt="<?php the_title();?>" class="second">
        <?php } ?>
        <div class="links">
            <div class="add to-cart"><?php woocommerce_template_single_add_to_cart();?></div>
            <div class="add to-whishlist"><?php get_template_part( 'templates/song', 'wishlist' );?></div>
        </div>
    </figure>
    <a href="<?php the_permalink();?>" class="description"><?php the_title();?></a>
    <div class="price"><?php woocommerce_template_single_price();?></div>
</div>
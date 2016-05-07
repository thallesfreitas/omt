<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$genres = get_the_terms($product->id, 'genre');

$genre_ids = array();

if ( $genres && ! is_wp_error( $genres ) ) {
    foreach($genres as $genre) {
        $genre_ids[] = $genre->term_id;
    }
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__not_in'         => array( $product->id ),
	'tax_query' 		   => array(
								array(
									'taxonomy' => 'genre',
									'field'    => 'term_id',
									'terms'    => $genre_ids,
								)
)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related-albums-container">

		<h6><?php _e('Related', 'teo');?></h6>
	    <h3><?php _e('Songs', 'teo');?></h3>
	    <div class="row">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'related-product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div>
	</div>

<?php endif;

wp_reset_postdata();

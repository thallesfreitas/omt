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

$categories = get_the_terms($product->id, 'product_cat');

$categories_ids = array();

if ( $categories && ! is_wp_error( $categories ) ) {
    foreach($categories as $category) {
        $categories_ids[] = $category->term_id;
    }
}

$posts_per_page = 3;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => 'rand',
	'post__not_in'         => array( $product->id ),
	'tax_query' 		   => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'term_id',
									'terms'    => $categories_ids,
								)
)
) );

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>
    <div class="col-sm-10 col-sm-offset-1">
        <div class="merchandise-container no-top-padding no-top-border">
          	<div class="row no-margin">
            	<div class="col-sm-12">
					<h6><?php _e('Related', 'teo');?></h6>
				    <h3><?php _e('Products', 'teo');?></h3>
	    			<div class="row">
						<?php 
						while ( $products->have_posts() ) : $products->the_post(); 
							get_template_part( 'woocommerce/single-merchandise/content-related-product' );
						endwhile; // end of the loop. 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif;

wp_reset_postdata();

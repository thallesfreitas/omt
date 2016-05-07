<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); 
?>

<div id="ajax-content">
	<div class="product-search-container">
		<div class="row no-margin">
	        <div class="col-sm-3 col-sm-offset-1">
	        	<h6><?php _e('Start', 'teo');?></h6>
	            <h3><?php _e('Shopping', 'teo');?></h3>
	        	<?php get_sidebar('merchandise');?>
	       	</div>
	    	<div class="col-sm-7">
	    		<div class="product-results">
	                <div class="row">
						<?php 
						if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="col-sm-6">
								<?php wc_get_template_part( 'content-merchandise', 'product' ); ?>
							</div>
							<?php endwhile;
							get_template_part('lib/pagination');
						else : ?>
							<p><?php _e('There are no products available', 'teo');?></p>
						<?php endif; wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();?>
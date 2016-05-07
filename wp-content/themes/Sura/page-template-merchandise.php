<?php
/*
Template name: Merchandise page
*/
get_header();
the_post();
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
						$terms = get_terms('product_cat');
		                $terms_ids = array();
		                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		                    foreach($terms as $term) {
		                        $terms_ids[] = $term->term_id;
		                    }
		                }
		            	$args = array();
		            	$args['post_type'] = 'product';
		                $args['tax_query'] = array(
		                    array(
		                        'taxonomy' => 'product_cat',
		                        'terms'    => $terms_ids,
		                    ),
		                );
		                $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
		                $args['paged'] = $paged;
		            	query_posts($args);
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
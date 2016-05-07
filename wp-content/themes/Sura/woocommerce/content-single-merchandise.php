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

global $product;

$images = array();

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
if(isset($image) && $image != '') {
	$images[] = $image;
}

$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$thumb = wp_get_attachment_url( $attachment_id );
		if($thumb != '') { 
			$images[] = $thumb;
		}
	}
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div id="ajax-content">
	<div class="row no-margin">
	    <div class="col-sm-5 no-padding">
	        <div class="product-images">
	            <div class="main-slider">
	                <?php if(count($images) > 0) { ?>
		                <ul class="slides">
							<?php foreach($images as $image) { ?>
								<li>
			                    	<figure>
			                    		<img src="<?php echo teo_resize($image, 600, 650);?>" alt="<?php the_title();?>">
			                    	</figure>
			                  	</li>
			                <?php } ?>
		                </ul>
		            <?php } ?>
	            </div>
	            <div class="thumb-slider">
	                <?php if(count($images) > 0) { ?>
		                <ul class="slides">
							<?php foreach($images as $image) { ?>
								<li>
			                    	<figure>
			                    		<img src="<?php echo teo_resize($image, 100, 100);?>" alt="<?php the_title();?>">
			                    	</figure>
			                  	</li>
			                <?php } ?>
		                </ul>
		            <?php } ?>
	            </div>
	        </div>
	    </div>
	    <div class="col-sm-6 no-padding">
	        <div class="product-description">
	            <div class="row">
	                <div class="col-sm-<?php if($product->product_type == 'variable') echo '12'; else echo '8';?>">
	                  	<div class="product-main-info">
	                  		<?php 
	                  		$categories = get_the_terms($post->ID, 'product_cat'); 
	                  		$cat = '';
	                  		if ( $categories && ! is_wp_error( $categories ) ) {
	                  			foreach($categories as $category) {
	                  				$cat = '<a href="' . get_term_link($category->term_id, 'product_cat') . '">' . $category->name . '</a>';
	                  			}
	                  		}
	                  		?>
	                    	<div class="breacrumb"><?php _e('Shop >', 'teo'); echo ' ' . $cat;?></div>
	                    	<div class="name"><?php the_title();?></div>
	                    	<div class="price"><?php woocommerce_template_single_price();?></div>
	                  	</div>
	                </div>
	                <div class="col-sm-<?php if($product->product_type == 'variable') echo '12'; else echo '4';?>">
	                	<?php get_template_part( 'woocommerce/single-merchandise/add-to-cart/' . $product->product_type );?>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-12">
	                  	<div class="product-info info-shown">
	                    	<h5><?php _e('Description', 'teo');?></h5>
		                    <div itemprop="description" class="text">
			                      <?php the_content('');?>
		                    </div>
		                    <a href="#" class="more">
		                    	<i class="fa fa-plus"></i>
		                    </a>
		                   	<a href="#" class="close">
		                   		<i class="fa fa-close"></i>
		                   	</a>
	                 	</div>
	                  	<?php
	                  	//decide whether the product has attributes or not, to show them in additional information
	                  	$attributes = $product->get_attributes();
	                  	if(count($attributes) > 0 || ($product->enable_dimensions_display() && $product->has_dimensions() ) ) { ?>
		                  	<div class="product-info info-hidden">
		                    	<h5><?php _e('Additional Information', 'teo');?></h5>
		                    	<div class="text">
		                    		<?php get_template_part('woocommerce/single-merchandise/product-attributes');?>
		                    	</div>
		                    	<a href="#" class="more">
		                    		<i class="fa fa-plus"></i>
		                    	</a>
		                    	<a href="#" class="close">
		                    		<i class="fa fa-close"></i>
		                    	</a>
		                  	</div>
		                <?php } ?>

	                  	<?php get_template_part('woocommerce/single-merchandise/tabs');?>
	                  	
	                  	<?php if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
							$count   = $product->get_rating_count();
							$average = round($product->get_average_rating());
							?>
							<div class="product-reviews">
			                    <div class="reviews-count">
			                      	<div class="text"><?php _e('Reviews', 'teo');?> - <?php echo $count;?></div>
			                      	<ul class="stars">
			                        	<?php for($i = 1; $i <= 5; $i++) { 
			                        		if($i <= $average) { ?>
			                        			<li class="checked"><i class="music-star"></i></li>
			                        		<?php } else { ?>
			                        			<li class="unchecked"><i class="music-star"></i></li>
			                        		<?php } 
			                        	} ?>
			                      	</ul>
			                    </div>
	                    		<div class="links">
	                    			<?php if($count != 0) { ?>
	                    				<a href="#" data-toggle="modal" data-target="#view-review-modal" class="view no-ajaxy"><?php _e('View', 'teo');?></a>
	                    			<?php } ?>
	                    			<a href="#" data-toggle="modal" data-target="#add-review-modal" class="add no-ajaxy"><?php _e('Add', 'teo');?></a>
	                    		</div>
	                  		</div>
	                  	<?php } ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="row no-margin">
	    <?php get_template_part('woocommerce/single-merchandise/related');?>
	          	
	    <div id="add-review-modal" tabindex="-1" role="dialog" aria-labelledby="add-review-modal-label" aria-hidden="true" class="modal fade">
	        <div class="modal-dialog modal-dialog-center">
	            <div class="modal-content add-review">
	               	<button data-dismiss="modal" class="close"><i class="fa fa-times"></i></button>
	                <div class="modal-header"><?php _e('Add your own review', 'teo');?></div>
	              	<div class="modal-body">
	              		<div class="row no-margin">
		              		<?php 
		              		if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) {

								$commenter = wp_get_current_commenter();

								$comment_form = array(
									'title_reply'          => '',
									'title_reply_to'       => '',
									'comment_notes_before' => '',
									'comment_notes_after'  => '',
									'fields'               => array(
										'author' => '
											<div class="col-sm-6 no-padding">
		                        				<div class="input-container bordered">
		                          					<div class="form-group">
		                          						<label for="author">' . __( 'Name', 'teo' ) . ' <span class="required">*</span></label> 
		                          						<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
		                          					</div>
		                          				</div>
		                          			</div>',
										'email'  => '
											<div class="col-sm-6 no-padding">
		                       					<div class="input-container bordered">
		                          					<div class="form-group">
		                          						<label for="email">' . __( 'Email', 'teo' ) . ' <span class="required">*</span></label>
		                          						<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
		                          					</div>
		                          				</div>
		                          			</div>',
									),
									'label_submit'  => __( 'Add review', 'teo' ),
									'id_submit' 	=> 'merchandise-review-submit',
									'logged_in_as'  => '',
									'comment_field' => '
										<div class="col-sm-12 no-padding">
				                        	<div class="input-container">
				                          		<div class="form-group">
				                       				<label for="comment">' . __( 'Message', 'teo' ) . '*:</label>
				                            		<textarea id="comment" name="comment" aria-required="true" class="form-control"></textarea>
				                          		</div>
				                        	</div>
				                   		</div>'
								);

								if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
									$comment_form['comment_field'] .= '
										<div class="col-sm-12 no-padding">
											<div class="rating-input">
												<input id="rating" name="rating" type="hidden" required="true">
												<label class="rating-label">' . __('Rating', 'teo') . '*:</label>
		                       					<div class="reviews-count">
		                            				<ul class="stars">
		                              					<li><i class="music-star"></i></li>
		                           						<li><i class="music-star"></i></li>
		                              					<li><i class="music-star"></i></li>
		                              					<li><i class="music-star"></i></li>
		                              					<li><i class="music-star"></i></li>
		                            				</ul>
		                          				</div>
		                        			</div>
		                      			</div>';
								}

								comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
							}
							else { ?>
								<div class="col-sm-12 no-padding" style="margin-top: 30px">
			                        <div class="input-container">
			                         	<div class="form-group">
			                       			<label for="comment"><?php _e('Only logged in customers who have purchased this product may leave a review', 'teo');?></label>
			                          	</div>
			                        </div>
			                   	</div>
							<?php } ?>
						</div>
	                </div>
	           	</div>
	        </div>
	    </div>
	    <div id="view-review-modal" tabindex="-1" role="dialog" aria-labelledby="add-review-modal-label" aria-hidden="true" class="modal fade">
	        <div class="modal-dialog modal-dialog-center">
	            <div class="modal-content view-review">
	                <button data-dismiss="modal" class="close"><i class="fa fa-times"></i></button>
	                <div class="modal-header"><?php _e('User Reviews', 'teo');?></div>
	                <div class="modal-body">
	                  	<div class="review-slider">
	               			<ul class="slides">
	               				<?php
	               				$args = array('order' 		=> 'DESC',
	               							  'orderby' 	=> 'comment_date_gmt',
	               							  'status'  	=> 'approve',
	               							  'post_id' 	=> $post->ID,
	               							  'number' 		=> 10
	               							  );
	               				$comments = get_comments($args);
	               				foreach($comments as $comment) { 
	               					$rating = round( get_comment_meta( $comment->comment_ID, 'rating', true ) );
	   								?>
								   	<li <?php comment_class('comment', $comment->comment_ID); ?> id="comment-<?php echo $comment->comment_ID; ?>">
								        <div id="comment-<?php echo $comment->comment_ID; ?>" class="item">
								        	<div class="author-info">
								        		<label><?php _e('Name', 'teo');?>:</label>
								                <div class="info">
								                	<a><?php echo $comment->comment_author;?></a> on <?php echo (get_comment_date('d.m.Y', $comment->comment_ID));?>
								                </div>
								                <div class="reviews-count">
								                    <ul class="stars">
								                        <?php for($i = 1; $i <= 5; $i++) { 
										                    if($i <= $rating) { ?>
										                       	<li class="checked"><i class="music-star"></i></li>
										                    <?php } else { ?>
										                       	<li class="unchecked"><i class="music-star"></i></li>
										                    <?php } 
										                } ?>
								                    </ul>
								                </div>
								            </div>
								            <div class="review-text">
								            	<?php echo $comment->comment_content; ?>
								            	<?php if ($comment->comment_approved == '0') : ?>
								                    <p>
								                        <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','teo') ?></em>
								                    </p>
								                <?php endif; ?>
								            </div>
								        </div>
								    </li>
	               				<?php } ?>
	                    	</ul>
	                  	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

	<?php do_action( 'woocommerce_after_single_product' ); ?>

</div>
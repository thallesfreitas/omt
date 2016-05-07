<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>

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

<div class="reviews-container">
    <h6><?php _e('Customer', 'teo');?></h6>
    <h3><?php _e('Reviews', 'teo');?></h3>
    <?php $average = round($product->get_average_rating() );?>
    <div class="reviews-count">
        <ul class="stars">
            <?php for($i = 1; $i <= 5; $i++) { 
		        if($i <= $average) { ?>
		            <li class="checked"><i class="music-star"></i></li>
		        <?php } else { ?>
		            <li class="unchecked"><i class="music-star"></i></li>
		        <?php } 
		    } ?>
        </ul>
        <div class="text"><?php echo sprintf(__('%s reviews', 'teo'), $product->get_rating_count());?></div>
    </div>
    
    <button data-toggle="modal" data-target="#add-review-modal" class="btn btn-default"><?php _e('Add review', 'teo');?></button>
    
    <?php 
    if ( have_comments() ) : ?>
    	<hr>
	    <ul class="reviews-list">
	    	<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
	    </ul>
	    <?php 
	    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			echo '<nav class="woocommerce-pagination">';
			paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'type'      => 'list',
			) ) );
			echo '</nav>';
		endif; ?>
	<?php else : ?>
		<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'teo' ); ?></p>
	<?php endif; ?>
</div>
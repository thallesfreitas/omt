<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<div itemprop="author" class="author"><?php comment_author(); ?>
			<?php
			if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
				if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
					echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';
			?>
			<span>/ <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'woocommerce' ) ); ?></time></span>
		</div>

		<div class="reviews-count" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
            <ul class="stars">
                <?php for($i = 1; $i <= 5; $i++) { 
		            if($i <= $rating) { ?>
		                <li class="checked"><i class="music-star"></i></li>
		            <?php } else { ?>
		                <li class="unchecked"><i class="music-star"></i></li>
		            <?php } 
		        } ?>
            </ul>
            <strong style="display: none" itemprop="ratingValue"><?php echo $rating; ?></strong>
        </div>

        <div class="text">
           	<?php echo get_comment_text(); ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <p>
                    <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','teo') ?></em>
                </p>
            <?php endif; ?>
        </div>
	</div>

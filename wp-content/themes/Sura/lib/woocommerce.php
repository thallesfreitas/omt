<?php

add_theme_support( 'woocommerce' );

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_action( 'wp_enqueue_scripts', 'teo_manage_woocommerce_styles', 99 );
function teo_manage_woocommerce_styles() {
	wp_dequeue_script( 'wc-chosen' );
}

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// add_action('woocommerce_before_main_content', 'teo_before_content', 10);
// add_action('woocommerce_after_main_content', 'teo_after_content', 20);

//removing the breadcrumbs since we don't use them
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

function teo_remove_reviews_tab($tabs) {
	unset($tabs['reviews']);
	return $tabs;
}

// remove reviews from regular tabs
add_filter( 'woocommerce_product_tabs', 'teo_remove_reviews_tab', 98);

// Fix the layout etc
function teo_before_content() {
	?>
	<!-- #content Starts -->
    <section class="main-container">
    	<div class="container">
    		<div class="row">
    <?php
}
function teo_after_content() {
	?>
			</div>
		</div>
	</section>
	<?php 
}

function teo_review($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   $rating = round( get_comment_meta( $comment->comment_ID, 'rating', true ) );
   ?>

   <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="id">
        	<div class="author-info">
        		<label><?php _e('Name', 'teo');?>:</label>
                <div class="info">
                	<a><?php echo get_comment_author();?></a> on <?php echo (get_comment_date('d.m.Y'));?>
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
            	<?php echo get_comment_text(); ?>
            	<?php if ($comment->comment_approved == '0') : ?>
                    <p>
                        <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','teo') ?></em>
                    </p>
                <?php endif; ?>
            </div>
        </div>
<?php } ?>
<?php
global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>

<div id="view-review-modal" tabindex="-1" role="dialog" aria-labelledby="add-review-modal-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content view-review">
            <button data-dismiss="modal" class="close"><i class="fa fa-times"></i></button>
            <div class="modal-header"><?php _e('User Reviews', 'teo');?></div>
            <div class="modal-body">
		
<?php if ( have_comments() ) : ?>

	<div class="review-slider">
        <ul class="slidesss">
			<?php wp_list_comments( 'callback=teo_review&reserve_top_level=true&type=comment' ); ?>
		</ul>
	</div>

<?php else : ?>

	<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'teo' ); ?></p>

<?php endif; ?>
			</div>
		</div>
	</div>
</div>
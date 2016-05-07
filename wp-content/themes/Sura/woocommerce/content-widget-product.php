<?php global $product; ?>
<li>
	<a class="left-image" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
	</a>
	<a class="right-info" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_title(); ?>
		<br /><br />
		<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
		<?php echo $product->get_price_html(); ?>
	</a>
</li>
<div style="clear: both"></div>
<?php 
global $product;
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div class="col-md-4 col-sm-6">
    <div class="song">
        <figure>
        	<?php if($image != '') { ?>
        		<img src="<?php echo teo_resize($image, 186, 210, true, true);?>" alt="<?php the_title();?>" />
        	<?php } else { ?>
        		<div class="placeholder-image">&nbsp;</div>
        	<?php } ?>
        	
            <div class="overlay">
                <div class="background"></div>
                <div class="icons">
                    <ul>
                        <?php if( $product->is_purchasable() && $product->is_in_stock() ) { ?>
                            <li><?php woocommerce_template_single_add_to_cart();?></li>
                        <?php } ?>
                        <li>
		                    <a href="#" data-id="<?php echo $post->ID;?>" class="play-song-individual">
		                       	<i class="music-player-play-outline"></i>
		                   	</a>
		                   	<a href="#" class="pause-song">
		                       	<i class="music-player-pause"></i>
		                   	</a>
		     	        </li>
                        <li>
                            <?php get_template_part( 'templates/song', 'wishlist' );?>
                        </li>
                    </ul>
                </div>
            </div>
        </figure>
        <a href="<?php the_permalink();?>" class="title"><?php the_title();?></a>
        <div class="price">
        	<?php global $product; echo $product->get_price_html();?>
        </div>
    </div>
</div>
<?php
global $post, $product;
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$thumb = teo_resize($image, 186, 223);
?>
<div class="song">
    <figure>
        <?php if($thumb != '') { ?>
            <img src="<?php echo $thumb;?>" alt="<?php the_title();?>">
        <?php } else { ?>
            <div class="placeholder-image">&nbsp;</div>
        <?php } ?>
        <div class="overlay">
            <div class="background"></div>
            <div class="icons">
                <ul>
                    <?php if( $product->is_purchasable() && $product->is_in_stock() ) { ?>
                        <li>
                            <?php woocommerce_template_single_add_to_cart();?>
                        </li>
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
    <div class="price"><?php woocommerce_template_single_price();?></div>
</div>
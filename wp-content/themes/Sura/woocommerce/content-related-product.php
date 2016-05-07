<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

//player info
$file = get_post_meta($post->ID, '_song_preview', true);

if($file == '') {
    $files = get_post_meta($post->ID, '_downloadable_files', true);

    foreach($files as $file) {
        $file = $file['file'];
        break;
    }
}

$mp3file = new MP3File($file);
@$duration = $mp3file->getDuration();

$artists = get_the_terms( $product->id, 'artist' );
$artist_names = array();
if ( $artists && ! is_wp_error( $artists ) ) {
    foreach($artists as $artist) {
        if(!isset($artist_names[$artist->term_id]) ) {
            $artist_names[$artist->term_id] = esc_attr($artist->name);
        }
    }
}

$albums = get_the_terms( $product->id, 'album' );
$album_links = array();
if ( $albums && ! is_wp_error( $albums ) ) {
    foreach($albums as $album) {
        if(!isset($album_links[$album->term_id]) ) {
            $album_links[$album->term_id] = '<a href="' . get_term_link($album) . '">' . esc_attr($album->name) . '</a>';
        }
    }
}

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

?>

<div class="col-sm-3">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    <div class="song big">
        <figure>
            <?php if($image != '') { ?>
                <img src="<?php echo esc_url($image);?>" alt="<?php the_title();?>">
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
        <div class="duration">
	        <?php 
	        echo MP3File::formatTime($duration);
	        if(count($album_links) > 0) {
	        	echo ' / ' . implode(', ', $album_links);
	        }
	        ?>
        </div>
    </div>
</div>
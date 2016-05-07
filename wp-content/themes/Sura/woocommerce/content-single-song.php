<?php
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$date = get_post_meta($post->ID, '_song_date', true);
$itunes = get_post_meta($post->ID, '_song_itunes', true);
$spotify = get_post_meta($post->ID, '_song_spotify', true);
$amazon = get_post_meta($post->ID, '_song_amazon', true);
$beatport = get_post_meta($post->ID, '_song_beatport', true);
$extra = get_post_meta($post->ID, '_song_extradetails', true);
$genres = get_the_terms($post->ID, 'genre');
$artists = get_the_terms($post->ID, 'artist');

$artists_links = array();
$album_link = '';
if ( $artists && ! is_wp_error( $artists ) ) {
    foreach($artists as $artist) {
        $artists_links[] = '<a class="artist-link" href="' . get_term_link($artist->term_id, 'artist') . '">' . esc_attr($artist->name) . '</a>';
    }
}

$albums = get_the_terms($post->ID, 'album');
if ( $albums && ! is_wp_error( $albums ) ) {
	foreach($albums as $album) {
		$album_link = '<a class="album-link" href="' . get_term_link($album->term_id, 'album') . '">' . esc_attr($album->name) . ' ></a>';
		break;
	}
}
$custom_attributes = get_post_meta($post->ID, '_product_attributes', true);

$variation = get_theme_mod('teo_songs_variation', '');
if($variation == '') {
	$variation = 'light';
}

$type = get_theme_mod('teo_website_type', '');
if($type == '' || ($type != 2 && $type != 1) ) {
    $type = 2;
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

	<div style="background-image: url('<?php echo $image;?>');?>" itemscope class="song-top-container single-song" data-id="<?php echo $post->ID;?>" itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="darken-overlay"></div>
		<div class="row no-margin">
	        <div class="col-lg-8 col-md-7 col-sm-6 no-padding">
	        	<div class="song-main-container">
	        		<div class="song-title"><?php woocommerce_template_single_title();?></div>
	        		<?php if(taxonomy_exists('album') || taxonomy_exists('artist') ) { ?>
	        			<div class="from"><?php _e('from', 'teo');?></div>
	        		<?php } ?>
	        		<div class="info">
	        			<?php 
	        			//not showing the artist if the site is for an individual artist(as it's obvious who's the artist)
	        			if($type == 1) {
	        				$artists_links = array();
	        			}

	        			if(count($artists_links) > 0) {
	        				echo implode(', ', $artists_links);
	        				if($album_link != '') {
	        					echo ' - ' . $album_link;
	        				}
	        			}
	        			elseif($album_link != '') {
	        				echo $album_link;
	        			}
	        			?>
	        		</div>
	        		<hr />
	        		<div class="song-icons">
	        			<div class="icon song">
	                    	<a href="#" data-id="<?php echo $post->ID;?>" class="play-song-individual">
                      			<i class="music-player-play-outline"></i>
                   			</a>
                          	<a href="#" class="pause-song">
                        		<i class="music-player-pause"></i>
                       		</a>
	                    </div>
	                    <div class="icon">
	                    	<?php woocommerce_template_single_add_to_cart();?>
	                      	<div class="text"><?php woocommerce_template_single_price();?></div>
	                    </div>
	                    <div class="icon">
	                    	<?php get_template_part( 'templates/song', 'wishlist' );?>
	                    </div>
	                </div>
	        	</div>
	        </div>
	        <div class="col-lg-4 col-md-5 col-sm-6 no-padding">
	            <div class="song-second-container">
	                <ul class="song-info-list">
	                	<?php
	                	if($date != '') { ?>
		                    <li>
		                      	<h4><?php _e('Released', 'teo');?></h4>
		                      	<div class="info"><?php echo date("F dS, Y", strtotime($date ) );?></div>
		                      	<hr />
		                    </li>
		                <?php } ?>

	                    <?php 
	                    if ( $genres && ! is_wp_error( $genres ) ) {
	                    	$genres_links = array();
	                    	foreach($genres as $genre) {
	                    		$genres_links[] = '<a href="' . get_term_link($genre->term_id, 'genre') . '">' . esc_attr($genre->name) . '</a>';
	                    	}
	                    	?>
	                    	<li>
		                      	<h4><?php _e('Genres', 'teo');?></h4>
		                      	<div class="info"><?php echo implode(', ', $genres_links);?></div>
		                      	<hr />
		                    </li>
	                    <?php } ?>

	                    <?php 
	                    if($custom_attributes && count($custom_attributes) > 0) { 
	                    	$terms_number = count($custom_attributes);
	                    	$count = 1;
	                    	foreach($custom_attributes as $taxonomy) {
	                    		$name = $taxonomy['name'];
	                    		if($taxonomy['is_taxonomy'] == 1) {
		                    		$terms = get_the_terms($post->ID, $name);
		                    		$term_links = array();
									if ( $terms && ! is_wp_error( $terms ) ) {
										foreach($terms as $term) {
											$term_links[] = '<a class="term-link" href="' . get_term_link($term) . '">' . esc_attr($term->name) . '</a>';
										}
									}
									?>
									<li>
			                    		<h4><?php echo wc_attribute_label($name);?></h4>
			                    		<div class="info"><?php echo implode(', ', $term_links);?></div>
			                    		<?php if($count != $terms_number) echo '<hr />'; ?>
			                    	</li>
	                    		<?php 
	                    		}
	                    		$count++;
	                    	}
		                } ?>
	                </ul>
	            </div>
	        </div>
	    </div>
	<?php if($variation == 'light') echo '</div>';?>
		<div class="buy-container <?php if($variation == 'dark') echo 'dark';?>">
		    <ul class="buy-icons">
		        <?php if($spotify != '') { ?>
		        	<li>
		        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($spotify);?>">
		        			<i class="fa fa-spotify"></i>
		        		</a>
		        	</li>
		        <?php } ?>

		        <?php if($itunes != '') { ?>
		        	<li>
		        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($itunes);?>">
		        			<i class="fa fa-apple"></i>
		        		</a>
		        	</li>
		        <?php } ?>

		        <?php if($amazon != '') { ?>
		        	<li>
		        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($amazon);?>">
		        			<img src="<?php echo get_template_directory_uri();?>/content/amazon-icon<?php if($variation == 'dark') echo '-white';?>.png" alt="Amazon icon">
		        		</a>
		        	</li>
		        <?php } ?>

		        <?php if($beatport != '') { ?>
		        	<li>
		        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($beatport);?>">
		        			<img src="<?php echo get_template_directory_uri();?>/content/beatport-icon<?php if($variation == 'dark') echo '-white';?>.png" alt="BeatPort icon">
		        		</a>
		        	</li>
		        <?php } ?>

		    </ul>
		</div>

	<?php if($variation == 'dark') echo '</div>';?>

	<?php woocommerce_output_related_products();?>

	<?php comments_template(); ?> 

</div>
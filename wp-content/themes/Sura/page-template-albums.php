<?php
/* 
Template name: Albums landing page
*/
get_header();
the_post();

$type = get_theme_mod('teo_website_type', '');
if($type == '' || ($type != 2 && $type != 1) ) {
    $type = 2;
}
?>
<div id="ajax-content">
	<?php if(teo_is_woo() ) { ?>
		<div class="discover-container" id="discover">
			<div class="row no-margin">
		        <div class="col-sm-12">
		            <h6><?php _e('Start to', 'teo');?></h6>
		            <h3><?php _e('Discover', 'teo');?></h3>
		        </div>
		    </div>
		            
		    <div class="row no-margin">
		    	<?php 
		    	$args = array();
				$args['hide_empty'] = false;
				$args['number'] = 4;
				$albums = get_terms('album', $args);
				if ( ! empty( $albums ) && ! is_wp_error( $albums ) ) {
					foreach($albums as $album) { 
			        	$meta = get_option( 'teo_album_' . $album->term_id ); ?>
			            <div class="col-sm-6 col-md-3">
			                <div class="album big">
			                    <?php if(isset($meta['image']) && $meta['image'] != '') { ?>
			                        <figure>
			                            <img src="<?php echo esc_url($meta['image']);?>" alt="<?php echo esc_attr($album->name);?>">
			                            <div class="overlay">
			                                <div class="background"></div>
			                            </div>
			                        </figure>
			                    <?php } ?>
			                    <a href="<?php echo get_term_link($album);?>" class="title"><?php echo esc_attr($album->name);?></a>
			                   	<?php 
			                    $args = array();
			                    $args['post_type'] = 'product';
			               	    $args['tax_query'] = array(
			                        array(
			                   	        'taxonomy' => 'album',
			                            'field'    => 'term_id',
			                            'terms'    => $album->term_id,
			                        )
			                    );
			                    $artists_links = array();
			                    if($type == 2) {
				                    $query = new WP_Query($args);
				                    while($query->have_posts() ) : $query->the_post();
				                        $artists = get_the_terms( $post->ID, 'artist' );
				                        if ( $artists && ! is_wp_error( $artists ) ) {
				                            foreach($artists as $artist) {
				                                if(!isset($artists_links[$artist->term_id]) ) {
				                                    //the artist isn't already added to the array.
				                                    $artists_links[$artist->term_id] = '<a href="' . get_term_link($artist->term_id, 'artist') . '">' . $artist->name . '</a>';
				                                }
				                            }
				                        }
				                    endwhile; wp_reset_postdata();
				                }
				                ?>
			                    <div class="artist"><?php echo implode(', ', $artists_links);?></div>
			                </div>
			            </div>
			        <?php } 
			    } ?>
		    </div>
		</div>
	<?php } else { ?>
		<div class="col-sm-12 no-padding">
			<div class="song-list-container">
				<div class="alert alert-warning">
					<?php _e('Please install / enable WooCommerce and add some songs / genres / artists in order to use this page', 'teo');?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<?php get_footer();?>

<?php 
get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$genres_links = $albums_array = array();
//in order to get the genres, we take the songs by this artist and then get their genres and add them in the $genres_links array
$args = array();
$args['post_type'] = 'product';
$args['posts_per_page'] = 6;
$args['tax_query'] = array(
	array(
		'taxonomy' => 'artist',
		'field'    => 'term_id',
		'terms'    => $term->term_id,
	)
);
query_posts($args);
while(have_posts() ) : the_post();
	$genres = get_the_terms( $post->ID, 'genre' );
	$albums = get_the_terms( $post->ID, 'album' );
	if ( $genres && ! is_wp_error( $genres ) ) {
		foreach($genres as $genre) {
			if(!isset($genres_links[$genre->term_id]) ) {
				//the genre isn't already added.
				$genres_links[$genre->term_id] = '<a href="' . get_term_link($genre->term_id, 'genre') . '">' . $genre->name . '</a>';
			}
		}
	}

	if ( $albums && ! is_wp_error( $albums ) ) {
		foreach($albums as $album) {
			if(!isset($albums_array[$album->term_id]) ) {
				//the genre isn't already added.
				$albums_array[$album->term_id] = $album->term_id;
			}
		}
	}
endwhile; wp_reset_query();

$meta = get_option( 'teo_taxonomy_' . $term->term_id ); 

$shortname = isset($meta['shortname']) && $meta['shortname'] != '' ? $meta['shortname'] : $term->name;
$shortdescription = isset($meta['shortdescription']) && $meta['shortdescription'] != '' ? $meta['shortdescription'] : $term->description;

$teo_artist = $term->name;

$type = get_theme_mod('teo_website_type', '');
if($type == '' || ($type != 2 && $type != 1) ) {
    $type = 2;
}

?>

<div id="ajax-content">

    <div class="row no-margin">
        <div class="col-sm-12 no-padding">
            <div style="background-image: url('<?php if(isset($meta['bgimage']) ) echo esc_url($meta['bgimage']);?>'" class="artist-main-container full-width">
                <div class="darken-overlay"></div>
                <div class="content">
                    <h1><?php echo esc_attr($term->name);?></h1>
                    <h4><?php echo implode(', ', $genres_links);?></h4>
                    <div class="description"><?php echo esc_attr($shortdescription)?></div>
                    <a href="#more-about" class="more-with-navigation more">
                    	<?php echo sprintf(__('More about %s', 'teo'), esc_attr($shortname) );?>
                    	<i class="fa fa-angle-down small"></i>
                    	<i class="fa fa-angle-down big"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
              
    <div class="row no-margin">
        <div class="col-sm-6 no-padding">
            <div id="more-about" class="artist-songs-container">
                <h6><?php echo esc_attr($shortname);?>'s</h6>
                <ul role="tablist" class="nav nav-tabs">
                    <li class="active"><a class="no-ajaxy" href="#songs" role="tab" data-toggle="tab"><?php _e('Songs', 'teo');?></a></li>
                    <li><a class="no-ajaxy" href="#albums" role="tab" data-toggle="tab"><?php _e('Albums', 'teo');?></a></li>
                </ul>
                <div class="tab-content">
                    <div id="songs" class="tab-pane active fade in">
                        <div class="row">
                          	<?php
                            query_posts($args);
                          	while(have_posts() ) : the_post();
    							get_template_part('templates/artist-song');
    						endwhile; 
                            wp_reset_query();
    						?>
                        </div>
                    </div>
                    <div id="albums" class="tab-pane fade">
                        <div class="row">
                        	<?php
                        	$albums = get_terms('album', array('include' => $albums_array, 'number' => 6) );
    						foreach($albums as $teo_album) {
    							include(locate_template('templates/artist-album.php'));
    						}
    						?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="col-sm-6 no-padding">
            <div class="artist-about-container light">
                <h6><?php _e('About', 'teo');?></h6>
                <h3><?php echo esc_attr($shortname);?></h3>
                <div class="user">
                    <ul class="social-icons pull-left">
                        <?php if(isset($meta['facebook']) && $meta['facebook'] != '') { ?>
                        	<li>
                        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['facebook']);?>">
                        			<i style="color: #3b5998" class="fa fa-facebook"></i>
                        		</a>
                        	</li>
                        <?php } ?>

                        <?php if(isset($meta['twitter']) && $meta['twitter'] != '') { ?>
                        	<li>
                        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['twitter']);?>">
                        			<i style="color: #00aced" class="fa fa-twitter"></i>
                        		</a>
                        	</li>
                        <?php } ?>

                        <?php if(isset($meta['youtube']) && $meta['youtube'] != '') { ?>
                        	<li>
                        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['youtube']);?>">
                        			<i style="color: #bb0000" class="fa fa-youtube"></i>
                        		</a>
                        	</li>
                        <?php } ?>

                        <?php if(isset($meta['soundcloud']) && $meta['soundcloud'] != '') { ?>
                        	<li>
                        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['soundcloud']);?>">
                        			<i style="color: #ff3a00" class="fa fa-soundcloud"></i>
                        		</a>
                        	</li>
                        <?php } ?>

                        <?php if(isset($meta['beatport']) && $meta['beatport'] != '') { ?>
                        	<li>
    			        		<a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['soundcloud']);?>">
    			        			<img src="<?php echo get_template_directory_uri();?>/content/beatbot-icon.png" alt="">
    			        		</a>
    			        	</li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="description"><?php echo esc_attr($term->description);?></div>
                <?php if(isset($meta['website']) && $meta['website'] != '') { ?>
                    <a href="<?php echo esc_url($meta['website']);?>" class="write"><?php echo esc_url($meta['website']);?>/</a>
                <?php } ?>

            </div>
        </div>
    </div>
              
    <?php 
    if($type == 2) {
        $args = array();
        $args['hide_empty'] = false;
        $args['exclude'] = $term->term_id;
        $args['number'] = 4;
        $other_artists = get_terms('artist', $args);
        if ( ! empty( $other_artists ) && ! is_wp_error( $other_artists ) ) { ?>
            <div class="row no-margin">
                <div class="col-sm-12 no-padding">
                    <div class="related-artists-container">
                        <h6><?php _e('Other', 'teo');?></h6>
                        <h3><?php _e('Artists', 'teo');?></h3>
                        <div class="row">
                            <?php foreach($other_artists as $artist) { 
                                $meta = get_option( 'teo_taxonomy_' . $artist->term_id );
                                $image = $meta['image'];
                                if($image == '') {
                                    $image = $meta['bgimage'];
                                }
                                ?>
                                <div class="col-sm-3">
                                    <div class="artist big">
                                        <?php if($image != '') { ?>
                                            <a href="<?php echo get_term_link($artist);?>">
                                                <figure>
                                                    <img src="<?php echo esc_url($image);?>" alt="<?php echo esc_attr($artist->name);?>">
                                                </figure>
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo get_term_link($artist);?>" class="title"><?php echo esc_attr($artist->name);?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        } 
    } ?>

</div>

<?php get_footer(); ?>
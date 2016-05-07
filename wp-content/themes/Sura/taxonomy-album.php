<?php 
get_header();
global $teo_data, $teo_songs, $teo_songs_count;
$variation = 2;

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$meta = get_option( 'teo_album_' . $term->term_id ); 

$type = get_theme_mod('teo_website_type', '');
if($type == '' || ($type != 2 && $type != 1) ) {
    $type = 2;
}

$artists_links = $genres_links = array();
//in order to get the artists, we take the songs in this album and then get their artists and add them in the $artists_links array
$args = array();
$args['post_type'] = 'product';
$args['posts_per_page'] = -1;
$args['tax_query'] = array(
    array(
        'taxonomy' => 'album',
        'field'    => 'term_id',
        'terms'    => $term->term_id,
    )
);
$query = new WP_Query($args);
while($query->have_posts() ) : $query->the_post();
    $genres = get_the_terms( $post->ID, 'genre' );
    $artists = get_the_terms( $post->ID, 'artist' );
    if ( $genres && ! is_wp_error( $genres ) ) {
        foreach($genres as $genre) {
            if(!isset($genres_links[$genre->term_id]) ) {
                //the genre isn't already added to the array.
                $genres_links[$genre->term_id] = '<a href="' . get_term_link($genre->term_id, 'genre') . '">' . $genre->name . '</a>';
            }
        }
    }

    //if the website type is music web app, we get the artists
    if ( $type == 2 && $artists && ! is_wp_error( $artists ) ) {
        foreach($artists as $artist) {
            if(!isset($artists_links[$artist->term_id]) ) {
                //the artist isn't already added to the array.
                $artists_links[$artist->term_id] = '<a href="' . get_term_link($artist->term_id, 'artist') . '">' . $artist->name . '</a>';
            }
        }
    }
endwhile; wp_reset_postdata();
?>

<div id="ajax-content">
    <?php 
    if($variation == '1') {
        include( locate_template( 'header-album-smallimage.php' ) );
    }
    else {
        include( locate_template( 'header-album-bigimage.php' ) );
    }
    ?>
    <div class="row no-margin">
        <div class="col-sm-8">
            <div class="song-list-container">
                <div class="table-responsive">
                    <table class="table no-border-top no-border-bottom">
                        <tr>
                            <th class="hidden-xs"></th>
                            <th><?php _e('Name', 'teo');?></th>
                            <th class="hidden-xs"><?php _e('Length', 'teo');?></th>
                            <th><?php _e('Price', 'teo');?></th>
                        </tr>
                        <?php 
                        $i = 1;
                        while($query->have_posts() ) : $query->the_post(); 
                            global $product;
                            $file = get_post_meta($post->ID, '_song_preview', true);

                            if($file == '') {
                                $files = get_post_meta($post->ID, '_downloadable_files', true);
                                $mp3file = '';
                                foreach($files as $file) {
                                    $file = $file['file'];
                                    break;
                                }
                            }
                            $mp3file = new MP3File($file);
                            @$duration = $mp3file->getDuration();
                            ?>
                            <tr class="song">
                                <td class="normal hidden-xs"><?php echo $i;?></td>
                                <td class="normal"><?php the_title();?></td>
                                <td class="normal hidden-xs"><?php echo MP3File::formatTime($duration);?></td>
                                <td class="normal"><?php echo $product->get_price_html();?></td>
                                <td class="hover-row">
                                    <a href="#" data-id="<?php echo $post->ID;?>" class="play-song play-song-individual">
                                        <i class="music-player-play-outline play"></i>
                                        <div class="song-title"><?php the_title();?></div>
                                    </a>
                                    <a href="#" class="pause-song">
                                        <i class="music-player-pause play"></i>
                                        <div class="song-title"><?php the_title();?></div>
                                    </a>
                                    <div class="song-options">
                                        <?php woocommerce_template_single_add_to_cart();?>
                                        <?php get_template_part( 'templates/song', 'wishlist' );?>
                                        <a class="add" href="<?php the_permalink();?>">
                                            <i class="play music-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; endwhile; wp_reset_postdata();?>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="album-info-container">
                <ul class="album-info-list">
                    <?php if(isset($meta['date']) && $meta['date'] != '') { ?>
                        <li>
                            <h4><?php _e('Released', 'teo');?></h4>
                            <div class="info"><?php echo date("F dS, Y", strtotime($meta['date'] ) );?></div>
                            <hr>
                        </li>
                    <?php } ?>
                    
                    <?php if(count($genres_links) > 0) { ?>
                        <li>
                            <h4><?php _e('Genres', 'teo');?></h4>
                            <div class="info"><?php echo implode(', ', $genres_links);?></div>
                            <hr>
                        </li>
                    <?php } ?>

                    <?php if(isset($meta['extra_title1']) && $meta['extra_title1'] != '') { ?>
                        <li>
                            <h4><?php echo esc_attr($meta['extra_title1']);?></h4>
                            <div class="info"><?php echo esc_attr($meta['extra_description1']);?></div>
                            <?php if(isset($meta['extra_title2']) && $meta['extra_title2'] != '') echo '<hr>';?>
                        </li>
                    <?php } ?>

                    <?php if(isset($meta['extra_title2']) && $meta['extra_title2'] != '') { ?>
                        <li>
                            <h4><?php echo esc_attr($meta['extra_title2']);?></h4>
                            <div class="info"><?php echo esc_attr($meta['extra_description2']);?></div>
                            <?php if(isset($meta['extra_title3']) && $meta['extra_title3'] != '') echo '<hr>';?>
                        </li>
                    <?php } ?>

                    <?php if(isset($meta['extra_title3']) && $meta['extra_title3'] != '') { ?>
                        <li>
                            <h4><?php echo esc_attr($meta['extra_title3']);?></h4>
                            <div class="info"><?php echo esc_attr($meta['extra_description3']);?></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    $args = array();
    $args['hide_empty'] = false;
    $args['exclude'] = $term->term_id;
    $args['number'] = 4;
    $other_albums = get_terms('album', $args);
    if ( ! empty( $other_albums ) && ! is_wp_error( $other_albums ) ) { ?>
        <div id="related-albums-container" class="related-albums-container">
            <h6><?php _e('Other', 'teo');?></h6>
            <h3><?php _e('Albums', 'teo');?></h3>
            <div class="row">
                <?php foreach($other_albums as $album) { 
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
                            ?>
                            <div class="artist"><?php echo implode(', ', $artists_links);?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>

<?php get_footer();?>
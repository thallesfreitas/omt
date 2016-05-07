<?php
/* 
Template name: Songs landing page
*/
get_header();
the_post();
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
                $genres = get_terms('genre');
                $genres_ids = array();
                if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
                    foreach($genres as $genre) {
                        $genres_ids[] = $genre->term_id;
                    }
                }
            	$args = array();
            	$args['post_type'] = 'product';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'genre',
                        'terms'    => $genres_ids,
                    ),
                );
                $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
                $args['paged'] = $paged;
            	query_posts($args);
            	if(have_posts() ) : while(have_posts() ) : the_post();
                    wc_get_template_part( 'content', 'product' );
                endwhile; 
                get_template_part('lib/pagination');
                else :
                    echo '<div class="col-sm-12"><p>' . __('There are currently no songs available. Make sure the Sura plugin is installed and each post has a genre added!.', 'teo') . '</p></div>';
                endif; 
                wp_reset_query();
                ?>
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
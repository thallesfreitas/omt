<?php
/* 
Template name: Events page
*/
the_post();
get_header();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$date = get_post_meta($post->ID, '_events_date', true);
$nrevents = (int)get_post_meta($post->ID, '_events_nrevents', true);
?>
<div id="ajax-content">
    <div class="row no-margin">
        <div style="background-image: url('<?php echo esc_url($image);?>')" class="tour-top">
            <div class="title-tag"><img src="<?php echo get_template_directory_uri();?>/img/tour-text.png" alt=""></div>
            <h2><?php the_title();?></h2>
            <?php if($date != '') { ?>
             	<div class="dates"><?php echo esc_attr($date);?></div>
            <?php } ?>
            <div class="description"><?php the_excerpt();?></div>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <div class="tour-list">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                        	<th><?php _e('Date', 'teo');?></th>
                        	<th><?php _e('Venue', 'teo');?></th>
                        	<th><?php _e('Location', 'teo');?></th>
                        </tr>
                        <?php
                        $args = array();
                        $args['post_type'] = 'event';
                        $args['post_status'] = 'any';
                        $nrevents = $nrevents != 0 ? $nrevents : 6;
                        $args['posts_per_page'] = $nrevents;
                        $args['order'] = 'ASC';
                   	    $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
                        $args['paged'] = $paged;
                        query_posts($args);
                   	    while(have_posts() ) : the_post(); 
                   		   $venue = get_post_meta($post->ID, '_event_venue', true);
                   		   $location = get_post_meta($post->ID, '_event_location', true);
                   		   $url = get_post_meta($post->ID, '_event_url', true);
                   		   ?>
                            <tr>
                                <td class="date"><?php the_time('M d Y' );?></td>
                                <td class="venue"><?php echo esc_attr($venue);?></td>
                                <td class="location"><?php echo esc_attr($location);?></td>
                                <?php if($url != '') { ?>
                                    <td><a rel="nofollow" target="_blank" href="<?php echo esc_url($url);?>" class="ticket"><?php _e('Tickets', 'teo');?></a></td>
                                <?php } ?>
                            </tr>
                        <?php endwhile; 
                        get_template_part('lib/pagination');
                        wp_reset_query(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
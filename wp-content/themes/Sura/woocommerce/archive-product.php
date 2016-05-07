<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();
the_post();
global $wp_query;
$query_vars = $wp_query->query_vars;
$taxonomy = isset($query_vars['taxonomy']) ? $query_vars['taxonomy'] : '';
$term     = isset($query_vars['term'])     ? $query_vars['term']     : '';
?>
<div id="ajax-content">
    <div class="discover-container" id="discover">
        <div class="row no-margin">
            <div class="col-sm-9">
                <h3><?php woocommerce_page_title(); ?></h3>
            </div>
            <div class="col-sm-3">
                <?php woocommerce_catalog_ordering(); ?>
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
            if($taxonomy != '' && $term != '') {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $term,
                    ),
                );
            }
            else {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'genre',
                        'terms'    => $genres_ids,
                    ),
                );
            }
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            if(have_posts() ) : while(have_posts() ) : the_post();
                if(teo_is_song($post->ID) ) {
                    wc_get_template_part( 'content', 'product' );
                }
            endwhile; 
            get_template_part('lib/pagination'); 
            else :
                echo '<p>' . __('There are currently no songs available. Make sure the Sura plugin is installed and each post has a genre added!', 'teo') . '</p>';
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
</div>
<?php get_footer();?>
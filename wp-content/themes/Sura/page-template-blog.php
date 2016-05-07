<?php 
/* 
Template name: Blog page template
*/
get_header();
the_post();
?>

<div id="ajax-content">
    <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="blog-posts">
            <?php 
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            while(have_posts() ) : the_post(); 
                get_template_part('content', get_post_format() );
            endwhile; 
            get_template_part('lib/pagination'); 
            wp_reset_query();
            ?>
        </div>
    </div>
</div>
<?php get_footer();?>
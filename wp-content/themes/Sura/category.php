<?php get_header();?>

<div id="ajax-content">
    <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="blog-posts">
            <div class="blog-posts-category">
                <div class="count">
                    <?php
                    $cat_id = get_cat_id( single_cat_title("",false) );
                    $postsInCat = get_term_by('id', $cat_id,'category');
                    $postsInCat = $postsInCat->count;
                    echo sprintf(__('%s posts', 'teo'), $postsInCat);
                    ?>
                </div>
                <div class="category"><?php echo single_cat_title( '', false );?></div>
                <hr>
            </div>

            <?php 
            while(have_posts() ) : the_post(); 
                get_template_part('content', get_post_format() );
            endwhile; 
            get_template_part('lib/pagination'); 
            ?>
        </div>
    </div>
</div>
<?php get_footer();?>
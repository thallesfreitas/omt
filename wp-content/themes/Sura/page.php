<?php
the_post();
get_header();
if(teo_is_woo() && (is_cart() || is_checkout() ) ) {
    $class = 'col-sm-8 col-sm-offset-2';
}
else {
    $class = 'col-sm-6 col-sm-offset-3';
}
?>
<div id="ajax-content">
    <div class="<?php echo $class;?> col-xs-10 col-xs-offset-1">
        <div class="blog-posts">
            <article class="blog-post text-center">
                <?php 
                if(has_post_thumbnail() ) { 
                    $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    //$resized = teo_resize($thumb, 683, 421);
                    $resized = $thumb;
                    ?>
                    <figure>
                        <img src="<?php echo $resized;?>" alt="<?php the_title();?>">
                    </figure>
                <?php } ?>
                <div class="title"><?php the_title();?></div>
                <div class="content"><?php the_content('');?></div>
            </article>
        </div>
    </div>
</div>
<?php get_footer();?>
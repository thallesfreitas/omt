<article <?php post_class('blog-post text-center summary');?>>
    <?php 
    if(has_post_thumbnail() ) { 
        $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $resized = teo_resize($thumb, 683, 421);
        ?>
        <a href="<?php the_permalink();?>">
            <figure>
                <img src="<?php echo $resized;?>" alt="<?php the_title();?>">
            </figure>
        </a>
    <?php } ?>
    <a href="<?php the_permalink();?>" class="title"><?php the_title();?></a>
    <div class="info"><?php _e('by', 'teo'); echo ' '; the_author_posts_link(); echo ' ' . sprintf(__('on %s', 'teo'), '<a href="' . get_permalink() . '">' . get_the_time("d.m.Y") ) . '</a>';?></div>
    <div class="content"><?php the_excerpt();?></div>
    <hr />
</article>
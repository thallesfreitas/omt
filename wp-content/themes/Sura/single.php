<?php
the_post();
get_header();
?>
<div id="ajax-content">
    <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="blog-posts">
            <article class="blog-post text-center">
                <?php 
                if(has_post_thumbnail() ) { 
                    $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $resized = teo_resize($thumb, 683, 421);
                    ?>
                    <figure>
                        <img src="<?php echo $resized;?>" alt="<?php the_title();?>">
                    </figure>
                <?php } ?>
                <div class="title"><?php the_title();?></div>
                <div class="info"><?php _e('by', 'teo'); echo ' '; the_author_posts_link(); echo ' ' . sprintf(__('on %s', 'teo'), get_the_time("d.m.Y") );?></div>
                <div class="content"><?php the_content('');?></div>
                
                <?php wp_link_pages(array('before' => '<div class="teo-pagination"><div class="nav-links">', 'after' => '</div></div>', 'next_or_number' => 'number', 'pagelink' => '<span>%</span>')); ?>

                <?php 
                $tags = get_the_terms($post->ID, 'post_tag');
                if($tags) { ?>
                    <div class="tags">
    	               	<label><?php _e('Tags', 'teo');?></label>
    	                <ul>
    	                  	<?php 
    	                  	$nrtags = 1;
    	                  	foreach($tags as $tag) { 
    	                  		if($nrtags != count($tags) ) { ?>
    	                  			<li><a href="<?php echo get_term_link( $tag );?>" title="<?php echo sprintf(__('View all post filed under %s', 'teo'), $tag->name);?>"><?php echo $tag->name;?>, </a></li>
    	                  		<?php } else { ?>
    	                  			<li><a href="<?php echo get_term_link( $tag );?>" title="<?php echo sprintf(__('View all post filed under %s', 'teo'), $tag->name);?>"><?php echo $tag->name;?></a></li>
    	                  	<?php }
    	                  		$nrtags++;
    	                  	} 
    	                  	?>
    	                </ul>
    	            </div>
    	        <?php } ?>

                <div class="post-navigation">
                    <?php if(function_exists('the_post_navigation') ) the_post_navigation(array('prev_text' => '&laquo; %title', 'next_text' => '%title &raquo;')); ?>
                </div>

                <div class="author">
                	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID') );?>">
                    	<figure>
                    		<?php echo get_avatar(get_the_author_meta('ID'), 70);?>
                    	</figure>
                    </a>
                   	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID') );?>" class="name">
                   		<?php echo get_the_author_meta('display_name');?>
                   	</a>
                    <div class="description"><?php echo get_the_author_meta('description');?></div>
                </div>
            </article>
        </div>
    </div>
</div>
<?php comments_template('', true);?>

<?php get_footer();?>
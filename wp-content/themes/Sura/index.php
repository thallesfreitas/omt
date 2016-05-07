<?php get_header();?>

<div id="ajax-content">
	<div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
	    <div class="blog-posts">
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
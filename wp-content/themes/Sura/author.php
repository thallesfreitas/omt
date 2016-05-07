<?php 
get_header();
$auth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<div id="ajax-content">
  <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
      <div class="blog-posts">
          <div class="blog-posts-author">
                <figure><?php echo get_avatar($auth->ID, 100);?></figure>
                <div class="type"><?php _e('author', 'teo');?></div>
                <div class="name"><?php echo esc_attr($auth->display_name);?></div>
                <div class="description"><?php echo esc_attr($auth->description);?></div>
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
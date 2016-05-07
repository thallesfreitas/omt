<?php
/* 
Template name: Landing page
*/
get_header('landing');
the_post();
$bgimage = get_post_meta($post->ID, '_landing_bgimage', true);
$back = get_post_meta($post->ID, '_landing_backtext', true);
$front = get_post_meta($post->ID, '_landing_fronttext', true);
$buttontext = get_post_meta($post->ID, '_landing_buttontext', true);
$buttonurl = get_post_meta($post->ID, '_landing_buttonurl', true);

$info1 = get_post_meta($post->ID, '_landing_info1', true);
$info2 = get_post_meta($post->ID, '_landing_info2', true);
$info3 = get_post_meta($post->ID, '_landing_info3', true);

$itunes     = get_theme_mod('teo_social_itunes', '');
$spotify    = get_theme_mod('teo_social_spotify', '');
$soundcloud = get_theme_mod('teo_social_soundcloud', '');
$facebook   = get_theme_mod('teo_social_fb', '');
$twitter    = get_theme_mod('teo_social_twitter', '');
$instagram  = get_theme_mod('teo_social_instagram', '');
$vine       = get_theme_mod('teo_social_vine', '');
$rss        = get_theme_mod('teo_social_rss', '');
$linkedin   = get_theme_mod('teo_social_linkedin', '');

if($bgimage == '') {
	$bgimage = get_template_directory_uri() . '/content/landing.jpg';
}
?>
<body style="background-image: url('<?php echo esc_url($bgimage);?>')" <?php body_class('full-background');?>>
	<div class="landing-container">
      	<?php if($back != '' || $front != '') { ?>
	      	<div class="line">
	        	<div class="custom-title">
	          		<div class="back"><?php echo esc_attr($back);?></div>
	          		<div class="front"><?php echo esc_attr($front);?></div>
	        	</div>
	      	</div>
	    <?php } ?>
      	<div class="line"><img src="<?php echo get_template_directory_uri();?>/img/landing.png" alt=""></div>
      	<?php if($info1 != '' || $info2 != '' || $info3 != '') { ?>
	      	<div class="line">
	        	<?php if($info1 != '') { ?>
	        		<div class="info"><?php echo esc_attr($info1);?></div>
	        	<?php } ?>
	        	
	        	<?php if($info2 != '') { ?>
	        		<div class="info"><?php echo esc_attr($info2);?></div>
	        	<?php } ?>

	        	<?php if($info3 != '') { ?>
	        		<div class="info"><?php echo esc_attr($info3);?></div>
	        	<?php } ?>
	      	</div>
	    <?php } ?>
      	
      	<?php if($buttontext != '') { ?>
      		<div class="line">
	        	<?php if($buttonurl != '') { ?>
	        		<a href="<?php echo esc_url($buttonurl);?>" class="btn btn-primary no-ajaxy"><?php echo esc_attr($buttontext);?></a>
	        	<?php } else { ?>
	        		<button class="btn btn-primary"><?php echo esc_attr($buttontext);?></button>
	        	<?php } ?>
	      	</div>
	    <?php } ?>

      	<div class="line">
        	<ul class="landing-social-icons">
	          	<?php if($spotify != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($spotify);?>"><i class="fa fa-spotify"></i></a></li>
	            <?php } ?>

	            <?php if($soundcloud != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($soundcloud);?>"><i class="fa fa-soundcloud"></i></a></li>
	            <?php } ?>

	            <?php if($itunes != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($itunes);?>"><i class="fa fa-apple"></i></a></li>
	            <?php } ?>

	           <?php if($twitter != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
	            <?php } ?>

	            <?php if($facebook != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
	            <?php } ?>
	            
	            <?php if($instagram != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a></li>
	            <?php } ?>

	            <?php if($vine != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($vine);?>"><i class="fa fa-vine"></i></a></li>
	            <?php } ?>

	            <?php if($rss != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($rss);?>"><i class="fa fa-rss"></i></a></li>
	            <?php } ?>

	            <?php if($linkedin != '') { ?>
	                <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($linkedin);?>"><i class="fa fa-linkedin"></i></a></li>
	            <?php } ?>
        	</ul>
      	</div>
    </div>
<?php wp_footer();?>
</body>

</html>
<?php
/* 
Template name: About artist page
*/
get_header();
the_post();

$avatar         = get_post_meta($post->ID, '_about_avatar', true);
$description    = get_post_meta($post->ID, '_about_description', true);
$email          = get_post_meta($post->ID, '_about_email', true);

$itunes         = get_post_meta($post->ID, '_about_itunes', true);
$spotify        = get_post_meta($post->ID, '_about_spotify', true);
$soundcloud     = get_post_meta($post->ID, '_about_soundcloud', true);
$facebook       = get_post_meta($post->ID, '_about_facebook', true);
$twitter        = get_post_meta($post->ID, '_about_twitter', true);
$instagram      = get_post_meta($post->ID, '_about_instagram', true);
$vine           = get_post_meta($post->ID, '_about_vine', true);
$linkedin       = get_post_meta($post->ID, '_about_linkedin', true);

?>
<div id="ajax-content">
    <div class="row no-margin">
        <div class="col-sm-12">
            <div class="about-me-container">
                <?php if($avatar != '') { ?>
                    <figure>
                        <img src="<?php echo teo_resize($avatar, 120, 120);?>" alt="">
                    </figure>
                <?php } ?>
                <ul class="social-icons">
                    <?php if($instagram != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($instagram);?>"><i style="color: #46589c" class="fa fa-instagram"></i></a></li>
                    <?php } ?>

                    <?php if($spotify != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($spotify);?>"><i style="color: #81b71a" class="fa fa-spotify"></i></a></li>
                    <?php } ?>

                    <?php if($soundcloud != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($soundcloud);?>"><i style="color: #f50f50" class="fa fa-soundcloud"></i></a></li>
                    <?php } ?>

                    <?php if($facebook != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($facebook);?>"><i style="color: #3b5998" class="fa fa-facebook"></i></a></li>
                    <?php } ?>

                    <?php if($twitter != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($twitter);?>"><i style="color: #47acf2" class="fa fa-twitter"></i></a></li>
                    <?php } ?>

                    <?php if($vine != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($vine);?>"><i style="color: #00bf8f" class="fa fa-vine"></i></a></li>
                    <?php } ?>

                    <?php if($linkedin != '') { ?>
                        <li><a target="_blank" rel="nofollow" href="<?php echo esc_url($linkedin);?>"><i style="color: #007bb6" class="fa fa-linkedin"></i></a></li>
                    <?php } ?>
                </ul>

                <?php if($description != '') { ?>
                    <div class="description"><?php echo esc_attr($description);?></div>
                <?php } ?>
                
                <?php if($email != '' && is_email($email) ) { ?>
                    <a href="mailto:<?php echo $email;?>" class="write"><?php _e('Write to me', 'teo');?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
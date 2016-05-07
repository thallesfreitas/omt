<?php
$itunes     = get_theme_mod('teo_social_itunes', '');
$spotify    = get_theme_mod('teo_social_spotify', '');
$soundcloud = get_theme_mod('teo_social_soundcloud', '');
$facebook   = get_theme_mod('teo_social_fb', '');
$twitter    = get_theme_mod('teo_social_twitter', '');
$instagram  = get_theme_mod('teo_social_instagram', '');
$vine       = get_theme_mod('teo_social_vine', '');
$rss        = get_theme_mod('teo_social_rss', '');
$linkedin   = get_theme_mod('teo_social_linkedin', '');
$bgimage    = get_theme_mod('teo_variation2_bgimage', '');
if($bgimage == '') {
    $bgimage = get_template_directory_uri() . '/content/footer-image.jpg';
}
$text       = get_theme_mod('teo_variation2_text', '');
?>

<footer style="background-image: url('<?php echo esc_url($bgimage);?>')" class="image-footer">
    <div class="darken-overlay"></div>
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
    <?php if($text != '') { ?>
        <div class="line">
            <div class="text"><?php echo esc_attr($text);?></div>
        </div>
    <?php } ?>
    <div class="line">
        <div class="copyright">
            <?php echo sprintf(__('Copyright &copy; %s.', 'teo'), get_bloginfo('name')); echo ' '; _e('Developed by', 'teo'); echo ' ';?>
            <a target="_blank" href="http://teothemes.com">TeoThemes</a>
        </div>
    </div>
</footer>
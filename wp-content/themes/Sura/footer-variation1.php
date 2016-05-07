<?php
$logo = get_theme_mod('teo_logo', '');
?>
<footer class="main-footer">
    <div class="row no-margin">
        <div class="col-sm-4 footer-widget footer-border-right">
            <?php dynamic_sidebar('Footer 1/3 Column'); ?>
        </div>
        <div class="col-sm-4 footer-widget footer-border-right">
            <?php dynamic_sidebar('Footer 2/3 Column'); ?>
        </div>
        <div class="col-sm-4 footer-widget ">
            <?php dynamic_sidebar('Footer 3/3 Column'); ?>
        </div>
    </div>
    <div class="copyright"><?php _e('Developed by', 'teo'); echo ' ';?> <a target="_blank" href="http://teothemes.com" title="WordPress Themes">TeoThemes</a></div>
</footer>
<?php
$logo = get_theme_mod('teo_logo', '');
?>
<header>
    <div class="simple-header">
        <a href="<?php echo home_url();?>" class="logo">
            <?php if($logo != '') { ?>
                <img src="<?php echo esc_url($logo);?>" alt="<?php bloginfo('name');?>" />
            <?php } else { ?>
                <i class="music-logo"></i>
            <?php } ?>
        </a>
        <div class="menu">
            <div class="navbar-header">
                <button type="header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" class="navbar-toggle"><span class="sr-only">Toggle navigation</span>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
                <div id="bs-example-navbar-collapse-2" class="collapse navbar-collapse main-nav">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'container' => '',
                        'menu_class' => 'nav navbar-nav navbar-left',
                        'echo' => true,
                        'depth' => 0 ) 
                    );
                    ?>
                </div>
            </div>
        </div>
        <?php get_template_part('header', 'right-icons');?>
    </div>
</header>

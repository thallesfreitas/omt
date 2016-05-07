<?php
$logo = get_theme_mod('teo_logo', '');
$bgimage = get_theme_mod('teo_header_bgimage', '');
if($bgimage == '') { 
    $bgimage = get_template_directory_uri() . '/content/menu-background.jpg';
}
?>
<header class="top_header">
    <div style="background-image: url('<?php echo esc_url($bgimage);?>')" class="image-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
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
                        
                    <?php 
                    if(!is_home() && !is_front_page() ) { 
                        get_template_part('lib/breadcrumbs');
                    } ?>
                </div>
            </div>
        </div>
    </div>
</header>

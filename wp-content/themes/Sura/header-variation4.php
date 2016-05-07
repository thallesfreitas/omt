<?php
$logo = get_theme_mod('teo_logo', '');
$bgimage = get_theme_mod('teo_header_bgimage', '');
$toptext = get_theme_mod('teo_variation4_text', '');
$topurl = get_theme_mod('teo_variation4_url', '');
$topdate = get_theme_mod('teo_variation4_date', '');
if($bgimage == '') { 
    $bgimage = get_template_directory_uri() . '/content/menu-background.jpg';
}
?>
<header class="top_header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php if($toptext != '') { ?>
                        <div class="news hidden-xs">
                            <?php if($topurl != '') { ?>
                                <a href="<?php echo esc_url($topurl);?>">
                                    <img src="<?php echo get_template_directory_uri();?>/img/news-icon.png" alt="">
                                    <div class="text"><?php echo esc_attr($toptext);?></div>
                                </a>
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri();?>/img/news-icon.png" alt="">
                                <div class="text"><?php echo esc_attr($toptext);?></div>
                            <?php } ?>
                            
                            <?php if($topdate != '') { ?>
                                <div class="date"><?php echo esc_attr($topdate);?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="account-login">
                        <?php if(!is_user_logged_in() ) { ?>
                            <a href="#" data-toggle="modal" data-target="#register-modal" class="create-account no-ajaxy"><?php _e('Create an Account', 'teo');?></a>
                            <a href="#" data-toggle="modal" data-target="#login-modal" class="login no-ajaxy"><?php _e('Login', 'teo');?></a>
                        <?php } else { 
                            global $current_user; get_currentuserinfo(); ?>
                            <div href="#" class="user-account">
                                <div class="text"><?php the_author_meta('display_name', $current_user->ID);?></div>
                                <?php if(teo_is_woo() ) { 
                                    global $woocommerce;
                                    $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
                                    $myaccount_page_url = get_permalink( $myaccount_page_id ); ?>
                                    <div class="account-links">
                                        <?php if($myaccount_page_url) { ?>
                                            <a href="<?php echo $myaccount_page_url;?>"><?php _e('Account', 'teo');?><i class="fa fa-angle-right"></i></a>
                                        <?php } ?>
                                        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php _e('Cart', 'teo');?> <i class="fa fa-angle-right"></i></a>
                                        <a class="no-ajaxy" href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e('Log out', 'teo');?> <i class="fa fa-angle-right"></i></a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
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
        
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content login">
                <button data-dismiss="modal" class="close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h3><?php _e('Login', 'teo');?></h3>
                        </div>
                        <div class="col-xs-12 text-center">
                            <button class="register"><?php _e("I don't have an account", 'teo');?></button>
                        </div>
                        <div class="col-xs-12">
                            <form role="form" method="post" action="<?php echo home_url();?>">
                                <div class="row no-margin">
                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_login_username"><?php _e('Username*:', 'teo');?></label>
                                                <input type="text" name="teo_username" id="teo_login_username" required="true" placeholder="<?php _e('Enter your username here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_login_password"><?php _e('Password*:', 'teo');?></label>
                                                <input type="password" name="teo_password" id="teo_login_password" required="true" placeholder="<?php _e('Enter your password here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 no-padding text-center">
                                        <button class="forgot"><?php _e('Forgot password?', 'teo');?></button>
                                    </div>
                                    
                                    <div class="col-xs-12 no-padding">
                                        <button type="submit" name="header_login" class="btn btn-default"><?php _e('Login', 'teo');?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content login">
                <button data-dismiss="modal" class="close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h3><?php _e('Register', 'teo');?></h3>
                        </div>
                            
                        <div class="col-xs-12 text-center">
                            <button class="log-in"><?php _e('wait, i have an account!', 'teo');?></button>
                        </div>
                        
                        <div class="col-xs-12">
                            <form role="form" method="post" action="<?php echo home_url();?>">
                                <div class="row no-margin">
                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_register_username"><?php _e('Username*:', 'teo');?></label>
                                                <input type="text" name="teo_username" id="teo_register_username" required="true" placeholder="<?php _e('Enter your username here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_register_email"><?php _e('Email*:', 'teo');?></label>
                                                <input type="email" name="teo_email" id="teo_register_email" required="true" placeholder="<?php _e('Enter your e-mail here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_register_pwd"><?php _e('Password*:', 'teo');?></label>
                                                <input type="password" name="teo_password" id="teo_register_pwd" required="true" placeholder="<?php _e('Enter your password here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 no-padding">
                                        <button type="submit" name="header_register" class="btn btn-default"><?php _e('Register', 'teo');?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="forgot-modal-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content login">
                <button data-dismiss="modal" class="close"><i class="fa fa-times"></i></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h3><?php _e('Forgot your password?', 'teo');?></h3>
                        </div>
                        
                        <div class="col-xs-12 text-center">
                            <button class="forgot-text"><?php _e("WE'LL MAIL YOU A LINK TO RESET IT, SWEET!", 'teo');?></button>
                        </div>
                  
                        <div class="col-xs-12">
                            <form role="form" method="post" action="<?php echo home_url();?>">
                                <div class="row no-margin">
                                    <div class="col-xs-6 col-xs-offset-3 no-padding">
                                        <div class="input-container">
                                            <div class="form-group">
                                                <label for="teo_forgot_email"><?php _e('Email*:', 'teo');?></label>
                                                <input type="email" name="teo_email" id="teo_forgot_email" required="true" placeholder="<?php _e('Enter your e-mail here...', 'teo');?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 no-padding">
                                        <button type="submit" name="=" class="btn btn-default"><?php _e('Reset', 'teo');?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

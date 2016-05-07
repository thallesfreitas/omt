<?php
$albums_page = get_option('teo_albums_page');
$songs_page = get_option('teo_songs_page');
$discover_page = get_option('teo_discover_page');
$logo = get_theme_mod('teo_logo', '');
?>
<header class="top_header">
    <div class="search-header">
        <a href="<?php echo home_url();?>" class="logo">
            <?php if($logo != '') { ?>
                <img src="<?php echo esc_url($logo);?>" alt="<?php bloginfo('name');?>" />
            <?php } else { ?>
                <i class="music-logo"></i>
            <?php } ?>
        </a>
        <div class="input-group search-group">
            <form action="<?php echo home_url( '/' ); ?>" method="get">
                <input type="text" name="s" placeholder="<?php _e('Start your search here...', 'teo');?>" class="form-control">
                <input type="submit" value="submit" class="hidden">
                <span class="input-group-btn">
                    <button type="button" class="btn">
                        <i class="music-search"></i>
                    </button>
                </span>
            </form>
        </div>
        
        <?php get_template_part('header', 'woocommerce-icons');?>
    
    </div>
    
    <div class="simple-sidebar">
        <ul>
            <?php if(teo_is_woo() ) { ?>
            
                <?php if(get_permalink($discover_page) ) { ?>
                    <li>
                        <a href="<?php echo get_permalink($discover_page);?>">
                            <img src="<?php echo get_template_directory_uri();?>/img/discover-icon.png" alt="">
                            <div class="hover-effect">
                                <div class="text"><?php _e('Discover', 'teo');?></div>
                                <div class="dot">
                                    <i class="fa fa-circle"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>

                <?php if(get_permalink($albums_page) ) { ?>
                    <li>
                        <a href="<?php echo get_permalink($albums_page);?>">
                            <img src="<?php echo get_template_directory_uri();?>/img/albums-icon.png" alt="">
                            <div class="hover-effect">
                                <div class="text"><?php _e('Albums', 'teo');?></div>
                                <div class="dot">
                                    <i class="fa fa-circle"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                
                <?php if(get_permalink($songs_page) ) { ?>
                    <li>
                        <a href="<?php echo get_permalink($songs_page);?>">
                            <img src="<?php echo get_template_directory_uri();?>/img/songs-icon.png" alt="">
                            <div class="hover-effect">
                                <div class="text"><?php _e('Songs', 'teo');?></div>
                                <div class="dot"><i class="fa fa-circle"></i></div>
                            </div>
                        </a>
                    </li>
                <?php } ?>

            <?php } ?>

            <?php
            //custom menu items
            $locations = get_nav_menu_locations();
            if(isset($locations) && isset($locations['left-menu']) ) {
                $menu = wp_get_nav_menu_object( $locations[ 'left-menu' ] );
                if(isset( $locations[ 'left-menu' ] ) && $menu ) {
                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                    foreach ( (array) $menu_items as $key => $menu_item ) { 
                        $icon = get_post_meta($menu_item->db_id, '_teo_menu_item_icon', true); 
                        ?>
                        <li>
                            <a href="<?php echo $menu_item->url;?>">
                                <?php if($icon != '') { ?>
                                    <img src="<?php echo esc_attr($icon);?>" alt="<?php echo esc_attr($menu_item->title);?>" />
                                <?php } ?>
                                <div class="hover-effect">
                                    <div class="text"><?php echo esc_attr($menu_item->title);?></div>
                                    <div class="dot"><i class="fa fa-circle"></i></div>
                                </div>
                            </a>
                        </li>
                    <?php 
                    }
                }
            }
            ?>
        </ul>
    </div>
</header>
<?php
// FilterCoupons Widget
class MerchandiseFilter extends WP_Widget
{
    function MerchandiseFilter(){
    $widget_ops = array('description' => 'Simple pricing merchandise widget.');
    $control_ops = array('width' => 200, 'height' => 300);
    parent::__construct(false,$name='[Merchandise] Price Filter',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){ 
    extract($args);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

    echo $before_widget; 

    if ( $title != '' )
        echo $before_title . $title . $after_title;

    global $wpdb, $wp;

    if ( get_option( 'permalink_structure' ) == '' )
        $form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
    else
        $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );

    $min = $max = 0;
    $post_min = $post_max = '';

    if ( sizeof( WC()->query->layered_nav_product_ids ) === 0 ) {
        $min = floor( $wpdb->get_var(
            $wpdb->prepare('
                SELECT min(meta_value + 0)
                FROM %1$s
                LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
                WHERE ( meta_key = \'%3$s\' OR meta_key = \'%4$s\' )
                AND meta_value != ""
            ', $wpdb->posts, $wpdb->postmeta, '_price', '_min_variation_price' )
        ) );
        $max = ceil( $wpdb->get_var(
            $wpdb->prepare('
                SELECT max(meta_value + 0)
                FROM %1$s
                LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
                WHERE meta_key = \'%3$s\'
            ', $wpdb->posts, $wpdb->postmeta, '_price' )
        ) );
    } else {
        $min = floor( $wpdb->get_var(
            $wpdb->prepare('
                SELECT min(meta_value + 0)
                FROM %1$s
                LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
                WHERE ( meta_key =\'%3$s\' OR meta_key =\'%4$s\' )
                AND meta_value != ""
                AND (
                    %1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
                    OR (
                        %1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
                        AND %1$s.post_parent != 0
                    )
                )
            ', $wpdb->posts, $wpdb->postmeta, '_price', '_min_variation_price'
        ) ) );
        $max = ceil( $wpdb->get_var(
            $wpdb->prepare('
                SELECT max(meta_value + 0)
                FROM %1$s
                LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
                WHERE meta_key =\'%3$s\'
                AND (
                    %1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
                    OR (
                        %1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
                        AND %1$s.post_parent != 0
                    )
                )
            ', $wpdb->posts, $wpdb->postmeta, '_price'
        ) ) );
    }

    if ( $min == $max )
        return;

    $id = rand(1, 50000);

    $slidervalue = 15 / 100 * $max;
    $currency = get_woocommerce_currency_symbol();
    $min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : $min + $slidervalue;
    $max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : $max - $slidervalue;
    ?>

    <form action="<?php echo $form_action;?>" method="get" class="filters-form">
        <div class="form-group">
            <label for="price"><?php _e('Price', 'teo');?></label>
            <div class="form-box">
                <div class="min"><?php echo wc_price($min_price);?></div>
                <div class="max"><?php echo wc_price($max_price);?></div>
                <input id="price-<?php echo $id;?>" name="price" type="text" value="" data-slider-min="<?php echo $min;?>" data-slider-max="<?php echo $max;?>" data-slider-step="5" data-slider-value="[<?php echo $min_price . ',' . $max_price;?>]" class="span2 price">
                <input type="hidden" name="currency" value="<?php echo $currency;?>" />
                <input type="hidden" name="min_price" value="<?php echo $min;?>" />
                <input type="hidden" name="max_price" value="<?php echo $max;?>" />                
            </div>
            <div style="clear: both"></div><br />
            <input class="btn btn-default" value="<?php _e('Filter', 'teo');?>" type="submit" />
        </div>
    </form>
        <?php 

    echo $after_widget;
  }

  /*Saves the settings. */
    function update($new_instance, $old_instance){
    $instance =  array();
    $instance['title'] = esc_attr($new_instance['title']);

    return $instance;
  }

  /*Creates the form for the widget in the back-end. */
    function form($instance){
    //Defaults
    $instance = wp_parse_args( (array) $instance, array('title' => '' ) );

    $title = esc_attr($instance['title']);
    
    echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title: ' . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" value="'. esc_textarea($title)  . '" /></p>';
  }

}// end RecentPosts class

// Text Box Widget
class TeoFooterWidget extends WP_Widget
{
    function TeoFooterWidget(){
    $widget_ops = array('description' => 'Text + Social Icons');
    $control_ops = array('width' => 200, 'height' => 300);
    parent::__construct(false,$name='[Music] Footer text + Social',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
    extract($args);

    $text = $instance['text'];

    echo $before_widget; 

    $itunes     = get_theme_mod('teo_social_itunes', '');
    $spotify    = get_theme_mod('teo_social_spotify', '');
    $soundcloud = get_theme_mod('teo_social_soundcloud', '');
    $facebook   = get_theme_mod('teo_social_fb', '');
    $twitter    = get_theme_mod('teo_social_twitter', '');
    $instagram  = get_theme_mod('teo_social_instagram', '');
    $vine       = get_theme_mod('teo_social_vine', '');
    $rss        = get_theme_mod('teo_social_rss', '');
    $linkedin   = get_theme_mod('teo_social_linkedin', '');

    echo '<div class="footer-text">';
    echo '<div class="text">' . $text . '</div>';
    echo '<ul class="social-links">';

    if($spotify != '') { ?>
        <li><a href="<?php echo esc_url($spotify);?>"><i class="fa fa-spotify"></i></a></li>
    <?php } ?>

    <?php if($soundcloud != '') { ?>
        <li><a href="<?php echo esc_url($soundcloud);?>"><i class="fa fa-soundcloud"></i></a></li>
    <?php } ?>

    <?php if($itunes != '') { ?>
        <li><a href="<?php echo esc_url($itunes);?>"><i class="fa fa-apple"></i></a></li>
    <?php } ?>

    <?php if($twitter != '') { ?>
        <li><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
    <?php } ?>

    <?php if($facebook != '') { ?>
        <li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
    <?php } ?>
            
    <?php if($instagram != '') { ?>
        <li><a href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a></li>
    <?php } ?>

    <?php if($vine != '') { ?>
        <li><a href="<?php echo esc_url($vine);?>"><i class="fa fa-vine"></i></a></li>
    <?php } ?>

    <?php if($rss != '') { ?>
        <li><a href="<?php echo esc_url($rss);?>"><i class="fa fa-rss"></i></a></li>
    <?php } ?>

    <?php if($linkedin != '') { ?>
        <li><a href="<?php echo esc_url($linkedin);?>"><i class="fa fa-linkedin"></i></a></li>
    <?php } 

    echo '</ul>';

    echo '</div>';

    echo $after_widget;
  }

  /*Saves the settings. */
    function update($new_instance, $old_instance){
    $instance =  array();
    $instance['text'] = $new_instance['text'];

    return $instance;
  }

  /*Creates the form for the widget in the back-end. */
    function form($instance){
    //Defaults
    $instance = wp_parse_args( (array) $instance, array('text' => '') );

    $text = $instance['text'];
    
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('text');?>">Text:</label><br />
        <textarea class="widefat" id="<?php echo $this->get_field_id('text');?>" name="<?php echo $this->get_field_name('text');?>"><?php echo esc_textarea($text);?></textarea>
    </p>
  <?php }

}// end TeoTextBoxWidget class

function TeoWidgets() {
  register_widget('MerchandiseFilter');
  register_widget('TeoFooterWidget');
}

add_action('widgets_init', 'TeoWidgets');
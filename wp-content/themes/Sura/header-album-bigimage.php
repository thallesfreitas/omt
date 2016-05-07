<div class="row no-margin">
    <div class="col-sm-12 no-padding">
        <div style="background-image: url('<?php echo esc_url($meta['bgimage']);?>')" class="album-main-container full-width">
            <div class="darken-overlay"></div>
            <div class="album-header-text">
                <div class="featured">
                    <i class="music-featured"></i>
                    <img src="<?php echo get_template_directory_uri();?>/img/title-underline.png" alt="" class="text-underline">
                </div>
                <div class="album-info">
                    <div class="album-title"><?php echo esc_attr($term->name);?></div>
                    <div class="artist"><?php echo implode(', ', $artists_links);?></div>
                    <hr>
                </div>
                <a href="#related-albums-container" class="more-with-navigation btn btn-default"><?php _e('More albums', 'teo');?></a>
            </div>
        </div>
    </div>
</div>
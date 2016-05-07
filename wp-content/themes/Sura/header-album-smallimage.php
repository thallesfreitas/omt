<div class="row no-margin album-small">
    <div class="col-sm-6 no-padding">
        <div class="album-main-container">
            <figure>
                <?php if(isset($meta['image']) && $meta['image'] != '') { ?>
                    <img src="<?php echo esc_url($meta['image']);?>" alt="<?php echo esc_attr($term->name);?>">
                <?php } ?>
                <div class="featured">
                    <div class="text">
                        <i class="music-featured"></i>
                    </div>
                    <img src="<?php echo get_template_directory_uri();?>/img/title-underline.png" alt="" class="text-underline">
                </div>
            </figure>
            <div class="album-info">
              <div class="album-title"><?php echo esc_attr($term->name);?></div>
              <div class="artist"><?php echo implode(', ', $artists_links);?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 no-padding">
        <div class="album-second-container">
            <ul class="buy-icons">
                <?php if(isset($meta['spotify']) && $meta['spotify'] != '') { ?>
                    <li><a href="<?php echo esc_url($meta['spotify']);?>"><i class="fa fa-spotify"></i></a></li>
                <?php } ?>

                <?php if(isset($meta['itunes']) && $meta['itunes'] != '') { ?>
                    <li><a href="<?php echo esc_url($meta['itunes']);?>"><i class="fa fa-apple"></i></a></li>
                <?php } ?>

                <?php if(isset($meta['youtube']) && $meta['youtube'] != '') { ?>
                    <li><a href="<?php echo esc_url($meta['youtube']);?>"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>

                <?php if(isset($meta['soundcloud']) && $meta['soundcloud'] != '') { ?>
                    <li><a href="<?php echo esc_url($meta['soundcloud']);?>"><i class="fa fa-soundcloud"></i></a></li>
                <?php } ?>

                <?php if(isset($meta['beatport']) && $meta['beatport'] != '') { ?>
                    <li><a href="<?php echo esc_url($meta['beatport']);?>"><img src="<?php echo get_template_directory_uri();?>/content/beatport-icon.png" alt="BeatPort icon"></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

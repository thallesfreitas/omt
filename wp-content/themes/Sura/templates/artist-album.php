<?php
$meta = get_option( 'teo_album_' . $teo_album->term_id ); 
?>
<div class="col-md-4 col-sm-6">
    <div class="album">
        <?php if(isset($meta['image']) && $meta['image'] != '') { ?>
            <a href="<?php echo get_term_link($teo_album);?>">
                <figure>
                    <img src="<?php echo esc_url($meta['image']);?>" alt="<?php echo esc_attr($teo_album->name);?>">
                    <div class="overlay">
                        <div class="background"></div>
                    </div>
                </figure>
            </a>
        <?php } ?>
        <a href="<?php echo get_term_link($teo_album);?>" class="title"><?php echo esc_attr($teo_album->name);?></a>
        <div class="artist"><?php echo esc_attr($teo_artist);?></div>
    </div>
</div>
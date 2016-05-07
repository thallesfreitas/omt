<button type="button" class="search-button btn">
    <i class="music-search"></i>
</button>
<div class="search-box">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-group">
                    <form action="<?php echo home_url(); ?>">
                        <input type="text" name="s" placeholder="<?php _e('Start your search here...', 'teo');?>" class="form-control">
                        <input type="submit" value="submit" class="hidden">
                    </form>
                </div>
                <a href="#" class="close-search">
                    <img src="<?php echo get_template_directory_uri();?>/img/close-btn.png" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('header', 'woocommerce-icons');?>
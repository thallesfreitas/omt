<?php if(teo_is_woo() ) get_template_part('footer', 'player');?>

<?php
$variation = get_theme_mod('teo_footer_variation', '');
if($variation == '') 
    $variation = 1;
get_template_part('footer', 'variation' . $variation);
?>
            </div>
        </div>
    </div>
    <?php wp_footer();?>
    </body>
</html>
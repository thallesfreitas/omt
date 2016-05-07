<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="<?php echo get_template_directory_uri();?>/content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <?php
    wp_head(); 
    ?>
</head>
<?php
$variation = get_theme_mod('teo_header_variation', '');
if($variation == '') 
    $variation = 1;

if($variation == 1) {
    $class = 'with-search-header';
}
elseif($variation == 2) {
    $class = 'with-simple-header';
}
elseif($variation == 3 || $variation == 4) {
    $class = 'with-image-header';
}
if(!teo_is_woo() ) {
    $class .= ' no-woocommerce';
}
global $teo_errors;
?>
<body <?php body_class($class);?>>
    <div class="container-fluid no-padding">
        <div class="row no-margin">
            <div class="col-xs-12 no-padding">
                <?php get_template_part('header', 'variation' . $variation);?>

                <?php if(isset($teo_valid) ) { ?>
                    <div class="container notifications">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success"><?php _e("Congratulations! You are now registered, we also sent you an e-mail with your account details!", 'teo');?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($teo_reset) ) { ?>
                    <div class="container notifications">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success"><?php _e("We sent you an e-mail with instructions on how to reset your password!", 'teo');?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($teo_errors) ) { ?>
                    <div class="container notifications">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php foreach($teo_errors as $error) { ?>
                                    <div class="alert alert-danger"><?php echo esc_attr($error);?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
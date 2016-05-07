<?php if(teo_is_woo() ) { ?>
    <div class="account-icons">
        <?php 
        global $woocommerce;
        $currency = html_entity_decode(get_woocommerce_currency_symbol() ); 
        ?>
        <ul>
            <li>
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="add-to-cart">
                    <img src="<?php echo get_template_directory_uri();?>/img/cart-icon.png" alt="">
                    <span class="dot">&nbsp;</span>
                    <span class="count"><?php echo $woocommerce->cart->cart_contents_count;?></span>
                </a>
                <div class="account-hover-box cart-hover-box">
                    <div class="top-count">
                        <div class="all-items">
                            <span class="count2"><?php echo $woocommerce->cart->cart_contents_count . ' ';?></span>
                            <span class="singular <?php if($woocommerce->cart->cart_contents_count != 1) echo 'hidden';?>"><?php _e('item', 'teo');?></span>
                            <span class="plural <?php if($woocommerce->cart->cart_contents_count == 1) echo 'hidden';?>"><?php _e('items', 'teo');?></span>
                        </div>
                        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="view-cart no-ajaxy"><?php _e('View cart', 'teo');?></a>
                    </div>

                    <ul class="items">
                        <?php
                        $cart_items = $woocommerce->cart->get_cart();
                        $total = 0;
                        foreach($cart_items as $cart_item) {
                            $post_id = $cart_item['product_id'];
                            $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); 
                            $product = new WC_Product($post_id);
                            $product_post = get_post($post_id);
                            ?>
                            <li id="header_product_<?php echo $post_id;?>">
                                <?php if($thumbnail != '') { ?>
                                    <a href="<?php echo get_permalink($post_id);?>">
                                        <figure>
                                            <img src="<?php echo teo_resize($thumbnail, 50, 43, true, true);?>" alt="<?php echo $product_post->post_title;?>">
                                        </figure>
                                    </a>
                                <?php } ?>
                                <a href="<?php echo get_permalink($post_id);?>" class="title"><?php echo $product_post->post_title;?></a>
                                <div class="type"><?php _e('Song', 'teo');?></div>
                                <div class="price"><?php echo $product->get_price_html();?></div>
                                <span data-id="<?php echo $post_id;?>" class="remove">
                                    <i class="fa fa-times"></i>
                                </span>
                            </li>
                        <?php $total += $product->price;  } ?>
                    </ul>

                    <div class="bottom-totals">
                        <div class="total">
                            <div class="text"><?php _e('total', 'teo');?></div>
                            <div class="amount"><?php echo $currency;?><span class="price"><?php echo $total;?></span></div>
                        </div>
                        <a href="<?php echo $woocommerce->cart->get_checkout_url();?>" class="checkout btn btn-default no-ajaxy"><?php _e('Checkout', 'teo');?></a>
                    </div>
                </div>
            </li>
            <li>
                <?php 
                $wishlist = isset($_SESSION['teo_wishlist']) ? $_SESSION['teo_wishlist'] : array();?>
                <a href="#" class="add-to-wishlist">
                    <img src="<?php echo get_template_directory_uri();?>/img/heart-icon.png" alt="">
                    <span class="dot">&nbsp;</span>
                    <span class="count"><?php echo count($wishlist);?></span>
                </a>
                <div class="account-hover-box wishlist-hover-box">
                    <div class="top-count">
                        <div class="all-items">
                            <span class="count2"><?php echo count($wishlist) . ' ';?></span>
                            <span class="singular <?php if(count($wishlist) != 1) echo 'hidden';?>"><?php _e('item', 'teo');?></span>
                            <span class="plural <?php if(count($wishlist) == 1) echo 'hidden';?>"><?php _e('items', 'teo');?></span>
                        </div>
                        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="view-cart no-ajaxy"><?php _e('View cart', 'teo');?></a>
                    </div>
                    <ul class="items">
                        <?php

                        if(isset($wishlist) && is_array($wishlist) ) {
                            $total = 0;
                            foreach($wishlist as $product) {
                                $post_id = $product;
                                $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); 
                                $product = new WC_Product($post_id);
                                $product_post = get_post($post_id);
                                ?>
                                <li id="header_product_<?php echo $post_id;?>">
                                    <?php if($thumbnail != '') { ?>
                                        <a href="<?php echo get_permalink($post_id);?>">
                                            <figure>
                                                <img src="<?php echo teo_resize($thumbnail, 50, 43, true, true);?>" alt="<?php echo $product_post->post_title;?>">
                                            </figure>
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo get_permalink($post_id);?>" class="title"><?php echo $product_post->post_title;?></a>
                                    <div class="type"><?php _e('Song', 'teo');?></div>
                                    <div class="price"><?php echo $product->get_price_html();?></div>
                                    <span data-id="<?php echo $post_id;?>" class="remove">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </li>
                            <?php $total += $product->price; 
                            } 
                        } ?>
                    </ul>
                    
                    <div class="bottom-totals">
                        <div class="total">
                            <div class="text"><?php _e('total', 'teo');?></div>
                            <div class="amount"><?php echo $currency;?><span class="price"><?php echo $total;?></span></div>
                        </div>
                        
                    </div>
                </div>
            </li>
        </ul>
    </div>
<?php } ?>
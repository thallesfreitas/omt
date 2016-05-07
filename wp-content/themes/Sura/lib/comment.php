<?php if ( ! function_exists( 'teo_comment' ) ) :
function teo_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $comment_count;
   ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <figure>
                <?php echo get_avatar($comment, 80); ?>
            </figure>
            <div class="comment-content">
                <div class="info">
                    <a <?php if($comment->comment_author_url != '') echo 'href="' . esc_url($comment->comment_author_url) . '"';?> class="name"><?php comment_author();?></a>
                    <?php echo ' ' . __('on', 'teo') . ' ' . get_comment_date('d.m.Y');?>
                </div>
                <div class="text">
                    <?php comment_text(); ?>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <p>
                            <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','Cleanse') ?></em>
                        </p>
                        <br />
                    <?php endif; ?>
                </div>
                <?php 
                $reply_link = get_comment_reply_link( array_merge( $args, array('reply_text' => __('Reply', 'teo'),'depth' => $depth, 'max_depth' => $args['max_depth'])) );
                echo $reply_link;
                edit_comment_link( __('Edit', 'teo', ' ' ) );
                ?>
            </div>
        </div>
<?php }
endif; ?>
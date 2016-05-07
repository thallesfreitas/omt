<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (esc_attr_e('Please do not load this page directly. Thanks!','teo'));

	if ( post_password_required() ) { ?>

<p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.','teo') ?></p>
<?php
		return;
	}
	global $redux_demo;
	$nrcomments = get_comments_number();
?>
<!-- You can start editing here. -->

<div class="comments-container" id="comments">
	<div class="count"><?php echo $nrcomments;?></div>

	<?php if ( have_comments() ) : ?>

		<h3><?php if($nrcomments != 1) _e('Comments', 'teo'); else _e('Comment', 'teo');?></h3>

		<hr>

        <div class="row no-margin">
            <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="paginate comment-paginate clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'teo' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'teo' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
			
		<?php if ( ! empty($comments_by_type['comment']) ) : ?>
			<ul class="comments">
				<?php wp_list_comments( array('type'=>'comment','callback'=>'teo_comment') ); ?>
			</ul>
		<?php endif; ?>
			
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="paginate comment-paginate clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'teo' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'teo' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
				
		<?php if ( ! empty($comments_by_type['pings']) ) : ?>
			<div id="trackbacks">
				<ul class="pinglist">
					<?php //wp_list_comments('type=pings&callback=tilability_pings'); ?>
				</ul>
			</div>
		<?php endif; ?>	
			</div>
		</div>

	<?php endif; ?>


	<?php if ( ! comments_open() ) : ?>
		<h3 class="comments-closed"><?php _e( 'Comments are closed.', 'teo' );?></h3>
	<?php endif; ?>
</div>

<?php if ('open' == $post->comment_status) : ?>
	<div class="add-comment-container">
		<h6><?php _e('Add your own', 'teo');?></h6>
        <h3><?php _e('Reply', 'teo');?></h3>
        <hr>
        <div class="row no-margin">
            <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
				<?php 
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				if($commenter['comment_author'] != '') 
					$name = esc_attr($commenter['comment_author']);
				else 
					$name = '';
				if($commenter['comment_author_email'] != '') 
					$email = esc_attr($commenter['comment_author_email']);
				else
					$email = '';
				if($commenter['comment_author_url'] != '') 
					$url = esc_attr($commenter['comment_author_url']);
				else 
					$url = '';
				$fields =  array(
				'author' => '<div class="form-group">
			            <label for="name">' . __('Name', 'teo') . ':</label>
			            <input class="form-control" id="author" placeholder="John Doe(*)" name="author" type="text" value="' . $name . '" ' . $aria_req . ' />
				    </div>',
				'email'  => '<div class="form-group">
			            <label for="name">' . __('E-mail', 'teo') . ':</label>
						<input class="form-control" id="email" placeholder="john@doe.com(*)" name="email" type="text" value="' . $email . '" ' . $aria_req . ' />
					</div>',
				'url'    => '<div class="form-group">
			            <label for="name">' . __('Website', 'teo') . ':</label>
						<input class="form-control" id="url" placeholder="http://example.com" name="url" type="text" value="' . $url . '" />
					</div>'
				); 

				$comment_textarea = '<div class="form-group">
			            <label for="message">Message:</label>
			            <textarea rows="3" class="form-control" placeholder="Your Message...(*)" id="comment" name="comment" aria-required="true"></textarea>
			        </div>';
				comment_form( array( 'fields' => $fields, 'comment_field' => $comment_textarea, 'id_submit' => 'contact_submit', 'label_submit' => esc_attr__( 'Submit Comment', 'teo' ), 'title_reply' => '', 'title_reply_to' => esc_attr__( 'Leave a Reply to %s', 'teo' )) ); ?>		
			</div>
		</div>
	</div>
<?php endif; //comment status if ?>
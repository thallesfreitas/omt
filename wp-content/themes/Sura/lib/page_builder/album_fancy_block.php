<?php
/** A simple text block **/
class AQ_FancyAlbum_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Album fancy block - with songs(full 12 columns recommended)',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_fancyalbum_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'album' 			=> '',
			'backtext'			=> 'all things',
			'fronttext'			=> 'new',
			'back_color' 		=> '#19d27d',
			'nrposts'			=> 5,
			'linktext'			=> 'View'
		);

		$args['hide_empty'] = false;
		$albums = get_terms('album', $args);
		$album_ids = array();
		if ( ! empty( $albums ) && ! is_wp_error( $albums ) ) {
			foreach($albums as $term) {
				$album_ids[$term->term_id] = $term->name;
			}
		}

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>

		<div class="description">
			<label for="<?php echo $this->get_field_id('album') ?>">
				Album to show songs for
				<?php echo aq_field_select('album', $block_id, $album_ids, $album); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('backtext') ?>">
				Back album text(partially covered by the front text)
				<?php echo aq_field_input('backtext', $block_id, $backtext, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('fronttext') ?>">
				Front album text(covers partially the back text)<br /><br />
				<?php echo aq_field_input('fronttext', $block_id, $fronttext, $size = 'full') ?>
			</label>
		</div>

		<div style="clear: both"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('back_color') ?>">
				Back + front album text color(default #19d27d)
				<?php echo aq_field_color_picker('back_color', $block_id, $back_color, $default = '#19d27d') ?>
			</label>
		</div>


		<div class="description half">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of songs shown
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('linktext') ?>">
				View album link text(default "View")
				<?php echo aq_field_input('linktext', $block_id, $linktext, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		if(teo_is_woo() ) {
			if($album != '') {
				$term = get_term($album, 'album');
			}
			else {
				return '';
			}

			if($term) {
				$meta = get_option( 'teo_album_' . $term->term_id ); 

				$shortdescription = isset($meta['shortdescription']) && $meta['shortdescription'] != '' ? esc_attr($meta['shortdescription']) : esc_attr($term->description);

				echo '<div class="col-sm-10 col-sm-offset-2 no-padding">';
				echo '<div class="latest-album">';

				if($meta['image'] != '') {
					$inline = '';
					if($term->count == 0) {
						$inline = ' style="margin-top: -175px" ';
					}
					echo '<figure ' . $inline . ' class="hidden-xs"><img alt="" src="' . esc_url($meta['image']) . '"></figure>';
				}
				echo '<div class="title">
		            	<div class="underlined">' . esc_attr($term->name) . '</div>
		        	</div>';

		        $inline2 = '';
		       	if($backtext != '' || $fronttext != '') {
		       		echo '<div class="custom-title">';
		       		$inline = '';
		       		if(strtolower($back_color != '#19d27d') ) {
		       			$inline = ' style="color: ' . esc_attr($back_color) . '" ';
		       		}
		       		if($backtext != '') {
		       			echo '<div ' . $inline . ' class="back">' . esc_attr($backtext) . '</div>';
		       		}
		       		if($fronttext != '') {
		       			echo '<div ' . $inline . ' class="front">' . esc_attr($fronttext) . '</div>';
		       		}
		       		echo '</div>';
		       	}
		       	else {
		       		$inline2 = ' style="margin-left: 0; margin-top: 30px" ';
		       	}

		       	echo '<a ' . $inline2 . ' class="view" href="' . get_term_link($term) . '">' . esc_attr($linktext) . ' <i class="fa fa-long-arrow-right"></i></a>';

		       	echo '<ul class="album-songs">';
		       	
		       	$args = array();
		       	$args['post_type'] = 'product';
				$args['post_status'] = 'publish';
				if($nrposts == 0) {
					$nrposts = 6;
				}
				$args['posts_per_page'] = -1;
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'album',
						'terms'    => $album,
					),
				);
				$count = 1;
				$query = new WP_Query($args);
				while($query->have_posts() && $count <= $nrposts ) : $query->the_post(); global $post;
					if(teo_is_song($post->ID) ) {
			            $file = get_post_meta($post->ID, '_song_preview', true);

						if($file == '') {
							$files = get_post_meta($post->ID, '_downloadable_files', true);
				            $mp3file = '';
				            foreach($files as $file) {
				                $file = $file['file'];
				                break;
				            }
				        }
			            $mp3file = new MP3File($file);
			            @$duration = $mp3file->getDuration();
						echo '<li>';
						echo '<a href="' . get_permalink() . '" class="song-title">' . get_the_title() . '</a>';
			            if($duration != '') {
			            	echo '<div class="duration">' . MP3File::formatTime($duration) . '</div>';
			            }
			            echo '</li>';

			            $count++;
			        }
				endwhile; wp_reset_postdata();
				echo '</ul>';

				$albums_pageid = (int)get_option('teo_albums_page');
				if($albums_pageid != 0) {
					echo '<a href="' . get_permalink($albums_pageid) . '" class="more-albums">' . __('More albums', 'teo') . '</a>';
				}

				echo '</div>';
				echo '</div>';
			}
		} else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some albums in order to use this block', 'teo') . '</div>';
	    }
	}
}
<?php
/** A simple text block **/
class AQ_SongsSlider_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Big songs slider',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_songsslider_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'genres' 			=> '',
			'headline'			=> 'Newest',
			'nrposts'			=> 6,
			'color_scheme' 		=> '#ffffff',
			'link_text' 		=> 'Discover more songs',
			'link_url'			=> ''
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$args['hide_empty'] = false;
		$terms = get_terms('genre', $args);
		$genres_array = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach($terms as $term) {
				$genres_array[$term->term_id] = $term->name;
			}
		}
		?>

		<div class="description">
			<label for="<?php echo $this->get_field_id('genres') ?>">
				Genres to show songs from
				<?php echo aq_field_multiselect('genres', $block_id, $genres_array, $genres ) ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('headline') ?>">
				Headline text
				<?php echo aq_field_input('headline', $block_id, $headline, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of songs to show
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('color_scheme') ?>">
				Text color scheme
				<?php echo aq_field_color_picker('color_scheme', $block_id, $color_scheme, $default = '#fff') ?>
			</label>
		</div>

		<div style="clear: both"></div>

		<p>If you want to add a "smooth link" to another section of the same page, you will need to check the source code and get the ID of that unique section. Then, in the URL box, set it as #THE-ID-HERE, like http://prntscr.com/64swla</p>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('link_text') ?>">
				Bottom Link Text(if used)
				<?php echo aq_field_input('link_text', $block_id, $link_text, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('link_url') ?>">
				Bottom Link URL(if used)
				<?php echo aq_field_input('link_url', $block_id, $link_url, $size = 'full') ?>
			</label>
		</div>

		<?php
	}
	
	function block($instance) {
		extract($instance);

		if(teo_is_woo() ) {
			$inline = '';
			if(strtolower($color_scheme) != '#ffffff') {
				$inline = ' style="color: ' . esc_attr($color_scheme) . '" ';
			}

			$id = rand(1, 50000);

			echo '<div id="introductory-slider-' . $id . '" class="introductory-slider">';

			echo '<ul class="slides">';

			$args = array();
			$args['post_type'] = 'product';
			$args['post_status'] = 'publish';
			if($nrposts == 0) {
				$nrposts = 6;
			}
			$args['posts_per_page'] = -1;
			if(isset($genres) && count($genres) > 0) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'genre',
						'terms'    => $genres,
					),
				);
			}
			$count = 1;
			$query = new WP_Query($args);
			while($query->have_posts() && $count <= $nrposts ) : $query->the_post(); global $post;
				if(teo_is_song($post->ID) ) {
					$file = '';
					$file = get_post_meta($post->ID, '_song_preview', true);
					if($file == '') {
						$files = get_post_meta($post->ID, '_downloadable_files', true);
			            $mp3file = '';
			            foreach($files as $file) {
			                $file = $file['file'];
			                break;
			            }
			        }

					echo '<li class="song">';

					echo '<div class="item">';

					echo '<div class="slide-title">';

					if($headline != '') { 
						echo '<h3 ' . $inline . '>' . esc_attr($headline) . '</h3>';
		            }

		            echo '<div class="line"><img src="' . get_template_directory_uri() . '/img/title-underline.png" alt=""></div>';

		            echo '</div>';
		            
		            echo '<div ' . $inline . ' class="song-title">' . get_the_title() . '</div>';

		            if($file != '') {
		            	$inline2 = '';
		            	if($link_text == '' || $link_url == '') {
		            		$inline2 = ' style="color: ' . esc_attr($color_scheme) . '; padding-bottom: 25px"';
		            	}
		            	else {
		            		$inline2 = $inline;
		            	}
		            	echo '<a ' . $inline2 . ' href="#" data-id="' . $post->ID . '" class="play play-song play-song-individual">' . __('Start listening', 'teo') . ' <i class="fa fa-play"></i></a>';
		            	echo '<a class="pause-song play play-song" href="#" style="display: none;">' . __('Pause song', 'teo') . '</a>';
		            }

		            if($link_text != '' && $link_url != '') {
		            	$class = '';
		            	if($link_url[0] == '#') {
		            		//smooth scroll
		            		$class = 'more-with-navigation';
		            	}
		            	echo '<a ' . $inline . ' href="' . esc_url($link_url) . '" class="more ' . $class . '">' . esc_attr($link_text) . ' <i class="fa fa-angle-down"></i></a>';
		            }

		            echo '</div>';
		            echo '</li>';
		            $count++;
		        }
	        endwhile; wp_reset_postdata();

	        echo '</ul>';

	        echo '</div>';

	        echo '
	        <style type="text/css">
	        	#introductory-slider-' . $id . ' .flex-control-nav li a.flex-active {
	        		background: ' . esc_attr($color_scheme) . ' !important;
	        	}
	        	#introductory-slider-' . $id . ' .flex-control-nav li a {
	        		border: 1px solid ' . esc_attr($color_scheme) . ' !important;
	        	}
	        </style>';
	    } else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some songs in order to use this block', 'teo') . '</div>';
	    }
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
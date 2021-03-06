<?php
/** A simple text block **/
class AQ_SongsAlt_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Songs block - music app',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_songsalt_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'genres' 			=> '',
			'nrposts'			=> 6,
			'subtitle'			=> 'My songs',
			'title2'			=> 'Discover',
			'subtitle_color' 	=> '#b2b2b2',
			'title_color' 		=> '#303030',
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

		<div class="description half">
			<label for="<?php echo $this->get_field_id('genres') ?>">
				Genres to show songs from
				<?php echo aq_field_multiselect('genres', $block_id, $genres_array, $genres ) ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of songs to show
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
			</label>
		</div>

		<div style="clear: both"></div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('subtitle') ?>">
				Small subtitle text(shows above the title)
				<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('title2') ?>">
				Title text
				<?php echo aq_field_input('title2', $block_id, $title2, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('subtitle_color') ?>">
				Subtitle color(default #b2b2b2)
				<?php echo aq_field_color_picker('subtitle_color', $block_id, $subtitle_color, $default = '#b2b2b2') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('title_color') ?>">
				Title color(default #303030)
				<?php echo aq_field_color_picker('title_color', $block_id, $title_color, $default = '#303030') ?>
			</label>
		</div>

		<?php
	}
	
	function block($instance) {
		extract($instance);

		if(teo_is_woo() ) {
			echo '<div class="artist-songs-container">';
		
			echo '<div class="col-sm-6">';

			if($subtitle != '') {
	        	if($subtitle_color != '') {
	        		echo '<h6 style="color: ' . esc_attr($subtitle_color) . '">' . esc_attr($subtitle) . '</h6>';
	        	}
	        	else {
	        		echo '<h6>' . esc_attr($subtitle) . '</h6>';
	        	}
	        }
	        if($title2 != '') {
	        	if($title_color != '') {
	        		echo '<h3 style="color: ' . esc_attr($title_color) . '">' . esc_attr($title2) . '</h3>';
	        	}
	        	else {
	        		echo '<h3>' . esc_attr($title2) . '</h3>';
	        	}
	        }

	        echo '</div>';

	        $songs_page = get_option('teo_songs_page');
	        $songs_permalink = get_permalink($songs_page);

	        if($songs_permalink) {
	        	echo '<div class="col-sm-6">
			        	<a class="view-all" href="' . esc_url($songs_permalink) . '">' . __('View All', 'teo') . ' <i class="music-plus-button"></i></a>
			        </div>';
		    }

		    echo '<div style="clear: both"></div>';

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
			$query = new WP_Query($args);
			$count = 1;
			while($query->have_posts() && $count <= $nrposts ) : $query->the_post(); global $post;
				if(teo_is_song($post->ID) ) {
					wc_get_template_part( 'content', 'product' );
					$count++;
				}
	        endwhile; wp_reset_postdata();

	        echo '</div>';
	    } else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some songs in order to use this block', 'teo') . '</div>';
	    }
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
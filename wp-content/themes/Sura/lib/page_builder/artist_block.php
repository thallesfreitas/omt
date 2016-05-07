<?php
/** A simple text block **/
class AQ_Artist_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Artist call to action block(with full bg image)',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_artist_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'artist' 	=> '',
			'textcolor' => '#fff',
			'linktext' 	=> __('Browse my songs', 'teo')
		);

		$args['hide_empty'] = false;
		$artists = get_terms('artist', $args);
		$artist_ids = array();
		if ( ! empty( $artists ) && ! is_wp_error( $artists ) ) {
			foreach($artists as $term) {
				$artist_ids[$term->term_id] = $term->name;
			}
		}

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('artist') ?>">
				Artist to show info for
				<?php echo aq_field_select('artist', $block_id, $artist_ids, $artist); ?>
			</label>
		</p>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Text color(default #fff)
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor, $default = '#fff') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('linktext') ?>">
				Bottom call to action text
				<?php echo aq_field_input('linktext', $block_id, $linktext, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		if(teo_is_woo() ) {
			if($artist != '') {
				$term = get_term($artist, 'artist');
			}
			else {
				return false;
			}

			if($term) {
				$meta = get_option( 'teo_taxonomy_' . $term->term_id ); 

				$shortdescription = isset($meta['shortdescription']) && $meta['shortdescription'] != '' ? esc_attr($meta['shortdescription']) : esc_attr($term->description);


				$inline = '';

				if($textcolor != '' && $textcolor != '#fff' && $textcolor != '#ffffff') {
					$inline .= ' style="color: ' . esc_attr($textcolor) . '"';
				}

				echo '
				<div class="artist-main-container" style="background-image: url(\'' . esc_url($meta['image']) . '\')">
					<div class="darken-overlay"></div>
		        	<div class="content">
			        	<h1 ' . $inline . '>' . esc_attr($term->name) . '</h1>
			        	<div ' . $inline . ' class="description">' . esc_attr($shortdescription) . '</div>
			        	<a ' . $inline . ' class="browse" href="' . get_term_link($term) . '">' . esc_attr($linktext) . '</a>
			        </div>
		        </div>';
		    } 
		}
		else {
		    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some artists in order to use this block', 'teo') . '</div>';
		}
	}
	
}
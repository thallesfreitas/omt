<?php
/** A simple text block **/
class AQ_Album_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Album presentation block',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_album_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'album' 	=> '',
			'bgcolor' => '#f9f9f9',
			'titlecolor' => '#303030',
			'textcolor' => '#8f8f8f',
			'linktext' 	=> __('View', 'teo')
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

		<p class="description half">
			<label for="<?php echo $this->get_field_id('album') ?>">
				Album to show info for
				<?php echo aq_field_select('album', $block_id, $album_ids, $album); ?>
			</label>
		</p>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Background color(default #303030)
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor, $default = '#303030') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('titlecolor') ?>">
				Album title color(default #f9f9f9)
				<?php echo aq_field_color_picker('titlecolor', $block_id, $titlecolor, $default = '#303030') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Album info text color(default #8f8f8f)
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor, $default = '#8f8f8f') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('linktext') ?>">
				Bottom call to action link text
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


				$inline = '';

				if($textcolor != '' && $textcolor != '#fff' && $textcolor != '#ffffff') {
					$inline .= ' style="color: ' . esc_attr($textcolor) . '"';
				}

				echo '<div class="artist-second-container" style="background-color: url(\'' . esc_url($bgcolor) . '\')">';
		       	if($meta['image'] != '') { 
		       		echo '<figure><img alt="" src="' . esc_url($meta['image']) . '"></figure>';
		       	}
		       	echo '
		       		<div class="info">
		                <div class="title">' . esc_attr($term->name) . '</div>
		                <div class="songs">
		                	<span>' . __('album', 'teo') . '</span> - ' . sprintf(__('%d songs', 'teo'), $term->count) . '
		                </div>
		               	<a class="view" href="' . get_term_link($term) . '">' . esc_attr($linktext) . ' <i class="fa fa-long-arrow-right"></i></a>
		            </div>';
		        echo '</div>';
		    }
	    } else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some albums in order to use this block', 'teo') . '</div>';
	    }
	}
	
}
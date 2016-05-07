<?php
/** A simple text block **/
class AQ_ArtistSecondary_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Artist description block(shows description + contact details)',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_artistsecondary_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'artist' 			=> '',
			'bg_color' 			=> '',
			'subtitle'			=> 'About',
			'title2'			=> 'My Music',
			'subtitle_color' 	=> '#b2b2b2',
			'title_color' 		=> '#303030',
			'textcolor' 		=> '#303030',
			'linktext' 			=> __('Write to me', 'teo'),
			'linkurl' 			=> ''
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

		<div class="description half">
			<label for="<?php echo $this->get_field_id('artist') ?>">
				Artist to show info for
				<?php echo aq_field_select('artist', $block_id, $artist_ids, $artist); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('bg_color') ?>">
				Background color(default #fff)
				<?php echo aq_field_color_picker('bg_color', $block_id, $bg_color, $default = '#fff') ?>
			</label>
		</div>

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

		<div class="description">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Text color(default #303030)
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor, $default = '#303030') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('linktext') ?>">
				Bottom contact text(default is Write to me)
				<?php echo aq_field_input('linktext', $block_id, $linktext, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('linkurl') ?>">
				Bottom contact URL
				<?php echo aq_field_input('linkurl', $block_id, $linkurl, $size = 'full') ?>
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
				return '';
			}

			if($term) { 
				$meta = get_option( 'teo_taxonomy_' . $term->term_id ); 

				$shortdescription = isset($meta['shortdescription']) && $meta['shortdescription'] != '' ? esc_attr($meta['shortdescription']) : esc_attr($term->description);


				$inline = '';

				if($textcolor != '' && $textcolor != '#303030') {
					$inline .= ' style="color: ' . esc_attr($textcolor) . '"';
				}

				echo '<div class="artist-about-container" style="background-color:' . esc_attr($bg_color) . '">';
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

		        echo '<div class="user">';
		        echo '<figure><img src="' . teo_resize(esc_url($meta['image']), 125, 125, true, true) . '" alt="' . esc_attr($term->name) . '" /></figure>';
		        echo '<ul class="social-icons more-margin">';
		        if(isset($meta['facebook']) && $meta['facebook'] != '') { ?>
		            <li>
		                <a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['facebook']);?>">
		                   	<i style="color: #3b5998" class="fa fa-facebook"></i>
		                </a>
		            </li>
		        <?php } ?>

		        <?php if(isset($meta['twitter']) && $meta['twitter'] != '') { ?>
		            <li>
		                <a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['twitter']);?>">
		                    <i style="color: #00aced" class="fa fa-twitter"></i>
		                </a>
		            </li>
		        <?php } ?>

		        <?php if(isset($meta['youtube']) && $meta['youtube'] != '') { ?>
		            <li>
		                <a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['youtube']);?>">
		                    <i style="color: #bb0000" class="fa fa-youtube"></i>
		                </a>
		            </li>
		        <?php } ?>

		        <?php if(isset($meta['soundcloud']) && $meta['soundcloud'] != '') { ?>
		            <li>
		                <a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['soundcloud']);?>">
		                    <i style="color: #ff3a00" class="fa fa-soundcloud"></i>
		                </a>
		            </li>
		        <?php } ?>

		        <?php if(isset($meta['beatport']) && $meta['beatport'] != '') { ?>
		            <li>
					    <a target="_blank" rel="nofollow" href="<?php echo esc_url($meta['beatport']);?>">
					        <img src="<?php echo get_template_directory_uri();?>/content/beatport-icon.png" alt="">
					    </a>
					</li>
		        <?php } ?>

		        <?php 
		        echo '</ul>
		        </div>';

		        if($textcolor != '') {
		        	echo '<div style="color: ' . esc_attr($textcolor) . '" class="description">' . esc_attr($term->description) . '</div>';
		        	echo '<a style="color: ' . esc_attr($textcolor) . '" class="write" href="' . esc_url($linkurl) . '">' . esc_attr($linktext) . '</a>';
		        }
		        else {
		        	echo '<div style="color: ' . esc_attr($textcolor) . '" class="description">' . esc_attr($term->description) . '</div>';
		        	echo '<a rel="nofollow" target="_blank" style="color: ' . esc_attr($textcolor) . '" class="write" href="' . esc_url($linkurl) . '">' . esc_attr($linktext) . '</a>';
		        }

		        echo '</div>';
		    }
	    } else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some artists in order to use this block', 'teo') . '</div>';
	    }
	}
	
}
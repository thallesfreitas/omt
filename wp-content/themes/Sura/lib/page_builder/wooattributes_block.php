<?php
/** A simple text block **/
class AQ_WooAttributes_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Custom WooCommerce attributes block',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_wooattributes_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'nrattributes'		=> 3,
			'subtitle'			=> 'About',
			'title2'			=> 'My Music',
			'subtitle_color' 	=> '#b2b2b2',
			'title_color' 		=> '#303030',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<div class="description">
			<label for="<?php echo $this->get_field_id('nrattributes') ?>">
				Number of WooCommerce attributes to show
				<?php echo aq_field_input('nrattributes', $block_id, $nrattributes, $size = 'full') ?>
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
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		if(teo_is_woo() ) {
			echo '<div class="artist-about-container">';
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

	        echo '<ul class="about-info">';

	        $custom_attributes = wc_get_attribute_taxonomies();

	        if($custom_attributes && count($custom_attributes) > 0) { 
	            $terms_number = count($custom_attributes);
	            $count = 1;
	            foreach($custom_attributes as $taxonomy) {
	                $name = wc_attribute_taxonomy_name($taxonomy->attribute_name);
		               
		            $terms = get_terms($name);
		            $term_links = array();
					if ( $terms && ! is_wp_error( $terms ) ) {
						foreach($terms as $term) {
							$term_links[] = '<a class="term-link" href="' . get_term_link($term) . '">' . $term->name . '</a>';
						}
					}
					?>
					<li>
			            <div class="title"><?php echo wc_attribute_label($name);?></div>
			            <div class="info"><?php echo implode(', ', $term_links);?></div>
			        </li>
	               	<?php 
	                if($count == $nrattributes) {
	                	break;
	                }
	                $count++;
	            }
		    }

			echo '</div>';
		} else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some attributes in order to use this block', 'teo') . '</div>';
	    }
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
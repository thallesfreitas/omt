<?php
/** A simple text block **/
class AQ_Merchandise_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Merchandise block',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_merchandise_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'categories' 		=> '',
			'nrposts'			=> 3,
			'subtitle'			=> 'Start Buying',
			'title2'			=> 'Merchandise',
			'subtitle_color' 	=> '#b2b2b2',
			'title_color' 		=> '#303030',
			'product_color' 	=> '#303030',
			'price_color' 		=> '#b2b2b2',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$args['hide_empty'] = false;
		$terms = get_terms('product_cat', $args);
		$genres_array = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach($terms as $term) {
				$genres_array[$term->term_id] = $term->name;
			}
		}
		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('categories') ?>">
				Categories to show products from
				<?php echo aq_field_multiselect('categories', $block_id, $genres_array, $categories ) ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of products to show
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
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

			echo '<div class="merchandise-container">';
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

			$args = array();
			$args['post_type'] = 'product';
			$args['post_status'] = 'publish';
			$args['posts_per_page'] = -1;
			if($nrposts == 0) {
				$nrposts = 6;
			}
			if(isset($categories) && count($categories) > 0) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'terms'    => $categories,
					),
				);
			}
			$query = new WP_Query($args);
			echo '<div class="row">';
			$count = 1;
			while($query->have_posts() && $count <= $nrposts ) : $query->the_post(); global $post;
				if(!teo_is_song($post->ID) ) {
					echo '<div class="col-sm-4">';
						wc_get_template_part( 'content-merchandise', 'product' );
					echo '</div>';
					$count++;
				}
	        endwhile; wp_reset_postdata();
	        echo '</div>';

	        echo '</div>';
	    } else {
	    	echo '<div class="alert alert-warning">' . __('Please install / enable WooCommerce and add some merchandise products in order to use this block', 'teo') . '</div>';
	    }
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
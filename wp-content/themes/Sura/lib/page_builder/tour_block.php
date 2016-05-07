<?php
/** A simple text block **/
class AQ_Tour_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Tours / Events block(12 columns recommended)',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_tour_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'bg_image' 			=> get_template_directory_uri() . '/content/tour-background.jpg',
			'top_image' 		=> get_template_directory_uri() . '/img/tour-text.png',
			'title2'			=> '',
			'duration' 			=> '',
			'description' 		=> '',
			'headercolor' 		=> '#ffffff',
			'nrposts' 			=> 6,
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>

		<div class="description">
			<label for="<?php echo $this->get_field_id('bg_image') ?>">
				Top background image(shows up at the top, above the events)
				<?php echo aq_field_upload('bg_image', $block_id, $bg_image, $media_type = 'image') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('top_image') ?>">
				Top small logo image, above the title
				<?php echo aq_field_upload('top_image', $block_id, $top_image, $media_type = 'image') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('title2') ?>">
				Tour title text
				<?php echo aq_field_input('title2', $block_id, $title2, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('duration') ?>">
				Tour schedule(start - end dates)
				<?php echo aq_field_input('duration', $block_id, $duration, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('description') ?>">
				Tour description text
				<?php echo aq_field_textarea('description', $block_id, $description, $size = 'full') ?>
			</label>
		</div>

		<div style="clear: both"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('headercolor') ?>">
				Header Text color(default #ffffff)
				<?php echo aq_field_color_picker('headercolor', $block_id, $headercolor, $default = '#ffffff') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of events shown
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo '<div class="tour-top" style="background-image: url(\'' . esc_url($bg_image) . '\')">';

			if($top_image != '') {
				echo '<div class="title-tag"><img alt="" src="' . esc_url($top_image) . '"></div>';
			}

			$inline = '';

			if($headercolor != '' && strtolower($headercolor) != '#ffffff') {
				$inline = ' style="color: ' . esc_attr($headercolor) . '" ';
			}

			if($title2 != '') {
				echo '<h2 ' . $inline . '> ' . esc_attr($title2) . '</h2>';
			}
			if($duration != '') {
				echo '<div ' . $inline . ' class="dates">' . esc_attr($duration) . '</div>';
			}
			if($description != '') {
				echo '<div ' . $inline . ' class="description">' . esc_attr($description) . '</div>';
			}
		echo '</div>'; 
		?>


		<div class="col-sm-8 col-sm-offset-2">
			<div class="tour-list">
                <div class="table-responsive">
                  	<table class="table">
                    	<tbody>
                    		<tr>
                      			<th><?php _e('Date', 'teo');?>'</th>
                      			<th><?php _e('Venue', 'teo');?>'</th>
                      			<th><?php _e('Location', 'teo');?>'</th>
                    		</tr>

        <?php 
        $args = array();
        $args['post_type'] = 'event';
        $args['posts_per_page'] = $nrposts != 0 ? $nrposts : 6;
        $args['post_status'] = 'any';
        $args['order'] = 'ASC';
        $query = new WP_Query($args);
        while($query->have_posts() ) : $query->the_post(); global $post;
            $venue = get_post_meta($post->ID, '_event_venue', true);
            $location = get_post_meta($post->ID, '_event_location', true);
            $url = get_post_meta($post->ID, '_event_url', true);
            ?>
	        <tr>
	            <td class="date"><?php the_time('M d Y' );?></td>
	            <td class="venue"><?php echo esc_attr($venue);?></td>
	            <td class="location"><?php echo esc_attr($location);?></td>
	            <?php if($url != '') { ?>
	                <td><a rel="nofollow" target="_blank" href="<?php echo esc_url($url);?>" class="ticket"><?php _e('Tickets', 'teo');?></a></td>
	            <?php } ?>
	        </tr>
	   	<?php endwhile; wp_reset_postdata(); ?>

	   					</tbody>
	   				</table>
	   			</div>
	   		</div>
	   	</div>
	
	<?php
	}
	
}
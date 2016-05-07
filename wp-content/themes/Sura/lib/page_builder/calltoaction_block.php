<?php
/** A simple text block **/
class AQ_Calltoaction_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Call to action block',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_calltoaction_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title2'				=> 'The world is',
			'subtitle'			=> 'A song',
			'description'		=> '',
			'color_scheme' 		=> '#ffffff',
			'button_text' 		=> '',
			'button_url' 		=> '',
			'button_bgcolor' 	=> '#19d27d',
			'button_textcolor' 	=> '#ffffff',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('title2') ?>">
				Title text
				<?php echo aq_field_input('title2', $block_id, $title2, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('subtitle') ?>">
				Subtitle text(shows below the title)
				<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('description') ?>">
				Description
				<?php echo aq_field_input('description', $block_id, $description, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('color_scheme') ?>">
				Text color scheme(default #ffffff)
				<?php echo aq_field_color_picker('color_scheme', $block_id, $color_scheme, $default = '#ffffff') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('button_text') ?>">
				Button text
				<?php echo aq_field_input('button_text', $block_id, $button_text, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('button_url') ?>">
				Button URL
				<?php echo aq_field_input('button_url', $block_id, $button_url, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('button_bgcolor') ?>">
				Button background color(default #19d27d)
				<?php echo aq_field_color_picker('button_bgcolor', $block_id, $button_bgcolor, $default = '#19d27d') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('button_textcolor') ?>">
				Button text color(default #ffffff)
				<?php echo aq_field_color_picker('button_textcolor', $block_id, $button_textcolor, $default = '#ffffff') ?>
			</label>
		</div>

		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo '<div class="action-call">';

		if($title2 != '') {
        	echo '<h2 style="color: ' . esc_attr($color_scheme) . '">' . esc_attr($title2) . '</h2>';
        }

		if($subtitle != '') {
        	echo '<h3 style="color: ' . esc_attr($color_scheme) . '">' . esc_attr($subtitle) . '</h3>';
        }

		echo '<div style="color: ' . esc_attr($color_scheme) . '" class="curved-lines"><img alt="" src="' . get_template_directory_uri() . '/img/curved-lines.png"></div>';

		if($description != '') {
			echo '<div style="color: ' . esc_attr($color_scheme) . '" class="text">' . esc_attr($description) . '</div>';
		}

		if($button_text != '') {
			if($button_url != '') {
				echo '<a target="_blank" href="' . esc_url($button_url) . '" style="color: ' . esc_attr($button_textcolor) . '; background-color: ' . esc_attr($button_bgcolor) . '" class="btn btn-default">' . esc_attr($button_text) . '</a>';
			}
			else {
				echo '<button style="color: ' . esc_attr($button_textcolor) . '; background-color: ' . esc_attr($button_bgcolor) . '" class="btn btn-default">' . esc_attr($button_text) . '</button>';
			}
		}
		echo '</div>';
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
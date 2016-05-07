<?php

class AQ_Section_Block extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Page Section',
			'size' => 'span12',
			'resizable' => false,
		);
		
		//create the widget
		parent::__construct('aq_section_block', $block_options);
		
	}

	//form header
	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title">',
							$name , $title, 
						'</div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings cf" id="block-settings-'.$number.'">';
	}

	function form($instance) {
	
		$defaults = array(
			'title' => 'The Page Section Title',
			'color' => '#ffffff',
			'type' => 'colour',
			'image' => '',
			'paddingtop' => '0',
			'paddingbottom' => '0',
		);
		$instance = wp_parse_args($instance, $defaults);
		$this->block_id = 'aq_block_' . $instance['number'];
		extract($instance);
		
		$type_options = array(
			'colour' => 'Color',
			'image' => 'Background Image',
		);
		
?>
					
		<div>	

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					The title for this page section(to easily manage it) <br />
					<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Background Type <br />
					<?php echo aq_field_select('type', $this->block_id, $type_options, $type) ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('color') ?>">
					<?php _e('Background Color', 'rise'); ?> <br />
					<?php echo aq_field_color_picker('color', $this->block_id, $color, $default = '#ffffff') ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('image') ?>">
					Background Image
					<?php echo aq_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>
				</label>
			</p>

			<p class="description half">
				<label for="<?php echo $this->get_field_id('paddingtop') ?>">
					Padding-top(in px, default value: 0, modify only if you want extra padding)
					<?php echo aq_field_input('paddingtop', $this->block_id, $paddingtop, $size = 'full') ?>
				</label>
			</p>

			<p class="description half last">
				<label for="<?php echo $this->get_field_id('paddingbottom') ?>">
					Padding-bottom(in px, default value: 0, modify only if you want extra padding)
					<?php echo aq_field_input('paddingbottom', $this->block_id, $paddingbottom, $size = 'full') ?>
				</label>
			</p>


		</div>
		
		<div class="clear"></div>
				
		<p class="empty-column">
			<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
		</p>
		
<?php
	echo '<ul class="blocks column-blocks cf"></ul>';
	}
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';

		extract($instance);
		
		$type_options = array(
			'colour' => 'Color',
			'image' => 'Background Image'
		);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-container block-aq_column_block '.$size.'">'; ?>
			
			<a style="padding: 7px 12px" href="#" data-id="<?php echo $number;?>" class="column-close">Show / Hide Section <code><?php echo $title;?></code></a>
			
			<?php 
			echo '<div class="block-settings-column block-settings-section cf" id="block-settings-'.$number.'">';
	?>
						
		<div id="section-<?php echo $number;?>" style="padding: 7px 12px">	
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					The title for this page section(to easily manage it) <br />
					<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Background Type <br />
					<?php echo aq_field_select('type', $this->block_id, $type_options, $type) ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('color') ?>">
					Background Color
					<?php echo aq_field_color_picker('color', $this->block_id, $color, $default = '#ffffff') ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('image') ?>">
					Background Image: <br />
					<?php echo aq_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>
				</label>
			</p>

			<p class="description half">
				<label for="<?php echo $this->get_field_id('paddingtop') ?>">
					Padding-top(in px, default value: 0, modify only if you want extra padding)
					<?php echo aq_field_input('paddingtop', $this->block_id, $paddingtop, $size = 'full') ?>
				</label>
			</p>

			<p class="description half last">
				<label for="<?php echo $this->get_field_id('paddingbottom') ?>">
					Padding-bottom(in px, default value: 0, modify only if you want extra padding)
					<?php echo aq_field_input('paddingbottom', $this->block_id, $paddingbottom, $size = 'full') ?>
				</label>
			</p>
		</div>
		<div class="clear"></div>
				
		<p class="empty-column">
			<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
		</p>
					
	<?php
		echo '<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo '</ul>';
			
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));

		$lightness = '';
		
		//column block header
		if(isset($template_id)) {

			$this->before_block($instance);
			
			//Grab background colour and evaluate brightness to go toward text colour
			if($color){
				$hex = ltrim($color, '#');
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
				($r + $g + $b > 382) ? $lightness = 'white-section' : $lightness = 'black-section';
			} else {
				$lightness = 'black-section';
			}

			$paddingbottom = (int)$paddingbottom;
			$paddingtop = (int)$paddingtop;
			
			//open section wrapper
			if( $type == 'colour' ){
				echo '<section class="line ' . $lightness . '" style="background-color: '. $color .'; padding-top: ' . $paddingtop . 'px; padding-bottom: ' . $paddingbottom . 'px">
					<div class="row no-margin">';
			} else {
				echo '<section class="line section-background" style="background-image: url('.$image.'); background-size: cover; padding-top: ' . $paddingtop . 'px; padding-bottom: ' . $paddingbottom . 'px">
					<div class="row no-margin">';
			}

						//define vars
						$overgrid = 0; $span = 0; $first = false;
						
						//check if column has blocks inside it
						$blocks = aq_get_blocks($template_id);
						
						//outputs the blocks
						if($blocks) {
							foreach($blocks as $key => $child) {
								global $aq_registered_blocks;
								extract($child);
								
								if(class_exists($id_base)) {
									//get the block object
									$block = $aq_registered_blocks[$id_base];
									
									//insert template_id into $child
									$child['template_id'] = $template_id;
									
									//display the block
									if($parent == $col_order) {
										
										$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
										
										$overgrid = $span + $child_col_size;
										
										if($overgrid > $col_size || $span == $col_size || $span == 0) {
											$span = 0;
											$first = true;
										}
										
										if($first == true) {
											$child['first'] = true;
										}
										
										$block->block_callback($child);
										
										$span = $span + $child_col_size;
										
										$overgrid = 0; //reset $overgrid
										$first = false; //reset $first
									}
								}
							}
						} 
			
				//close section wrapper

				echo '</div>
				</section>';

				$this->after_block($instance);
			
		} else {
			//show nothing
		}
	}
	
}
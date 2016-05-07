<?php
/** A simple text block **/
class AQ_Blog_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Latest posts - blog',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_blog_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'categories' 		=> '',
			'nrposts'			=> 4,
			'subtitle'			=> 'Stories from',
			'title2'			=> 'The Blog',
			'subtitle_color' 	=> '#b2b2b2',
			'title_color' 		=> '#303030',
			'content_color' 	=> '#4b4b4b',
			'meta_color' 		=> '#b2b2b2',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$args['hide_empty'] = false;
		$terms = get_terms('category', $args);
		$categories_arr = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach($terms as $term) {
				$categories_arr[$term->term_id] = $term->name;
			}
		}
		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('categories') ?>">
				Categories to show posts from
				<?php echo aq_field_multiselect('categories', $block_id, $categories_arr, $categories ) ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of posts to show
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

		<div class="description half">
			<label for="<?php echo $this->get_field_id('content_color') ?>">
				Blog content color(default #4b4b4b)
				<?php echo aq_field_color_picker('content_color', $block_id, $content_color, $default = '#4b4b4b') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('meta_color') ?>">
				Blog meta info color(default #b2b2b2)
				<?php echo aq_field_color_picker('meta_color', $block_id, $meta_color, $default = '#b2b2b2') ?>
			</label>
		</div>

		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo '<div class="blog-container">';
		
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

        $id_blog = get_option('teo_blog_page');

        if($id_blog) {
        	$permalink = get_permalink($id_blog);
        	echo '<div class="col-sm-6">';
        	echo '<a class="see-blog" href="' . esc_url($permalink) . '">' . __('See Blog', 'teo') . ' <i class="music-plus-button"></i></a>';
        	echo '</div>';
        }

        echo '<div style="clear: both"></div>';

        echo '<div class="col-sm-12">';

		echo '<ul class="blog-posts">';
		$args = array();
		$args['post_type'] = 'post';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = $nrposts != 0 ? $nrposts : 4;
		$query = new WP_Query($args);
		while($query->have_posts() ) : $query->the_post(); 
			global $post;
			global $authordata;
			echo '
				<li class="blog-post">
                    <div class="row">
                      	<div class="col-sm-3">
                      		<a class="post-title" href="' . get_permalink() . '">' . get_the_title() . '</a>
                        	<ul class="info">
                          		<li>' . sprintf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
												esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
												esc_attr( sprintf( __( 'Posts by %s', 'teo' ), get_the_author() ) ),
												get_the_author() ) . 
								'</li>
                          		<li>/</li>
                          		<li>' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . __('ago', 'teo') . '</li>
                        	</ul>
                      	</div>
                      	<div class="col-sm-9">
                        	<div class="post-text">' . get_the_excerpt() . '</div>
                      	</div>
                    </div>
                    <a class="view" href="' . get_permalink() . '"><i class="music-eye"></i></a>
                </li>';
        endwhile; wp_reset_postdata();
        echo '</ul>';

        echo '</div>';

        echo '</div>';
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}
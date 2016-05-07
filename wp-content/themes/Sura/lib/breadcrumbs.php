<div class="header-text hidden-xs">
    <?php 
    if(function_exists('bcn_display')) {
	    echo '<h6>';
	    bcn_display();
	    echo '</h6>';
	}
	else if(function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<h6>','</h6>');
	} 
	else
    { 
    	global $wp_query;
		$query_vars = $wp_query->query_vars;
		?>
		<h6>
			<a href="<?php echo home_url(); ?>">
				<?php _e('Home','teo') ?>
			</a> 
			<span class="raquo">&raquo;</span>	
			<?php if( is_tag() ) { ?>
				<?php _e('Posts Tagged ','teo') ?>
				<span class="raquo">&quot;</span>
				<?php single_tag_title(); 
				echo('&quot;'); 
			} elseif (is_day()) { ?>
				<?php _e('Posts made in','teo') ?> 
				<?php echo ' '; the_time('F jS, Y'); 
			} elseif (is_month()) { ?>
				<?php _e('Posts made in','teo') ?> 
				<?php echo ' '; the_time('F, Y');
			} elseif (is_year()) {
				_e('Posts made in','teo') ?> 
				<?php echo ' '; the_time('Y');
			} elseif (is_search()) { ?>
				<?php _e('Search results for','teo') ?> 
				<?php echo ' ' . the_search_query();
			} elseif (is_product()) { 
				global $post;
				$product_term = NULL;
				if(teo_is_song($post->ID) ) {
					$terms = get_the_terms($post->ID, 'genre');
				}
				else {
					$terms = get_the_terms($post->ID, 'product_cat');
				}
				if ( $terms && ! is_wp_error( $terms ) ) {
					foreach($terms as $term) {
						$product_term = $term;
						break;
					}
				}
				if($term && is_object($term) ) {
					$catlink = get_term_link( $product_term );
					echo '<a href="' . esc_url($catlink) . '">' . $product_term->name . '</a> ';
					echo '<span class="raquo">&raquo;</span> ';
				}
				echo get_the_title();
			} elseif (is_single()) { 
				$category = get_the_category();
				$catlink = get_category_link( $category[0]->cat_ID );
				echo '<a href="' . esc_url($catlink) . '">' . $category[0]->cat_name . '</a> ';
				echo '<span class="raquo">&raquo;</span> ' . get_the_title();
			} elseif (is_tax()) { 
				$value    = $query_vars['term'];
				$taxonomy = $wp_query->query_vars['taxonomy'];
				$term = get_term_by('slug', $value, $taxonomy);
				echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
			} elseif (is_category()) { 
				single_cat_title();
			} elseif (is_author()) {
				$curauth = $wp_query->get_queried_object();
				_e('Posts by ','teo'); echo ' ',$curauth->nickname;
			} elseif (is_page()) { 
				the_title();
			} elseif (is_archive() ) {
				post_type_archive_title();
			}
			if(isset($query_vars['paged']) && $query_vars['paged'] > 1) {
				echo '<span class="raquo">&raquo;</span> ' . __('page', 'teo') . ' ' . (int)$query_vars['paged'];
			}
			?>
		</h6>
	<?php } ?>
</div>
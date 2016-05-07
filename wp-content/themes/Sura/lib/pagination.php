<div class="teo-pagination">
	<?php
	if(function_exists('wp_pagenavi')) 
		wp_pagenavi(); 
	else { 
		the_posts_pagination( array( 'mid_size' => 2, 'screen_reader_text' => ' ' ) );
	}
	?>
</div>
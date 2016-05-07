<?php
/* 
Template name: Page builder template
*/
get_header();
the_post();
?>
<div id="ajax-content">
	<?php the_content(''); ?>
</div>

<?php get_footer(); ?>
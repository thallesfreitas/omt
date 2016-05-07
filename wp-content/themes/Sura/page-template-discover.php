<?php
/* 
Template name: Discover landing page
*/
get_header();
the_post();
?>
<div id="ajax-content">
	<div class="row no-margin">
	    <?php if(teo_is_woo() ) { 
	    	$genres = get_terms('genre');
			$count = 0;
			if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
				$count = count($genres);
			}
			$attributes = wc_get_attribute_taxonomies();
			?>
		    <div class="col-sm-2 no-padding">
		        <div class="search-navigation">
		            <header>
		                <div class="title"><?php _e('Type', 'teo');?></div>
		                <ul role="tablist" class="nav nav-tabs">
		                    <li><a href="#albums" role="tab" data-toggle="tab" class="no-ajaxy"><?php _e('Albums', 'teo');?></a></li>
		                    <li class="active"><a href="#songs" role="tab" data-toggle="tab" class="no-ajaxy"><?php _e('Songs', 'teo');?></a></li>
		                </ul>
		            </header>
		            <div class="tab-content">
		                <div id="songs" class="tab-pane active fade in">
		                    <div class="navbar-header">
		                      	<button type="header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" class="navbar-toggle"><span class="sr-only">Toggle navigation</span>
		                        	<div class="text"><?php _e('Choose Browse Option', 'teo');?></div>
		                        	<i class="fa fa-angle-down"></i>
		                    	</button>
		                	</div>
			                <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse main-nav">
			                    <ul class="nav navbar-nav navbar-left">
			                        <li class="active">
			                        	<a href="#">
			                            	<div class="browse-by"><?php _e('Genre', 'teo');?></div>
			                            	<div class="extra"><?php echo sprintf(__('%s genres', 'teo'), $count);?></div>
			                            	<div class="show-more"><i class="fa fa-angle-right"></i></div>
			                            	<div class="show-less"><i class="fa fa-angle-down"></i></div>
			                            </a>
			                          	<ul>
			                          		<?php 
			                          		if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
			                          			foreach($genres as $genre) { ?>
			                          				<li><a href="<?php echo get_term_link($genre);?>"><?php echo esc_attr($genre->name);?></a></li>
			                          			<?php 
			                          			}
			                          		} 
			                          		?>
			                          	</ul>
			                        </li>
			                        <?php 
			                        foreach($attributes as $attribute) { 
			                        	$taxonomy_name = wc_attribute_taxonomy_name( $attribute->attribute_name );
			                        	$terms = get_terms($taxonomy_name);
			                        	$count = 0;
			                        	if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
			                        		$count = count($terms);
			                        	}
				                        ?>
				                        <li>
				                        	<a href="#">
				                            	<div class="browse-by"><?php echo $attribute->attribute_label;?></div>
				                            	<div class="extra"><?php echo sprintf(__('%s items', 'teo'), $count);?></div>
				                            	<div class="show-more"><i class="fa fa-angle-right"></i></div>
				                            	<div class="show-less"><i class="fa fa-angle-down"></i></div>
				                            </a>
				                            <ul>
				                          		<?php 
				                          		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				                          			foreach($terms as $term) { ?>
				                          				<li><a href="<?php echo get_term_link($term);?>"><?php echo esc_attr($term->name);?></a></li>
				                          			<?php 
				                          			}
				                          		} 
				                          		?>
				                          	</ul>
				                        </li>
				                    <?php } ?>
			                    </ul>
			                </div>
		            	</div>
		        		<div id="albums" class="tab-pane fade">
		        			<div class="navbar-header">
		                      	<button type="header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" class="navbar-toggle"><span class="sr-only">Toggle navigation</span>
		                        	<div class="text"><?php _e('Choose Browse Option', 'teo');?></div>
		                        	<i class="fa fa-angle-down"></i>
		                    	</button>
		                	</div>
			                <div id="bs-example-navbar-collapse-2" class="collapse navbar-collapse main-nav">
			                    <ul class="nav navbar-nav navbar-left">
			                    	<?php
			                    	$albums = get_terms('album', array('number' => 10));
									if ( ! empty( $albums ) && ! is_wp_error( $albums ) ) {
										foreach($albums as $album) {
											$args = array();
											$args['post_type'] = 'product';
											$args['tax_query'] = array(
												array(
													'taxonomy' => 'album',
													'field'    => 'term_id',
													'terms'    => $album->term_id,
												)
											);
											?>
					                        <li>
					                        	<a href="#">
					                            	<div class="browse-by"><?php echo esc_attr($album->name);?></div>
					                            	<div class="show-more"><i class="fa fa-angle-right"></i></div>
					                            	<div class="show-less"><i class="fa fa-angle-down"></i></div>
					                            </a>
					                          	<ul>
					                          		<?php 
					                          		$query = new WP_Query($args);
					                          		while($query->have_posts() ) : $query->the_post(); ?>
					                          			<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
					                          		<?php 
					                          		endwhile; wp_reset_postdata();
					                          		?> 
					                          	</ul>
					                        </li>
			                        	<?php 
			                        	}
			                        }
			                        ?>
			                    </ul>
			                </div>
		        		</div>
		        	</div>
		    	</div>
			</div>
		            
			<div class="col-sm-10 no-padding">
			    <div class="song-list-container">
			        <h6><?php _e('Discover', 'teo');?></h6>
			        <h3><?php _e('Music', 'teo');?></h3>
			        <div class="clearfix"></div>
			        <br /><br />
			        <div class="table-responsive">
			            <table class="table">
			                <tr>
			                    <th><?php _e('Name', 'teo');?></th>
			                    <th class="hidden-xs"><?php _e('Length', 'teo');?></th>
			                    <th class="hidden-xs"><?php _e('Genres', 'teo');?></th>
			                    <th><?php _e('Price', 'teo');?></th>
			                </tr>
			                <?php
			                $genres = get_terms('genre');
					        $genres_ids = array();
					        if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
					            foreach($genres as $genre) {
					                $genres_ids[] = $genre->term_id;
					            }
					        }
			                $args = array();
			                $args['post_type'] = 'product';
			                $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
		                	$args['paged'] = $paged;
		                	$args['tax_query'] = array(
					            array(
					                'taxonomy' => 'genre',
					                'terms'    => $genres_ids,
					            ),
					        );
			                query_posts($args);
			                if(have_posts() ) : while(have_posts() ) : the_post(); 
			                	global $product;
		                        $file = get_post_meta($post->ID, '_song_preview', true);

								if($file == '') {
									$files = get_post_meta($post->ID, '_downloadable_files', true);
			                        $mp3file = '';
				                    foreach($files as $file) {
				                        $file = $file['file'];
				                        break;
				                    }
				                }
				                
			                    $mp3file = new MP3File($file);
			                    @$duration = $mp3file->getDuration();

			                    $genres = get_the_terms( $post->ID, 'genre' );
			                    $genre_names = array();
			                    if ( $genres && ! is_wp_error( $genres ) ) {
			                        foreach($genres as $genre) {
			                            if(!isset($genre_names[$genre->term_id]) ) {
			                                $genre_names[$genre->term_id] = $genre->name;
			                            }
			                        }
			                    }
				                ?>
					            <tr class="song">
					                <td class="normal"><?php the_title();?></td>
					                <td class="normal hidden-xs"><?php echo MP3File::formatTime($duration);?></td>
					                <td class="normal hidden-xs"><?php echo implode(', ', $genre_names);?></td>
					                <td class="normal"><?php echo $product->get_price_html();?></td>
					                <td class="hover-row">
					                 	<a href="#" data-id="<?php echo $post->ID;?>" class="play-song play-song-individual">
					                  		<i class="music-player-play-outline play"></i>
					                       	<div class="song-title"><?php the_title();?></div>
					                    </a>
					                    <a href="#" class="pause-song">
					                  		<i class="music-player-pause play"></i>
					                  		<div class="song-title"><?php the_title();?></div>
					                    </a>
					                    <div class="song-options">
					                        <?php woocommerce_template_single_add_to_cart();?>
					                       	<?php get_template_part( 'templates/song', 'wishlist' );?>
							                <a href="<?php the_permalink();?>" class="view">
							                    <i class="play music-eye"></i>
							                </a>
					                    </div>
					                </td>
					            </tr>
				           	<?php
				            endwhile; ?>
				        </table>
				        <?php
				        get_template_part('lib/pagination');
				        else :
				        	echo '</table>';
				        	echo '<p>' . __('There are currently no songs available. Make sure the Sura plugin is installed and each post has a genre added!', 'teo') . '</p>';
				        endif;
				        wp_reset_query(); 
				        ?>
			        </div>
			    </div>
			</div>
		<?php } else { ?>
			<div class="col-sm-12 no-padding">
				<div class="song-list-container">
					<div class="alert alert-warning">
						<?php _e('Please install / enable WooCommerce and add some songs / genres / artists in order to use this page', 'teo');?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php get_footer();?>
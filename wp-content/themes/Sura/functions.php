<?php
add_action( 'after_setup_theme', 'teo_setup' );
if ( ! function_exists( 'teo_setup' ) ){
	function teo_setup(){
		load_theme_textdomain('teo', get_template_directory() .'/languages');
		require get_template_directory() . '/lib/custom-functions.php';
		require get_template_directory() . '/lib/comment.php';
 		require get_template_directory() . '/lib/meta_boxes.php';
		require get_template_directory() . '/lib/mp3file.class.php';
		require get_template_directory() . '/lib/woocommerce.php';
		require get_template_directory() . '/lib/widgets.php';
		require get_template_directory() . '/lib/custom_menu_walker/menu_class.php';
		require get_template_directory() . '/lib/theme_customizer/settings.php';
		require get_template_directory() . '/lib/class-tgm-plugin-activation.php';
	}
}

add_action( 'tgmpa_register', 'teo_register_required_plugins' );
function teo_register_required_plugins() {
	$plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Sura Custom Post Types and Taxonomies', // The plugin name.
            'slug'               => 'sura-teothemes', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/sura-teothemes.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'Sura Page Builder', // The plugin name.
            'slug'               => 'teothemes-page-builder', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/teothemes-page-builder.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
        ),

    );

    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

add_action('init', 'teo_pagebuilder', 99);

function teo_pagebuilder() {
	if(class_exists('AQ_Page_Builder') ) {
		require_once('lib/page_builder/section_block.php');
		require_once('lib/page_builder/artist_block.php');
		require_once('lib/page_builder/album_block.php');
		require_once('lib/page_builder/songs_block.php');
		require_once('lib/page_builder/artist_block_secondary.php');
		require_once('lib/page_builder/tour_block.php');
		require_once('lib/page_builder/album_fancy_block.php');
		require_once('lib/page_builder/merchandise_block.php');
		require_once('lib/page_builder/instagram_block.php');
		require_once('lib/page_builder/wooattributes_block.php');
		require_once('lib/page_builder/songs_slider_block.php');
		require_once('lib/page_builder/songs_block_alternative.php');
		require_once('lib/page_builder/calltoaction_block.php');
		require_once('lib/page_builder/blog_block.php');

		aq_register_block('AQ_Section_Block');
		
		aq_register_block('AQ_Artist_Block');
		aq_register_block('AQ_ArtistSecondary_Block');

		aq_register_block('AQ_Album_Block');	
		aq_register_block('AQ_FancyAlbum_Block');
		aq_register_block('AQ_Tour_Block');
		aq_register_block('AQ_Songs_Block');
		aq_register_block('AQ_Merchandise_Block');
		aq_register_block('AQ_Instagram_Block');
		aq_register_block('AQ_WooAttributes_Block');
		aq_register_block('AQ_SongsSlider_Block');
		aq_register_block('AQ_SongsAlt_Block');
		aq_register_block('AQ_Calltoaction_Block');
		aq_register_block('AQ_Blog_Block');
	}
}

add_action('init', 'teo_support');
if( !function_exists('teo_support')) {
	function teo_support() {
		add_theme_support( 'post-thumbnails');
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5' );
	}
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once get_template_directory() . '/lib/meta_boxes/init.php';

}


add_action('init', 'teo_sidebars') ;
function teo_sidebars() {
	$args = array(
		'name'          => 'Merchandise sidebar',
		'before_widget' => '<div id="%1$s" class="merchandise-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>' 
	);
	register_sidebar($args);

	$args = array(
		'name'          => 'Footer 1/3 Column',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>' 
	);
	register_sidebar($args);

	$args = array(
		'name'          => 'Footer 2/3 Column',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>' 
	);
	register_sidebar($args);

	$args = array(
		'name'          => 'Footer 3/3 Column',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>' 
	);
	register_sidebar($args);
}
// Loading css/js files into the theme
add_action('wp_enqueue_scripts', 'teo_scripts');
if ( !function_exists('teo_scripts') ) {
	function teo_scripts() {
		wp_enqueue_style( 'libraries', get_template_directory_uri() . '/css/libraries.min.css', array(), '1.0');
		wp_enqueue_style( 'libraries', get_template_directory_uri() . '/css/mcustomscrollbar.css', array(), '1.0');
		wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0');

		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-slider');
		wp_enqueue_script( 'libraries', get_template_directory_uri() . '/js/libraries.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'jplayer-playlist', get_template_directory_uri() . '/js/add-on/jplayer.playlist.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'jquery.scrollto', get_template_directory_uri() . '/js/jquery.scrollto.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'jquery.history', get_template_directory_uri() . '/js/jquery.history.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'ajaxify', get_template_directory_uri() . '/js/ajaxify.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'init-misc', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0', true);
		wp_localize_script( 'main', 'MyAjax', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
		wp_localize_script( 'main', 'MyVar', array( 'path' => get_template_directory_uri(), 'count' => 0, 'pluginpath' => plugins_url() ) );

		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
	}

}

//add_action('wp_head', 'teo_default_playersong');

function teo_default_playersong() {
	if(!is_single() ) {
		$song = get_theme_mod('teo_default_song', '');
		if($song != '') {
			global $teo_songs, $teo_songs_count;

			$post = get_post($song);

			$artists = get_the_terms( $post->ID, 'artist' );
			$artist_names = array();
			if ( $artists && ! is_wp_error( $artists ) ) {
			    foreach($artists as $artist) {
			        if(!isset($artist_names[$artist->term_id]) ) {
			            $artist_names[$artist->term_id] = $artist->name;
			        }
			    }
			}

			$files = get_post_meta($post->ID, '_downloadable_files', true);
			$mp3file = '';

			if(is_array($files) ) {
				foreach($files as $file) {
				    $file = $file['file'];
				    break;
				}
			}

			if(isset($file) ) {
				$song_array = array();
				$song_array['index'] = $teo_songs_count;
				$song_array['title'] = get_the_title($post->ID);
				$song_array['artist'] = implode(', ', $artist_names);
				$song_array['mp3'] = $file;
				$teo_songs[] = $song_array;
				$teo_songs_count++;
			}
		}
	}
}


//add_action('wp_footer', 'teo_load_playersongs', 110);

function teo_load_playersongs() {
	global $teo_songs;
	$songs = json_encode($teo_songs);
	echo '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				songs = ' . $songs . ';
			      myPlaylist = new jPlayerPlaylist({
			        jPlayer: "#jpId",
			        cssSelectorAncestor: ".audio-player"
			      }, songs, {
			        playlistOptions: {
			          enableRemoveControls: false
			        },
			        swfPath: "/plugins/jplayer",
			        supplied: "mp3",
			        smoothPlayBar: true,
			        keyEnabled: true,
			        audioFullScreen: true
			      });
				jQuery(".play-song").click(function() {
			        var index;
			        index = jQuery(this).data("play");
			        myPlaylist.play(index);
			        return false;
			    });
			    jQuery(".song").find(".pause-song").click(function() {
			        var item;
			        item = jQuery(this).closest(".song");
			        item.find(".play-song-individual").css("display", "block");
			        item.find(".pause-song").css("display", "none");
			        myPlaylist.pause();
			        return false;
			    });

				jQuery(".song").find(".play-song-individual").click(function() {
			        var index, item;
			        item = jQuery(this).closest(".song");
			        jQuery(".play-song-individual").css("display", "block");
			        jQuery(".pause-song").css("display", "none");
			        item.find(".play-song-individual").css("display", "none");
			        item.find(".pause-song").css("display", "block");
			        index = jQuery(this).data("play");
			        myPlaylist.play(index);
			        return false;
			    });

			});
		</script>
	';
}

add_action( 'admin_enqueue_scripts', 'teo_admin_scripts' );

function teo_admin_scripts($hook) {
    if ( 'edit-tags.php' != $hook ) {
        return;
    }

    wp_enqueue_style('thickbox'); // call to media files in wp
    wp_enqueue_script('thickbox');
    wp_enqueue_script( 'media-upload'); 

    wp_enqueue_script( 'admin-customscripts', get_template_directory_uri() . '/js/admin_scripts.js', array('jquery', 'thickbox', 'media-upload'));
}



//Loading the custom CSS from the theme options panel with a priority of 11, so it loads after the other css files

add_action('wp_head', 'teo_custom_css', 11);
function teo_custom_css() {
	global $redux_demo;
	if(isset($redux_demo['css-code']) && $redux_demo['css-code'] != '')
			echo '<style type="text/css">' . $redux_demo['css-code'] . '</style>';
}

function teo_register_menus() {
	register_nav_menus( array( 'top-menu' => 'Top primary menu',
							   'left-menu'	=> 'Left Menu Header 1'
							 )
	);
}
add_action('init', 'teo_register_menus');

function teo_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php 
}
if ( ! isset( $content_width ) ) $content_width = 990;

//add to cart ajax actions

add_action( 'wp_ajax_teo_addtocart', 'teo_add_to_cart' );
add_action( 'wp_ajax_nopriv_teo_addtocart', 'teo_add_to_cart' );

function teo_add_to_cart() {
	$id = $_POST['product_id'];
	if ( class_exists( 'WooCommerce' ) ) {
		global $cart;
		$cart = WC()->instance()->cart;
		$cart->add_to_cart($id, 1);
	}
    exit;
}

add_action( 'wp_ajax_teo_removefromcart', 'teo_remove_from_cart' );
add_action( 'wp_ajax_nopriv_removefromcart', 'teo_remove_from_cart' );

function teo_remove_from_cart($id = 0) {
	if($id == 0) {
		$id = $_POST['product_id'];
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$cart = WC()->instance()->cart;
		$cart_id = $cart->generate_cart_id($id);
		$cart_item_id = $cart->find_product_in_cart($cart_id);

		if($cart_item_id){
		   $cart->set_quantity($cart_item_id,0);
		}
	}
    if($id == 0) {
    	exit;
    }
}

//add to wishlist ajax actions

add_action( 'wp_ajax_teo_addtowishlist', 'teo_add_to_wishlist' );
add_action( 'wp_ajax_nopriv_teo_addtowishlist', 'teo_add_to_wishlist' );

function teo_add_to_wishlist() {
	$id = $_POST['product_id'];
	if(!in_array($id, $_SESSION['teo_wishlist']) ) {
		$_SESSION['teo_wishlist'][] = $id;
	}
    exit;
}

add_action( 'wp_ajax_teo_removefromwishlist', 'teo_remove_from_wishlist' );
add_action( 'wp_ajax_nopriv_teo_removefromwishlist', 'teo_remove_from_wishlist' );

function teo_remove_from_wishlist() {
	$id = $_POST['product_id'];
	$key = array_search($id, $_SESSION['teo_wishlist']);
	if($key !== false){
		unset($_SESSION['teo_wishlist'][$key]);
	}
    exit;
}


add_action('init', 'teo_process_actions' );

function teo_process_actions() {
	global $teo_errors, $teo_valid, $teo_reset;
	if(isset($_POST['header_register']) ) {
		$username = sanitize_user($_POST['teo_username']);
		$email = sanitize_email($_POST['teo_email']);
		$password = $_POST['teo_password'];
		$teo_errors = array();
	    if($email == '') {
	        $teo_errors[] = __('You must add an e-mail address', 'teo');
	    }
	    if($username == '') {
	        $teo_errors[] = __('You must add a username', 'teo');
	    }
	    if($password == '') {
	        $teo_errors[] = __('The password is empty.', 'teo');
	    }
	    if(username_exists($username) ) {
	    	$teo_errors[] = __('The username already exists');
	    }
	    if(email_exists($email) ) {
	    	$teo_errors[] = __('The e-mail already exists');
	    }
	    if(count($teo_errors) == 0) {
	        //all is good
	        $hash = wp_hash_password($password);
	        $user = wp_create_user($username, $password, $email);
	        if( is_wp_error( $user ) ) {
	            $teo_errors[] = $user->get_error_message();
	        }
	        else {
	        	$teo_valid = 1;
	        	teo_wp_new_user_notification($user, $password);
	        }
	    }
	}

	if(isset($_POST['header_login']) ) {
		$teo_errors = array();
		$username = sanitize_user($_POST['teo_username']);
	    $password = $_POST['teo_password'];
	    $creds = array();
	    $creds['user_login'] = $username;
	    $creds['user_password'] = $password;
	    $creds['remember'] = true;
	    $user = wp_signon( $creds, false );
	    if ( is_wp_error($user) ) {
	        $teo_errors[] = $user->get_error_message();
	    }
	}

	if(isset($_POST['header_reset']) ) {
		global $wpdb, $current_site;

		$user_login = sanitize_email($_POST['teo_email']);
		
		if ( empty( $user_login ) ) {
			return false;
		} else if ( strpos( $user_login, '@' ) ) {
			$user_data = get_user_by( 'email', trim( $user_login ) );
			if ( empty( $user_data ) )
				return false;
		} else {
			$login = trim($user_login);
			$user_data = get_user_by('login', $login);
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 */
		do_action( 'lostpassword_post' );

		if ( !$user_data ) {
			return false;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.0
		 * @deprecated 1.5.1 Misspelled. Use 'retrieve_password' hook instead.
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retreive_password', $user_login );

		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.1
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retrieve_password', $user_login );

		/**
		 * Filter whether to allow a password to be reset.
		 *
		 * @since 2.7.0
		 *
		 * @param bool true           Whether to allow the password to be reset. Default true.
		 * @param int  $user_data->ID The ID of the user attempting to reset a password.
		 */
		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( ! $allow )
			return new WP_Error('no_password_reset', __('Password reset is not allowed for this user'));
		else if ( is_wp_error($allow) )
			return $allow;

		// Generate something random for a password reset key.
		$key = wp_generate_password( 20, false );

		/**
		 * Fires when a password reset key is generated.
		 *
		 * @since 2.5.0
		 *
		 * @param string $user_login The username for the user.
		 * @param string $key        The generated password reset key.
		 */
		do_action( 'retrieve_password_key', $user_login, $key );

		// Now insert the key, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . WPINC . '/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

		$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
		$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
		$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

		if ( is_multisite() )
			$blogname = $GLOBALS['current_site']->site_name;
		else
			/*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		$title = sprintf( __('[%s] Password Reset'), $blogname );

		/**
		 * Filter the subject of the password reset email.
		 *
		 * @since 2.8.0
		 *
		 * @param string $title Default email title.
		 */
		$title = apply_filters( 'retrieve_password_title', $title );

		/**
		 * Filter the message body of the password reset mail.
		 *
		 * @since 2.8.0
		 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $message    Default mail message.
		 * @param string  $key        The activation key.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

		if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
			wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.') );

		$teo_reset = 1;
	}
}

// Redefine user notification function
function teo_wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
    $user = new WP_User($user_id);

    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email);

    if ( empty($plaintext_pass) )
        return;

    $message  = __('Hi there,') . "\r\n\r\n";
    $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
    $message .= wp_login_url() . "\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
    $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
    $message .= sprintf(__('If you have any problems, please contact me at %s. If it\'s not you that registered with this e-mail address, please let us know!'), get_option('admin_email')) . "\r\n\r\n";
    $message .= __('Have a nice day!');

    wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);
}

add_action( 'wp_ajax_teo_defaultsongs', 'teo_defaultsongs' );
add_action( 'wp_ajax_nopriv_teo_defaultsongs', 'teo_defaultsongs' );

function teo_defaultsongs() {
	$variation = get_theme_mod('teo_default_song', '');
	$variation = 0;
	$songs = array();
	$index = 0;
	$post = get_post($variation);
	if($post) {
		$product = new WC_Product($post);
		$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$thumb = teo_resize($image, 96, 96 );

		$cart = WC()->instance()->cart;
		$cart_id = $cart->generate_cart_id($product->id);
		$cart_item_id = $cart->find_product_in_cart($cart_id);

		$artists = get_the_terms( $post->ID, 'artist' );
		$artist_names = array();
		if ( $artists && ! is_wp_error( $artists ) ) {
		    foreach($artists as $artist) {
		        if(!isset($artist_names[$artist->term_id]) ) {
		            $artist_names[$artist->term_id] = $artist->name;
		        }
		    }
		}
		$file = get_post_meta($post->ID, '_song_preview', true);

		if($file == '') {
		    $files = get_post_meta($post->ID, '_downloadable_files', true);
		    $mp3file = '';

		    if(is_array($files) ) {
		        foreach($files as $file) {
		            $file = $file['file'];
		            break;
		        }
		    }
		}

		$song_array = array();
		$song_array['song_id'] = $post->ID;
		$song_array['thumbnail'] = $thumb;
		$song_array['title'] = $post->post_title;
		$song_array['artist'] = implode(', ', $artist_names);
		$song_array['mp3'] = $file;
		$song_array['permalink'] = get_permalink($post->ID);
		$song_array['price'] = $product->get_price();
		$song_array['currency'] = html_entity_decode(get_woocommerce_currency_symbol() );
		
		if($cart_item_id) {
			$song_array['cart_added'] = 1;
		}
		else {
			$song_array['cart_added'] = 0;
		}

		if(isset($_SESSION['teo_wishlist']) && in_array($post->ID, $_SESSION['teo_wishlist']) ) {
			$song_array['wishlist_added'] = 1;
		}
		else {
			$song_array['wishlist_added'] = 0;
		}

		$songs[] = $song_array;
	}
	$args = array();
	if($post) {
		$args['post__not_in'] = (array)$post->ID;
	}
	$args['posts_per_page'] = 5;
	$args['post_type'] = 'product';
	$query = new WP_Query($args);
	while($query->have_posts() ) : $query->the_post(); global $post;
		$product = new WC_Product($post);
		$artists = get_the_terms( $post->ID, 'artist' );
		$artist_names = array();
		if ( $artists && ! is_wp_error( $artists ) ) {
		    foreach($artists as $artist) {
		        if(!isset($artist_names[$artist->term_id]) ) {
		            $artist_names[$artist->term_id] = $artist->name;
		        }
		    }
		}
		$file = get_post_meta($post->ID, '_song_preview', true);

		if($file == '') {
		    $files = get_post_meta($post->ID, '_downloadable_files', true);
		    $mp3file = '';

		    if(is_array($files) ) {
		        foreach($files as $file) {
		            $file = $file['file'];
		            break;
		        }
		    }
		}
		$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$thumb = teo_resize($image, 96, 96 );

		$cart = WC()->instance()->cart;
		$cart_id = $cart->generate_cart_id($product->id);
		$cart_item_id = $cart->find_product_in_cart($cart_id);

		$song_array = array();
		$song_array['song_id'] = $post->ID;
		$song_array['thumbnail'] = $thumb;
		$song_array['title'] = get_the_title();
		$song_array['artist'] = implode(', ', $artist_names);
		$song_array['mp3'] = $file;
		$song_array['permalink'] = get_permalink();
		$song_array['price'] = $product->get_price();
		$song_array['currency'] = html_entity_decode(get_woocommerce_currency_symbol() );

		if($cart_item_id) {
			$song_array['cart_added'] = 1;
		}
		else {
			$song_array['cart_added'] = 0;
		}

		if(isset($_SESSION['teo_wishlist']) && in_array($post->ID, $_SESSION['teo_wishlist']) ) {
			$song_array['wishlist_added'] = 1;
		}
		else {
			$song_array['wishlist_added'] = 0;
		}

		$songs[] = $song_array;

	endwhile;
	echo json_encode($songs);
	die;
}


add_action( 'wp_ajax_teo_songdetails', 'teo_song_details' );
add_action( 'wp_ajax_nopriv_teo_songdetails', 'teo_song_details' );

function teo_song_details() {
	$id = (int)$_POST['song_id'];
	if($id == 0) {
		exit;
	}
	$query = new WP_Query( 'post_type=product&p=' . $id );
	if($query->have_posts() ) : $query->the_post(); global $post;
		$product = new WC_Product($post);
		$artists = get_the_terms( $post->ID, 'artist' );
		$artist_names = array();
		if ( $artists && ! is_wp_error( $artists ) ) {
		    foreach($artists as $artist) {
		        if(!isset($artist_names[$artist->term_id]) ) {
		            $artist_names[$artist->term_id] = $artist->name;
		        }
		    }
		}
		$file = get_post_meta($post->ID, '_song_preview', true);

		if($file == '') {
		    $files = get_post_meta($post->ID, '_downloadable_files', true);
		    $mp3file = '';

		    if(is_array($files) ) {
		        foreach($files as $file) {
		            $file = $file['file'];
		            break;
		        }
		    }
		}
	endif;

	$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	$thumb = teo_resize($image, 96, 96 );

	$cart = WC()->instance()->cart;
	$cart_id = $cart->generate_cart_id($product->id);
	$cart_item_id = $cart->find_product_in_cart($cart_id);

	$song_array = array();
	$song_array['song_id'] = $post->ID;
	$song_array['thumbnail'] = $thumb;
	$song_array['title'] = get_the_title();
	$song_array['artist'] = implode(', ', $artist_names);
	$song_array['mp3'] = $file;
	$song_array['permalink'] = get_permalink();
	$song_array['price'] = $product->get_price();
	$song_array['currency'] = html_entity_decode(get_woocommerce_currency_symbol() );
	
	if($cart_item_id) {
		$song_array['cart_added'] = 1;
	}
	else {
		$song_array['cart_added'] = 0;
	}

	if(isset($_SESSION['teo_wishlist']) && in_array($post->ID, $_SESSION['teo_wishlist']) ) {
		$song_array['wishlist_added'] = 1;
	}
	else {
		$song_array['wishlist_added'] = 0;
	}

	echo json_encode($song_array);
    exit;
}

add_action('init', 'teo_start_session', 1);

function teo_start_session() {
    if(!session_id()) {
        session_start();
    }
}

function teo_is_song($post_id) {
	$files = get_post_meta($post_id, '_downloadable_files', true);
	if($post_id != 0 && is_array($files) && count($files) > 0) {
		return true;
	}
	return false;
}

function teo_is_woo() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	return false;
}

?>
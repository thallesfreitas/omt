<?php
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function teo_customizer( $wp_customize ) {
	require 'featured_song_class.php';
		
	$wp_customize->add_section( 
		'teo_logo_section' ,
		array(
			'title'       => __( 'Logo', 'teo' ),
			'priority'    => 30,
			'description' => 'Upload a logo to replace the default site name and description in the header',
		)
	);
	$wp_customize->add_setting( 'teo_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'teo_logo', array(
		'label'    			=> __( 'Logo', 'teo' ),
		'section'  			=> 'teo_logo_section',
		'settings' 			=> 'teo_logo',
		'sanitize_callback' => 'esc_url'
	) ) );

	$wp_customize->add_section( 
		'teo_favicon_section' ,
		array(
			'title'       => __( 'Favicon', 'teo' ),
			'priority'    => 30,
			'description' => 'Upload a favicon to replace the default site name and description in the header',
		)
	);
	$wp_customize->add_setting( 'teo_favicon' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'teo_favicon', array(
		'label'    			=> __( 'Favicon', 'teo' ),
		'section'  			=> 'teo_favicon_section',
		'settings' 			=> 'teo_favicon',
		'sanitize_callback'	=> 'esc_url'
	) ) );

	$wp_customize->add_section( 
		'teo_websitetype_section' ,
		array(
			'title'       => __( 'Website type', 'teo' ),
			'priority'    => 30,
			'description' => "Whether you'll use the site as an artist or as an application.",
		)
	);

	$wp_customize->add_setting( 'teo_website_type' );
	$wp_customize->add_control(
		'teo_website_type',
		array(
			'label'				=> 'Header variation',
			'section'			=> 'teo_websitetype_section',
			'type'           	=> 'radio',
            'choices'        	=> array(
                1   		=> __( 'Single artist(related artists and other such artist info will be hidden)' ),
                2  			=> __( 'Music web application(multiple artists)' ),
            ),
            'sanitize_callback'	=> 'esc_attr'
		)
	);


	$wp_customize->add_section( 
		'teo_header_section' ,
		array(
			'title'       => __( 'Header info', 'teo' ),
			'priority'    => 30,
			'description' => 'Info about the header variation used.',
		)
	);

	$wp_customize->add_setting( 'teo_header_variation' );
	$wp_customize->add_control(
		'teo_header_variation',
		array(
			'label'				=> 'Header variation',
			'section'			=> 'teo_header_section',
			'type'           	=> 'radio',
            'choices'        	=> array(
                1   		=> __( 'Header 1(left icons menu + top search bar)' ),
                2  			=> __( 'Header 2(standard top menu + search bar and woocommerce icons on the right)' ),
                3  			=> __( 'Header 3(same as header 2, except with breadcrumbs and background image)' ),
                4  			=> __( 'Header 4(same as header 3, but with one more top bar with a notification on the left + register / login on the right)' )
            ),
            'sanitize_callback'	=> 'esc_attr'
		)
	);

	$wp_customize->add_setting( 'teo_header_bgimage' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'teo_header_bgimage', array(
		'label'    			=> __( 'Variation 3 / 4 background image', 'teo' ),
		'section'  			=> 'teo_header_section',
		'settings' 			=> 'teo_header_bgimage',
		'sanitize_callback'	=> 'esc_url'
	) ) );

	$wp_customize->add_setting( 'teo_variation4_text' );
	$wp_customize->add_control(
		'teo_variation4_text',
		array(
			'label'				=> 'Variation 4 top notification text(latest album/post/etc)',
			'section'			=> 'teo_header_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_attr'
		)
	);

	$wp_customize->add_setting( 'teo_variation4_url' );
	$wp_customize->add_control(
		'teo_variation4_url',
		array(
			'label'				=> 'Variation 4 top notification text URL',
			'section'			=> 'teo_header_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_variation4_date' );
	$wp_customize->add_control(
		'teo_variation4_date',
		array(
			'label'				=> 'Variation 4 top date(if you want to show a date)',
			'section'			=> 'teo_header_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);


	$wp_customize->add_section( 
		'teo_player_section' ,
		array(
			'title'       => __( 'Featured player song', 'teo' ),
			'priority'    => 30,
			'description' => 'The song to play by default in the footer player',
		)
	);
	$wp_customize->add_setting( 'teo_default_song' );
	$wp_customize->add_control( new Teo_Featured_Song_Custom_Control( $wp_customize, 'teo_default_song', array(
		'label'    			=> __( 'Default song in the player', 'teo' ),
		'section'  			=> 'teo_player_section',
		'settings' 			=> 'teo_default_song',
		'sanitize_callback'	=> 'esc_attr'
	) ) );

	$wp_customize->add_section( 
		'teo_song_section' ,
		array(
			'title'       => __( 'Single Song social variation', 'teo' ),
			'priority'    => 30,
			'description' => 'Info about the kind of social icons to be shown.',
		)
	);

	$wp_customize->add_setting( 'teo_songs_variation' );
	$wp_customize->add_control(
		'teo_songs_variation',
		array(
			'label'				=> 'Social Icons variation',
			'section'			=> 'teo_song_section',
			'type'           	=> 'radio',
            'choices'        	=> array(
                'dark'   	=> __( 'Light Version' ),
                'light'  	=> __( 'Dark Version' )
            ),
            'sanitize_callback'	=> 'esc_attr'
		)
	);

	$wp_customize->add_section( 
		'teo_footer_section' ,
		array(
			'title'       => __( 'Footer info', 'teo' ),
			'priority'    => 30,
			'description' => 'Info about the footer variation used.',
		)
	);

	$wp_customize->add_setting( 'teo_footer_variation' );
	$wp_customize->add_control(
		'teo_footer_variation',
		array(
			'label'				=> 'Footer variation',
			'section'			=> 'teo_footer_section',
			'type'           	=> 'radio',
            'choices'        	=> array(
                1   		=> __( 'Widgetized footer' ),
                2  			=> __( 'Background image + social icons / copyright info' )
            ),
            'sanitize_callback'	=> 'esc_attr'
		)
	);


	$wp_customize->add_setting( 'teo_variation2_bgimage' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'teo_variation2_bgimage', array(
		'label'    			=> __( 'Variation 2 background image', 'teo' ),
		'section'  			=> 'teo_footer_section',
		'settings' 			=> 'teo_variation2_bgimage',
		'sanitize_callback'	=> 'esc_url'
	) ) );

	$wp_customize->add_setting( 'teo_variation2_text' );
	$wp_customize->add_control(
		'teo_variation2_text',
		array(
			'label'				=> 'Footer Variation 2 text',
			'section'			=> 'teo_footer_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_attr'
		)
	);
	
	$wp_customize->add_section( 
		'teo_social_section' ,
		array(
			'title'       => __( 'Social', 'teo' ),
			'priority'    => 31,
			'description' => 'Provide social media profiles',
		)
	);

	$wp_customize->add_setting( 'teo_social_itunes' );
	$wp_customize->add_control(
		'teo_social_itunes',
		array(
			'label'				=> 'iTunes URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_social_spotify' );
	$wp_customize->add_control(
		'teo_social_spotify',
		array(
			'label'				=> 'Spotify URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'

		)
	);

	$wp_customize->add_setting( 'teo_social_soundcloud' );
	$wp_customize->add_control(
		'teo_social_soundcloud',
		array(
			'label'				=> 'SoundCloud URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_social_fb' );
	$wp_customize->add_control(
		'teo_social_fb',
		array(
			'label'				=> 'Facebook URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_social_twitter' );
	$wp_customize->add_control(
		'teo_social_twitter',
		array(
			'label'				=> 'Twitter link',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_social_instagram' );
	$wp_customize->add_control(
		'teo_social_instagram',
		array(
			'label'				=> 'Instagram URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);


	$wp_customize->add_setting( 'teo_social_vine' );
	$wp_customize->add_control(
		'teo_social_vine',
		array(
			'label'				=> 'Vine URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);

	$wp_customize->add_setting( 'teo_social_rss' );
	$wp_customize->add_control(
		'teo_social_rss',
		array(
			'label'				=> 'Rss URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);
	$wp_customize->add_setting( 'teo_social_linkedin' );
	$wp_customize->add_control(
		'teo_social_linkedin',
		array(
			'label'				=> 'Linkedin URL',
			'section'			=> 'teo_social_section',
			'type'				=> 'text',
			'sanitize_callback'	=> 'esc_url'
		)
	);
}

add_action( 'customize_register', 'teo_customizer' );

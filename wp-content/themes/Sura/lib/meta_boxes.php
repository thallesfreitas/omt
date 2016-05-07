<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$categories = get_terms( 'category', array( 'hide_empty' => '0' ) );
	$cats = array();
	foreach($categories as $cat) {
		$cats[$cat->term_id] = $cat->name;
	}

	$prefix = '_landing_';

	$meta_boxes[] = array(
		'id'         => 'landing_metabox',
		'title'      => 'Landing page details',
		'show_on'    => array( 'key' => 'page-template', 'value' => array('page-template-landing.php') ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Back custom text', // <label>
			    'desc'  => 'Shows up blurry and "behind" the front text', // description
			    'id'    => $prefix . 'backtext', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Front custom text', // <label>
			    'desc'  => 'Shows up "over" the back text', // description
			    'id'    => $prefix . 'fronttext', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Information - line 1', // <label>
			    'desc'  => 'Some information that will show up on one line. Examples: Artist name, album name, latest song name, etc', // description
			    'id'    => $prefix . 'info1', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Information - line 2(optional)', // <label>
			    'desc'  => 'If you need an extra line to add some info, use this one.', // description
			    'id'    => $prefix . 'info2', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Information - line 3(optional)', // <label>
			    'desc'  => 'If you need an extra line to add some info, use this one.', // description
			    'id'    => $prefix . 'info3', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Button Text', // <label>
			    'desc'  => 'The text on the bottom call to action button', // description
			    'id'    => $prefix . 'buttontext', // field id and name
			    'type'  => 'text', // type of field,
			    'std'	=> 'Continue to site'
			),
			array( // Text Input
			    'name' => 'Button URL', // <label>
			    'desc'  => 'The URL of the above call to action button', // description
			    'id'    => $prefix . 'buttonurl', // field id and name
			    'type'  => 'text', // type of field,
			    'std'	=> esc_url( home_url() )
			),
		)
	);

	$prefix = '_about_';

	$meta_boxes[] = array(
		'id'         => 'about_metabox',
		'title'      => 'About artist page template details',
		'show_on'    => array( 'key' => 'page-template', 'value' => array('page-template-about.php') ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Avatar', // <label>
			    'desc'  => 'The avatar of the artist(120x120px or 240x240px for retina)', // description
			    'id'    => $prefix . 'avatar', // field id and name
			    'type'  => 'file', // type of field,
			),
			array( // Text Input
			    'name' => 'iTunes URL', // <label>
			    'desc'  => 'iTunes social URL(if used)', // description
			    'id'    => $prefix . 'itunes', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Spotify URL', // <label>
			    'desc'  => 'Spotify social URL(if used)', // description
			    'id'    => $prefix . 'spotify', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'SoundCloud URL', // <label>
			    'desc'  => 'SoundCloud social URL(if used)', // description
			    'id'    => $prefix . 'soundcloud', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Facebook URL', // <label>
			    'desc'  => 'Facebook social URL(if used)', // description
			    'id'    => $prefix . 'facebook', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Twitter URL', // <label>
			    'desc'  => 'Twitter social URL(if used)', // description
			    'id'    => $prefix . 'twitter', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Instagram URL', // <label>
			    'desc'  => 'Instagram social URL(if used)', // description
			    'id'    => $prefix . 'instagram', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Vine URL', // <label>
			    'desc'  => 'Vine social URL(if used)', // description
			    'id'    => $prefix . 'vine', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'LinkedIn URL', // <label>
			    'desc'  => 'LinkedIn social URL(if used)', // description
			    'id'    => $prefix . 'linkedin', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Description', // <label>
			    'desc'  => 'Artist description text', // description
			    'id'    => $prefix . 'description', // field id and name
			    'type'  => 'textarea', // type of field,
			),
			array( // Text Input
			    'name' => 'Contact e-mail', // <label>
			    'desc'  => 'If you want to let your visitors contact you via e-mail, fill this', // description
			    'id'    => $prefix . 'email', // field id and name
			    'type'  => 'text', // type of field,
			),
		)
	);

	if(post_type_exists('event') ) {
		$prefix = '_event_';

		$meta_boxes[] = array(
			'id'         => 'event_metabox',
			'title'      => 'Event details',
			'pages'      => array( 'event', ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array( // Text Input
				    'name' => 'Event date', // <label>
				    'desc'  => 'The date of the event', // description
				    'id'    => $prefix . 'date', // field id and name
				    'type'  => 'text_date', // type of field,
				),
				array( // Text Input
				    'name' => 'Venue', // <label>
				    'desc'  => 'Information about the venue', // description
				    'id'    => $prefix . 'venue', // field id and name
				    'type'  => 'text', // type of field,
				),
				array( // Text Input
				    'name' => 'Location', // <label>
				    'desc'  => 'Information about the event location', // description
				    'id'    => $prefix . 'location', // field id and name
				    'type'  => 'text', // type of field,
				),
				array( // Text Input
				    'name' => 'Tickets URL', // <label>
				    'desc'  => 'The URL from where tickets can be purchased', // description
				    'id'    => $prefix . 'url', // field id and name
				    'type'  => 'text', // type of field,
				),
			)
		);
	}

	$prefix = '_events_';

	$meta_boxes[] = array(
		'id'         => 'events_metabox',
		'title'      => 'Custom info for the events page template',
		'show_on'    => array( 'key' => 'page-template', 'value' => array('page-template-events.php') ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Number of events', // <label>
			    'desc'  => 'The number of events shown!', // description
			    'id'    => $prefix . 'nrevents', // field id and name
			    'type'  => 'text', // type of field,
			    'std' => 6
			    ),
			array(
				'name'     => 'Date info',
				'desc'     => 'Information about the dates of the events(for example the date of the first one - the date of the last one)',
				'id'       => $prefix . 'date',
				'type'     => 'text',
				'std' 	   => ''
			),
		)
	);

	$prefix = '_song_';

	$meta_boxes[] = array(
		'id'         => 'song_metabox',
		'title'      => 'Song details',
		'pages'      => array( 'product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __( 'Preview song for the footer player', 'cmb' ),
				'desc' => __( "A preview of the song, playable in the footer player. Full song will be used if you don't add a preview.", 'cmb' ),
				'id'   => $prefix . 'preview',
				'type' => 'file',
			),
			array( // Text Input
			    'name' => 'Released date', // <label>
			    'desc'  => 'The released date of the song', // description
			    'id'    => $prefix . 'date', // field id and name
			    'type'  => 'text_date', // type of field,
			),
			array( // Text Input
			    'name' => 'iTunes URL', // <label>
			    'desc'  => 'The iTunes URL to purchase the song, if applicable', // description
			    'id'    => $prefix . 'itunes', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Spotify URL', // <label>
			    'desc'  => 'The Spotify URL to purchase the song, if applicable', // description
			    'id'    => $prefix . 'spotify', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'Amazon URL', // <label>
			    'desc'  => 'The Amazon URL to purchase the song, if applicable', // description
			    'id'    => $prefix . 'amazon', // field id and name
			    'type'  => 'text', // type of field,
			),
			array( // Text Input
			    'name' => 'BeatPort URL', // <label>
			    'desc'  => 'The BeatPort URL to purchase the song, if applicable', // description
			    'id'    => $prefix . 'beatport', // field id and name
			    'type'  => 'text', // type of field,
			),
		)
	);

	return $meta_boxes;
}
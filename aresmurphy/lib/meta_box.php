<?php
/**
 * Admin feature for Custom Meta Box
 *
 * @author 		Themeum
 * @category 	Admin Core
 * @package 	Varsity
 *-------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Registering meta boxes
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themeum_core_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_core_register_meta_boxes( $meta_boxes )
{

	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */

	// Better has an underscore as last sign
	$prefix = 'themeum_';
		$contact_forms = array();
	    $contact_forms = get_all_posts('wpcf7_contact_form');
	    $contact_forms['Select'] = 'Select';

	/**
	 * Register Post Meta for Movie Post Type
	 *
	 * @return array
	 */


	// --------------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Post Open ----------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------
	$meta_boxes[] = array(
		'id' => 'post-meta-quote',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Quote Settings', 'aresmurphy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Text', 'aresmurphy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => esc_html__( 'Write Your Quote Here', 'aresmurphy' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Author', 'aresmurphy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => esc_html__( 'Write Quote Author or Source', 'aresmurphy' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);



	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Link Settings', 'aresmurphy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Link URL', 'aresmurphy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => esc_html__( 'Write Your Link', 'aresmurphy' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Audio Settings', 'aresmurphy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Audio Embed Code', 'aresmurphy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}audio_code",
				'desc'  => esc_html__( 'Write Your Audio Embed Code Here', 'aresmurphy' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)

		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-video',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Video Settings', 'aresmurphy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Video Embed Code/ID', 'aresmurphy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => esc_html__( 'Write Your Vedio Embed Code/ID Here', 'aresmurphy' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'  => __( 'Video Durations', 'aresmurphy' ),
				'id'    => "{$prefix}video_durations",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'     => esc_html__( 'Select Vedio Type/Source', 'aresmurphy' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'aresmurphy' ),
					'2' => esc_html__( 'YouTube', 'aresmurphy' ),
					'3' => esc_html__( 'Vimeo', 'aresmurphy' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1'
			),

		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Gallery Settings', 'aresmurphy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => esc_html__( 'Gallery Image Upload', 'aresmurphy' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)
		)
	);
	// --------------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Post Close ---------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------


	// --------------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Page Close ---------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------


	$meta_boxes[] = array(
		'id' 			=> 'page-meta-settings',
		'title' 		=> __( 'Page Settings', 'aresmurphy' ),
		'pages' 		=> array( 'page'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',

		'fields' => array(

			array(
				'name'             => __( 'Upload Sub Title Banner Image', 'aresmurphy' ),
				'id'               => "{$prefix}subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
				'name'             => __( 'Upload Sub Title BG Color', 'aresmurphy' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#fff"
			),
		)
	);


	$meta_boxes[] = array(
		'id' 				=> 'portfolio-meta-settings',
		'title' 		=> __( 'Project Settings', 'aresmurphy' ),
		'pages' 		=> array( 'portfolio' ),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'fields' => array(
			array(
				'name'  			=> __( 'Client', 'aresmurphy' ),
				'id'    			=> "{$prefix}portfolio_client",
				'type'  			=> 'text',
				'clone'				=> false
			),
			array(
				'name'  			=> __( 'Date', 'aresmurphy' ),
				'id'    			=> "{$prefix}portfolio_date",
				'type'  			=> 'date',
				'clone'				=> false
			),
			array(
				'name'     => esc_html__( 'Select Image Size', 'aresmurphy' ),
				'id'       => "{$prefix}portfolio_img_size",
				'type'     => 'radio',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1x' => esc_html__( '1x', 'aresmurphy' ),
					'2x-width' => esc_html__( 'Height 2x', 'aresmurphy' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1x'
			),
		)
	);



	return $meta_boxes;
}


/**
 * Get list of post from any post type
 *
 * @return array
 */

function get_all_posts($post_type)
{
	$args = array(
			'post_type' => $post_type,  // post type name
			'posts_per_page' => -1,   //-1 for all post
		);

	$posts = get_posts($args);

	$post_list = array();

	if (!empty( $posts ))
	{
		foreach ($posts as $post)
		{
			setup_postdata($post);
			$post_list[$post->ID] = $post->post_title;
		}
		wp_reset_postdata();
		return $post_list;
	}
	else
	{
		return $post_list;
	}
}

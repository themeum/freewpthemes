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
		'title' => esc_html__( 'Post Quote Settings', 'flatpro' ),

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
				'name'  => esc_html__( 'Quote Text', 'flatpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => esc_html__( 'Write Your Quote Here', 'flatpro' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Author', 'flatpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => esc_html__( 'Write Quote Author or Source', 'flatpro' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);



	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Link Settings', 'flatpro' ),

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
				'name'  => esc_html__( 'Link URL', 'flatpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => esc_html__( 'Write Your Link', 'flatpro' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);

	// --------------------------------------------------------------------------------------------------------------	
	// ----------------------------------------- sub Header Page Open -----------------------------------------------
	// --------------------------------------------------------------------------------------------------------------
	$meta_boxes[] = array(
		'id' 			=> 'page-meta-settings',
		'title' 		=> esc_html__( 'Page Settings', 'flatpro' ),
		'pages' 		=> array( 'page','portfolio'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'fields' 		=> array(
			array(
				'name'             => esc_html__( 'Upload Sub Title Banner Image', 'flatpro' ),
				'id'               => $prefix."subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	

			array(
				'name'             => esc_html__( 'Sub Title BG Color', 'flatpro' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#007ee8"
			),

			array(
				'name'             => esc_html__( 'Sub Title Gradient Color', 'flatpro' ),
				'id'               => "{$prefix}subtitle_gradient_color",
				'type'             => 'color',
				'std' 			   => ""
			),	

			array(
				'name'  			=> esc_html__( 'Sub title', 'flatpro' ),
				'id'    			=> "{$prefix}sub_title_text",
				'desc'  			=> esc_html__( 'Sub Title', 'flatpro' ),
				'type'  			=> 'textarea',
				'std'   			=> ''
			)		
		)
	);
	// --------------------------------------------------------------------------------------------------------------	
	// ----------------------------------------- sub Header Page Open -----------------------------------------------
	// --------------------------------------------------------------------------------------------------------------


	$meta_boxes[] = array(
		'id' 			=> 'post-meta-audio',
		'title' 		=> esc_html__( 'Post Audio Settings', 'flatpro' ),
		'pages' 		=> array( 'post'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,
		'fields' 		=> array(
			array(
				'name'  	=> esc_html__( 'Audio Embed Code', 'flatpro' ),
				'id'    	=> "{$prefix}audio_code",
				'desc'  	=> esc_html__( 'Write Your Audio Embed Code Here', 'flatpro' ),
				'type'  	=> 'textarea',
				'std'   	=> ''
			)

		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-video',
		'title' => esc_html__( 'Post Video Settings', 'flatpro' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Video Embed Code/ID', 'flatpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => esc_html__( 'Write Your Vedio Embed Code/ID Here', 'flatpro' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'  => __( 'Video Durations', 'flatpro' ),
				'id'    => "{$prefix}video_durations",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'     => esc_html__( 'Select Vedio Type/Source', 'flatpro' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'flatpro' ),
					'2' => esc_html__( 'YouTube', 'flatpro' ),
					'3' => esc_html__( 'Vimeo', 'flatpro' ),
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
		'title' => esc_html__( 'Post Gallery Settings', 'flatpro' ),

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
				'name'             => esc_html__( 'Gallery Image Upload', 'flatpro' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)
		)
	);


	# Single Page Media Settings
	$meta_boxes[] = array(
		'id' 			=> 'single-page-media-settings',
		'title' 		=> esc_html__( 'Blog Single Page Media Settings', 'flatpro' ),
		'pages' 		=> array( 'post'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,
		'fields' 		=> array(
			array(
				'name'     		=> esc_html__( 'Single Blog Content Settings', 'flatpro' ),
				'id'       		=> "{$prefix}single_page_settings",
				'type'     		=> 'select',
				'default'   	=> 'only_feature',
				'options'  		=> array(
					'only_feature' 		=> esc_html__( 'Only Feature Image', 'flatpro' ),
					'only_format' 		=> esc_html__( 'Only Format Option', 'flatpro' ),
					'feature_format' 	=> esc_html__( 'Feature Image and Format Option', 'flatpro' ),
				),
				'multiple'    	=> false,
				'std'         	=> '1'
			),

		)
	);
	# End Media Settings.



	// --------------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Post Close ---------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------

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

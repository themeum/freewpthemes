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
		'title' => esc_html__( 'Post Quote Settings', 'starterpro' ),

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
				'name'  => esc_html__( 'Quote Text', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => esc_html__( 'Write Your Quote Here', 'starterpro' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Author', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => esc_html__( 'Write Quote Author or Source', 'starterpro' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);



	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Link Settings', 'starterpro' ),

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
				'name'  => esc_html__( 'Link URL', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => esc_html__( 'Write Your Link', 'starterpro' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Audio Settings', 'starterpro' ),

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
				'name'  => esc_html__( 'Audio Embed Code', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}audio_code",
				'desc'  => esc_html__( 'Write Your Audio Embed Code Here', 'starterpro' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-video',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Video Settings', 'starterpro' ),

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
				'name'  => esc_html__( 'Video Embed Code/ID', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => esc_html__( 'Write Your Vedio Embed Code/ID Here', 'starterpro' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'  => __( 'Video Durations', 'starterpro' ),
				'id'    => "{$prefix}video_durations",
				'type'  => 'text',
				'std'   => ''
			),			
			array(
				'name'     => esc_html__( 'Select Vedio Type/Source', 'starterpro' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'starterpro' ),
					'2' => esc_html__( 'YouTube', 'starterpro' ),
					'3' => esc_html__( 'Vimeo', 'starterpro' ),
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
		'title' => esc_html__( 'Post Gallery Settings', 'starterpro' ),

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
				'name'             => esc_html__( 'Gallery Image Upload', 'starterpro' ),
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
	// ----------------------------------------- Page Open ----------------------------------------------------------	
	// --------------------------------------------------------------------------------------------------------------
	$meta_boxes[] = array(
		'id' => 'page-meta-settings',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Page Settings', 'starterpro' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'page'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// List of meta fields
		'fields' => array(
			array(
				'name'             => esc_html__( 'Upload Sub Title Banner Image', 'starterpro' ),
				'id'               => $prefix."subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	

			array(
				'name'             => esc_html__( 'Upload Sub Title BG Color', 'starterpro' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#191919"
			),	

			array(
				'name'  => esc_html__( 'Sub title', 'starterpro' ),
				'id'    => "{$prefix}sub_title_text",
				'desc'  => esc_html__( 'Sub Title', 'starterpro' ),
				'type'  => 'text',
				
			)		
		)
	);	

	// --------------------------------------------------------------------------------------------------------------	
	// ----------------------------------------- Page Close ---------------------------------------------------------	
	// --------------------------------------------------------------------------------------------------------------	

	// --------------------------------------------------------------------------------------------------------------	
	// ----------------------------------------- Team ---------------------------------------------------------	
	// --------------------------------------------------------------------------------------------------------------	
	$meta_boxes[] = array(
		'id' => 'team-meta-setting',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Additional Infomation', 'starterpro' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'team'),

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
				'name'  => __( 'Designation', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_designation",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Facebook Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_facebook_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Twitter Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_twitter_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Google Plus Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_plusone_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Pinterest Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_pinterest_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Linkedin Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_linkedin_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Dribbble Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_dribbble_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Flickr Url', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_flickr_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
		)
	);


	// --------------------------------------------------------------------------------------------------------------	
	// ----------------------------------------- Slider ---------------------------------------------------------	
	// --------------------------------------------------------------------------------------------------------------
	$meta_boxes[] = array(
		'id' => 'slider-meta-setting',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Additional Infomation', 'starterpro' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'slider'),

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
				'name'  => __( 'Button Text', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_btn_text",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Link', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_btn_link",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Two Text', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_btn_two_text",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Two Link', 'starterpro' ),
				// Field ID, i.e. the meta key
				'id'    => "thm_btn_two_link",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)	
		)
	);

	$meta_boxes[] = array(
		
		'id' 			=> 'project-meta-setting',
		'title' 		=> __( 'Project Infomation', 'starterpro' ),
		'pages' 		=> array( 'project'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,

		'fields' => array(

			array(
				'name'  => __( 'External URL', 'starterpro' ),
				'id'    => "external_link",
				'type'  => 'text',
				'std'   => ''
			),		

		)
	);



	

	$meta_boxes[] = array(
		'id' 			=> 'page-meta-settings',
		'title' 		=> __( 'Page Settings', 'starterpro' ),
		'pages' 		=> array( 'page','project'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',

		'fields' => array(

			array(
				'name'             => __( 'Upload Sub Title Banner Image', 'starterpro' ),
				'id'               => "{$prefix}subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	

			array(
				'name'             => __( 'Upload Sub Title BG Color', 'starterpro' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#444"
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




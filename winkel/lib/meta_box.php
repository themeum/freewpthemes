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
		'title' => esc_html__( 'Post Quote Settings', 'winkel' ),

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
				'name'  => esc_html__( 'Quote Text', 'winkel' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => esc_html__( 'Write Your Quote Here', 'winkel' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Quote Author', 'winkel' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => esc_html__( 'Write Quote Author or Source', 'winkel' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)

		)
	);



	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Post Link Settings', 'winkel' ),

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
				'name'  => esc_html__( 'Link URL', 'winkel' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => esc_html__( 'Write Your Link', 'winkel' ),
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
		'title' 		=> esc_html__( 'Page Settings', 'winkel' ),
		'pages' 		=> array( 'page'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'fields' 		=> array(
			array(
				'name'             => esc_html__( 'Upload Sub Title Banner Image', 'winkel' ),
				'id'               => $prefix."subtitle_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	

			array(
				'name'             => esc_html__( 'Sub Title BG Color', 'winkel' ),
				'id'               => "{$prefix}subtitle_color",
				'type'             => 'color',
				'std' 			   => "#212529"
			),

			array(
				'name'  			=> esc_html__( 'Sub title', 'winkel' ),
				'id'    			=> "{$prefix}sub_title_text",
				'desc'  			=> esc_html__( 'Sub Title', 'winkel' ),
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
		'title' 		=> esc_html__( 'Post Audio Settings', 'winkel' ),
		'pages' 		=> array( 'post'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,
		'fields' 		=> array(
			array(
				'name'  	=> esc_html__( 'Audio Embed Code', 'winkel' ),
				'id'    	=> "{$prefix}audio_code",
				'desc'  	=> esc_html__( 'Write Your Audio Embed Code Here', 'winkel' ),
				'type'  	=> 'textarea',
				'std'   	=> ''
			)

		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-video',
		'title' => esc_html__( 'Post Video Settings', 'winkel' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'Video Embed Code/ID', 'winkel' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => esc_html__( 'Write Your Vedio Embed Code/ID Here', 'winkel' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'  => __( 'Video Durations', 'winkel' ),
				'id'    => "{$prefix}video_durations",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'     => esc_html__( 'Select Vedio Type/Source', 'winkel' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'winkel' ),
					'2' => esc_html__( 'YouTube', 'winkel' ),
					'3' => esc_html__( 'Vimeo', 'winkel' ),
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
		'title' => esc_html__( 'Post Gallery Settings', 'winkel' ),

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
				'name'             => esc_html__( 'Gallery Image Upload', 'winkel' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)
		)
	);


	# Single Page Media Settings
	$meta_boxes[] = array(
		'id' 			=> 'single-page-media-settings',
		'title' 		=> esc_html__( 'Blog Single Page Media Settings', 'winkel' ),
		'pages' 		=> array( 'post'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,
		'fields' 		=> array(
			array(
				'name'     		=> esc_html__( 'Single Blog Content Settings', 'winkel' ),
				'id'       		=> "{$prefix}single_page_settings",
				'type'     		=> 'select',
				'default'   	=> 'only_feature',
				'options'  		=> array(
					'only_feature' 		=> esc_html__( 'Only Feature Image', 'winkel' ),
					'only_format' 		=> esc_html__( 'Only Format Option', 'winkel' ),
					'feature_format' 	=> esc_html__( 'Feature Image and Format Option', 'winkel' ),
				),
				'multiple'    	=> false,
				'std'         	=> '1'
			),

		)
	);

	# Products
	$meta_boxes[] = array(
		'id' 			=> 'product-page-settings',
		'title' 		=> esc_html__( 'Product Ads', 'winkel' ),
		'pages' 		=> array( 'product'),
		'context' 		=> 'normal',
		'priority' 		=> 'high',
		'autosave' 		=> true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Ads URL 1', 'winkel' ),
				'id'    => "{$prefix}ads_url1",
				'desc'  => esc_html__( 'Upload ads URL 1', 'winkel' ),
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'             => esc_html__( 'Upload ads img 1', 'winkel' ),
				'id'               => $prefix."ads_img1",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),				
			array(
				'name'             => esc_html__( 'divider', 'winkel' ),
				'id'               => $prefix."ads_div1",
				'type'             => 'divider',
			),			
			array(
				'name'  => esc_html__( 'Ads URL 2', 'winkel' ),
				'id'    => "{$prefix}ads_url2",
				'desc'  => esc_html__( 'Upload ads URL 2', 'winkel' ),
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'             => esc_html__( 'Upload ads img 2', 'winkel' ),
				'id'               => $prefix."ads_img2",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	
			array(
				'name'             => esc_html__( 'divider', 'winkel' ),
				'id'               => $prefix."ads_div2",
				'type'             => 'divider',
			),		
			array(
				'name'  => esc_html__( 'Ads URL 3', 'winkel' ),
				'id'    => "{$prefix}ads_url3",
				'desc'  => esc_html__( 'Upload ads URL 3', 'winkel' ),
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'             => esc_html__( 'Upload ads img 3', 'winkel' ),
				'id'               => $prefix."ads_img3",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),	
			array(
				'name'             => esc_html__( 'divider', 'winkel' ),
				'id'               => $prefix."ads_div3",
				'type'             => 'divider',
			),		
			array(
				'name'  => esc_html__( 'Ads URL 4', 'winkel' ),
				'id'    => "{$prefix}ads_url4",
				'desc'  => esc_html__( 'Upload ads URL 4', 'winkel' ),
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'             => esc_html__( 'Upload ads img 4', 'winkel' ),
				'id'               => $prefix."ads_img4",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
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

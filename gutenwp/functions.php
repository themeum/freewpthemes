<?php

define( 'gutenwp_CSS', get_parent_theme_file_uri().'/css/' );
define( 'gutenwp_JS', get_parent_theme_file_uri().'/js/' );

/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
include( get_parent_theme_file_path('lib/class-tgm-plugin-activation.php') );
include( get_parent_theme_file_path('lib/gutenwp-post-category.php') );


/*-------------------------------------------*
*				Register Navigation
*------------------------------------------*/
register_nav_menus( array(
	'primary' 	=> esc_html__( 'Primary Menu', 'gutenwp' ),
	'footernav' => esc_html__( 'Footer Menu', 'gutenwp' )
) );


/*-------------------------------------------*
 *				Nav Walker
 *------------------------------------------*/
include( get_parent_theme_file_path('lib/menu/admin-megamenu-walker.php') );
include( get_parent_theme_file_path('lib/menu/meagmenu-walker.php') );
include( get_parent_theme_file_path('lib/menu/mobile-navwalker.php') );
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------------------
*				Themeum Core
*-------------------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/gutenwp-core.php') );


/*-------------------------------------------*
*				Gutenwp Register
*------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/gutenwp-register.php') );

/*-----------------------------------------------------
* 				Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('gutenwp_excerpt_max_charlength')):
	function gutenwp_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
endif;


add_filter( 'document_title_parts', function( $title ){
    if ( is_search() ) 
        $title['title'] = sprintf( 
            esc_html__( '&#8220;%s&#8221; result page', 'gutenwp' ), 
            get_search_query() 
        );
    return $title;
} );


/*-----------------------------------------------------
 *              Review List
 *----------------------------------------------------*/
add_action('after_switch_theme', 'gutenwp_review_setup_options');
function gutenwp_review_setup_options(){
  if( get_option('review_page_id') == "" ){
        $register_page = array(
          'post_title'    => 'Reviews',
          'post_content'  => '',
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_type'     => 'product',
          'page_template' => 'page-reviews.php'
        );
        $post_id = wp_insert_post( $register_page );
        add_option( 'review_page_id', $post_id ); 
    }
}

/* -------------------------------------------
* 				Custom body class
* ------------------------------------------- */
add_filter( 'body_class', 'gutenwp_body_class' );
function gutenwp_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
* 				Logout Redirect Home
* -------------------------------------------- */
add_action( 'wp_logout', 'gutenwp_auto_redirect_external_after_logout');
function gutenwp_auto_redirect_external_after_logout(){
	wp_redirect( home_url('/') );
	exit();
}


/* -------------------------------------------
*        Theme Updater
* -------------------------------------------- */

if ( ! class_exists('Gutenwp_Regular_Theme_Updater')) {
	class Gutenwp_Regular_Theme_Updater {
		private $api_end_point;
		private $theme_name;
		private $theme_version;

		public static function init() {
			return new self();
		}

		public function __construct() {
			$theme               = wp_get_theme();
			$this->theme_name    = strtolower( $theme->get( 'gutenwp' ) );
			$this->theme_version = $theme->get( "Version" );
			$this->api_end_point = 'https://www.themeum.com/wp-json/themeum-free-product/v2/';

			add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_for_update' ) );
		}

		/**
		 * @return array|bool|mixed|object
		 *
		 * Get update information
		 */
		public function check_for_update_api() {
			// Make the POST request
			$request = wp_remote_post( $this->api_end_point.'check-update',
				array(
					'timeout' 	=> 45,
					'body' 		=> array(
						'product_type' 	=> 'theme',
						'name' 			=> $this->theme_name
					),
				)
			);

			$request_body = false;
			// Check if response is valid
			if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
				$request_body = json_decode( $request['body'] );
			}
			return $request_body;
		}

		/**
		 * @param $transient
		 *
		 * @return mixed
		 */
		public function check_for_update( $transient ) {
			if ( empty( $transient->checked[ $this->theme_name ] ) ) {
				return $transient;
			}
			$request = $this->check_for_update_api();

			if ( $request->success ) {
				$request_data = $request->data;
				if ( version_compare( $this->theme_version, $request_data->version, '<' ) ) {
					$transient->response[ $this->theme_name ] = array(
						'new_version' => $request_data->version,
						'package'     => $request_data->download_url,
						'url'     => 'https://themeum.com',
					);
				}
			}

			return $transient;
		}
	}

	Gutenwp_Regular_Theme_Updater::init();
}
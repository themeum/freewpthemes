<?php

define( 'bridegroom_CSS', get_parent_theme_file_uri().'/css/' );
define( 'bridegroom_JS', get_parent_theme_file_uri().'/js/' );

/* -------------------------------------------
*           Include TGM Plugins
* -------------------------------------------- */
include( get_parent_theme_file_path('lib/class-tgm-plugin-activation.php') );


/*-------------------------------------------*
*			Register Navigation
*------------------------------------------*/
register_nav_menus( array(
	'primary' 		=> esc_html__( 'Primary Menu', 'bridegroom' ),
	'footernav' 	=> esc_html__( 'Footer Menu', 'bridegroom' )
) );


/*-------------------------------------------*
*			Nav Walker
*--------------------------------------------*/
include( get_parent_theme_file_path('lib/menu/meagmenu-walker.php') );
include( get_parent_theme_file_path('lib/menu/mobile-navwalker.php') );

/*-------------------------------------------------------
*			Themeum Core
*-------------------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/bridegroom-core.php') );


/*-------------------------------------------*
*			Bridegroom Register
*------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/bridegroom-register.php') );

/*-----------------------------------------------------
* 			Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('bridegroom_excerpt_max_charlength')):
	function bridegroom_excerpt_max_charlength($charlength) {
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


/*-----------------------------------------------------
* 		Filters the parts of the document title.
*----------------------------------------------------*/
add_filter( 'document_title_parts', function( $title ){
    if ( is_search() ) 
        $title['title'] = sprintf( 
            esc_html__( '&#8220;%s&#8221; result page', 'bridegroom' ), 
            get_search_query() 
        );
    return $title;
} );


/* ------------------------------------------ *
*			Woocommerce Support
* ------------------------------------------- */
function bridegroom_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'bridegroom_woocommerce_support' );


/* ------------------------------------------ *
*			Woocommerce Product Column.
* ------------------------------------------- */
function bridegroom_loop_columns() {
    $shop_col = get_theme_mod( 'shop_grid_column', true );
	return $shop_col;  
}
add_filter('loop_shop_columns', 'bridegroom_loop_columns'); // Set Number of rows in Shop


/*-----------------------------------------------------
*              Review List
*----------------------------------------------------- */
add_action('after_switch_theme', 'bridegroom_review_setup_options');
function bridegroom_review_setup_options(){
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
add_filter( 'body_class', 'bridegroom_body_class' );
function bridegroom_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'bridegroom_auto_redirect_external_after_logout');
function bridegroom_auto_redirect_external_after_logout(){
	wp_redirect( home_url('/') );
	exit();
}

/* -------------------------------------------
*             License for bridegroom Theme
* -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.bridegroom-theme-license.php');

/* -------------------------------------------
*        		Licence Code
* ------------------------------------------- */
add_action('admin_menu', 'bridegroom_options_menu');
if ( ! function_exists('bridegroom_options_menu')){
	function bridegroom_options_menu(){
		$personalblog_option_page = add_menu_page('bridegroom Options', 'bridegroom Options', 'manage_options', 'bridegroom-options', 'bridegroom_option_callback');
		add_action('load-'.$personalblog_option_page, 'bridegroom_option_page_check');
	}
}

function bridegroom_option_callback(){}
function bridegroom_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_bridegroom-options'){
		wp_redirect(admin_url('customize.php'));
	}
}


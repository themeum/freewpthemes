<?php

define( 'EVENTCO_CSS', get_parent_theme_file_uri().'/css/' );
define( 'EVENTCO_JS', get_parent_theme_file_uri().'/js/' );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
include( get_parent_theme_file_path('lib/class-tgm-plugin-activation.php') );


/*-------------------------------------------*
*				Register Navigation
*------------------------------------------*/
register_nav_menus( array(
	'primary' 	=> esc_html__( 'Primary Menu', 'eventco' )
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
*				Eventco Core
*-------------------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/eventco-core.php') );


/*-------------------------------------------*
*				Eventco Register
*------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/eventco-register.php') );

/*-------------------------------------------------------
*          Themeum Login Registration
*-------------------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/ajax-login.php') );
include( get_parent_theme_file_path('lib/main-function/login-registration.php') );
include( get_parent_theme_file_path('lib/registration.php') );


/*-----------------------------------------------------
* 				Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('eventco_excerpt_max_charlength')):
	function eventco_excerpt_max_charlength($charlength) {
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
            esc_html__( '&#8220;%s&#8221; result page', 'eventco' ),
            get_search_query()
        );
    return $title;
} );



/* ------------------------------------------ *
*				WooCommerce support
* ------------------------------------------- */
function eventco_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'eventco_woocommerce_support' );

# Woocommerce Product Column.
function eventco_loop_columns() {
    $shop_col = get_theme_mod( 'shop_grid_column', true );
	return $shop_col;
}
add_filter('loop_shop_columns', 'eventco_loop_columns'); // Set Number of rows in Shop



/*-----------------------------------------------------
 *              Review List
 *----------------------------------------------------*/
add_action('after_switch_theme', 'eventco_review_setup_options');
function eventco_review_setup_options(){
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
add_filter( 'body_class', 'eventco_body_class' );
function eventco_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
*         Custom Function for Speaker
* ------------------------------------------- */
function themeum_speaker_list($id){
    $list1_array = array();
    if(!empty($id)){
        global $post;
        $args = array(
            'post_type'         => 'speaker',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
            'p'                 => intval($id)
        );

        $posts = get_posts($args);
        foreach ($posts as $post){
            setup_postdata( $post );

            $image = '';
            if ( has_post_thumbnail()) {
                $image = get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'img-responsive'));
            }

            $list1_array[] = array(
                'name'      	=> get_the_title(),
                'designation'  	=> get_post_meta( get_the_ID(), 'themeum_designation', true ),
                'image'     	=> $image,
                'url'       	=> get_the_permalink()
            );
        }
        wp_reset_postdata();
    }
    return $list1_array;
}



/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'eventco_auto_redirect_external_after_logout');
function eventco_auto_redirect_external_after_logout(){
	wp_redirect( home_url('/') );
	exit();
}

/* -------------------------------------------
*             License for Eventco Theme
* -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.eventco-theme-license.php');

/* -------------------------------------------
*        		Licence Code
* ------------------------------------------- */
add_action('admin_menu', 'eventco_options_menu');
if ( ! function_exists('eventco_options_menu')){
	function eventco_options_menu(){
		$personalblog_option_page = add_menu_page('Eventco Options', 'Eventco Options', 'manage_options', 'eventco-options', 'eventco_option_callback');
		add_action('load-'.$personalblog_option_page, 'eventco_option_page_check');
	}
}

function eventco_option_callback(){}
function eventco_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_eventco-options'){
		wp_redirect(admin_url('customize.php'));
	}
}

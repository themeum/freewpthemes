<?php
define( 'flatpro_CSS', get_template_directory_uri().'/css/' );
define( 'flatpro_JS', get_template_directory_uri().'/js/' );
define( 'flatpro_DIR', get_template_directory() );

define( 'FLATPRO_DIR', get_template_directory() );
define( 'FLATPRO_URI', trailingslashit(get_template_directory_uri()) );

/* -------------------------------------------
*		Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*		Include MetaBox
* -------------------------------------------- */
if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
	require_once ( flatpro_DIR .'/lib/meta-box/meta-box.php');
}
require_once ( flatpro_DIR .'/lib/meta_box.php' );

/* -------------------------------------------
*		License for Flat Pro Theme
* -------------------------------------------- */
require_once( FLATPRO_DIR . '/lib/license/class.flatpro-theme-license.php');

/*-------------------------------------------
*		WPPB addons
*--------------------------------------------*/
require_once( FLATPRO_DIR . '/lib/thm-wppb/thm-wppb.php');



/* -------------------------------------------
*		Portfolio Posttype Add
* -------------------------------------------- */
require_once( flatpro_DIR . '/lib/portfolio.php');


/* -------------------------------------------
*		Include TGM Plugins
* -------------------------------------------- */
require_once( flatpro_DIR . '/lib/class-tgm-plugin-activation.php');


/* ------------------------------------------
*		Customizer
* ------------------------------------------- */
require_once( flatpro_DIR . '/lib/customizer/libs/googlefonts.php');
require_once( flatpro_DIR . '/lib/customizer/customizer.php');
function flatpro_customize_control_js() {
	wp_enqueue_script( 'color-preset-control', flatpro_JS . 'color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'flatpro_customize_control_js' );


/* -------------------------------------------
*		Widget
* -------------------------------------------- */
require_once( flatpro_DIR . '/lib/widgets/themeum_about_widget.php' );
require_once( flatpro_DIR . '/lib/widgets/image_widget.php' );
require_once( flatpro_DIR . '/lib/widgets/themeum_social_share.php' );
require_once( flatpro_DIR . '/lib/widgets/blog-posts.php');


/*-------------------------------------------
*		Element addons
*--------------------------------------------*/
require_once( flatpro_DIR . '/lib/thm-elementor/thm-elementor.php');


/*-------------------------------------------*
*		Register Navigation
*------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'flatpro' ),
	'footernav' => esc_html__( 'Footer Menu', 'flatpro' ),
) );


/*-------------------------------------------*
*		Navwalker
*------------------------------------------*/
require_once( flatpro_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( flatpro_DIR . '/lib/menu/meagmenu-walker.php');
require_once( flatpro_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
*		Startup Register
*------------------------------------------*/
require_once( flatpro_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
*		Themeum Core
*-------------------------------------------------------*/
require_once( flatpro_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
*		Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('flatpro_excerpt_max_charlength')):
	function flatpro_excerpt_max_charlength($charlength) {
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


/*-------------------------------------------
*		Custom Excerpt Length
*-------------------------------------------*/
if(!function_exists('crowdfunding_excerpt_max_charlength')):
    function crowdfunding_excerpt_max_charlength($str,$charlength) {
        $excerpt = $str;
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



/* -------------------------------------------
*		Custom body class
* ------------------------------------------- */
add_filter( 'body_class', 'flatpro_body_class' );
function flatpro_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
*		Logout Redirect Home
* ------------------------------------------- */
add_action( 'wp_logout', 'flatpro_auto_redirect_external_after_logout');
function flatpro_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
*		Remove API
* ------------------------------------------- */
function flatpro_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'flatpro_remove_api' );


/* -------------------------------------------
*		SVG image upload
* ------------------------------------------- */
function flatpro_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'flatpro_mime_types');


/* -------------------------------------------
*		FlatPro Options Menu
* ------------------------------------------- */
add_action('admin_menu', 'flatpro_options_menu');
if ( ! function_exists('flatpro_options_menu')){
	function flatpro_options_menu(){
		$personalblog_option_page = add_menu_page('Flat Pro Options', 'Flat Pro Options', 'manage_options', 'flatpro-options', 'flatpro_option_callback');
		add_action('load-'.$personalblog_option_page, 'flatpro_option_page_check');
	}
}

function flatpro_option_callback(){}
function flatpro_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_flatpro-options'){
		wp_redirect(admin_url('customize.php'));
	}
}

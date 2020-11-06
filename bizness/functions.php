<?php
define( 'BIZNESS_CSS', get_template_directory_uri().'/css/' );
define( 'BIZNESS_JS', get_template_directory_uri().'/js/' );
//define( 'BIZNESS_DIR', get_template_directory() );

define( 'BIZNESS_DIR', get_template_directory() );
define( 'BIZNESS_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*             License for Bizness Theme
* -------------------------------------------- */
require_once( BIZNESS_DIR . '/lib/license/class.bizness-theme-license.php');


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( BIZNESS_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'bizness' ),
	'footernav' => esc_html__( 'Footer Menu', 'bizness' ),
) );


/*-------------------------------------------*
 *				Navwalker
 *------------------------------------------*/
require_once( BIZNESS_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( BIZNESS_DIR . '/lib/menu/meagmenu-walker.php');
require_once( BIZNESS_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Bizness Register
 *------------------------------------------*/
require_once( BIZNESS_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( BIZNESS_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('bizness_excerpt_max_charlength')):
	function bizness_excerpt_max_charlength($charlength) {
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


/* -------------------------------------------
 * 				Custom body class
 * ------------------------------------------- */
add_filter( 'body_class', 'bizness_body_class' );
function bizness_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'bizness_auto_redirect_external_after_logout');
function bizness_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 *        Bizness Theme Options
 * ------------------------------------------- */
add_action('admin_menu', 'bizness_options_menu');
if ( ! function_exists('bizness_options_menu')){
  function bizness_options_menu(){
    $bizness_option_page = add_menu_page('Bizness Options', 'Bizness Options', 'manage_options', 'bizness-options', 'bizness_option_callback');
    add_action('load-'.$bizness_option_page, 'bizness_option_page_check');
  }
}

function bizness_option_callback(){}
function bizness_option_page_check(){
  global $current_screen;
  if ($current_screen->id === 'toplevel_page_bizness-options'){
    wp_redirect(admin_url('customize.php'));
  }
}

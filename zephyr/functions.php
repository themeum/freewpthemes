<?php
define( 'ZEPHYR_CSS', get_template_directory_uri().'/css/' );
define( 'ZEPHYR_JS', get_template_directory_uri().'/js/' );
define( 'ZEPHYR_DIR', get_template_directory() );
define( 'ZEPHYR_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( ZEPHYR_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'zephyr' ),
	'footernav' => esc_html__( 'Footer Menu', 'zephyr' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( ZEPHYR_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( ZEPHYR_DIR . '/lib/menu/meagmenu-walker.php');
require_once( ZEPHYR_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( ZEPHYR_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( ZEPHYR_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('zephyr_excerpt_max_charlength')):
	function zephyr_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'zephyr_body_class' );
function zephyr_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'zephyr_auto_redirect_external_after_logout');
function zephyr_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
*           License for Zephyr Theme
* -------------------------------------------- */
require_once( ZEPHYR_DIR . '/lib/license/class.zephyr-theme-license.php');

/* -------------------------------------------
*        		Licence Code
* ------------------------------------------- */
add_action('admin_menu', 'zephyr_options_menu');
if ( ! function_exists('zephyr_options_menu')){
  function zephyr_options_menu(){
    $personalblog_option_page = add_menu_page('Zephyr Options', 'Zephyr Options', 'manage_options', 'zephyr-options', 'zephyr_option_callback');
    add_action('load-'.$personalblog_option_page, 'zephyr_option_page_check');
  }
}

function zephyr_option_callback(){}
function zephyr_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_zephyr-options'){
		wp_redirect(admin_url('customize.php'));
	}
}

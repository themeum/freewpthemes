<?php
define( 'wpestate_CSS', get_template_directory_uri().'/css/' );
define( 'wpestate_JS', get_template_directory_uri().'/js/' );
define( 'wpestate_DIR', get_template_directory() );

/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( wpestate_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'wpestate' ),
	'footernav' => esc_html__( 'Footer Menu', 'wpestate' ),
) );

/*-------------------------------------------*
 *				Mobile Nav Walker
 *------------------------------------------*/
require_once( wpestate_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( wpestate_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );

/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( wpestate_DIR . '/lib/main-function/wpestate-register.php');


/*-------------------------------------------------------
 *				wpestate Core
 *-------------------------------------------------------*/
require_once( wpestate_DIR . '/lib/main-function/wpestate-core.php');

require_once( wpestate_DIR . '/lib/login-register.php');

/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('wpestate_excerpt_max_charlength')):
	function wpestate_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'wpestate_body_class' );
function wpestate_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'wpestate_auto_redirect_external_after_logout');
function wpestate_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}

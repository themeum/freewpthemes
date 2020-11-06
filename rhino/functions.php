<?php
define( 'RHINO_CSS', get_template_directory_uri().'/css/' );
define( 'RHINO_JS', get_template_directory_uri().'/js/' );
define( 'RHINO_DIR', get_template_directory() );
define( 'RHINO_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
 * 				Rhino Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'rhino_options_menu');
if ( ! function_exists('rhino_options_menu')){
    function rhino_options_menu(){
        $rhino_option_page = add_menu_page('Rhino Options', 'Rhino Options', 'manage_options', 'rhino-options', 'rhino_option_callback');
        add_action('load-'.$rhino_option_page, 'rhino_option_page_check');
    }
}
function rhino_option_callback(){}
function rhino_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_rhino-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
 * 				License for Rhino Theme
 * -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.rhino-theme-license.php');


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( RHINO_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'rhino' ),
	'footernav' => esc_html__( 'Footer Menu', 'rhino' ),
) );

/*-------------------------------------------*
 *				Mobile Nav Walker
 *------------------------------------------*/
require_once( RHINO_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( RHINO_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );

/*-------------------------------------------*
 *				Rhino Register
 *------------------------------------------*/
require_once( RHINO_DIR . '/lib/main-function/rhino-register.php');


/*-------------------------------------------------------
 *				Rhino Core
 *-------------------------------------------------------*/
require_once( RHINO_DIR . '/lib/main-function/rhino-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('rhino_excerpt_max_charlength')):
	function rhino_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'rhino_body_class' );
function rhino_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'rhino_auto_redirect_external_after_logout');
function rhino_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}

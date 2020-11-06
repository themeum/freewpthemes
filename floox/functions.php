<?php
define( 'floox_CSS', get_template_directory_uri().'/css/' );
define( 'floox_JS', get_template_directory_uri().'/js/' );
define( 'floox_DIR', get_template_directory() );

define( 'FLOOX_DIR', get_template_directory() );
define( 'FLOOX_URI', trailingslashit(get_template_directory_uri()) );

/* -------------------------------------------
 * 				Floox Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'floox_options_menu');
if ( ! function_exists('floox_options_menu')){
    function floox_options_menu(){
        $floox_option_page = add_menu_page('Floox Options', 'Floox Options', 'manage_options', 'floox-options', 'floox_option_callback');
        add_action('load-'.$floox_option_page, 'floox_option_page_check');
    }
}
function floox_option_callback(){}
function floox_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_floox-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
*             License for Floox Pro Theme
* -------------------------------------------- */
require_once( FLOOX_DIR . '/lib/license/class.floox-theme-license.php');


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( floox_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'floox' ),
	// 'footernav' => esc_html__( 'Footer Menu', 'floox' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( floox_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( floox_DIR . '/lib/menu/meagmenu-walker.php');
require_once( floox_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( floox_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( floox_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('floox_excerpt_max_charlength')):
	function floox_excerpt_max_charlength($charlength) {
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
 *          	Custom Excerpt Length
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
 * 				Custom body class
 * ------------------------------------------- */
add_filter( 'body_class', 'floox_body_class' );
function floox_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'floox_auto_redirect_external_after_logout');
function floox_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 * 				Remove API
 * ------------------------------------------- */
function floox_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'floox_remove_api' );


/* -------------------------------------------
 * 				SVG image upload
 * ------------------------------------------- */
function floox_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'floox_mime_types');
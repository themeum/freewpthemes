<?php
define( 'calypso_CSS', get_template_directory_uri().'/css/' );
define( 'calypso_JS', get_template_directory_uri().'/js/' );
define( 'CALYPSO_DIR', get_template_directory() );

/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( CALYPSO_DIR . '/lib/class-tgm-plugin-activation.php');

/* -------------------------------------------
*           	Fontawesome Helper
* -------------------------------------------- */
require_once( CALYPSO_DIR . '/lib/fontawesome-helper.php');

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'calypso' ),
) );

/*-------------------------------------------*
*				navwalker
*------------------------------------------*/
require_once( CALYPSO_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( CALYPSO_DIR . '/lib/menu/meagmenu-walker.php');
require_once( CALYPSO_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );

/*-------------------------------------------*
*				Calypso Register
*------------------------------------------*/
require_once( CALYPSO_DIR . '/lib/main-function/themeum-register.php');

/*-------------------------------------------------------
*				Themeum Core
*-------------------------------------------------------*/
require_once( CALYPSO_DIR . '/lib/main-function/themeum-core.php');

require_once( CALYPSO_DIR . '/woocommerce/calypso-color-variations.php');

/*-----------------------------------------------------
* 				Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('calypso_excerpt_max_charlength')):
	function calypso_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'calypso_body_class' );
function calypso_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
* 				Logout Redirect Home
* ------------------------------------------- */
add_action( 'wp_logout', 'calypso_auto_redirect_external_after_logout');
function calypso_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
* 				Remove API
* ------------------------------------------- */
function calypso_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'calypso_remove_api' );

/* -------------------------------------------
* 				SVG image upload
* ------------------------------------------- */
function calypso_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'calypso_mime_types');

/* -------------------------------------------
*        WooCommerce Product Column
* ------------------------------------------- */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; # 3 products per row
    }
}

# Shipping Tab Content
add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
function woo_rename_tab($tabs) {
    $tabs['additional_information']['title'] = 'SHIPPING';
    return $tabs;
}

# Variation Product 
add_filter('woocommerce_product_add_to_cart_text', 'change_add_to_cart_capipso', 10, 2);
function change_add_to_cart_capipso($text, $instance){
    if ($instance->get_type() === 'variable'){
        $text = __("Details", 'calypso');
    }
    return $text;
}

/* -------------------------------------------
*        Guttenberg
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );

/* -------------------------------------------
*             License for Calypso Theme
* -------------------------------------------- */
require_once( CALYPSO_DIR . '/lib/license/class.calypso-theme-license.php');

/* -------------------------------------------
*        		Licence Code
* ------------------------------------------- */
add_action('admin_menu', 'calypso_options_menu');
if ( ! function_exists('calypso_options_menu')){
    function calypso_options_menu(){
        $personalblog_option_page = add_menu_page('Calypso Options', 'Calypso Options', 'manage_options', 'calypso-options', 'calypso_option_callback');
        add_action('load-'.$personalblog_option_page, 'calypso_option_page_check');
    }
}

/* -------------------------------------------
*        		Calypso Option
* ------------------------------------------- */
function calypso_option_callback(){}
function calypso_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_calypso-options'){
        wp_redirect(admin_url('customize.php'));
    }
}
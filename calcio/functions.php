<?php
define('CALCIO_NAME', wp_get_theme()->get( 'Name' ));
define('CALCIO_CSS', get_parent_theme_file_uri().'/css/');
define('CALCIO_JS', get_parent_theme_file_uri().'/js/');


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
 * 				Calcio Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'calcio_options_menu');
if ( ! function_exists('calcio_options_menu')){
    function calcio_options_menu(){
        $calcio_option_page = add_menu_page('Calcio Options', 'Calcio Options', 'manage_options', 'calcio-options', 'calcio_option_callback');
        add_action('load-'.$calcio_option_page, 'calcio_option_page_check');
    }
}
function calcio_option_callback(){}
function calcio_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_calcio-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
 * 				License for Calcio Theme
 * -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.calcio-theme-license.php');


/*-------------------------------------------*
 *				TGM Plugin
 *------------------------------------------*/
require_once( get_parent_theme_file_path()  . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'mainmenu' => esc_html__( 'Main Menu', 'calcio' ),
	'secondary_menu' => esc_html__( 'Secondary Menu', 'calcio' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_parent_theme_file_path()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_parent_theme_file_path()  . '/lib/menu/meagmenu-walker.php');
require_once( get_parent_theme_file_path()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Calcio_Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Calcio Register
 *------------------------------------------*/
require_once( get_parent_theme_file_path()  . '/lib/main-function/themeum-register.php');



/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_parent_theme_file_path()  . '/lib/main-function/themeum-core.php');



# -----------------------------------------
# ----------- Load More -------------------
# -----------------------------------------
require_once( get_parent_theme_file_path()  . '/post-format/themeum-loadmore.php');

/*-----------------------------------------------------
* 				Custom Excerpt Length
*----------------------------------------------------*/

if(!function_exists('calcio_excerpt_max_charlength')):
	function calcio_excerpt_max_charlength($charlength) {
		$excerpt = wp_strip_all_tags( get_the_excerpt() );
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
* 				Custom Title Length
*----------------------------------------------------*/

if(!function_exists('calcio_max_charlength')):
	function calcio_max_charlength($charlen, $char) {
		$exrcp = wp_strip_all_tags($char);
		$charlen++;

		if ( mb_strlen( $exrcp ) > $charlen ) {
			$subex = mb_substr( $exrcp, 0, $charlen - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}

		} else {
			return $exrcp;
		}
	}
endif;



/*-------------------------------------------*
 *				woocommerce support
 *------------------------------------------*/

add_action( 'after_setup_theme', 'calcio_woocommerce_support' );
function calcio_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/*-----------------------------------------------------
 * 				Custom body class
 *----------------------------------------------------*/
add_filter( 'body_class', 'calcio_body_class' );
function calcio_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = esc_attr($layout).'-bg';

    $sub_header_cls = '';

	if (!get_theme_mod( 'enable_sub_header' )) {
		$sub_header_cls = 'thm-sub-header-disabled';
	}

	if (is_page() && !is_front_page()) {
		$sub_header_cls = '';
	}

	$classes[] = esc_attr($sub_header_cls);

	return $classes;
}


function calcio_customize_control_js() {
	wp_enqueue_script( 'calcio-color-preset-control', get_parent_theme_file_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'calcio_customize_control_js' );

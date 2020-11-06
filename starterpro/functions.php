<?php

define('STARTERPRO_NAME', wp_get_theme()->get( 'Name' ));
define('STARTERPRO_CSS', get_template_directory_uri().'/css/');
define('STARTERPRO_JS', get_template_directory_uri().'/js/');

define( 'STARTERPRO_DIR', get_template_directory() );
define( 'STARTERPRO_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
* Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/*-------------------------------------------
* Register Post Type
*--------------------------------------------*/
//require_once(get_template_directory() . '/lib/ads/ads.php' );

/* -------------------------------------------
* License for Starter Pro Theme
* -------------------------------------------- */
require_once( STARTERPRO_DIR . '/lib/license/class.starterpro-theme-license.php');

/*-------------------------------------------
* Include MetaBox
*--------------------------------------------*/
if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}
require_once (get_template_directory().'/lib/meta_box.php');


/*-------------------------------------------
* Include TGM Plugins
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

/*-------------------------------------------
* Customizer
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/customizer/libs/googlefonts.php');
require_once( get_template_directory()  . '/lib/customizer/customizer.php');
function starterpro_customize_control_js() {
	wp_enqueue_script( 'color-preset-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'starterpro_customize_control_js' );

/*-------------------------------------------
* KingComposer Shortcode
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/addons/thm-classic-slider.php' );
require_once( get_template_directory()  . '/lib/addons/team-carousel.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-title.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-team.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-testimonial.php' );
require_once( get_template_directory()  . '/lib/addons/testimonal-carousel.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-latest-post.php' );
require_once( get_template_directory()  . '/lib/addons/thm-contact-form7.php' );
require_once( get_template_directory()  . '/lib/addons/thm-google-map.php' );
require_once( get_template_directory()  . '/lib/addons/client-carousel.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-video-popup.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-project-addons.php' );

/*-------------------------------------------
* Widget
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/themeum_about_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/image_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/themeum_social_share.php' );
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');


/*-------------------------------------------*
 * Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'starterpro' ),
) );


/*-------------------------------------------*
 * title tag
 *------------------------------------------*/

add_action( 'after_setup_theme', 'starterpro_slug_setup' );
if(!function_exists( 'starterpro_slug_setup' )):
    function starterpro_slug_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-formats', array( 'link', 'quote' ) );
    }
endif;


/*-------------------------------------------*
 * Navwalker
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');


/*-------------------------------------------*
 * Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 * Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');

/*-------------------------------------------------------
 * Starter legacy
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/starter-legacy.php');


/*-----------------------------------------------------
 * Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('starterpro_excerpt_max_charlength')):
	function starterpro_excerpt_max_charlength($charlength) {
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
 * Custom body class
 *----------------------------------------------------*/
add_filter( 'body_class', 'starterpro_body_class' );
function starterpro_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/*-----------------------------------------------------
 * Starter Theme Options
 *----------------------------------------------------*/
add_action('admin_menu', 'starterpro_options_menu');
if ( ! function_exists('starterpro_options_menu')){
	function starterpro_options_menu(){
		$starter_option_page = add_menu_page('Starter Pro Options', 'Starter Pro Options', 'manage_options', 'starter-options', 'flatpro_option_callback');
		add_action('load-'.$starter_option_page, 'starterpro_option_page_check');
	}
}

function starterpro_option_callback(){}
function starterpro_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_starter-options'){
		wp_redirect(admin_url('customize.php'));
	}
}

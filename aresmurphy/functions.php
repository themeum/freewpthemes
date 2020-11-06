<?php
define('ARESMURPHY_NAME', wp_get_theme()->get( 'Name' ));
define('ARESMURPHY_CSS', get_template_directory_uri().'/css/');
define('ARESMURPHY_JS', get_template_directory_uri().'/js/');

define( 'ARESMURPHY_DIR', get_template_directory() );
define( 'ARESMURPHY_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*           Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           License for Ares Murphy Theme
* -------------------------------------------- */
require_once( ARESMURPHY_DIR . '/lib/license/class.aresmurphy-theme-license.php');


/*-------------------------------------------
*           Register Post Type
*--------------------------------------------*/
//require_once(get_template_directory() . '/lib/ads/ads.php' );


/*-------------------------------------------
*           Include MetaBox
*--------------------------------------------*/
if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}
require_once (get_template_directory().'/lib/meta_box.php');


/*-------------------------------------------
*           Include TGM Plugins
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

/*-------------------------------------------
*           Customizer
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/customizer/libs/googlefonts.php');
require_once( get_template_directory()  . '/lib/customizer/customizer.php');
function aresmurphy_customize_control_js() {
	wp_enqueue_script( 'color-preset-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'aresmurphy_customize_control_js' );

/*-------------------------------------------
*           KingComposer Shortcode
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
require_once( get_template_directory()  . '/lib/addons/themeum-image-hover.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-project-addons.php' );
require_once( get_template_directory()  . '/lib/addons/thm-portfolio-slider.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-social-media.php' );
require_once( get_template_directory()  . '/lib/addons/themeum-blocknumber.php' );

/*-------------------------------------------
*           Widget
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/themeum_about_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/image_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/themeum_social_share.php' );
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');


/*-------------------------------------------*
*           Register Navigation
*------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'aresmurphy' ),
) );


/*-------------------------------------------*
*           Navwalker
*------------------------------------------*/
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
*           Ares Murphy Register
*------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
*           Themeum Core
*-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
*           Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('aresmurphy_excerpt_max_charlength')):
	function aresmurphy_excerpt_max_charlength($charlength) {
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
*           Custom body class
*----------------------------------------------------*/
add_filter( 'body_class', 'aresmurphy_body_class' );
function aresmurphy_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}


/*-----------------------------------------------------
*           Add Ares Murphy options menu
*----------------------------------------------------*/
add_action('admin_menu', 'ares_murphy_options_menu');
if ( ! function_exists('ares_murphy_options_menu')){
	function ares_murphy_options_menu(){
		$personalblog_option_page = add_menu_page('Ares Murphy Options', 'Ares Murphy Options', 'manage_options', 'aresmurphy-options', 'ares_murphy_option_callback');
		add_action('load-'.$personalblog_option_page, 'ares_murphy_option_page_check');
	}
}

function ares_murphy_option_callback(){}
function ares_murphy_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_aresmurphy-options'){
		wp_redirect(admin_url('customize.php'));
	}
}
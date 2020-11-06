<?php

define('PERSONALBLOG_NAME', wp_get_theme()->get( 'Name' ));
define('PERSONALBLOG_CSS', get_template_directory_uri().'/css/');
define('PERSONALBLOG_JS', get_template_directory_uri().'/js/');

define( 'PERSONALBLOG_DIR', get_template_directory() );
define( 'PERSONALBLOG_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/*-------------------------------------------
*          Include MetaBox
*--------------------------------------------*/
if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}
require_once (get_template_directory().'/lib/meta_box.php');


/*-------------------------------------------
*           Include TGM Plugins
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');


/* -------------------------------------------
*           	License for Personal Blog Theme
* -------------------------------------------- */
require_once( PERSONALBLOG_DIR . '/lib/license/class.personalblog-theme-license.php');


/*-------------------------------------------
*           Customizer
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/customizer/libs/googlefonts.php');
require_once( get_template_directory()  . '/lib/customizer/customizer.php');


/*-------------------------------------------
*          Widget
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/image_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/themeum_social_share.php' );
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');
require_once( get_template_directory()  . '/lib/widgets/about-widget.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' 	=> esc_html__( 'Primary Menu', 'personalblog' ),
	'footernav' => esc_html__( 'Footer Menu', 'personalblog' )
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');


/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');

require_once( get_template_directory()  . '/lib/theme-update-checker.php');
$personal_update_checker = new ThemeUpdateChecker(
	'personalblog',
	'http://demo.themeum.com/update-notice/updatepersonal.json'
);


/*-----------------------------------------------------
 * 				Load More
*----------------------------------------------------*/
add_action( 'wp_ajax_nopriv_personalblog_load_more_posts', 'personalblog_load_more_posts_cb' );
add_action( 'wp_ajax_personalblog_load_more_posts', 'personalblog_load_more_posts_cb' );
function personalblog_load_more_posts_cb()
{
    require_once( get_template_directory()  . '/lib/loadmore.php');

    die();
}


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('personalblog_excerpt_max_charlength')):
	function personalblog_excerpt_max_charlength($charlength) {
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
 * 				Personal Blog Options
 *----------------------------------------------------*/
add_action('admin_menu', 'personalblog_options_menu');
if ( ! function_exists('personalblog_options_menu')){
	function personalblog_options_menu(){
		$personalblog_option_page = add_menu_page('Personal Blog Options', 'Personal Blog Options', 'manage_options', 'personalblog-options', 'personalblog_option_callback');
		add_action('load-'.$personalblog_option_page, 'personalblog_option_page_check');
	}
}

function personalblog_option_callback(){}
function personalblog_option_page_check(){
	global $current_screen;
	if ($current_screen->id === 'toplevel_page_personalblog-options'){
		wp_redirect(admin_url('customize.php'));
	}
}

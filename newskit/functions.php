<?php
define( 'NEWSKIT_CSS', get_template_directory_uri().'/css/' );
define( 'NEWSKIT_JS', get_template_directory_uri().'/js/' );
define( 'NEWSKIT_DIR', get_template_directory() );

define( 'NEWSKIT_URI', trailingslashit(get_template_directory_uri()) );

/* -------------------------------------------
 * 				Newskit Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'newskit_options_menu');
if ( ! function_exists('newskit_options_menu')){
    function newskit_options_menu(){
        $newskit_option_page = add_menu_page('Newskit Options', 'Newskit Options', 'manage_options', 'newskit-options', 'newskit_option_callback');
        add_action('load-'.$newskit_option_page, 'newskit_option_page_check');
    }
}
function newskit_option_callback(){}
function newskit_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_newskit-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
*             License for Newskit Theme
* -------------------------------------------- */
require_once( NEWSKIT_DIR . '/lib/license/class.newskit-theme-license.php');

/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( NEWSKIT_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'newskit' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( NEWSKIT_DIR . '/lib/menu/meagmenu-walker.php');
require_once( NEWSKIT_DIR . '/lib/menu/mobile-navwalker.php');

/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( NEWSKIT_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( NEWSKIT_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('newskit_excerpt_max_charlength')):
	function newskit_excerpt_max_charlength($charlength) {
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
if(!function_exists('newskit_max_charlength')):
  function newskit_max_charlength($charlen, $char) {
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



/* -------------------------------------------
 * 				Custom body class
 * ------------------------------------------- */
add_filter( 'body_class', 'newskit_body_class' );
function newskit_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'newskit_auto_redirect_external_after_logout');
function newskit_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 * 				Remove API
 * ------------------------------------------- */
function newskit_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'newskit_remove_api' );

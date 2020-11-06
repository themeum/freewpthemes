<?php
define( 'MELODY_CSS', get_template_directory_uri().'/css/' );
define( 'MELODY_JS', get_template_directory_uri().'/js/' );
define( 'MELODY_DIR', get_template_directory() );

define( 'MELODY_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*             License for Melody Theme
* -------------------------------------------- */
require_once( MELODY_DIR . '/lib/license/class.melody-theme-license.php');


/* -------------------------------------------
*        		Licence Option
* ------------------------------------------- */
add_action('admin_menu', 'melody_options_menu');
if ( ! function_exists('melody_options_menu')){
    function melody_options_menu(){
        $melody_option_page = add_menu_page('Melody Options', 'Melody Theme Options', 'manage_options', 'melody-options', 'melody_option_callback');
        add_action('load-'.$melody_option_page, 'melody_option_page_check');
    }
}


/* -------------------------------------------
*        		Melody Option
* ------------------------------------------- */
function melody_option_callback(){}
function melody_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_melody-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/*
 * Support and Docs Menu
 * */

add_action('admin_menu', 'support_admin_menu');

/**
 * Calypso Theme Support External Link
 */
function support_admin_menu() {
    global $submenu;
    $url = 'https://www.themeum.com/docs/melody-introduction/';
    $submenu['index.php'][] = array('Melody Docs', 'manage_options', $url);
    $url = 'https://www.themeum.com/forums/forum/melody/';
    $submenu['index.php'][] = array('Melody Support Forum', 'manage_options', $url);

}

/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( MELODY_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
*				Register Navigation
*------------------------------------------*/
register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'melody' ),
	  'footer' => esc_html__( 'Footer Menu', 'melody' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( MELODY_DIR . '/lib/menu/meagmenu-walker.php');
require_once( MELODY_DIR . '/lib/menu/mobile-navwalker.php');

/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( MELODY_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
*				Themeum Core
*-------------------------------------------------------*/
require_once( MELODY_DIR . '/lib/main-function/themeum-core.php');


/*-------------------------------------------
 *          	Custom Excerpt Length
 *-------------------------------------------*/
if(!function_exists('melody_max_charlength')):
  function melody_max_charlength($charlen, $char) {
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
add_filter( 'body_class', 'melody_body_class' );
function melody_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'melody_auto_redirect_external_after_logout');
function melody_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}

if ( ! isset( $content_width ) ) $content_width = 900;
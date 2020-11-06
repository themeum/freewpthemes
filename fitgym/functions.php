<?php
define( 'FITGYM_CSS', get_template_directory_uri().'/css/' );
define( 'FITGYM_JS', get_template_directory_uri().'/js/' );
define( 'FITGYM_DIR', get_template_directory() );
define( 'FITGYM_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
 * 				Fitgym Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'fitgym_options_menu');
if ( ! function_exists('fitgym_options_menu')){
    function fitgym_options_menu(){
        $fitgym_option_page = add_menu_page('Fitgym Options', 'Fitgym Options', 'manage_options', 'fitgym-options', 'fitgym_option_callback');
        add_action('load-'.$fitgym_option_page, 'Fitgym_option_page_check');
    }
}
function fitgym_option_callback(){}
function fitgym_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_fitgym-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
*             License for Fitgym Theme
* -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.fitgym-theme-license.php');


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( FITGYM_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'fitgym' ),
	'footernav' => esc_html__( 'Footer Menu', 'fitgym' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( FITGYM_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( FITGYM_DIR . '/lib/menu/meagmenu-walker.php');
require_once( FITGYM_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Fitgym Register
 *------------------------------------------*/
require_once( FITGYM_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( FITGYM_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('fitgym_excerpt_max_charlength')):
	function fitgym_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'fitgym_body_class' );
function fitgym_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'fitgym_auto_redirect_external_after_logout');
function fitgym_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 * 				Remove API
 * ------------------------------------------- */
function fitgym_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'fitgym_remove_api' );


/* -------------------------------------------
 * 				SVG image upload
 * ------------------------------------------- */
function fitgym_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'fitgym_mime_types');


/* -------------------------------------------
 *        Theme Updater
 * ------------------------------------------- */

if ( ! class_exists('Themeum_Regular_Theme_Updater')) {
  class Themeum_Regular_Theme_Updater {
    private $api_end_point;
    private $theme_name;
    private $theme_version;

    public static function init() {
      return new self();
    }

    public function __construct() {
      $theme               = wp_get_theme();
      $this->theme_name    = strtolower( $theme->get( 'TextDomain' ) );
      $this->theme_version = $theme->get( "Version" );
      $this->api_end_point = 'https://demo.themeum.com/free-updates/';

      add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_for_update' ) );
    }

    /**
     * @return array|bool|mixed|object
     *
     * Get update information
     */
    public function check_for_update_api() {
      // Make the POST request
      $request = wp_remote_post( $this->api_end_point . $this->theme_name . '/update.php' );

      $request_body = false;
      // Check if response is valid
      if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
        $request_body = json_decode( $request['body'] );
      }

      return $request_body;
    }

    /**
     * @param $transient
     *
     * @return mixed
     */
    public function check_for_update( $transient ) {
      if ( empty( $transient->checked[ $this->theme_name ] ) ) {
        return $transient;
      }
      $request_body = $this->check_for_update_api();

      if ( $request_body ) {
        if ( version_compare( $this->theme_version, $request_body->version, '<' ) ) {
          $transient->response[ $this->theme_name ] = array(
            'new_version' => $request_body->version,
            'package'     => $request_body->download_url,
            'url'     => $request_body->url,
          );
        }
      }

      return $transient;
    }
  }

  Themeum_Regular_Theme_Updater::init();
}

//check has social links

function fitgym_has_social() {
	$wp_facebook = get_theme_mod('wp_facebook');
	$wp_twitter = get_theme_mod('wp_twitter');
	$wp_google_plus = get_theme_mod('wp_google_plus');
	$wp_pinterest = get_theme_mod('wp_pinterest');
	$wp_instagram = get_theme_mod('wp_instagram');
	$wp_youtube = get_theme_mod('wp_youtube');
	$wp_linkedin = get_theme_mod('wp_linkedin');
	$wp_dribbble = get_theme_mod('wp_dribbble');
	$wp_behance = get_theme_mod('wp_behance');
	$wp_flickr = get_theme_mod('wp_flickr');
	$wp_vk = get_theme_mod('wp_vk');
	$wp_skype = get_theme_mod('wp_skype');

	$is_social = $wp_facebook || $wp_twitter || $wp_google_plus || $wp_pinterest || $wp_instagram || $wp_youtube || $wp_linkedin || $wp_dribbble || $wp_behance || $wp_flickr || $wp_vk|| $wp_skype;

	return $is_social;
}

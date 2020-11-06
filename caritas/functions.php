<?php
define( 'CARITAS_CSS', get_template_directory_uri().'/css/' );
define( 'CARITAS_JS', get_template_directory_uri().'/js/' );
define( 'CARITAS_DIR', get_template_directory() );
define( 'CARITAS_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( CARITAS_DIR . '/lib/class-tgm-plugin-activation.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'caritas' ),
	'footernav' => esc_html__( 'Footer Menu', 'caritas' ),
) );


/*-------------------------------------------*
 *				Navwalker
 *------------------------------------------*/
require_once( CARITAS_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( CARITAS_DIR . '/lib/menu/meagmenu-walker.php');
require_once( CARITAS_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Caritas_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Caritas Register
 *------------------------------------------*/
require_once( CARITAS_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( CARITAS_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('caritas_excerpt_max_charlength')):
	function caritas_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'caritas_body_class' );
function caritas_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'caritas_auto_redirect_external_after_logout');
function caritas_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 * 				Remove API
 * ------------------------------------------- */
function caritas_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'caritas_remove_api' );


/* -------------------------------------------
 *        Theme Updater
 * ------------------------------------------- */

if ( ! class_exists('Caritas_Regular_Theme_Updater')) {
  class Caritas_Regular_Theme_Updater {
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

  Caritas_Regular_Theme_Updater::init();
}

//check has social links

function caritas_has_social() {
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

/* -------------------------------------------
 *        Lic Menu
 * ------------------------------------------- */

require_once (CARITAS_DIR. '/lib/license/class.caritas-theme-license.php');

add_action('admin_menu', 'caritas_options_menu');
if ( ! function_exists('caritas_options_menu')){
    function caritas_options_menu(){
        $caritas_option_page = add_menu_page('Caritas Options', 'Caritas Options', 'manage_options', 'caritas-options', 'caritas_option_callback');
        add_action('load-'.$caritas_option_page, 'caritas_option_page_check');
    }
}

function caritas_option_callback(){}
function caritas_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_caritas-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/**
 * Add Tinymce button for placing shortcode
 */
function caritas_add_mce_button() {

    // check user permissions
    if ( !current_user_can( 'edit_posts' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'caritas_add_tinymce_js' );
        add_filter( 'mce_buttons','caritas_register_mce_button');
    }
}
// Declare script for new button
function caritas_add_tinymce_js( $plugin_array ) {
    $plugin_array['caritas_button'] = CARITAS_JS .'/mce-button.js';
    return $plugin_array;
}
// Register new button in the editor
function caritas_register_mce_button( $buttons ) {
    array_push( $buttons, 'caritas_button' );
    return $buttons;
}

add_action( 'after_setup_theme', 'caritas_theme_setup' );

if ( ! function_exists( 'caritas_theme_setup' ) ) {
    function caritas_theme_setup() {

        add_action( 'init', 'caritas_buttons' );

    }
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'caritas_buttons' ) ) {
    function caritas_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', 'caritas_add_buttons' );
        add_filter( 'mce_buttons', 'caritas_register_buttons' );
    }
}

if ( ! function_exists( 'caritas_add_buttons' ) ) {
    function caritas_add_buttons( $plugin_array ) {
        $plugin_array['mybutton'] = CARITAS_JS.'/mce-button.js';
        return $plugin_array;
    }
}

if ( ! function_exists( 'caritas_register_buttons' ) ) {
    function caritas_register_buttons( $buttons ) {
        array_push( $buttons, 'mybutton' );
        return $buttons;
    }
}

add_action ( 'after_wp_tiny_mce', 'caritas_tinymce_extra_vars' );

if ( !function_exists( 'caritas_tinymce_extra_vars' ) ) {
	function caritas_tinymce_extra_vars() { ?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_title' => esc_html__('Donate Button', 'caritas'),
					'currency' => esc_html__('Currency Text (default: USD:$)', 'caritas'),
					'paypalid' => esc_html__('Type your Paypal ID', 'caritas'),
					'target' => esc_html__('Click Target', 'caritas'),
					'more' => esc_html__('More', 'caritas'),
					'amount1' => esc_html__('Amount 1', 'caritas'),
					'amount2' => esc_html__('Amount 2', 'caritas'),
					'amount3' => esc_html__('Amount 3', 'caritas'),
					'amount4' => esc_html__('Amount 4', 'caritas'),
					'btn_name' => esc_html__('Donate Now', 'caritas'),
					'class' => esc_html__('Css Class', 'caritas'),
				)
				);
			?>;
		</script><?php
	}
}

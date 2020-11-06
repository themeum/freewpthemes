<?php

define('WPTIXON_NAME', wp_get_theme()->get( 'Name' ));
define('WPTIXON_CSS', get_template_directory_uri().'/css/');
define('WPTIXON_JS', get_template_directory_uri().'/js/');

/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
 * 				Winkel Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'wptixon_options_menu');
if ( ! function_exists('winkel_options_menu')){
    function wptixon_options_menu(){
        $winkel_option_page = add_menu_page('Tixon Options', 'Tixon Options', 'manage_options', 'wptixon-options', 'wptixon_option_callback');
        add_action('load-'.$wptixon_option_page, 'wptixon_option_page_check');
    }
}
function wptixon_option_callback(){}
function wptixon_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_wptixon-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
*             License for Tixon Theme
* -------------------------------------------- */
require_once( get_template_directory() . '/lib/license/class.wptixon-theme-license.php');


/*-------------------------------------------
*         Register Post Type
*--------------------------------------------*/
//require_once(get_template_directory() . '/lib/ads/ads.php' );


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

/*-------------------------------------------
*           Customizer
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/customizer/libs/googlefonts.php');
require_once( get_template_directory()  . '/lib/customizer/customizer.php');
function wptixon_customize_control_js() {
	wp_enqueue_script( 'color-preset-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'wptixon_customize_control_js' );

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
require_once( get_template_directory()  . '/lib/addons/themeum-project-addons.php' );
require_once( get_template_directory()  . '/lib/addons/thm-portfolio-slider.php' );
require_once( get_template_directory()  . '/lib/addons/woocommerce-products.php' );

/*-------------------------------------------
*          Widget
*--------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/themeum_about_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/image_widget.php' );
require_once( get_template_directory()  . '/lib/widgets/themeum_social_share.php' );
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'wptixon' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('wptixon_excerpt_max_charlength')):
	function wptixon_excerpt_max_charlength($charlength) {
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



function wptixon_document_title_parts($parts)
{
	if (is_post_type_archive() && function_exists('is_shop') && is_shop()) {
		$parts['title'] = esc_html__('Shop','wptixon');
	}

	return $parts;
}
add_filter( 'document_title_parts', 'wptixon_document_title_parts', 99 );


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );



function wptixon_wc_product_loop_thumb_wrap_open()
{
	?>
	<span class="tixon-product-image">
	<?php
}
function wptixon_wc_product_loop_thumb_wrap_close()
{
	?>
	</span>
	<?php
}
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5 );


add_action( 'woocommerce_before_shop_loop_item_title', 'wptixon_wc_product_loop_thumb_wrap_open', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 25 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 30 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wptixon_wc_product_loop_thumb_wrap_close', 35 );

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );

/*-----------------------------------------------------
 * 				Custom body class
 *----------------------------------------------------*/
add_filter( 'body_class', 'wptixon_body_class' );
function wptixon_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

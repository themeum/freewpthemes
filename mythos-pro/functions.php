<?php
define( 'MYTHOS_CSS', get_template_directory_uri().'/css/' );
define( 'MYTHOS_JS', get_template_directory_uri().'/js/' );
define( 'MYTHOS_DIR', get_template_directory() );
define( 'MYTHOS_URI', trailingslashit(get_template_directory_uri()) );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
get_template_part('lib/class-tgm-plugin-activation');

/*-------------------------------------------*
*				Register Navigation
*------------------------------------------- */
register_nav_menus( array(
	'primary' 	=> esc_html__( 'Primary Menu', 'mythos-pro' ),
	'footernav' => esc_html__( 'Footer Menu', 'mythos-pro' ),
) );


/*-------------------------------------------*
*				navwalker
*------------------------------------------*/
get_template_part('lib/menu/admin-megamenu-walker');
get_template_part('lib/menu/meagmenu-walker');
get_template_part('lib/menu/mobile-navwalker');

add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
*			Startup Register
*--------------------------------------------*/
get_template_part('lib/main-function/themeum-register');


/*-------------------------------------------------------
*				Themeum Core
*-------------------------------------------------------*/
get_template_part('lib/main-function/themeum-core');
get_template_part('woocommerce/mythos-color-variations');


/*-------------------------------------------*
*				Customizer
*------------------------------------------- */
get_template_part('lib/customizer/libs/googlefonts');
get_template_part('lib/customizer/customizer');


/*-----------------------------------------------------
* 				Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('mythos_excerpt_max_charlength')):
	function mythos_excerpt_max_charlength($charlength) {
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
add_filter( 'body_class', 'mythos_body_class' );
function mythos_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg'.' body-content';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'mythos_auto_redirect_external_after_logout');
function mythos_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
*             License for mythos Theme
* -------------------------------------------- */
require_once( MYTHOS_DIR . '/lib/license/class.mythos-theme-license.php');

/* -------------------------------------------
*        		Licence Code
* ------------------------------------------- */

if (is_user_logged_in() && user_can(get_current_user_id(), 'manage_options')) {
    add_action('admin_menu', 'mythos_options_menu');

    if (!function_exists('mythos_options_menu')) {
        function mythos_options_menu()
        {
            $personalblog_option_page = add_menu_page('Mythos Options', 'Mythos Options', 'manage_options', 'mythos-options', 'mythos_option_callback');
            add_action('load-' . $personalblog_option_page, 'mythos_option_page_check');
        }
    }
}
function mythos_option_callback(){}
function mythos_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_mythos-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/*-------------------------------------------*
*              woocommerce support
*------------------------------------------*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/* -------------------------------------------
*        WooCommerce Product Column
* ------------------------------------------- */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; # 3 products per row
    }
}

// Woocommerce Product Count
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $nbr ) {
	$product_number = get_theme_mod('shop_post_count', 9);
  	return $product_number;
}


# Product Rating.
add_action('woocommerce_after_shop_loop_item', 'get_star_rating' );
function get_star_rating(){
	global $product;

    $average 		= $product->get_average_rating();
    $rating_count 	= $product->get_rating_count();
	$review_count 	= $product->get_review_count(); ?>
	<div class="woocommerce-product-rating">
		<?php echo wp_kses_post(wc_get_rating_html( $average, $rating_count )); ?>
        <?php if ( comments_open() ) : 
            /* translators: %s is replaced with "string" */
            ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
				<?php printf( (int) $review_count); ?>
				(<?php printf( esc_html(_n( 'review', 'reviews', (int) $review_count, 'mythos-pro' )), '<span class="count">' . (int) $review_count . '</span>' ); ?>)
			</a>
		<?php endif ?>
	</div>
<?php	
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

# Remove product description in single page.
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	$tabs['description']['title'] = 'Informations';
    unset( $tabs['additional_information'] );
    return $tabs;
}

# add variation sale price
function get_variation_price_by_id($product_id, $variation_id){
	$currency_symbol = get_woocommerce_currency_symbol();
	$product = new WC_Product_Variable($product_id);
	$variations = $product->get_available_variations();
	$var_data = [];
	foreach ($variations as $variation) {
		if($variation['variation_id'] == $variation_id){
			$display_regular_price = $variation['display_regular_price'].'<span class="currency">'. $currency_symbol .'</span>';
			$display_price = $variation['display_price'].'<span class="currency">'. $currency_symbol .'</span>';
		}
	}
	//Check if Regular price
	if ($display_regular_price == $display_price){
		$display_price = false;
	}
	$priceArray = array(
		'display_regular_price' => $display_regular_price,
		'display_price' => $display_price
	);
	$priceObject = (object)$priceArray;
	return $priceObject;
}











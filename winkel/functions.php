<?php
define( 'winkel_CSS', get_template_directory_uri().'/css/' );
define( 'winkel_JS', get_template_directory_uri().'/js/' );
define( 'winkel_DIR', get_template_directory() );


/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );


/* -------------------------------------------
 * 				Winkel Options Menu
 * ------------------------------------------- */
add_action('admin_menu', 'winkel_options_menu');
if ( ! function_exists('winkel_options_menu')){
    function winkel_options_menu(){
        $winkel_option_page = add_menu_page('Winkel Options', 'Winkel Options', 'manage_options', 'winkel-options', 'winkel_option_callback');
        add_action('load-'.$winkel_option_page, 'winkel_option_page_check');
    }
}
function winkel_option_callback(){}
function winkel_option_page_check(){
    global $current_screen;
    if ($current_screen->id === 'toplevel_page_winkel-options'){
        wp_redirect(admin_url('customize.php'));
    }
}


/* -------------------------------------------
*             License for Winkel Theme
* -------------------------------------------- */
require_once( winkel_DIR . '/lib/license/class.winkel-theme-license.php');


/* -------------------------------------------
*          		Include MetaBox
* -------------------------------------------- */
if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
	require_once ( winkel_DIR .'/lib/meta-box/meta-box.php');
}
require_once ( winkel_DIR .'/lib/meta_box.php' );


/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( winkel_DIR . '/lib/class-tgm-plugin-activation.php');

/* ------------------------------------------
*           	Customizer
* ------------------------------------------- */
require_once( winkel_DIR . '/lib/customizer/libs/googlefonts.php');
require_once( winkel_DIR . '/lib/customizer/customizer.php');
require_once( winkel_DIR . '/lib/login-register.php');

function winkel_customize_control_js() {
	wp_enqueue_script( 'color-preset-control', winkel_JS . 'color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'winkel_customize_control_js' );


/* -------------------------------------------
*          		Widget
* -------------------------------------------- */
require_once( winkel_DIR . '/lib/widgets/themeum_about_widget.php' );
require_once( winkel_DIR . '/lib/widgets/image_widget.php' );
require_once( winkel_DIR . '/lib/widgets/themeum_social_share.php' );
require_once( winkel_DIR . '/lib/widgets/blog-posts.php');
require_once( winkel_DIR . '/lib/widgets/themeum_shop_category.php');
require_once( winkel_DIR . '/lib/widgets/themeum_brand_category.php');



/*-------------------------------------------
*          		Element addons
*--------------------------------------------*/
require_once( winkel_DIR . '/lib/thm-elementor/thm-elementor.php');

/*-------------------------------------------
*          		WPPB addons
*--------------------------------------------*/
require_once( winkel_DIR . '/lib/thm-wppb/thm-wppb.php');


/*-------------------------------------------
*          		add font winkel
*--------------------------------------------*/
require_once( winkel_DIR . '/lib/fontwinkel-helper.php');


/*-------------------------------------------
*          		Cart Shortcode
*--------------------------------------------*/
require_once( winkel_DIR . '/lib/cart-shortcode.php');

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' 		=> esc_html__( 'Primary Menu', 'winkel' ),
	'footernav' 	=> esc_html__( 'Button Menu', 'winkel' ),
	'footer_menu' 	=> esc_html__( 'Footer Menu', 'winkel' ),
) );


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
require_once( winkel_DIR . '/lib/menu/admin-megamenu-walker.php');
require_once( winkel_DIR . '/lib/menu/meagmenu-walker.php');
require_once( winkel_DIR . '/lib/menu/mobile-navwalker.php');
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( winkel_DIR . '/lib/main-function/themeum-register.php');


/*-------------------------------------------------------
 *				Themeum Core
 *-------------------------------------------------------*/
require_once( winkel_DIR . '/lib/main-function/themeum-core.php');


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('winkel_excerpt_max_charlength')):
	function winkel_excerpt_max_charlength($charlength) {
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
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/* -------------------------------------------
 * 				Custom body class
 * ------------------------------------------- */
add_filter( 'body_class', 'winkel_body_class' );
function winkel_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'winkel_auto_redirect_external_after_logout');
function winkel_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
* 				Remove API
* ------------------------------------------- */
function winkel_remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'winkel_remove_api' );


/* -------------------------------------------
 *   cart override
 * ------------------------------------------- */

function woocommerce_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="love show-cart-btn" data-viewcart="'.__( "View Cart","winkel" ).'"><i class="fa fa-eye"></i></a>';
}


/* -------------------------------------------
 *   Add Custom Field To Category Form
 * ------------------------------------------- */
add_action( 'product_cat_add_form_fields', 'product_cat_form_custom_field_add', 10 );
add_action( 'product_cat_edit_form_fields', 'product_cat_form_custom_field_edit', 10, 2 );
function product_cat_form_custom_field_add( $taxonomy ) {
	?>
	<div class="form-field">
	<label for="product_cat_custom_order"><?php _e('Select category icon','winkel');?></label>
		<select  id="product_cat_custom_order" name="product_cat_custom_order">
			<?php
				$iconlist = getWinkelIconsList();
				$op = '<option value="%s"%s>%s</option>';
				foreach ($iconlist as $value ) {
					if ($product_cat_custom_order == $value) {
						printf($op, $value, ' selected="selected"', $value);
					} else {
						printf($op, $value, '', $value);
					}
				}
				?>
		</select>
		<label for="product_cat_subtitle_custom_order"><?php _e('Category sub title','winkel');?></label>
		<input name="product_cat_subtitle_custom_order" id="product_cat_subtitle_custom_order" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('Add sub title','winkel');?></p>
	</div>
	<?php
}
 
function product_cat_form_custom_field_edit( $tag, $taxonomy ) {
?>
	<tr class="form-field">
		<th scope="row"><label for="product_cat_custom_order"><?php _e('Select Icon','winkel');?></label></th>
		<td>
			<select  id="product_cat_custom_order" name="product_cat_custom_order">
			<?php
			    $option_name = 'product_cat_custom_order_' . $tag->term_id;
			    $product_cat_custom_order = get_option( $option_name );
			    $iconlist = getWinkelIconsList();

				$op = '<option value="%s"%s>%s</option>';

				foreach ($iconlist as $value ) {

					if ($product_cat_custom_order == $value) {
			            printf($op, $value, ' selected="selected"', $value);
			        } else {
			            printf($op, $value, '', $value);
			        }
			    }
				?>
			</select>
		</td>
	</tr>

	<?php 
	$option_name = 'product_cat_subtitle_custom_order_' . $tag->term_id;
	$product_cat_subtitle_custom_order = get_option( $option_name );
	?>
	<tr class="form-field">
	  <th scope="row" valign="top"><label for="product_cat_subtitle_custom_order"><?php _e('Add sub title','winkel');?></label></th>
	  <td>
	    <input type="text" name="product_cat_subtitle_custom_order" id="product_cat_subtitle_custom_order" value="<?php echo esc_attr( $product_cat_subtitle_custom_order ) ? esc_attr( $product_cat_subtitle_custom_order ) : ''; ?>" size="40" aria-required="true" />
	     <p class="description"><?php _e('Add sub title','winkel');?></p>
	  </td>
	</tr>

<?php
}

/** Save Custom Field Of product_cat Form */
add_action( 'created_product_cat', 'product_cat_form_custom_field_save', 10, 2 ); 
add_action( 'edited_product_cat', 'product_cat_form_custom_field_save', 10, 2 );
 
function product_cat_form_custom_field_save( $term_id, $tt_id ) {

    if ( isset( $_POST['product_cat_custom_order'] ) ) {         
        $option_name = 'product_cat_custom_order_' . $term_id;
        update_option( $option_name, sanitize_text_field( $_POST['product_cat_custom_order'] ) );
    }

	if ( isset( $_POST['product_cat_subtitle_custom_order'] ) ) {			
		$option_name = 'product_cat_subtitle_custom_order_' . $term_id;
		update_option( $option_name, sanitize_text_field( $_POST['product_cat_subtitle_custom_order'] ) );
	}

}


/* -------------------------------------------
 *   show header cart
 * ------------------------------------------- */
if ( ! function_exists( 'winkel_header_cart' ) ) {
	function winkel_header_cart() {
		if( function_exists('WC') ){
			?>
			<ul class="site-header-cart menu">
				<li>
					<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'winkel' ); ?>">
					<span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'winkel' ), WC()->cart->get_cart_contents_count() ) );?></span>
					</a>
				</li>
				<li>
					<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
				</li>
			</ul>
		<?php
		}
	}
}

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'storefront_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'storefront_cart_link_fragment' );
}
if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
	function storefront_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start(); ?>
					<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'winkel' ); ?>">
			<span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'winkel' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
			<?php 
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/* -------------------------------------------
 *  filter tab
 * ------------------------------------------- */
add_filter( 'woocommerce_product_tabs', 'winekl_new_product_tab' );
function winekl_new_product_tab( $tabs ) {
	// Adds the new tab
	$tabs['test_tab'] = array(
		'title' 	=> __( 'Short Description', 'winkel' ),
		'priority' 	=> 1,
		'callback' 	=> 'woo_new_product_tab_content'
	);
	return $tabs;
}
function woo_new_product_tab_content() {
	// The new tab content
	global $post;
	echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );	
}


/* -------------------------------------------
 *  Add custom taxonomy
 * ------------------------------------------- */
function winkel_register_product_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Brand Categories', 'taxonomy general name', 'winkel' ),
		'singular_name'     	=> _x( 'Brand Category', 'taxonomy singular name', 'winkel' ),
		'search_items'      	=> __( 'Search Brand Category', 'winkel' ),
		'all_items'         	=> __( 'All Brand Category', 'winkel' ),
		'parent_item'       	=> __( 'Product Parent Category', 'winkel' ),
		'parent_item_colon' 	=> __( 'Product Parent Category:', 'winkel' ),
		'edit_item'         	=> __( 'Edit Brand Category', 'winkel' ),
		'update_item'       	=> __( 'Update Brand Category', 'winkel' ),
		'add_new_item'      	=> __( 'Add New Brand Category', 'winkel' ),
		'new_item_name'     	=> __( 'New Brand Category Name', 'winkel' ),
		'menu_name'         	=> __( 'Brand Category', 'winkel' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('product_brand',array( 'product' ),$args);
}
add_action('init','winkel_register_product_cat_taxonomy');


/* -------------------------------------------
 *   Add custom field in brand category
 * ------------------------------------------- */

/** Add Custom Field To Category Form */
add_action( 'product_brand_add_form_fields', 'product_brand_form_custom_field_add', 10 );
add_action( 'product_brand_edit_form_fields', 'product_brand_form_custom_field_edit', 10, 2 );


function product_brand_form_custom_field_add( $taxonomy ) {
	?>
	<div class="form-field">
		<label for="product_brand_subtitle_custom_order"><?php _e('Add sub banner image','winkel');?></label>
		<input name="product_brand_subtitle_custom_order" id="product_brand_subtitle_custom_order" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('Add sub banner image','winkel');?></p>
	</div>
	<?php
	}
	
	function product_brand_form_custom_field_edit( $tag, $taxonomy ) {
	
	?>
		<?php 
		$option_name = 'product_brand_subtitle_custom_order_' . $tag->term_id;
		$product_brand_subtitle_custom_order = get_option( $option_name );
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="product_brand_subtitle_custom_order"><?php _e('Add sub banner image','winkel');?></label></th>
		<td>
			<input type="text" name="product_brand_subtitle_custom_order" id="product_brand_subtitle_custom_order" value="<?php echo esc_attr( $product_brand_subtitle_custom_order ) ? esc_attr( $product_brand_subtitle_custom_order ) : ''; ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Add sub banner image','winkel');?></p>
		</td>
		</tr>
	<?php
}

/** Save Custom Field Of product_brand Form */
add_action( 'created_product_brand', 'product_brand_form_custom_field_save', 10, 2 ); 
add_action( 'edited_product_brand', 'product_brand_form_custom_field_save', 10, 2 );
function product_brand_form_custom_field_save( $term_id, $tt_id ) {
	if ( isset( $_POST['product_brand_subtitle_custom_order'] ) ) {			
		$option_name = 'product_brand_subtitle_custom_order_' . $term_id;
		update_option( $option_name, sanitize_text_field( $_POST['product_brand_subtitle_custom_order'] ) );
	}
}


/* -------------------------------------------
 *   filter woocommerce_layered_nav_any_label
 * ------------------------------------------- */
function winkel_filter_woocommerce_layered_nav_any_label( $sprintf, $taxonomy_label, $taxonomy ) { 
    return 'All'; 
};
add_filter( 'woocommerce_layered_nav_any_label', 'winkel_filter_woocommerce_layered_nav_any_label', 10, 3 ); 

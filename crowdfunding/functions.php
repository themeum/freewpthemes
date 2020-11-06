<?php
			define('THMJS', get_template_directory_uri().'/js/');
			define('KC_LICENSE', 'l483kg4m-jxbv-ju7k-or7h-yhgd-q3jl1ec3fqyi');

function crowdfunding_scripts() {
	//Default CSS
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );
			wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css' );
			wp_enqueue_style( 'owl-theme-css', get_template_directory_uri() . '/css/owl.theme.css' );
			wp_enqueue_style( 'owl-transitions-css', get_template_directory_uri() . '/css/owl.transitions.css' );
			wp_enqueue_style( 'animated', get_template_directory_uri() . '/css/animated.css' );
			wp_enqueue_style( 'crowdfunding-main-css', get_template_directory_uri() . '/css/main.css' );
			wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );

  //Default JS
			wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '01102019', true );

}
add_action( 'wp_enqueue_scripts', 'crowdfunding_scripts' );

/*-------------------------------------------------------
 *              Metabox Add
 *-------------------------------------------------------*/
if(!function_exists('rwmb_meta')){
    // Include the meta box script
    require_once get_template_directory() . '/lib/meta-box/meta-box.php';
    require_once (get_template_directory().'/lib/metabox.php');
}

/*-------------------------------------------------------
*              Redux Framework Options Added
*-------------------------------------------------------*/
global $themeum_options;
if ( !class_exists( 'ReduxFramework' ) ) {
    require_once( get_template_directory() . '/admin/framework.php' );
}
require_once( get_template_directory() . '/admin/import-functions.php' );
if ( !isset( $redux_demo ) ) {
    require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

/*-------------------------------------------*
 *              Register Navigation
 *------------------------------------------*/
		register_nav_menus( array( 'primary' => 'Main Menu' ) );

/*-------------------------------------------*
 *              title tag
 *------------------------------------------*/
		add_action( 'after_setup_theme', 'wpneo_theme_support' );
function wpneo_theme_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'title-tag' );
}

/*-------------------------------------------*
 *              Navwalker
 *------------------------------------------*/
		require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
		require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
		require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
		add_filter( 'wp_edit_nav_menu_walker','crowdfunding_megamenu_walker', 10, 2 );
		function crowdfunding_megamenu_walker($class, $menu_id){
		    return 'Themeum_Megamenu_Walker';
}

/*-------------------------------------------*
 *              Startup Register
 *-------------------------------------------*/
		require_once( get_template_directory()  . '/lib/main-function/crowdfunding-register.php');
		require_once( get_template_directory()  . '/lib/main-function/crowdfunding-core.php');

/*-------------------------------------------
 *          AJAX login System
 *-------------------------------------------*/
		require_once( get_template_directory() . '/lib/login.php' );
		require_once( get_template_directory()  . '/lib/main-function/ajax-login.php' );
		require_once( get_template_directory()  . '/lib/main-function/login-registration.php' );

/*-------------------------------------------
*           Custom Widgets
*--------------------------------------------*/
		require_once( get_template_directory()  . '/lib/widgets/image_widget.php');
		require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');
		require_once( get_template_directory()  . '/lib/widgets/follow_us_widget.php');
		require_once( get_template_directory()  . '/lib/widgets/menu_list_widget.php');

/*-------------------------------------------
*           General Shortcode
*--------------------------------------------*/
		require_once( get_template_directory()  . '/lib/main-function/crowdfunding-shortcode.php' );

/*-------------------------------------------
*           KingComposer Shortcode
*--------------------------------------------*/
		require_once( get_template_directory()  . '/lib/addons/kc-slider.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-listing.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-title.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-feature.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-counter.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-recent-blog.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-google-map.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-icon-title.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-person.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-search.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-project-form.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-registration.php' );
		require_once( get_template_directory()  . '/lib/addons/kc-dashboard.php' );

/*-------------------------------------------
 *          User Login AJAX Check
 *-------------------------------------------*/
function ajax_check_user_logged_in() {
    echo is_user_logged_in()?'yes':'no';
    die();
}
		add_action('wp_ajax_is_user_logged_in', 'ajax_check_user_logged_in');
		add_action('wp_ajax_nopriv_is_user_logged_in', 'ajax_check_user_logged_in');

/*-------------------------------------------
 *          Custom Excerpt Length
 *-------------------------------------------*/
if(!function_exists('crowdfunding_excerpt_max_charlength')):
    function crowdfunding_excerpt_max_charlength($str,$charlength) {
        $excerpt = $str;
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

		add_action("wp_ajax_wpneo_search", "ajax_data_search_return");
		add_action("wp_ajax_nopriv_wpneo_search", "ajax_data_search_return");
function ajax_data_search_return(){
    $output = '';
    $data_view = '';
    $args = array();
    if(isset($_POST['raw_data'])){
        $args = array(
            's'                 => $_POST['raw_data'],
            'post_type'         => 'product',
            'posts_per_page'    => 10
        );
        if(isset($_POST['category'])){
            if($_POST['category']!='' && $_POST['category']!='all'){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    =>  $_POST['category'],
                    ),
                );
            }
        }
        $data_view = $_POST['raw_data'];
    }
    $search_data = new WP_Query($args);
    if($search_data->have_posts()):
        $output .= '<ul>';
        while ($search_data->have_posts()): $search_data->the_post();
            $the_title = str_ireplace( $data_view ,"<span>".$data_view."</span>", get_the_title() );
            $output .= '<li><a href="'.get_permalink().'"><i class="fa fa-caret-square-o-right"></i> '.$the_title.'</a></li>';
        endwhile;
        $output .= '</ul>';
        wp_reset_postdata();
    endif;
    wp_die($output);
}

/* -------------------------------------------
*        Guttenberg for Themeum Themes
* ------------------------------------------- */
			add_theme_support( 'align-wide' );
			add_theme_support( 'wp-block-styles' );

/* -------------------------------------------
*        Add JS from the Theme Options
* ------------------------------------------- */
function custom_js_add(){
    global $themeum_options;
    if( isset($themeum_options['js_editor']) ){
        echo '<script type="text/javascript">';
        echo $themeum_options['js_editor'];
        echo '</script>';
    }
}
			add_action( 'wp_footer', 'custom_js_add' );
			require_once( get_template_directory()  . '/lib/import-functions.php');

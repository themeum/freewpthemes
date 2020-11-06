<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('eventco_widdget_init')):

    function eventco_widdget_init(){
        $bottomcolumn = get_theme_mod( 'bottom_column', '4' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'eventco' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'eventco' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'eventco' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'eventco' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom Widgets', 'eventco' ),
            'id'            => 'bottom1',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'eventco'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

    }

    add_action('widgets_init','eventco_widdget_init');

endif;

if ( ! function_exists( 'eventco_fonts_url' ) ) :
    function eventco_fonts_url() {
    $fonts_url = '';

    $montserrat = _x( 'on', 'Montserrat font: on or off', 'eventco' );

    if ( 'off' !== $montserrat ) {
    $font_families = array();

    if ( 'off' !== $montserrat ) {
    $font_families[] = 'Montserrat:100,200,300,400,500,600,700';
    }

    $query_args = array(
    'family'  => urlencode( implode( '|', $font_families ) ),
    'subset'  => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('eventco_style')):

    function eventco_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700' );

        wp_enqueue_style( 'eventco-font', eventco_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap', EVENTCO_CSS . 'bootstrap.min.css',false,'all');
        if ( is_rtl() ) {
            wp_enqueue_style( 'bootstrap-rtl', EVENTCO_CSS . 'bootstrap-rtl.min.css',false,'all');
        }
        wp_enqueue_style( 'font-awesome', EVENTCO_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'magnific-popup', EVENTCO_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'eventco-main', EVENTCO_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'eventco-woocommerce', EVENTCO_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'eventco-custom.css', EVENTCO_CSS . 'custom.css',false,'all');
        wp_enqueue_style( 'eventco-responsive', EVENTCO_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'eventco-style',get_stylesheet_uri());
        wp_add_inline_style( 'eventco-style', EVENTCO_css_generator() );

        #JS
        wp_enqueue_script('tether',EVENTCO_JS.'tether.min.js',array(),false,true);
        wp_enqueue_script('popper',EVENTCO_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',EVENTCO_JS.'bootstrap.js',array(),false,true);
        wp_enqueue_script('loopcounter',EVENTCO_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('js-social',EVENTCO_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',EVENTCO_JS.'jquery.magnific-popup.min.js',array(),false,true);

        if( get_theme_mod( 'custom_preset_en', true ) == 0 ) {
            wp_enqueue_style( 'themeum-preset', get_parent_theme_file_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );
        }
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('eventco-main',EVENTCO_JS.'main.js',array(),false,true);

        # For Ajax URL
        wp_enqueue_script('eventco-main');
        wp_localize_script( 'eventco-main', 'ajax_objects', array(
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...','eventco'),
            'ajax_nonce'        => wp_create_nonce('calendar-demo-nonce')
        ));
    }

    add_action('wp_enqueue_scripts','eventco_style');

endif;

if(!function_exists('eventco_admin_style')):

    function eventco_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_parent_theme_file_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');

        if( is_admin() ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script('eventco-colorpicker', get_parent_theme_file_uri().'/js/admin-colorpicker.js',  array( 'wp-color-picker' ),false,true);
        }

    }
    add_action('admin_enqueue_scripts','eventco_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'eventco_plugins_include');

if(!function_exists('eventco_plugins_include')):

    function eventco_plugins_include()
    {
        $plugins = array(

                array(
                    'name'                  => esc_html__( 'WP Page Builder by Themeum', 'eventco' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'eventco' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Eventco Core', 'eventco' ),
                    'slug'                  => 'eventco-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/eventco/eventco-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'eventco' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => 'WooCoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.0.8.zip',
                ),
                array(
                    'name'                  => 'Eventco Demo Importer',
                    'slug'                  => 'eventco-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/eventco/eventco-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'eventco' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.3.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'eventco' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),


            );

        $config = array(
            'domain'            => 'eventco',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'eventco' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'eventco' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'eventco' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'eventco'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'eventco'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','eventco'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'eventco' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;


/*-------------------------------------------------------
*       Next and Previous Month of Events Calendar
*-------------------------------------------------------- */
function eventco_displaynextmonth(){
    check_ajax_referer( 'calendar-demo-nonce', '_nonce' );
    if( isset($_POST['nextmonth']) && isset($_POST['nextyear']) ){
        get_template_part('lib/calendar');
        $calendar_next = new Calendar();
        $nextmonth  = $_POST['nextmonth'];
        $nextyear   = $_POST['nextyear'];
        echo $calendar_next->eventco_nextprevious_month( $nextmonth, $nextyear );
    }
    wp_die();
}
add_action('wp_ajax_eventco_displaynextmonth', 'eventco_displaynextmonth');
add_action('wp_ajax_nopriv_eventco_displaynextmonth', 'eventco_displaynextmonth');

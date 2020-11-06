<?php 
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('personalblog_widdget_init')):

    function personalblog_widdget_init()
    {

        register_sidebar(
            array( 
                'name'          => esc_html__( 'Sidebar', 'personalblog' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'personalblog' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(
            array( 
                'name'          => esc_html__( 'Bottom', 'personalblog' ),
                'id'            => 'bottom',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'personalblog'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

    }
    
    add_action('widgets_init','personalblog_widdget_init');

endif;

if ( ! function_exists( 'personalblog_fonts_url' ) ) :
    function personalblog_fonts_url() {
    $fonts_url = '';

    $open_sans = _x( 'on', 'Poppins font: on or off', 'personalblog' );
     
    if ( 'off' !== $open_sans ) {
    $font_families = array();
     
    if ( 'off' !== $open_sans ) {
    $font_families[] = 'Poppins:300,400,500,600,700';
    }
     
    $query_args = array(
    'family'  => urlencode( implode( '|', $font_families ) ),
    'subset'  => urlencode( 'latin,latin-ext' ),
    );
     
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
     
    return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('personalblog_style')):

    function personalblog_style(){

        wp_enqueue_style( 'personalblog-font', personalblog_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css',false,'all');
        wp_enqueue_style( 'personalblog-main', get_template_directory_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'personalblog-responsive', get_template_directory_uri() . '/css/responsive.css',false,'all');
        wp_enqueue_style('personalblog-style',get_stylesheet_uri());
        wp_add_inline_style( 'personalblog-style', personalblog_css_generator() );
        wp_enqueue_script('bootstrap',PERSONALBLOG_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial.min',PERSONALBLOG_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.scrollUp.min',PERSONALBLOG_JS.'jquery.scrollUp.min.js',array(),false,true);
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('unique-style',PERSONALBLOG_JS.'main.js',array(),false,true);
        wp_localize_script( 'unique-style', 'theme_personalblog', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    }

    add_action('wp_enqueue_scripts','personalblog_style');

endif;




if(!function_exists('personalblog_admin_style')):

    function personalblog_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','personalblog_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'personalblog_plugins_include');

if(!function_exists('personalblog_plugins_include')):

    function personalblog_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'wp instagram widget', 'personalblog' ),
                    'slug'                  => 'wp-instagram-widget',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-instagram-widget.zip'),
                ),                                                        
                array(
                    'name'                  => esc_html__( 'Widget Importer Exporter', 'personalblog' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.4.zip'),
                ),
            );
    $config = array(
            'domain'            => 'personalblog',           
            'default_path'      => '',                           
            'parent_menu_slug'  => 'themes.php',                 
            'parent_url_slug'   => 'themes.php',                
            'menu'              => 'install-required-plugins',   
            'has_notices'       => true,                         
            'is_automatic'      => false,                      
            'message'           => '',                     
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'personalblog' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'personalblog' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'personalblog' ), 
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'personalblog'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'personalblog'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','personalblog'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'personalblog' ) 
                )
    );

    tgmpa( $plugins, $config );

    }

endif;
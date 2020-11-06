<?php 
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('calcio_widdget_init')):

    function calcio_widdget_init()
    {

        $bottomcolumn = get_theme_mod( 'bottom_column', '3' );

        register_sidebar(array( 'name'          => esc_html__( 'Left Sidebar', 'calcio' ),
                                'id'            => 'left_sidebar',
                                'description'   => esc_html__( 'Widgets in this area will be shown on Left Sidebar.', 'calcio' ),
                                'before_title'  => '<h3 class="widget_title">',
                                'after_title'   => '</h3>',
                                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                                'after_widget'  => '</div>'
                    )
        );
        register_sidebar(array( 'name'          => esc_html__( 'Right Sidebar', 'calcio' ),
                                'id'            => 'right_sidebar',
                                'description'   => esc_html__( 'Widgets in this area will be shown on Right Sidebar.', 'calcio' ),
                                'before_title'  => '<h3 class="widget_title">',
                                'after_title'   => '</h3>',
                                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                                'after_widget'  => '</div>'
                    )
        );


        register_sidebar(array( 
                            'name'          => esc_html__( 'Bottom', 'calcio' ),
                            'id'            => 'bottom',
                            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'calcio'),
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>',
                            'before_widget' => '<div class="col-sm-6 col-md-'.esc_attr($bottomcolumn).' bottom-widget"><div id="%1$s" class="widget %2$s" >',
                            'after_widget'  => '</div></div>'
                            )
        );

    }
    
    add_action('widgets_init','calcio_widdget_init');

endif;

if ( ! function_exists( 'calcio_fonts_url' ) ) :
    function calcio_fonts_url() {
        $fonts_url = '';
        $montserrat = _x( 'on', 'Montserrat font: on or off', 'calcio' );
        if ( 'off' !== $montserrat ) {
            $font_families = array();
            if ( 'off' !== $montserrat ) {
                $font_families[] = 'Montserrat:300,400,600,700,800';
            }
            $query_args = array(
                'family'  => urlencode( implode( '|', $font_families ) ),
                'subset'  => urlencode( 'latin' ),
            );
            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('calcio_style')):

    function calcio_style(){

        wp_enqueue_style( 'calcio-font', calcio_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap', get_parent_theme_file_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome', get_parent_theme_file_uri() . '/css/font-awesome.css',false,'all');
        wp_enqueue_style( 'magnific-popup', get_parent_theme_file_uri() . '/css/magnific-popup.css',false,'all');
        wp_enqueue_style( 'calcio-main', get_parent_theme_file_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'calcio-custom', get_parent_theme_file_uri() . '/css/custom.css',false,'all');
        wp_enqueue_style( 'calcio-responsive', get_parent_theme_file_uri() . '/css/responsive.css',false,'all');
        wp_enqueue_style( 'calcio-woocommerce', get_parent_theme_file_uri() . '/css/woocommerce.css',false,'all');

        wp_enqueue_style('calcio-style',get_stylesheet_uri());
        wp_add_inline_style( 'calcio-style', calcio_css_generator() );
        wp_enqueue_script('bootstrap',CALCIO_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('magnific-popup',CALCIO_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',CALCIO_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('prettySocial',CALCIO_JS.'jquery.prettySocial.min.js',array(),false,true);
        
        if( get_theme_mod( 'custom_preset_en', true ) == 0 ){
            wp_enqueue_style( 'calcio-preset', get_parent_theme_file_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );       
        }

        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}

        wp_enqueue_script('unique-style',CALCIO_JS.'main.js',array(),false,true);
        wp_localize_script( 'unique-style', 'thm_calcio', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

        wp_localize_script( 'unique-style', 'thm_edc', array( 'thm_mmc_right' => get_theme_mod( 'header_search_btn', false ) ? 24 : 0, ) );

        if ( is_rtl() ) {
          wp_enqueue_style( 'bootstrap-rtl', get_parent_theme_file_uri() . '/css/bootstrap-rtl.min.css',false,'all');  
        }
    }

    add_action('wp_enqueue_scripts','calcio_style');

endif;




if(!function_exists('calcio_admin_style')):

    function calcio_admin_style(){
        wp_enqueue_media();
        wp_register_script('calcio-post-meta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('calcio-post-meta');
    }
    add_action('admin_enqueue_scripts','calcio_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'calcio_plugins_include');

if(!function_exists('calcio_plugins_include')):

    function calcio_plugins_include()
    {
        $plugins = array(

                array(
                    'name'                  => esc_html__( 'Themeum Core', 'calcio' ),
                    'slug'                  => 'themeum-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/calcio/themeum-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum Demo Importer', 'calcio' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/calcio/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                      
                array(
                    'name'                  => esc_html__( 'WPBakery Visual Composer', 'calcio' ),
                    'slug'                  => 'js_composer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/js_composer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                                                         
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'calcio' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                ), 
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'calcio' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                ),  
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                ), 
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'calcio' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                ),
            );
    $config = array(
        'id'           => 'calcio',                
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,                   
        'dismissable'  => true,                    
        'dismiss_msg'  => '',                     
        'is_automatic' => false,                 
        'message'      => '',                                  
    );

    tgmpa( $plugins, $config );

    }

endif;
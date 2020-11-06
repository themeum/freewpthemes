<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('starterpro_widdget_init')):

    function starterpro_widdget_init()
    {

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'starterpro' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'starterpro' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Bottom', 'starterpro' ),
                'id'            => 'bottom',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'starterpro'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

    }

    add_action('widgets_init','starterpro_widdget_init');

endif;

if ( ! function_exists( 'starterpro_fonts_url' ) ) :
    function starterpro_fonts_url() {
    $fonts_url = '';

    $open_sans = _x( 'on', 'Poppins font: on or off', 'starterpro' );

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
if(!function_exists('starterpro_style')):

    function starterpro_style(){

        wp_enqueue_style( 'starterpro-font', starterpro_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css',false,'all');
        wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css',false,'all');
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css',false,'all');
        wp_enqueue_style( 'starterpro-starter-legacy', get_template_directory_uri() . '/css/starter-legacy.css',false,'all');
        wp_enqueue_style( 'starterpro-custom-css', get_template_directory_uri() . '/css/custom-css.css',false,'all');
        wp_enqueue_style( 'starterpro-main', get_template_directory_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'starterpro-blog-detaills', get_template_directory_uri() . '/css/blog-details.css',false,'all');
        wp_enqueue_style( 'starterpro-responsive', get_template_directory_uri() . '/css/responsive.css',false,'all');

        wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css',false,'all');
        wp_enqueue_style( 'animate.min', get_template_directory_uri() . '/css/animate.min.css',false,'all');

        wp_enqueue_style('starterpro-style',get_stylesheet_uri());
        wp_add_inline_style( 'starterpro-style', starterpro_css_generator() );
        wp_enqueue_script('bootstrap',STARTERPRO_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',STARTERPRO_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',STARTERPRO_JS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',STARTERPRO_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',STARTERPRO_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettyPhoto',STARTERPRO_JS.'jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',STARTERPRO_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.nav',STARTERPRO_JS.'jquery.nav.js',array(),false,true);
        wp_enqueue_script('main-onepage',STARTERPRO_JS.'main-onepage.js',array(),false,true);

        // Google Map API key
        if( get_theme_mod( 'google_map_api_key', '' ) ){
          wp_enqueue_script( 'googlemap', 'https://maps.google.com/maps/api/js?key='.get_theme_mod( 'google_map_api_key'), array(), '',false,true );
        }

        wp_enqueue_script('gmaps',STARTERPRO_JS.'gmaps.js',array(),false,true);

        if( get_theme_mod( 'custom_preset_en', true ) == 0 ) {
            wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );
        }

        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}

        wp_enqueue_script('unique-style',STARTERPRO_JS.'main.js',array(),false,true);

    }

    add_action('wp_enqueue_scripts','starterpro_style');

endif;




if(!function_exists('starterpro_admin_style')):

    function starterpro_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','starterpro_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'starterpro_plugins_include');

if(!function_exists('starterpro_plugins_include')):

    function starterpro_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'King Composer', 'starterpro' ),
                    'slug'                  => 'kingcomposer',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/kingcomposer.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'King Composer RPO (Free with StarterPro)', 'starterpro' ),
                    'slug'                  => 'kc_pro',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/starterpro/kc_pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum demo importer', 'starterpro' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/starterpro/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum Project', 'starterpro' ),
                    'slug'                  => 'themeum-project',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/starterpro/themeum-project.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'starterpro' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.5.zip'),
                ),

                array(
                    'name'                  => esc_html__( 'Widget Settings Importer/Exporter', 'starterpro' ),
                    'slug'                  => 'widget-settings-importexport',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-settings-importexport.1.5.0.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'starterpro' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip'),
                ),
            );
    $config = array(
            'domain'            => 'starterpro',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required Plugins', 'starterpro' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'starterpro' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'starterpro' ),
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'starterpro'),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'starterpro'),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','starterpro'),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'starterpro' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

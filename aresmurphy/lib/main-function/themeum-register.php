<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('aresmurphy_widdget_init')):

    function aresmurphy_widdget_init()
    {
        $bottomcolumn = get_theme_mod( 'bottom_column', '4' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'aresmurphy' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'aresmurphy' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'aresmurphy' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'aresmurphy' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }         

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom', 'aresmurphy' ),
            'id'            => 'bottom',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'aresmurphy'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="col-sm-6 col-md-'.esc_attr($bottomcolumn).' bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

    }

    add_action('widgets_init','aresmurphy_widdget_init');

endif;

if ( ! function_exists( 'aresmurphy_fonts_url' ) ) :
    function aresmurphy_fonts_url() {
    $fonts_url = '';

    $open_sans = _x( 'on', 'Poppins font: on or off', 'aresmurphy' );

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
if(!function_exists('aresmurphy_style')):

    function aresmurphy_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Raleway:100,200,300,regular,500,600,700,800,900&subset=latin' );

        wp_enqueue_style( 'aresmurphy-font', aresmurphy_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css',false,'all');
        wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css',false,'all');
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css',false,'all');
        wp_enqueue_style( 'aresmurphy-custom-css', get_template_directory_uri() . '/css/custom-css.css',false,'all');
        wp_enqueue_style( 'aresmurphy-blog-content', get_template_directory_uri() . '/css/blog-content.css',false,'all');
        wp_enqueue_style( 'aresmurphy-ares-icon', get_template_directory_uri() . '/css/ares-icon.css',false,'all');
        wp_enqueue_style( 'aresmurphy-main', get_template_directory_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'aresmurphy-blog-detaills', get_template_directory_uri() . '/css/blog-details.css',false,'all');
        wp_enqueue_style( 'aresmurphy-responsive', get_template_directory_uri() . '/css/responsive.css',false,'all');

        wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css',false,'all');
        wp_enqueue_style( 'animate.min', get_template_directory_uri() . '/css/animate.min.css',false,'all');

        wp_enqueue_style('aresmurphy-style',get_stylesheet_uri());
        wp_add_inline_style( 'aresmurphy-style', aresmurphy_css_generator() );
        wp_enqueue_script('bootstrap',ARESMURPHY_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',ARESMURPHY_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',ARESMURPHY_JS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',ARESMURPHY_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',ARESMURPHY_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettyPhoto',ARESMURPHY_JS.'jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',ARESMURPHY_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.nav',ARESMURPHY_JS.'jquery.nav.js',array(),false,true);
        wp_enqueue_script('main-onepage',ARESMURPHY_JS.'main-onepage.js',array(),false,true);

        if( get_theme_mod( 'custom_preset_en', true ) == 0 ) {
            wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );
        }

        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}

        wp_enqueue_script('unique-style',ARESMURPHY_JS.'main.js',array(),false,true);

    }

    add_action('wp_enqueue_scripts','aresmurphy_style');

endif;




if(!function_exists('aresmurphy_admin_style')):

    function aresmurphy_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','aresmurphy_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'aresmurphy_plugins_include');

if(!function_exists('aresmurphy_plugins_include')):

    function aresmurphy_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'kingcomposer', 'aresmurphy' ),
                    'slug'                  => 'kingcomposer',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/kingcomposer.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'kc pro', 'aresmurphy' ),
                    'slug'                  => 'kc_pro',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/aresmurphy/kc_pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum demo importer', 'aresmurphy' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/aresmurphy/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum Portfolio', 'aresmurphy' ),
                    'slug'                  => 'themeum-portfolio',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/aresmurphy/themeum-portfolio.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'aresmurphy' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.0.13.zip'),
                ),

                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'aresmurphy' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.4.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'aresmurphy' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip'),
                ),
            );
    $config = array(
            'domain'            => 'aresmurphy',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'aresmurphy' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'aresmurphy' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'aresmurphy' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'aresmurphy'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'aresmurphy'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','aresmurphy'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'aresmurphy' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

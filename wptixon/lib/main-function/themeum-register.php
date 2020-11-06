<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('wptixon_widdget_init')):

    function wptixon_widdget_init()
    {
        $bottomcolumn = get_theme_mod( 'bottom_column', '4' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'wptixon' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'wptixon' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'wptixon' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'wptixon' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }         

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom', 'wptixon' ),
            'id'            => 'bottom',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'wptixon'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="col-sm-6 col-md-'.esc_attr($bottomcolumn).' bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

    }

    add_action('widgets_init','wptixon_widdget_init');

endif;

if ( ! function_exists( 'wptixon_fonts_url' ) ) :
    function wptixon_fonts_url() {
    $fonts_url = '';

    $open_sans = _x( 'on', 'Poppins font: on or off', 'wptixon' );

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
if(!function_exists('wptixon_style')):

    function wptixon_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Raleway:100,200,300,regular,500,600,700,800,900&subset=latin' );

        wp_enqueue_style( 'wptixon-font', wptixon_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css',false,'all');
        wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css',false,'all');
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css',false,'all');
        wp_enqueue_style( 'wptixon-custom-css', get_template_directory_uri() . '/css/custom-css.css',false,'all');
        wp_enqueue_style( 'wptixon-blog-content', get_template_directory_uri() . '/css/blog-content.css',false,'all');
        wp_enqueue_style( 'wptixon-main', get_template_directory_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'wptixon-blog-detaills', get_template_directory_uri() . '/css/blog-details.css',false,'all');
        wp_enqueue_style( 'wptixon-responsive', get_template_directory_uri() . '/css/responsive.css',false,'all');

        wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css',false,'all');
        wp_enqueue_style( 'animate.min', get_template_directory_uri() . '/css/animate.min.css',false,'all');

        wp_enqueue_style('wptixon-style',get_stylesheet_uri());
        wp_add_inline_style( 'wptixon-style', wptixon_css_generator() );
        wp_enqueue_script('bootstrap',WPTIXON_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',WPTIXON_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',WPTIXON_JS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',WPTIXON_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',WPTIXON_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettyPhoto',WPTIXON_JS.'jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',WPTIXON_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.nav',WPTIXON_JS.'jquery.nav.js',array(),false,true);
        wp_enqueue_script('main-onepage',WPTIXON_JS.'main-onepage.js',array(),false,true);

        if( get_theme_mod( 'custom_preset_en', true ) == 0 ) {
            wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );
        }

        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}

        wp_enqueue_script('unique-style',WPTIXON_JS.'main.js',array(),false,true);

    }

    add_action('wp_enqueue_scripts','wptixon_style');

endif;




if(!function_exists('wptixon_admin_style')):

    function wptixon_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','wptixon_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'wptixon_plugins_include');

if(!function_exists('wptixon_plugins_include')):

    function wptixon_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'kingcomposer', 'wptixon' ),
                    'slug'                  => 'kingcomposer',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/kingcomposer.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'kc pro', 'wptixon' ),
                    'slug'                  => 'kc_pro',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/tixon/kc_pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum demo importer', 'wptixon' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/tixon/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum Project', 'wptixon' ),
                    'slug'                  => 'themeum-project',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/tixon/themeum-project.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'wptixon' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'flatpro' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'wptixon' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'wptixon' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.8.1.zip'),
                ),
            );
    $config = array(
            'domain'            => 'wptixon',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'wptixon' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'wptixon' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'wptixon' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'wptixon'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'wptixon'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','wptixon'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'wptixon' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

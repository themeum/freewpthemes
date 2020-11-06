<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('calypso_widdget_init')):

    function calypso_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'calypso' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'calypso' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'calypso' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'calypso'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'calypso' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'calypso'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'calypso' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'calypso'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'calypso' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'calypso'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 5', 'calypso' ),
            'id'            => 'bottom5',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 5.' , 'calypso'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        
        register_sidebar(array(
            'name'          => esc_html__( 'Shop', 'calypso' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'Widgets in this area will be shown before Shop.' , 'calypso'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="shop-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );




    }

    add_action('widgets_init','calypso_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('calypso_style')):

    function calypso_style(){

        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', calypso_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', calypso_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'magnific-popup', calypso_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'calypso-main', calypso_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'custom', calypso_CSS . 'custom.css',false,'all');
        wp_enqueue_style( 'flexslider', calypso_CSS . 'flexslider.css',false,'all');
        wp_enqueue_style( 'calypso-responsive', calypso_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'calypso-woocommerce', calypso_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'calypso-icon-font', calypso_CSS . 'calypso-icon.css',false,'all');
        wp_enqueue_style( 'calypso-owl-carousel', calypso_CSS . 'owl.carousel.css',false,'all');
        wp_enqueue_style( 'calypso-animate', calypso_CSS . 'animate.css',false,'all');
        wp_enqueue_style( 'calypso-style',get_stylesheet_uri());
        wp_add_inline_style( 'calypso-style', calypso_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',calypso_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',calypso_JS.'loopcounter.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true);
        }
        wp_enqueue_script('jquery.prettySocial',calypso_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',calypso_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',calypso_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.owl.carousel',calypso_JS.'owl.carousel.js',array(),false,true);
        wp_enqueue_script('slick',calypso_JS.'slick.min.js',array(),false,true);

        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
        wp_enqueue_script('calypso-main',calypso_JS.'main.js',array(),false,true);

            // For Ajax URL
            wp_enqueue_script('calypso-main');
            wp_localize_script( 'calypso-main', 'ajax_objects', array(
                'ajaxurl'           => admin_url( 'admin-ajax.php' ),
                'redirecturl'       => home_url('/'),
                'loadingmessage'    => __('Sending user info, please wait...', 'calypso')
            ));
    }
    add_action('wp_enqueue_scripts','calypso_style');

endif;
function frontend_hooks() {
add_action('elementor/frontend/after_register_scripts', array($this, 'calypso_style'), 10);
}



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('calypso_admin_style')):

    function calypso_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','calypso_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'calypso_plugins_include');

if(!function_exists('calypso_plugins_include')):

    function calypso_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Themeum Core', 'calypso' ),
                    'slug'                  => 'themeum-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/calypso/themeum-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum demo importer', 'calypso' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/calypso/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'calypso' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.8.1.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Elementor', 'calypso' ),
                    'slug'                  => 'elementor',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/elementor.1.6.2.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'calypso' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),

                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'calypso' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                ), 
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'calypso' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
            );
    $config = array(
            'domain'            => 'calypso',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'calypso' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'calypso' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'calypso' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'calypso'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'calypso'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'calypso'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'calypso' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

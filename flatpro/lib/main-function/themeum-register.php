<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('flatpro_widdget_init')):

    function flatpro_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'flatpro' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'flatpro' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );        

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'flatpro' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'flatpro'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'flatpro' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'flatpro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'flatpro' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'flatpro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'flatpro' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'flatpro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','flatpro_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('flatpro_style')):

    function flatpro_style(){
        
        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', flatpro_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', flatpro_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'magnific-popup', flatpro_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'flatpro-main', flatpro_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'custom_css', flatpro_CSS . 'custom_css.css',false,'all');
        wp_enqueue_style( 'flexslider', flatpro_CSS . 'flexslider.css',false,'all');
        wp_enqueue_style( 'flatpro-responsive', flatpro_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'flatpro-woocommerce', flatpro_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'flatpro-style',get_stylesheet_uri());
        wp_add_inline_style( 'flatpro-style', flatpro_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',flatpro_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',flatpro_JS.'loopcounter.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true); 
        }
        wp_enqueue_script('jquery.prettySocial',flatpro_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',flatpro_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',flatpro_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery-slick',flatpro_JS.'slick.min.js',array(),false,true);
        
        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('flatpro-main',flatpro_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','flatpro_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('flatpro_admin_style')):

    function flatpro_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','flatpro_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'flatpro_plugins_include');

if(!function_exists('flatpro_plugins_include')):

    function flatpro_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Wp Pagebuilder', 'rhino' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'rhino' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Themeum demo importer', 'flatpro' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/flatpro/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),               
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'flatpro' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.1.1.zip', 
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'flatpro' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
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
            );
    $config = array(
            'domain'            => 'flatpro',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'flatpro' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'flatpro' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'flatpro' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'flatpro'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'flatpro'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','flatpro'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'flatpro' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

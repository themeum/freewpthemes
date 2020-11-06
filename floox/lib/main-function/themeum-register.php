<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('floox_widdget_init')):

    function floox_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'floox' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'floox' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'floox' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'floox'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'floox' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'floox'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'floox' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'floox'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'floox' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'floox'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','floox_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('floox_style')):

    function floox_style(){

        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', floox_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', floox_CSS . 'font-awesome.min.css',false,'all');
        //wp_enqueue_style( 'magnific-popup', floox_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'floox-main', floox_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'custom', floox_CSS . 'custom.css',false,'all');
        wp_enqueue_style( 'floox-responsive', floox_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'floox-woocommerce', floox_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'floox-icon', floox_CSS . 'floox-icon.css',false,'all');
        wp_enqueue_style( 'floox-style',get_stylesheet_uri());
        wp_add_inline_style( 'floox-style', floox_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',floox_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',floox_JS.'loopcounter.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true);
        }
        wp_enqueue_script('jquery.prettySocial',floox_JS.'jquery.prettySocial.min.js',array(),false,true);

        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
        wp_enqueue_script('floox-main',floox_JS.'main.js',array(),false,true);

            // For Ajax URL
            wp_enqueue_script('floox-main');
            wp_localize_script( 'floox-main', 'ajax_objects', array(
                'ajaxurl'           => admin_url( 'admin-ajax.php' ),
                'redirecturl'       => home_url('/'),
                'loadingmessage'    => __('Sending user info, please wait...','floox')
            ));
    }
    add_action('wp_enqueue_scripts','floox_style');

endif;
function frontend_hooks() {
add_action('elementor/frontend/after_register_scripts', array($this, 'floox_style'), 10);
}



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('floox_admin_style')):

    function floox_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','floox_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'floox_plugins_include');

if(!function_exists('floox_plugins_include')):

    function floox_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Themeum Core', 'floox' ),
                    'slug'                  => 'themeum-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/floox/themeum-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => 'Themeum Demo Importer',
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/floox/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),   
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'floox' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Wp Pagebuilder', 'floox' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'floox' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'floox' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
            );
    $config = array(
            'domain'            => 'floox',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'floox' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'floox' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'floox' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'floox'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'floox'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','floox'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'floox' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

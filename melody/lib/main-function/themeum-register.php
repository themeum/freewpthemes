<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('melody_widdget_init')):

    function melody_widdget_init()
    {
        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'melody' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'melody' ),
                'before_title'  => '<div class="widget_heading"><h3 class="widget_title">',
                'after_title'   => '</h3></div>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'melody' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'melody'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'melody' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'melody'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'melody' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'melody'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'melody' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'melody'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','melody_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('melody_style')):

    function melody_style(){

        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', MELODY_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', MELODY_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'magnific-popup', MELODY_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'melody-main', MELODY_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'melody-responsive', MELODY_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'slick-css', MELODY_CSS . 'slick.css',false,'all');
        wp_enqueue_style( 'melody-style',get_stylesheet_uri());
        wp_add_inline_style( 'melody-style', MELODY_CSS_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',MELODY_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',MELODY_JS.'loopcounter.js',array(),false,true );
        wp_enqueue_script('magnific',MELODY_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',MELODY_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('slick-js',MELODY_JS.'slick.min.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true);
        }

        # Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
        wp_enqueue_script('melody-main', MELODY_JS.'main.js',array(),false,true);

        # For Ajax URL
        wp_enqueue_script('melody-main');
        wp_localize_script( 'melody-main', 'ajax_objects', array(
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...', 'melody')
        ));
    }
    add_action('wp_enqueue_scripts','melody_style');
   // add_action('wppb_enqueue_scripts_in_editor','melody_style');

endif;
// function frontend_hooks() {
// add_action('elementor/frontend/after_register_scripts', array($this, 'melody_style'), 10);
// }



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('melody_admin_style')):

    function melody_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','melody_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'melody_plugins_include');

if(!function_exists('melody_plugins_include')):

    function melody_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Themeum Core', 'melody' ),
                    'slug'                  => 'themeum-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/melody/themeum-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => 'Themeum Demo Importer',
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/melody/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Pagebuilder', 'melody' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'melody' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'melody' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Instagram Feed', 'melody' ),
                    'slug'                  => 'instagram-feed',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/instagram-feed.1.8.3.zip'),
                ),
                
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'melody' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
             
            );
    $config = array(
            'domain'            => 'melody',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'melody' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'melody' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'melody' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'melody'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'melody'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','melody'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'melody' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

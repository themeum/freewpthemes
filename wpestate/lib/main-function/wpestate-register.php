<?php
/*-------------------------------------------*
 *      wpestate Widget Registration
 *------------------------------------------*/
if(!function_exists('wpestate_widdget_init')):

    function wpestate_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'wpestate' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'wpestate' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );        

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'wpestate' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'wpestate'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'wpestate' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'wpestate'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'wpestate' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'wpestate'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'wpestate' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'wpestate'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','wpestate_widdget_init');

endif;




/*-------------------------------------------*
 *      wpestate Style
 *------------------------------------------*/
if(!function_exists('wpestate_style')):

    function wpestate_style(){
        
        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', wpestate_CSS . 'bootstrap.min.css',false,'all');
        //Rtl Bootstrap css
        if(is_rtl()){
            wp_enqueue_style( 'bootstrap-rtl.min', wpestate_CSS . 'bootstrap-rtl.min.css',false,'all');
        }
        wp_enqueue_style( 'font-awesome.min', wpestate_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'wpestate-main', wpestate_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'wpestate-style',get_stylesheet_uri());
        wp_enqueue_style( 'wpestate-responsive', wpestate_CSS . 'responsive.css',false,'all');
        wp_add_inline_style( 'wpestate-style', wpestate_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',wpestate_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',wpestate_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('magnific-popup',wpestate_JS.'jquery.magnific-popup.min.js',array(),false,true);
        
        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('wpestate-main',wpestate_JS.'main.js',array(),false,true);

         // For Ajax URL
         wp_localize_script( 'wpestate-main', 'ajax_objects', array( 
             'ajaxurl'           => admin_url( 'admin-ajax.php' ),
             'redirecturl'       => home_url('/'),
             'loadingmessage'    => __('Sending user info, please wait...','wpestate')
         ));

    }
    add_action('wp_enqueue_scripts','wpestate_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('wpestate_admin_style')):

    function wpestate_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','wpestate_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'wpestate_plugins_include');

if(!function_exists('wpestate_plugins_include')):

    function wpestate_plugins_include()
    {
        $plugins = array(               
                array(
                    'name'                  => esc_html__( 'Wp Pagebuilder', 'wpestate' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'wpestate' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => 'wpestate Demo Importer',
                    'slug'                  => 'wpestate-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/estate/wpestate-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'wpestate Core', 'wpestate' ),
                    'slug'                  => 'wpestate-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/estate/wpestate-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'wpestate' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                
            );
    $config = array(
            'domain'            => 'wpestate',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'wpestate' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'wpestate' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'wpestate' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'wpestate'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'wpestate'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','wpestate'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'wpestate' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

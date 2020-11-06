<?php
/*-------------------------------------------*
 *      Rhino Widget Registration
 *------------------------------------------*/
if(!function_exists('rhino_widdget_init')):

    function rhino_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'rhino' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'rhino' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );        

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'rhino' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'rhino'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'rhino' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'rhino'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'rhino' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'rhino'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'rhino' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'rhino'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','rhino_widdget_init');

endif;



/*-------------------------------------------*
 *      Rhino Style
 *------------------------------------------*/
if(!function_exists('rhino_style')):

    function rhino_style(){
        
        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', RHINO_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', RHINO_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'rhino-font', RHINO_CSS . 'rhino-icon.css',false,'all');
        wp_enqueue_style( 'rhino-main', RHINO_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'rhino-responsive', RHINO_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'rhino-style',get_stylesheet_uri());
        wp_add_inline_style( 'rhino-style', rhino_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('parallax-js','https://cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/TweenMax.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',RHINO_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',RHINO_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',RHINO_JS.'jquery.prettySocial.min.js',array(),false,true);
        
        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('rhino-main',RHINO_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','rhino_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('rhino_admin_style')):

    function rhino_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('rhino-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','rhino_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'rhino_plugins_include');

if(!function_exists('rhino_plugins_include')):

    function rhino_plugins_include()
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
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'rhino' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
                ),
                array(
                    'name'                  => 'rhino Demo Importer',
                    'slug'                  => 'rhino-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/rhino/rhino-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'rhino Core', 'rhino' ),
                    'slug'                  => 'rhino-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/rhino/rhino-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'rhino' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'rhino' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),                
                
            );
    $config = array(
            'domain'            => 'rhino',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'rhino' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'rhino' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'rhino' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'rhino'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'rhino'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','rhino'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'rhino' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

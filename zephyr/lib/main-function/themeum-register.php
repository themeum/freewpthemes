<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('zephyr_widdget_init')):

    function zephyr_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'zephyr' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'zephyr' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'zephyr' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'zephyr'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'zephyr' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'zephyr'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'zephyr' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'zephyr'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'zephyr' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'zephyr'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','zephyr_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('zephyr_style')):

    function zephyr_style(){

        wp_enqueue_media();
        # CSS
        wp_enqueue_style( 'bootstrap.min', ZEPHYR_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', ZEPHYR_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'gocharity', ZEPHYR_CSS . 'gocharity.css',false,'all');
        wp_enqueue_style( 'zephyr-main', ZEPHYR_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'zephyr-responsive', ZEPHYR_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'zephyr-style',get_stylesheet_uri());
        wp_add_inline_style( 'zephyr-style', zephyr_css_generator() );

        # JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',ZEPHYR_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',ZEPHYR_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',ZEPHYR_JS.'jquery.prettySocial.min.js',array(),false,true);

        # Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('zephyr-main',ZEPHYR_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','zephyr_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('zephyr_admin_style')):

    function zephyr_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','zephyr_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'zephyr_plugins_include');

if(!function_exists('zephyr_plugins_include')):

    function zephyr_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Wp Pagebuilder', 'zephyr' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'zephyr' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => 'Zephyr Demo Importer',
                    'slug'                  => 'zephyr-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/zephyr/zephyr-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Zephyr Core', 'zephyr' ),
                    'slug'                  => 'zephyr-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/zephyr/zephyr-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'zephyr' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'zephyr' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),

            );

            $config = array(
                    'domain'            => 'zephyr',
                    'default_path'      => '',
                    'parent_menu_slug'  => 'themes.php',
                    'parent_url_slug'   => 'themes.php',
                    'menu'              => 'install-required-plugins',
                    'has_notices'       => true,
                    'is_automatic'      => false,
                    'message'           => '',
                    'strings'           => array(
                    'page_title'                                => esc_html__( 'Install Required Plugins', 'zephyr' ),
                    'menu_title'                                => esc_html__( 'Install Plugins', 'zephyr' ),
                    'installing'                                => esc_html__( 'Installing Plugin: %s', 'zephyr' ),
                    'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'zephyr'),
                    'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'zephyr'),
                    'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','zephyr'),
                    'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'zephyr' )
            )
            );

    tgmpa( $plugins, $config );

    }

endif;

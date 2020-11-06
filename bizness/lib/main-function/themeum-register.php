<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('bizness_widdget_init')):

    function bizness_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'bizness' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'bizness' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'bizness' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'bizness'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'bizness' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'bizness'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'bizness' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'bizness'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'bizness' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'bizness'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','bizness_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('bizness_style')):

    function bizness_style(){

        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', BIZNESS_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', BIZNESS_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'font-bizness.min', BIZNESS_CSS . 'bizness-fonts.css',false,'all');
        wp_enqueue_style( 'bizness-main', BIZNESS_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'bizness-responsive', BIZNESS_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'bizness-style',get_stylesheet_uri());
        wp_add_inline_style( 'bizness-style', bizness_css_generator() );

        // JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',BIZNESS_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',BIZNESS_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',BIZNESS_JS.'jquery.prettySocial.min.js',array(),false,true);

        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('bizness-main',BIZNESS_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','bizness_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('bizness_admin_style')):

    function bizness_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','bizness_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'bizness_plugins_include');

if(!function_exists('bizness_plugins_include')):

    function bizness_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Wp Pagebuilder', 'bizness' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'bizness' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => true,
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
                    'name'                  => 'Bizness Demo Importer',
                    'slug'                  => 'bizness-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/bizness/bizness-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Bizness Core', 'bizness' ),
                    'slug'                  => 'bizness-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/bizness/bizness-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'bizness' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'bizness' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WooCommerce', 'bizness' ),
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/woocommerce.zip'),
                ),

            );
    $config = array(
            'domain'            => 'bizness',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'bizness' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'bizness' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'bizness' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'bizness'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'bizness'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','bizness'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'bizness' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

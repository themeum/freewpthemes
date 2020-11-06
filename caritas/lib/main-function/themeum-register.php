<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('caritas_widdget_init')):

    function caritas_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'caritas' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'caritas' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'caritas' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'caritas'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'caritas' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'caritas'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'caritas' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'caritas'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'caritas' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'caritas'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 5', 'caritas' ),
            'id'            => 'bottom5',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 5.' , 'caritas'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','caritas_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('caritas_style')):

    function caritas_style(){

        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', CARITAS_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', CARITAS_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'caritas-main', CARITAS_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'caritas-responsive', CARITAS_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'caritas-font', '//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700,800,900',false,'all');
        wp_enqueue_style( 'caritas-style',get_stylesheet_uri());
        wp_add_inline_style( 'caritas-style', caritas_css_generator() );

        // JS
	    wp_enqueue_script('theater','//npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('popper',CARITAS_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',CARITAS_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',CARITAS_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',CARITAS_JS.'jquery.prettySocial.min.js',array(),false,true);

        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('caritas-main',CARITAS_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','caritas_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('caritas_admin_style')):

    function caritas_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','caritas_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'caritas_plugins_include');

if(!function_exists('caritas_plugins_include')):

    function caritas_plugins_include()
    {
        $plugins = array(

            array(
                'name'                  => esc_html__( 'WP Page Builder', 'caritas' ),
                'slug'                  => 'wp-pagebuilder',
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
            ),
            array(
                'name'                  => esc_html__( 'WP Page Builder Pro', 'caritas' ),
                'slug'                  => 'wp-pagebuilder-pro',
                'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => esc_html__( 'MailChimp for WordPress', 'caritas' ),
                'slug'                  => 'mailchimp-for-wp',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
            ),
            array(
                'name'                  => 'Caritas Demo Importer',
                'slug'                  => 'caritas-demo-importer',
                'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/caritas/caritas-demo-importer.zip'),
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => esc_html__( 'Caritas Core', 'caritas' ),
                'slug'                  => 'caritas-core',
                'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/caritas/caritas-core.zip'),
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => esc_html__( 'WP Mega Menu', 'caritas' ),
                'slug'                  => 'wp-megamenu',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
            ),
            array(
                'name'                  => esc_html__( 'Widget Importer & Exporter', 'caritas' ),
                'slug'                  => 'widget-importer-exporter',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
            ),
            array(
                'name'                  => esc_html__( 'Classic Editor', 'caritas' ),
                'slug'                  => 'classic-editor',
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/classic-editor.zip'),
            ),

        );
    $config = array(
            'domain'            => 'caritas',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'caritas' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'caritas' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'caritas' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'caritas'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'caritas'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','caritas'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'caritas' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

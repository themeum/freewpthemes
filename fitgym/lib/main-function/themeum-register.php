<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('fitgym_widdget_init')):

    function fitgym_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'fitgym' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'fitgym' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );        

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'fitgym' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'fitgym'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'fitgym' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'fitgym'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'fitgym' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'fitgym'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'fitgym' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'fitgym'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','fitgym_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('fitgym_style')):

    function fitgym_style(){
        
        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', FITGYM_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', FITGYM_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'fitgym-main', FITGYM_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'fitgym-responsive', FITGYM_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'fitgym-woocommerce', FITGYM_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'fitgym-font', '//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900',false,'all');
        wp_enqueue_style( 'fitgym-style',get_stylesheet_uri());
        wp_add_inline_style( 'fitgym-style', fitgym_css_generator() );

        // JS
	    wp_enqueue_script('theater','//npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('popper',FITGYM_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',FITGYM_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',FITGYM_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',FITGYM_JS.'jquery.prettySocial.min.js',array(),false,true);

        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('fitgym-main',FITGYM_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','fitgym_style');

endif;



/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('fitgym_admin_style')):

    function fitgym_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','fitgym_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'fitgym_plugins_include');

if(!function_exists('fitgym_plugins_include')):

    function fitgym_plugins_include()
    {
        $plugins = array(

            array(
                'name'                  => esc_html__( 'Wp Pagebuilder', 'fitgym' ),
                'slug'                  => 'wp-pagebuilder',
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
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
                'name'                  => esc_html__( 'MailChimp for WordPress', 'fitgym' ),
                'slug'                  => 'mailchimp-for-wp',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
            ),
            array(
                'name'                  => 'Fitgym Demo Importer',
                'slug'                  => 'fitgym-demo-importer',
                'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/fitgym/fitgym-demo-importer.zip'),
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => esc_html__( 'Fitgym Core', 'fitgym' ),
                'slug'                  => 'fitgym-core',
                'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/fitgym/fitgym-core.zip'),
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => esc_html__( 'WP Mega Menu', 'fitgym' ),
                'slug'                  => 'wp-megamenu',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
            ),
            array(
                'name'                  => esc_html__( 'Widget Importer & Exporter', 'fitgym' ),
                'slug'                  => 'widget-importer-exporter',
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
            ),

        );
    $config = array(
            'domain'            => 'fitgym',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'fitgym' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'fitgym' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'fitgym' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'fitgym'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'fitgym'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','fitgym'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'fitgym' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

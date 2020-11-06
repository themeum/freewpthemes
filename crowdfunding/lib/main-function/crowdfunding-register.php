<?php

if(!function_exists('crowdfunding_setup')):

    function crowdfunding_setup()
    {
        # Textdomain
        load_theme_textdomain( 'crowdfunding', get_template_directory() . '/languages' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'featured-ideas', 458, 353, true );
        add_image_size( 'project-thumb', 360, 250, true );
        add_image_size( 'blog-thumb', 690, 347, true );
        add_image_size( 'blog-full', 1140, 500, true );
        add_theme_support( 'post-formats', array( 'aside','audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        add_editor_style('');

        if ( ! isset( $content_width ) )
        $content_width = 660;
    }

    add_action('after_setup_theme','crowdfunding_setup');

endif;


/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('crowdfunding_widdget_init')):

    function crowdfunding_widdget_init()
    {
        register_sidebar(array(
                'name'          => __( 'Sidebar', 'crowdfunding' ),
                'id'            => 'sidebar',
                'description'   => __( 'Widgets in this area will be shown on Sidebar.', 'crowdfunding' ),
                'before_title'  => '<h3  class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
        );


        register_sidebar(array(
                'name'          => __( 'Bottom Left', 'crowdfunding' ),
                'id'            => 'bottom-left',
                'description'   => __( 'Widgets in this area will be shown before Footer left.' , 'crowdfunding'),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
                )
        );
        register_sidebar(array(
                'name'          => __( 'Bottom Center Category 1', 'crowdfunding' ),
                'id'            => 'bottom-category-1',
                'description'   => __( 'Widgets in this area will be shown before Footer center.' , 'crowdfunding'),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
                'name'          => __( 'Bottom Center Category 2', 'crowdfunding' ),
                'id'            => 'bottom-category-2',
                'description'   => __( 'Widgets in this area will be shown before Footer center.' , 'crowdfunding'),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
                'name'          => __( 'Bottom Center Category 3', 'crowdfunding' ),
                'id'            => 'bottom-category-3',
                'description'   => __( 'Widgets in this area will be shown before Footer center.' , 'crowdfunding'),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
                'name'          => __( 'Bottom Right', 'crowdfunding' ),
                'id'            => 'bottom-right',
                'description'   => __( 'Widgets in this area will be shown before Footer right.' , 'crowdfunding'),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

    }

    add_action('widgets_init','crowdfunding_widdget_init');

endif;




/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/

if(!function_exists('crowdfunding_style')):

    function crowdfunding_style(){
        global $themeum_options;
        wp_enqueue_style('thm-style',get_stylesheet_uri());
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',THMJS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('wow.min',THMJS.'wow.min.js',array(),false,true);
        wp_enqueue_script('jquery.countdown',THMJS.'jquery.countdown.min.js',array(),false,true);
        wp_enqueue_script('jquery.counterup',THMJS.'jquery.counterup.min.js',array(),false,true);
        wp_enqueue_script('jquery.inview',THMJS.'jquery.inview.min.js',array(),false,true);
        if( $themeum_options['google-map-key'] ){
            wp_enqueue_script( 'googlemap', 'https://maps.google.com/maps/api/js?key='.$themeum_options["google-map-key"], array(), '',false,true );
        }
        wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');
        wp_enqueue_script('main',THMJS.'main.js',array(),false,true);
        wp_localize_script('main','paymentAjax',array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'paymentNonce' => wp_create_nonce('payment_form_submit')
            )
        );
    }
    add_action('wp_enqueue_scripts','crowdfunding_style');

endif;



if(!function_exists('crowdfunding_admin_style')):

    function crowdfunding_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','crowdfunding_admin_style');

endif;

/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'crowdfunding_plugins_include' );

if(!function_exists('crowdfunding_plugins_include')):

    function crowdfunding_plugins_include(){
        $plugins = array(
                array(
                    'name'                  => 'Contact Form 7', // The plugin name
                    'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                ),
                array(
                    'name'                  => 'Widget Settings Importer/Exporter',
                    'slug'                  => 'widget-settings-importexport',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/widget-settings-importexport.1.5.0.zip',
                ),
                array(
                    'name'                  => 'WooCommerce', // The plugin name
                    'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                ),
                array(
                    'name'                  => 'King Composer Page Builder', // The plugin name
                    'slug'                  => 'kingcomposer', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                ),
                array(
                    'name'                  => esc_html__( 'WP Crowdfunding', 'crowdfunding' ),
                    'slug'                  => 'wp-crowdfunding',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'crowdfunding' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                ),

            );
        $config = array(
            'domain'            => 'crowdfunding',           // Text domain - likely want to be the same as your theme.
            'default_path'      => '',                           // Default absolute path to pre-packaged plugins
            'parent_menu_slug'  => 'themes.php',                 // Default parent menu slug
            'parent_url_slug'   => 'themes.php',                 // Default parent URL slug
            'menu'              => 'install-required-plugins',   // Menu slug
            'has_notices'       => true,                         // Show admin notices or not
            'is_automatic'      => false,                        // Automatically activate plugins after installation or not
            'message'           => '',                           // Message to output right before the plugins table
            'strings'           => array(
                'page_title'                                => __( 'Install Required Plugins', 'crowdfunding' ),
                'menu_title'                                => __( 'Install Plugins', 'crowdfunding' ),
                'installing'                                => __( 'Installing Plugin: %s', 'crowdfunding' ), // %1$s = plugin name
                'oops'                                      => __( 'Something went wrong with the plugin API.', 'crowdfunding'),
                'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                                    => __( 'Return to Required Plugins Installer', 'crowdfunding'),
                'plugin_activated'                          => __( 'Plugin activated successfully.','crowdfunding'),
                'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'crowdfunding' ) // %1$s = dashboard link
            )
    );

    tgmpa( $plugins, $config );

    }

endif;

<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('bridegroom_widdget_init')):

    function bridegroom_widdget_init(){
        $bottomcolumn = get_theme_mod( 'bottom_column', '4' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'bridegroom' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'bridegroom' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'bridegroom' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'bridegroom' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }         

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom Widgets', 'bridegroom' ),
            'id'            => 'bottom1',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'bridegroom'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        
    }

    add_action('widgets_init','bridegroom_widdget_init');

endif;

if ( ! function_exists( 'bridegroom_fonts_url' ) ) :
    function bridegroom_fonts_url() {
    $fonts_url = '';

    $montserrat = _x( 'on', 'Montserrat font: on or off', 'bridegroom' );

    if ( 'off' !== $montserrat ) {
    $font_families = array();

    if ( 'off' !== $montserrat ) {
    $font_families[] = 'Montserrat:100,200,300,400,500,600,700';
    }

    $query_args = array(
    'family'  => urlencode( implode( '|', $font_families ) ),
    'subset'  => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('bridegroom_style')):

    function bridegroom_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700' );
        wp_enqueue_style( 'bridegroom-font', bridegroom_fonts_url(), array(), null );
        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap', bridegroom_CSS . 'bootstrap.min.css',false,'all');
        if ( is_rtl() ) {
            wp_enqueue_style( 'bootstrap-rtl', bridegroom_CSS . 'bootstrap-rtl.min.css',false,'all');
        }
        wp_enqueue_style( 'font-awesome', bridegroom_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'magnific-popup', bridegroom_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'bridegroom-main', bridegroom_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'jquery.prettySocial', bridegroom_CSS . 'jquery.prettySocial.min.css',false,'all');
        wp_enqueue_style( 'bridegroom-woocommerce', bridegroom_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'bridegroom-responsive', bridegroom_CSS . 'responsive.css',false,'all'); 
        wp_enqueue_style( 'bridegroom-style',get_stylesheet_uri());
        wp_add_inline_style( 'bridegroom-style', bridegroom_css_generator() );

        #JS
        wp_enqueue_script('popper',bridegroom_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',bridegroom_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',bridegroom_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('js-social',bridegroom_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('magnific-popup',bridegroom_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('masonry-js',bridegroom_JS.'masonry.min.js',array(),false,true);

        # Main.JS
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('bridegroom-main',bridegroom_JS.'main.js',array(),false,true);

        # For Ajax URL
        wp_enqueue_script('bridegroom-main');
        wp_localize_script( 'bridegroom-main', 'ajax_objects', array( 
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...','bridegroom'),
        ));
    }

    add_action('wp_enqueue_scripts','bridegroom_style');

endif;

if(!function_exists('bridegroom_admin_style')):

    function bridegroom_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_parent_theme_file_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');

        if( is_admin() ) {    
            wp_enqueue_style( 'wp-color-picker' ); 
            wp_enqueue_script('bridegroom-colorpicker', get_parent_theme_file_uri().'/js/admin-colorpicker.js',  array( 'wp-color-picker' ),false,true);
        }

    }
    add_action('admin_enqueue_scripts','bridegroom_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'bridegroom_plugins_include');

if(!function_exists('bridegroom_plugins_include')):

    function bridegroom_plugins_include()
    {
        $plugins = array(
                
                array(
                    'name'                  => esc_html__( 'WP Pagebuilder', 'bridegroom' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ), 
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'bridegroom' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'bridegroom Core', 'bridegroom' ),
                    'slug'                  => 'bridegroom-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/bridegroom/bridegroom-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'bridegroom' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => true, 
                    'version'               => '', 
                    'force_activation'      => false,
                    'force_deactivation'    => false, 
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.0.8.zip', 
                ),
                array(
                    'name'                  => 'bridegroom Demo Importer',
                    'slug'                  => 'bridegroom-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/bridegroom/bridegroom-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'bridegroom' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.3.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'wpeducon' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'bridegroom' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
               
            );

        $config = array(
            'domain'            => 'bridegroom',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'       => esc_html__( 'Install Required Plugins', 'bridegroom' ),
                        'menu_title'       => esc_html__( 'Install Plugins', 'bridegroom' ),
                        'installing'       => esc_html__( 'Installing Plugin: %s', 'bridegroom' ),
                        'oops'             => esc_html__( 'Something went wrong with the plugin API.', 'bridegroom'),
                        'return'           => esc_html__( 'Return to Required Plugins Installer', 'bridegroom'),
                        'plugin_activated' => esc_html__( 'Plugin activated successfully.','bridegroom'),
                        'complete'         => esc_html__( 'All plugins installed and activated successfully. %s', 'bridegroom' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;


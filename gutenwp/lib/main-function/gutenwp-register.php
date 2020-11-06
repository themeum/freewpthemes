<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('gutenwp_widdget_init')):

    function gutenwp_widdget_init(){
        $bottomcolumn = get_theme_mod( 'bottom_column', '4' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'gutenwp' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'gutenwp' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom1 Widgets', 'gutenwp' ),
            'id'            => 'bottom1',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'gutenwp'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom2 Widgets', 'gutenwp' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'gutenwp'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom3 Widgets', 'gutenwp' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'gutenwp'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom4 Widgets', 'gutenwp' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom.' , 'gutenwp'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        # Offcanvas menu widgets.
        register_sidebar(array( 
            'name'          => __( 'Top Menu Widgets', 'gutenwp' ),
            'id'            => 'offcanvas_menu',
            'description'   => __( 'Widgets in this area will be shown before Header.' , 'gutenwp'),
            'before_title'  => '<h3 class="widget_title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="col-sm-6 col-md-3 bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        
    }

    add_action('widgets_init','gutenwp_widdget_init');

endif;

if ( ! function_exists( 'gutenwp_fonts_url' ) ) :
    function gutenwp_fonts_url() {
    $fonts_url = '';

    $montserrat = _x( 'on', 'Montserrat font: on or off', 'gutenwp' );

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
if(!function_exists('gutenwp_style')):

    function gutenwp_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700' );
        wp_enqueue_style( 'gutenwp-font', gutenwp_fonts_url(), array(), null );
        
        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap', gutenwp_CSS . 'bootstrap.min.css',false,'all');
        if ( is_rtl() ) {
            wp_enqueue_style( 'bootstrap-rtl', gutenwp_CSS . 'bootstrap-rtl.min.css',false,'all');
        }
        wp_enqueue_style( 'font-awesome', gutenwp_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'slick.guten', gutenwp_CSS . 'slick.min.css',false,'all');
        wp_enqueue_style( 'gutenwp-main', gutenwp_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'gutenwp-responsive', gutenwp_CSS . 'responsive.css',false,'all'); 
        wp_enqueue_style( 'gutenwp-style',get_stylesheet_uri());
        wp_add_inline_style( 'gutenwp-style', gutenwp_css_generator() );

        #JS
        wp_enqueue_script('popper',gutenwp_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',gutenwp_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('gutenwp-slick',gutenwp_JS.'slick.min.js',array(),false,true);
        wp_enqueue_script('scrollup-js',gutenwp_JS.'jquery.scrollUp.min.js',array(),false,true);
        wp_enqueue_script('js-social',gutenwp_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('masonry',gutenwp_JS.'masonry.min.js',array(),false,true);
        
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('gutenwp-main',gutenwp_JS.'main.js',array(),false,true);

        # For Ajax URL
        wp_enqueue_script('gutenwp-main');
        wp_localize_script( 'gutenwp-main', 'ajax_objects', array( 
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...','gutenwp'),
            'ajax_nonce'        => wp_create_nonce('calendar-demo-nonce')
        ));
    }

    add_action('wp_enqueue_scripts','gutenwp_style');
    add_action('wppb_enqueue_scripts_in_editor','gutenwp_style');
    add_action('enqueue_block_editor_assets','gutenwp_style');

endif;



if(!function_exists('gutenwp_admin_style')):

    function gutenwp_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_parent_theme_file_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');

        if( is_admin() ) {    
            wp_enqueue_style( 'wp-color-picker' ); 
            wp_enqueue_script('gutenwp-colorpicker', get_parent_theme_file_uri().'/js/admin-colorpicker.js',  array( 'wp-color-picker' ),false,true);
        }

    }
    add_action('admin_enqueue_scripts','gutenwp_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'gutenwp_plugins_include');

if(!function_exists('gutenwp_plugins_include')):

    function gutenwp_plugins_include()
    {
        $plugins = array(
                
                array(
                    'name'                  => esc_html__( 'WP Pagebuilder', 'gutenwp' ),
                    'slug'                  => 'wp-pagebuilder',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
                ), 
                array(
                    'name'                  => esc_html__( 'WP Page Builder Pro', 'gutenwp' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/packages/wp-pagebuilder-pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Gutenwp Core', 'gutenwp' ),
                    'slug'                  => 'gutenwp-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/gutenwp/gutenwp-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => esc_html__( 'Themeum Tweet', 'gutenwp' ),
                    'slug'                  => 'themeum-tweet',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/gutenwp/themeum-tweet.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'gutenwp' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => 'Gutenwp Demo Importer',
                    'slug'                  => 'gutenwp-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/gutenwp/gutenwp-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'gutenwp' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.3.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'gutenwp' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Instagram Feed', 'gutenwp' ),
                    'slug'                  => 'instagram-feed',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/instagram-feed.1.8.3.zip'),
                ),
               

            );

        $config = array(
            'domain'            => 'gutenwp',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'gutenwp' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'gutenwp' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'gutenwp' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'gutenwp'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'gutenwp'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','gutenwp'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'gutenwp' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;


<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('mythos_widdget_init')):

    function mythos_widdget_init()
    {
        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'mythos-pro' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'mythos-pro' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'mythos-pro' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'mythos-pro'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'mythos-pro' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'mythos-pro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'mythos-pro' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'mythos-pro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'mythos-pro' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'mythos-pro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Shop', 'mythos-pro' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'Widgets in this area will be shown before Shop.' , 'mythos-pro'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="shop-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','mythos_widdget_init');

endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('mythos_style')):

    function mythos_style(){

        wp_enqueue_media();
        # CSS
        wp_enqueue_style( 'bootstrap.min', MYTHOS_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'fontawesome', MYTHOS_CSS . 'fontawesome.min.css',false,'all');
        wp_enqueue_style( 'magnific', MYTHOS_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'mythos-main', MYTHOS_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'woocommerce-css', MYTHOS_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'mythos-responsive', MYTHOS_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'mythos-style',get_stylesheet_uri());
        wp_add_inline_style( 'mythos-style', mythos_css_generator() );
        # JS
        wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',MYTHOS_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',MYTHOS_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('magnific-popup',MYTHOS_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettySocial',MYTHOS_JS.'jquery.prettySocial.min.js',array(),false,true);

        # Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('mythos-main',MYTHOS_JS.'main.js',array(),false,true);
    }
    add_action('wp_enqueue_scripts','mythos_style');

endif;


function mythos_customize_control_js() {
    wp_enqueue_script( 'thmc-customizer', MYTHOS_URI.'lib/customizer/assets/js/customizer.js', array('jquery', 'jquery-ui-datepicker'), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'mythos_customize_control_js' );


add_action('enqueue_block_editor_assets', 'mythos_action_enqueue_block_editor_assets');
function mythos_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'bootstrap-grid.min', MYTHOS_CSS . 'bootstrap-grid.min.css',false,'all');
    wp_enqueue_style( 'mythos-style', get_stylesheet_uri() );
    wp_enqueue_style( 'mythos-gutenberg-editor-styles', get_template_directory_uri() . '/css/style-editor.css', null, 'all' );
    wp_add_inline_style( 'mythos-style', mythos_css_generator() );
}



/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'mythos_plugins_include');

if(!function_exists('mythos_plugins_include')):

    function mythos_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Qubely', 'mythos-pro' ),
                    'slug'                  => 'qubely',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/qubely.zip'),
                ),
                array(
                    'name'                  => 'Mythos Pro Demo Importer',
                    'slug'                  => 'mythos-pro-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/mythos/mythos-pro-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Mythos Pro Core', 'mythos-pro' ),
                    'slug'                  => 'mythos-pro-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/mythos/mythos-pro-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'mythos-pro' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Mega Menu Pro', 'mythos-pro' ),
                    'slug'                  => 'wp-pagebuilder-pro',
                    'source'                => esc_url( get_template_directory_uri().'/lib/plugin/wp-megamenu-pro.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'mythos-pro' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                ), 
                array(
                    'name'                  => 'WooCommerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.1.1.zip', 
                ),
              
            );

            $config = array(
                    'domain'            => 'mythos-pro',
                    'default_path'      => '',
                    'menu'              => 'install-required-plugins',
                    'has_notices'       => true,
                    'dismissable'       => true, 
                    'dismiss_msg'       => '', 
                    'is_automatic'      => false,
                    'message'           => ''
            );

    tgmpa( $plugins, $config );

    }

endif;

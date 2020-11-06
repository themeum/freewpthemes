<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('winkel_widdget_init')):

    function winkel_widdget_init()
    {

        register_sidebar(array(
                'name'          => esc_html__( 'Sidebar', 'winkel' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'winkel' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );        

        register_sidebar(array(
                'name'          => esc_html__( 'Bottom 1', 'winkel' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'winkel'),
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'winkel' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'winkel' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'winkel' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 5', 'winkel' ),
            'id'            => 'bottom5',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 6', 'winkel' ),
            'id'            => 'bottom6',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );        
        register_sidebar(array(
            'name'          => esc_html__( 'Shop', 'winkel' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'Widgets in this area will be shown before Shop.' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="shop-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
        register_sidebar(array(
            'name'          => esc_html__( 'Shop Category Page Header', 'winkel' ),
            'id'            => 'shop-cat',
            'description'   => esc_html__( 'Widgets in this area will be shown top of the Product Category .' , 'winkel'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="shop-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','winkel_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('winkel_style')):

    function winkel_style(){
        
        wp_enqueue_media();
        // CSS
        wp_enqueue_style( 'bootstrap.min', winkel_CSS . 'bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome.min', winkel_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'winkel-font-style', winkel_CSS . 'winkel-font-style.css',false,'all');
        wp_enqueue_style( 'magnific-popup', winkel_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'nice-select', winkel_CSS . 'nice-select.css',false,'all');
        wp_enqueue_style( 'chosen', winkel_CSS . 'chosen.css',false,'all');
        wp_enqueue_style( 'winkel-main', winkel_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'sweetalert','https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css',false,'all');
        wp_enqueue_style( 'flexslider', winkel_CSS . 'flexslider.css',false,'all');
        wp_enqueue_style( 'winkel-responsive', winkel_CSS . 'responsive.css',false,'all');
        wp_enqueue_style( 'winkel-woocommerce', winkel_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'winkel-style',get_stylesheet_uri());
        wp_add_inline_style( 'winkel-style', winkel_css_generator() );

        // JS
        wp_enqueue_script('main-popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',winkel_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',winkel_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('sticky-kit',winkel_JS.'sticky-kit.js',array(),false,true);
        wp_enqueue_script('chosen.jquery',winkel_JS.'chosen.jquery.js',array(),false,true);
        wp_enqueue_script('nice-select',winkel_JS.'jquery.nice-select.min.js',array(),false,true);
        wp_enqueue_script('off-canvas',winkel_JS.'off-canvas.js',array(),false,true);
        wp_enqueue_script('sweetalert', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true); 
        } else {
            wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js'); 
        }
        wp_enqueue_script('jquery.prettySocial',winkel_JS.'jquery.prettySocial.min.js',array(),false,true);
        wp_enqueue_script('jquery.isotope.min',winkel_JS.'jquery.isotope.min.js',array(),false,true);
        wp_enqueue_script('jquery.magnific-popup.min',winkel_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('jquery-slick',winkel_JS.'slick.min.js',array(),false,true);

        // Overwrite price Slider
        if( function_exists('get_woocommerce_currency_symbol') ){
            wp_deregister_script( 'wc-price-slider' );
            wp_enqueue_script('wc-price-slider', winkel_JS . 'price-slider.js', array('jquery', 'jquery-ui-slider', 'wc-jquery-ui-touchpunch'));
            wp_localize_script( 'wc-price-slider', 'woocommerce_price_slider_params', array(
                'min_price'			           => isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '',
                'max_price'			           => isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '',
                'currency_format_num_decimals' => 0,
                'currency_format_symbol'       => get_woocommerce_currency_symbol(),
                'currency_format_decimal_sep'  => esc_attr( wc_get_price_decimal_separator() ),
                'currency_format_thousand_sep' => esc_attr( wc_get_price_thousand_separator() ),
                'currency_format'              => esc_attr( str_replace( array( '%1$s', '%2$s' ), array( '%s', '%v' ), get_woocommerce_price_format() ) ),
            ) );
        }
        

        // Variation Prducts
        wp_deregister_script( 'wc-add-to-cart-variation' );
        wp_register_script( 'wc-add-to-cart-variation', winkel_JS . 'add-to-cart-variation.js', array( 'jquery', 'wp-util' ), false, true );
        
        // Single Comments
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script('winkel-main',winkel_JS.'main.js',array(),false,true);

        // For Ajax URL
        wp_localize_script( 'winkel-main', 'ajax_objects', array( 
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...','winkel')
        ));

    }
    add_action('wp_enqueue_scripts','winkel_style');

endif;


/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('winkel_admin_style')):

    function winkel_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','winkel_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'winkel_plugins_include');

if(!function_exists('winkel_plugins_include')):

    function winkel_plugins_include()
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
                    'name'                  => esc_html__( 'Themeum demo importer', 'winkel' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/winkel/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'winkel' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.9.zip'),
                ),              
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'winkel' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.8.zip'),
                ),                
                array(
                    'name'                  => esc_html__( 'Regenerate Thumbnails', 'winkel' ),
                    'slug'                  => 'regenerate-thumbnails',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip'),
                ),
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.1.2.zip', 
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'winkel' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.5.zip'),
                ),                
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'winkel' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WooCommerce Wishlist', 'winkel' ),
                    'slug'                  => 'woocommerce-wishlist',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/winkel/woocommerce-wishlist.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => esc_html__( 'WooCommerce Currency Switcher', 'winkel' ),
                    'slug'                  => 'woocommerce-currency-switcher',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/winkel/woocommerce-currency-switcher.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

            );
    $config = array(
            'domain'            => 'winkel',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'winkel' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'winkel' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'winkel' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'winkel'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'winkel'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','winkel'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'winkel' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;

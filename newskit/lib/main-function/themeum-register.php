<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/
if(!function_exists('newskit_widdget_init')):

	function newskit_widdget_init()
	{

		register_sidebar(array(
				'name'          => esc_html__( 'Sidebar', 'newskit' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'newskit' ),
				'before_title'  => '<div class="widget_heading"><h3 class="widget_title">',
				'after_title'   => '</h3></div>',
				'before_widget' => '<div id="%1$s" class="widget %2$s" >',
				'after_widget'  => '</div>'
			)
		);

		register_sidebar(array(
				'name'          => esc_html__( 'Bottom 1', 'newskit' ),
				'id'            => 'bottom1',
				'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'newskit'),
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
				'after_widget'  => '</div></div>'
			)
		);

		register_sidebar(array(
				'name'          => esc_html__( 'Bottom 2', 'newskit' ),
				'id'            => 'bottom2',
				'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'newskit'),
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
				'after_widget'  => '</div></div>'
			)
		);

		register_sidebar(array(
				'name'          => esc_html__( 'Bottom 3', 'newskit' ),
				'id'            => 'bottom3',
				'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'newskit'),
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
				'after_widget'  => '</div></div>'
			)
		);
		register_sidebar(array(
				'name'          => esc_html__( 'Bottom 4', 'newskit' ),
				'id'            => 'bottom4',
				'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'newskit'),
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
				'after_widget'  => '</div></div>'
			)
		);
	}

	add_action('widgets_init','newskit_widdget_init');

endif;



/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('newskit_style')):

	function newskit_style(){

		wp_enqueue_media();
		// CSS
		wp_enqueue_style( 'bootstrap.min', NEWSKIT_CSS . 'bootstrap.min.css',false,'all');
		wp_enqueue_style( 'font-awesome.min', NEWSKIT_CSS . 'font-awesome.min.css',false,'all');
		wp_enqueue_style( 'font-newskit', NEWSKIT_CSS . 'newskit.css',false,'all');
		wp_enqueue_style( 'newskit-main', NEWSKIT_CSS . 'main.css',false,'all');
		wp_enqueue_style( 'newskit-responsive', NEWSKIT_CSS . 'responsive.css',false,'all');
		wp_enqueue_style( 'newskit-woocommerce', NEWSKIT_CSS . 'woocommerce.css',false,'all');
		wp_enqueue_style( 'newskit-style',get_stylesheet_uri());
		wp_add_inline_style( 'newskit-style', NEWSKIT_CSS_generator() );

		// JS
		wp_enqueue_script('main-tether','https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js',array(),false,true);
		wp_enqueue_script('bootstrap',NEWSKIT_JS.'bootstrap.min.js',array(),false,true);
		wp_enqueue_script('loopcounter',NEWSKIT_JS.'loopcounter.js',array(),false,true);
		wp_enqueue_script('jquery.prettySocial',NEWSKIT_JS.'jquery.prettySocial.min.js',array(),false,true);
		wp_register_script('newskit-slick', NEWSKIT_JS.'slick.min.js',array(),false,true);

		# Single Comments
		if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
		wp_enqueue_script('newskit-custom', NEWSKIT_JS.'custom.js',array(),false,true);
		wp_enqueue_script('newskit-main', NEWSKIT_JS.'main.js',array('jquery'),false,true);


		# For Ajax URL
		wp_enqueue_script('newskit-main');
		wp_localize_script( 'newskit-main', 'ajax_objects', array(
			'ajaxurl'           => admin_url( 'admin-ajax.php' ),
			'redirecturl'       => home_url('/'),
			'loadingmessage'    => __('Sending user info, please wait...','newskit')
		));
	}
	add_action('wp_enqueue_scripts','newskit_style');

endif;
function frontend_hooks() {
	add_action('elementor/frontend/after_register_scripts', array($this, 'newskit_style'), 10);
}

/*-------------------------------------------------------
*           Backend Style for Metabox
*-------------------------------------------------------*/
if(!function_exists('newskit_admin_style')):

	function newskit_admin_style(){
		wp_enqueue_media();
		wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
		wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
		wp_enqueue_script('thmpostmeta');
	}
	add_action('admin_enqueue_scripts','newskit_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'newskit_plugins_include');

if(!function_exists('newskit_plugins_include')):

	function newskit_plugins_include()
	{
		$plugins = array(
			array(
				'name'                  => esc_html__( 'Themeum Core', 'newskit' ),
				'slug'                  => 'themeum-core',
				'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/newskit/themeum-core.zip'),
				'required'              => true,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => '',
			),
			array(
                'name'                  => 'Themeum Demo Importer',
                'slug'                  => 'themeum-demo-importer',
                'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/newskit/themeum-demo-importer.zip'),
                'required'              => false,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
                ),
			array(
				'name'                  => esc_html__( 'Themeum Poll', 'newskit' ),
				'slug'                  => 'themeum-poll',
				'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/newskit/themeum-poll.zip'),
				'required'              => false,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => '',
			),
			array(
				'name'                  => esc_html__( 'Themeum Twitter Feed', 'newskit' ),
				'slug'                  => 'themeum-twitter-feed',
				'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/newskit/themeum-twitter-feed.zip'),
				'required'              => false,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => '',
			),
			array(
				'name'                  => esc_html__( 'Wp Pagebuilder', 'newskit' ),
				'slug'                  => 'wp-pagebuilder',
				'required'              => true,
				'version'               => '',
				'force_activation'      => true,
				'force_deactivation'    => false,
				'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-pagebuilder.zip'),
			),
			array(
				'name'                  => esc_html__( 'MailChimp for WordPress', 'newskit' ),
				'slug'                  => 'mailchimp-for-wp',
				'required'              => false,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.6.zip'),
			),

			array(
				'name'                  => esc_html__( 'Widget Importer & Exporter', 'newskit' ),
				'slug'                  => 'widget-importer-exporter',
				'required'              => false,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
			),
			array(
				'name'                  => esc_html__( 'WP Mega Menu', 'newskit' ),
				'slug'                  => 'wp-megamenu',
				'required'              => true,
				'version'               => '',
				'force_activation'      => false,
				'force_deactivation'    => false,
				'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
			),
		);

		$config = array(
			'domain'            => 'newskit',
			'default_path'      => '',
			'parent_menu_slug'  => 'themes.php',
			'parent_url_slug'   => 'themes.php',
			'menu'              => 'install-required-plugins',
			'has_notices'       => true,
			'is_automatic'      => false,
			'message'           => '',
			'strings'           => array(
				'page_title'                                => esc_html__( 'Install Required Plugins', 'newskit' ),
				'menu_title'                                => esc_html__( 'Install Plugins', 'newskit' ),
				'installing'                                => esc_html__( 'Installing Plugin: %s', 'newskit' ),
				'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'newskit'),
				'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'newskit'),
				'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','newskit'),
				'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'newskit' )
			)
		);

		tgmpa( $plugins, $config );

	}

endif;

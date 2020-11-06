<?php

$panel_to_section = array(
	'id'           => 'starterpro_panel_options',
	'title'        => esc_html( 'Personal Blog Options', 'personalblog' ),
	'description'  => esc_html__( 'Personal Blog Theme Options', 'personalblog' ),
	'priority'     => 10,
	'sections'     => array(

		array(
			'id'              => 'home_settings',
			'title'           => esc_html__( 'Home layout', 'personalblog' ),
			'description'     => esc_html__( 'Home Layout', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'blog_layout',
					'label'    => esc_html__( 'Select Blog Layout', 'personalblog' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'blogleft',
					'choices'  => array(
						'blogleft' => esc_html( 'Blog Left', 'personalblog' ),
						'blogright' => esc_html( 'Blog Right', 'personalblog' ),
						'blogfullwidth' => esc_html( 'Blog Full Width', 'personalblog' ),
					)
				),
				array(
					'settings' => 'single_page_style',
					'label'    => esc_html__( 'Select Blog Single Plage Layout', 'personalblog' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'leftside',
					'choices'  => array(
						'leftside' => esc_html( 'Single With Left Sidebar', 'personalblog' ),
						'rightside' => esc_html( 'Single With Right Sidebar', 'personalblog' ),
						'fullwidth' => esc_html( 'Single With Full Width', 'personalblog' ),
					)
				),				
				array(
					'settings' => 'pagination_layout',
					'label'    => esc_html__( 'Select Pagination Layout', 'personalblog' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'pagiloadmore',
					'choices'  => array(
						'paginumber' => esc_html( 'Number', 'personalblog' ),
						'pagiloadmore' => esc_html( 'Load More', 'personalblog' ),
					)
				),				
			)
		),

		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo & favicon', 'personalblog' ),
			'description'     => esc_html__( 'All Logo & favicon', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'personalblog' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'personalblog' ),
						'logotext' => esc_html( 'Logo text', 'personalblog' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'personalblog' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Use your Custom logo text', 'personalblog' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'personalblog',
				),				
			)//fields
		),//logo_setting
		
		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'personalblog' ),
			'description'     => esc_html__( 'Typography Setting', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Source Sans Pro',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'body_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '18',
				),

				//Menu font
				array(
					'settings' => 'menu_google_font',
					'label'    => esc_html__( 'Select Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '14',
				),


				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Heading1 Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Heading1 Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '42',
				),


				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Heading2 Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Heading2 Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '32',
				),

				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Heading3 Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Heading3 Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '28',
				),

				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '22',
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'personalblog' ),
					'type'     => 'select',
					'default'  => 'Roboto Slab',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'personalblog' ),
					'type'     => 'number',
					'default'  => '18',
				),

			)//fields
		),//typo_setting


		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'personalblog' ),
			'description'     => esc_html__( 'Layout & Styling', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00aeef',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00a2e8',
				),

				array(
					'settings' => 'button_color_title',
					'label'    => esc_html__( 'Button Color Settings', 'personalblog' ),
					'type'     => 'title',
					'priority' => 10,
				),
				
				array(
					'settings' => 'button_bg_color',
					'label'    => esc_html__( 'Background Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#32aad6',
				),

				array(
					'settings' => 'button_hover_bg_color',
					'label'    => esc_html__( 'Hover Background Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00aeef',
				),
				array(
					'settings' => 'button_text_color',
					'label'    => esc_html__( 'Text Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'personalblog' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				# end button color section.

			)//fields
		),//Layout & Styling

		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'personalblog' ),
			'description'     => esc_html__( '404 page background and text settings', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'errorbg',
					'label'    => esc_html__( 'Upload 404 Page Background Image', 'personalblog' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'errorlogo',
					'label'    => esc_html__( 'Upload 404 Page logo Image', 'personalblog' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'personalblog' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Page Not Found - Lost Maybe?.', 'personalblog')
				),
				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'personalblog' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'personalblog')
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( '404 Button Text', 'personalblog' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Go Back Home', 'personalblog')
				),
			)
		),

		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'personalblog' ),
			'description'     => esc_html__( 'Blog Setting', 'personalblog' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'blog_intro_en',
					'label'    => esc_html__( 'Enable Excerpt', 'personalblog' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_post_text_limit',
					'label'    => esc_html__( 'Excerpt character Limit', 'personalblog' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '330',
				),
				array(
					'settings' => 'blog_continue_en',
					'label'    => esc_html__( 'Enable Blog Readmore', 'personalblog' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_single_share',
					'label'    => esc_html__( 'Blog Single Social Share', 'personalblog' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_continue',
					'label'    => esc_html__( 'Continue Reading', 'personalblog' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Read More',
				),
			)//fields
		),//blog_setting

		array(
			'id'              => 'footer_setting',
			'title'           => esc_html__( 'Footer Setting', 'personalblog' ),
			'description'     => esc_html__( 'Footer Setting', 'personalblog' ),
			'priority'        => 10,
			'fields'         => array(
		
				array(
					'settings' => 'copyright_en',
					'label'    => esc_html__( 'Enable Copyright Text', 'personalblog' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),			
				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Copyright Text', 'personalblog' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//footer_setting

	),
);//starterpro_panel_options


$framework = new THM_Customize( $panel_to_section );

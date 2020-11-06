<?php

$panel_to_section = array(
	'id'           => 'aresmurphy_panel_options',
	'title'        => esc_html( 'Ares Murphy Options', 'aresmurphy' ),
	'description'  => esc_html__( 'Ares Murphy Theme Options', 'aresmurphy' ),
	'priority'     => 10,
	'sections'     => array(

		array(
			'id'              => 'header_setting',
			'title'           => esc_html__( 'Header Settings', 'aresmurphy' ),
			'description'     => esc_html__( 'Header Settings', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'header_layout',
					'label'    => esc_html__( 'Header Layout', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'portfolio',
					'choices'  => array(
						'portfolio' => esc_html( 'Portfolio', 'aresmurphy' ),
						'photography' => esc_html( 'Photography', 'aresmurphy' ),
						'individual' => esc_html( 'Individual', 'aresmurphy' ),
						'resume' => esc_html( 'Resume', 'aresmurphy' ),
						'blog' => esc_html( 'Blog', 'aresmurphy' ),
					)

				),	
				//start resume info	
				array(
					'settings' => 'resume_banner',
					'label'    => esc_html__( 'Upload Resume banner Image', 'aresmurphy' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/resume-slider-bg.jpg',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),
				array(
					'settings' => 'resume_share',
					'label'    => esc_html__( 'Resume Share', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),				
				array(
					'settings' => 'resume_title',
					'label'    => esc_html__( 'About Me Title', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Hello, I am Ares Murphy',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),					
				array(
					'settings' => 'resume_desc',
					'label'    => esc_html__( 'Resume Short Note', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'UI & UX DESIGNER @ JOOMSHAPER LLC',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),	
				array(
					'settings' => 'resume_design',
					'label'    => esc_html__( 'Resume Designer', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'Ares Murphy',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),					
				array(
					'settings' => 'resume_mobile',
					'label'    => esc_html__( 'Resume Mobile', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '+123456 78910',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),					
				array(
					'settings' => 'resume_email',
					'label'    => esc_html__( 'Resume Email', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'aresm@gmail.com',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),					
				array(
					'settings' => 'resume_address',
					'label'    => esc_html__( 'Resume Addesss', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'Monica Blvd, Los Angeles, USA 3200',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'resume',
					)
				),	
				//start Blog info	
				array(
					'settings' => 'image_profile',
					'label'    => esc_html__( 'Upload Profile Image', 'aresmurphy' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/profile-img.jpg',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'blog',
					)
				),	
				array(
					'settings' => 'profile_text',
					'label'    => esc_html__( 'About Me', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Hello, I am Ares Murphy',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'blog',
					)
				),	
				array(
					'settings' => 'profile_short_note',
					'label'    => esc_html__( 'Profile Short Note', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'Thank you for hanging around my online Portfolio for awhile.',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '=',
						'value' => 'blog',
					)
				),						
				array(
					'settings' => 'header_color',
					'label'    => esc_html__( 'Header background Color', 'aresmurphy' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
					'dependency' => array(
						'id' => 'header_layout',
						'comp' => '!=',
						'value' => 'individual',
					)
				),
				array(
					'settings' => 'header_padding_top',
					'label'    => esc_html__( 'Header Top Padding', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 30,
					'default'  => 0,
				),
				array(
					'settings' => 'header_padding_bottom',
					'label'    => esc_html__( 'Header Bottom Padding', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 30,
					'default'  => 0,
				),
				array(
					'settings' => 'header_fixed',
					'label'    => esc_html__( 'Sticky Header', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'sticky_header_color',
					'label'    => esc_html__( 'Sticky background Color', 'aresmurphy' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
				
			)//fields
		),//header_setting

		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo & favicon', 'aresmurphy' ),
			'description'     => esc_html__( 'All Logo & favicon', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'aresmurphy' ),
						'logotext' => esc_html( 'Logo text', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'aresmurphy' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_width',
					'label'    => esc_html__( 'Logo Width', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_height',
					'label'    => esc_html__( 'Logo Height', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_margintop',
					'label'    => esc_html__( 'Margin Top', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
				),				
				array(
					'settings' => 'logo_marginbottom',
					'label'    => esc_html__( 'Margin Margin', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Use your Custom logo text', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Ares Murphy',
					'dependency' => array(
						'id' => 'logo_style',
						'comp' => '=',
						'value' => 'logotext',
					)
				),				
			)//fields
		),//logo_setting
		
		array(
			'id'              => 'sub_header_banner',
			'title'           => esc_html__( 'Sub Header Banner', 'aresmurphy' ),
			'description'     => esc_html__( 'sub header banner', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'disable_sub_header',
					'label'    => esc_html__( 'Disable Sub Header', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),				
				array(
					'settings' => 'sub_header_padding_top',
					'label'    => esc_html__( 'Sub-Header Padding Top', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 40,
				),
				array(
					'settings' => 'sub_header_padding_bottom',
					'label'    => esc_html__( 'Sub-Header Padding Bottom', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 20,
				),
				array(
					'settings' => 'sub_header_margin_bottom',
					'label'    => esc_html__( 'Sub-Header Margin Bottom', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'sub_header_banner_img',
					'label'    => esc_html__( 'Sub-Header Background Image', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_banner_color',
					'label'    => esc_html__( 'Sub-Header Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'sub_header_title',
					'label'    => esc_html__( 'Title Settings', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title_enable',
					'label'    => esc_html__( 'Header Title Enable', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'sub_header_title_size',
					'label'    => esc_html__( 'Header Title Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => '72',
				),
				array(
					'settings' => 'sub_header_title_color',
					'label'    => esc_html__( 'Header Title Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),					
				array(
					'settings' => 'breadcrumb_enable',
					'label'    => esc_html__( 'Disable Breadcrumb', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),	
				array(
					'settings' => 'sub_header_breadcrumb_color',
					'label'    => esc_html__( 'Header Breadcrumb Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),									
			)//fields
		),//sub_header_banner


		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'aresmurphy' ),
			'description'     => esc_html__( 'Typography Setting', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'font_title_body',
					'label'    => esc_html__( 'Body Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'body_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '16',
				),
				array(
					'settings' => 'body_font_height',
					'label'    => esc_html__( 'Body Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'body_font_weight',
					'label'    => esc_html__( 'Body Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'body_font_color',
					'label'    => esc_html__( 'Body Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				array(
					'settings' => 'font_title_menu',
					'label'    => esc_html__( 'Menu Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Menu font
				array(
					'settings' => 'menu_google_font',
					'label'    => esc_html__( 'Select Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '16',
				),
				array(
					'settings' => 'menu_font_height',
					'label'    => esc_html__( 'Menu Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '30',
				),
				array(
					'settings' => 'menu_font_weight',
					'label'    => esc_html__( 'Menu Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'menu_font_color',
					'label'    => esc_html__( 'Menu Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),

				array(
					'settings' => 'font_title_h1',
					'label'    => esc_html__( 'Heading 1 Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_height',
					'label'    => esc_html__( 'Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_weight',
					'label'    => esc_html__( 'Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'h1_font_color',
					'label'    => esc_html__( 'Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h2',
					'label'    => esc_html__( 'Heading 2 Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_height',
					'label'    => esc_html__( 'Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_weight',
					'label'    => esc_html__( 'Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'h2_font_color',
					'label'    => esc_html__( 'Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h3',
					'label'    => esc_html__( 'Heading 3 Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h3_font_height',
					'label'    => esc_html__( 'Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'h3_font_weight',
					'label'    => esc_html__( 'Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'h3_font_color',
					'label'    => esc_html__( 'Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h4',
					'label'    => esc_html__( 'Heading 4 Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '18',
				),
				array(
					'settings' => 'h4_font_height',
					'label'    => esc_html__( 'Heading4 Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h4_font_weight',
					'label'    => esc_html__( 'Heading4 Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'h4_font_color',
					'label'    => esc_html__( 'Heading4 Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h5',
					'label'    => esc_html__( 'Heading 5 Font Options', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'h5_font_height',
					'label'    => esc_html__( 'Heading5 Font Line Height', 'aresmurphy' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'h5_font_weight',
					'label'    => esc_html__( 'Heading5 Font Weight', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'aresmurphy' ),
						'100' => esc_html( '100', 'aresmurphy' ),
						'200' => esc_html( '200', 'aresmurphy' ),
						'300' => esc_html( '300', 'aresmurphy' ),
						'400' => esc_html( '400', 'aresmurphy' ),
						'500' => esc_html( '500', 'aresmurphy' ),
						'600' => esc_html( '600', 'aresmurphy' ),
						'700' => esc_html( '700', 'aresmurphy' ),
						'800' => esc_html( '800', 'aresmurphy' ),
						'900' => esc_html( '900', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'h5_font_color',
					'label'    => esc_html__( 'Heading5 Font Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				// extra Font
								//body font
				array(
					'settings' => 'others_google_font',
					'label'    => esc_html__( 'others Google Font', 'aresmurphy' ),
					'type'     => 'select',
					'default'  => 'Playfair Display',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'other_font_weight',
					'google_font_weight_default' => '400'
				),

			)//fields
		),//typo_setting

		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'aresmurphy' ),
			'description'     => esc_html__( 'Layout & Styling', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'boxfull_en',
					'label'    => esc_html__( 'Select BoxWidth of FullWidth', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fullwidth',
					'choices'  => array(
						'boxwidth' => esc_html__( 'BoxWidth', 'aresmurphy' ),
						'fullwidth' => esc_html__( 'FullWidth', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'body_bg_img',
					'label'    => esc_html__( 'Body Background Image', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'body_bg_attachment',
					'label'    => esc_html__( 'Body Background Attachment', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fixed',
					'choices'  => array(
						'scroll' => esc_html__( 'Scroll', 'aresmurphy' ),
						'fixed' => esc_html__( 'Fixed', 'aresmurphy' ),
						'inherit' => esc_html__( 'Inherit', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'body_bg_repeat',
					'label'    => esc_html__( 'Body Background Repeat', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'no-repeat',
					'choices'  => array(
						'repeat' => esc_html__( 'Repeat', 'aresmurphy' ),
						'repeat-x' => esc_html__( 'Repeat Horizontally', 'aresmurphy' ),
						'repeat-y' => esc_html__( 'Repeat Vertically', 'aresmurphy' ),
						'no-repeat' => esc_html__( 'No Repeat', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'body_bg_size',
					'label'    => esc_html__( 'Body Background Size', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'cover',
					'choices'  => array(
						'cover' => esc_html__( 'Cover', 'aresmurphy' ),
						'contain' => esc_html__( 'Contain', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'body_bg_position',
					'label'    => esc_html__( 'Body Background Position', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'left top',
					'choices'  => array(
						'left top' => esc_html__('left top', 'aresmurphy'),
						'left center' => esc_html__('left center', 'aresmurphy'),
						'left bottom' => esc_html__('left bottom', 'aresmurphy'),
						'right top' => esc_html__('right top', 'aresmurphy'),
						'right center' => esc_html__('right center', 'aresmurphy'),
						'right bottom' => esc_html__('right bottom', 'aresmurphy'),
						'center top' => esc_html__('center top', 'aresmurphy'),
						'center center' => esc_html__('center center', 'aresmurphy'),
						'center bottom' => esc_html__('center bottom', 'aresmurphy'),
					)
				),
				array(
					'settings' => 'preset',
					'label'    => esc_html__( 'Preset Color', 'aresmurphy' ),
					'type'     => 'radio_image',
					'priority' => 10,
					'transport'=> 'postMessage',
					'default'  => '#000000',
					'choices'  => array(
						'#000000' => get_template_directory_uri().'/lib/customizer/assets/presets/1.png',
						'#00a651' => get_template_directory_uri().'/lib/customizer/assets/presets/2.png',
						'#ed1c24' => get_template_directory_uri().'/lib/customizer/assets/presets/3.png',
						'#a67c52' => get_template_directory_uri().'/lib/customizer/assets/presets/4.png',
					)
				),
				array(
					'settings' => 'custom_preset_en',
					'label'    => esc_html__( 'Set Custom Color', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),

				array(
					'settings' => 'bottom_color',
					'label'    => esc_html__( 'Bottom background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'bottom_text_color',
					'label'    => esc_html__( 'Bottom Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),

				# button color section(new)
				array(
					'settings' => 'button_color_title',
					'label'    => esc_html__( 'Button Color Settings', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				
				array(
					'settings' => 'button_bg_color',
					'label'    => esc_html__( 'Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'button_hover_bg_color',
					'label'    => esc_html__( 'Hover Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),
				array(
					'settings' => 'button_text_color',
					'label'    => esc_html__( 'Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_radius',
					'label'    => esc_html__( 'Border Radius', 'aresmurphy' ),
					'type'     => 'range',
					'priority' => 10,
					'default'  => '3',
				),
				# end button color section.

				# navbar color section start.
				array(
					'settings' => 'menu_color_title',
					'label'    => esc_html__( 'Menu Color Settings', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'navbar_text_color',
					'label'    => esc_html__( 'Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				array(
					'settings' => 'navbar_bracket_color',
					'label'    => esc_html__( 'Bracket Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),

				array(
					'settings' => 'navbar_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),
				array(
					'settings' => 'navbar_hover_bracket_color',
					'label'    => esc_html__( 'Hover Bracket Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),

				array(
					'settings' => 'navbar_active_text_color',
					'label'    => esc_html__( 'Active Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),
				array(
					'settings' => 'navbar_active_bracket_color',
					'label'    => esc_html__( 'Active Bracket Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#252525',
				),

				array(
					'settings' => 'sub_menu_color_title',
					'label'    => esc_html__( 'Sub-Menu Color Settings', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_menu_bg',
					'label'    => esc_html__( 'Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#262626',
				),
				array(
					'settings' => 'sub_menu_text_color',
					'label'    => esc_html__( 'Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#9d9d9d',
				),
				array(
					'settings' => 'sub_menu_bg_hover',
					'label'    => esc_html__( 'Hover Background Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#262626',
				),
				array(
					'settings' => 'sub_menu_text_color_hover',
					'label'    => esc_html__( 'Hover Text Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'mega_menu_color_title',
					'label'    => esc_html__( 'Mega Menu Color Settings', 'aresmurphy' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'mega_menu_title',
					'label'    => esc_html__( 'Title Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'mega_menu_border',
					'label'    => esc_html__( 'Border Color', 'aresmurphy' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#3d3d3d',
				),
				#End of the navbar color section


			)//fields
		),//Layout & Styling

		array(
			'id'              => 'social_media_settings',
			'title'           => esc_html__( 'Social Media', 'aresmurphy' ),
			'description'     => esc_html__( 'Social Media', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'wp_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_google_plus',
					'label'    => esc_html__( 'Add Goole Plus URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),				
				array(
					'settings' => 'wp_vimeo',
					'label'    => esc_html__( 'Add Video URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_behance',
					'label'    => esc_html__( 'Add Behance URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_flickr',
					'label'    => esc_html__( 'Add Flickr URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_rss',
					'label'    => esc_html__( 'Add RSS', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_skype',
					'label'    => esc_html__( 'Add Skype URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//social_media

		array(
			'id'              => 'coming_soon',
			'title'           => esc_html__( 'Coming Soon', 'aresmurphy' ),
			'description'     => esc_html__( 'Coming Soon', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'comingsoon_en',
					'label'    => esc_html__( 'Enable Coming Soon', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'comingsoonbg',
					'label'    => esc_html__( 'Upload Coming Soon Site Image', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoonlogo',
					'label'    => esc_html__( 'Upload Coming Soon Page logo', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoontitle',
					'label'    => esc_html__( 'Add Coming Soon Title', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),

				array(
					'settings' => 'comingsoon_date',
					'label'    => esc_html__( 'Coming Soon date', 'aresmurphy' ),
					'type'     => 'date',
					'priority' => 10,
					'default'  => '2019-08-09',
				),
				array(
					'settings' => 'newsletter',
					'label'    => esc_html__( 'Add mailchimp Form Shortcode Here', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),

				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Add Copy Right Text Shortcode Here', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => 'Copyright © Ares Murphy, 2017',
				),

				array(
					'settings' => 'comingsoon_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_google_plus',
					'label'    => esc_html__( 'Add Google Plus URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//coming_soon

		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'aresmurphy' ),
			'description'     => esc_html__( '404 page background and text settings', 'aresmurphy' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'errorbg',
					'label'    => esc_html__( 'Upload 404 Page Background Image', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'errorlogo',
					'label'    => esc_html__( 'Upload 404 Page logo Image', 'aresmurphy' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('404', 'aresmurphy')
				),

				array(
					'settings' => '404_sub_title',
					'label'    => esc_html__( '404 Page Sub Title', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Page Not Found!', 'aresmurphy')
				),

				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'aresmurphy' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'aresmurphy')
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( '404 Button Text', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Go Back Home', 'aresmurphy')
				),
			)
		),
		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'aresmurphy' ),
			'description'     => esc_html__( 'Blog Setting', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'blog_column',
					'label'    => esc_html__( 'Select Blog Column', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '12',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'aresmurphy' ),
						'6' => esc_html( 'Column 2', 'aresmurphy' ),
						'4' => esc_html( 'Column 3', 'aresmurphy' ),
						'3' => esc_html( 'Column 4', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'blog_date',
					'label'    => esc_html__( 'Enable Blog Date', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_author',
					'label'    => esc_html__( 'Enable Blog Author', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_category',
					'label'    => esc_html__( 'Enable Blog Category', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),				
				array(
					'settings' => 'blog_hit',
					'label'    => esc_html__( 'Enable Blog Hit Count', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment',
					'label'    => esc_html__( 'Enable Comment', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_post_text_limit',
					'label'    => esc_html__( 'Post character Limit', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '280',
				),
				array(
					'settings' => 'blog_continue_en',
					'label'    => esc_html__( 'Enable Blog Readmore', 'aresmurphy' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_continue',
					'label'    => esc_html__( 'Continue Reading', 'aresmurphy' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Read More',
				),
			)//fields
		),//blog_setting
		array(
			'id'              => 'bottom_setting',
			'title'           => esc_html__( 'Bottom Setting', 'aresmurphy' ),
			'description'     => esc_html__( 'Bottom Setting', 'aresmurphy' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'bottom_column',
					'label'    => esc_html__( 'Select Bottom Column', 'aresmurphy' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '4',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'aresmurphy' ),
						'6' => esc_html( 'Column 2', 'aresmurphy' ),
						'4' => esc_html( 'Column 3', 'aresmurphy' ),
						'3' => esc_html( 'Column 4', 'aresmurphy' ),
					)
				),
				array(
					'settings' => 'bottom_padding_top',
					'label'    => esc_html__( 'Bottom Top Padding', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 90,
				),
				array(
					'settings' => 'bottom_padding_bottom',
					'label'    => esc_html__( 'Bottom Bottom Padding', 'aresmurphy' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 90,
				),
			)//fields
		)
	),
);//aresmurphy_panel_options


$framework = new THM_Customize( $panel_to_section );

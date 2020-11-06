<?php

$panel_to_section = array(
	'id'           => 'wptixon_panel_options',
	'title'        => esc_html( 'Tixon Options', 'wptixon' ),
	'description'  => esc_html__( 'Tixon Theme Options', 'wptixon' ),
	'priority'     => 10,
	'sections'     => array(

		array(
			'id'              => 'topbar_setting',
			'title'           => esc_html__( 'Topbar Settings', 'wptixon' ),
			'description'     => esc_html__( 'Topbar Settings', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'topbar_en',
					'label'    => esc_html__( 'Topbar Enable/Disable', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'topbar_email',
					'label'    => esc_html__( 'Topbar Email', 'wptixon' ),
					'type'     => 'email',
					'priority' => 10,
					'default'  => 'support@themeum.com',
				),
				array(
					'settings' => 'topbar_phone',
					'label'    => esc_html__( 'Topbar Phone Number', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '+00 44 123 456 78910',
				),
				array(
					'settings' => 'topbar_social',
					'label'    => esc_html__( 'Topbar With Social', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'topbar_color',
					'label'    => esc_html__( 'Topbar background color', 'wptixon' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => 'rgba(0,0,0,0.3)',
				),
				array(
					'settings' => 'topbar_text_color',
					'label'    => esc_html__( 'Topbar text color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'topbar_padding_top',
					'label'    => esc_html__( 'Topbar Padding Top', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 20,
				),
				array(
					'settings' => 'topbar_padding_bottom',
					'label'    => esc_html__( 'Topbar Padding Bottom', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 20,
				),				
			)//fields
		),//topbar_setting

		array(
			'id'              => 'header_setting',
			'title'           => esc_html__( 'Header Settings', 'wptixon' ),
			'description'     => esc_html__( 'Header Settings', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'header_color',
					'label'    => esc_html__( 'Header background Color', 'wptixon' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'header_border_color',
					'label'    => esc_html__( 'Header border bottom color', 'wptixon' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => 'rgba(255, 255, 255, 0)',
				),
				array(
					'settings' => 'header_padding_top',
					'label'    => esc_html__( 'Header Top Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 0,
				),
				array(
					'settings' => 'header_padding_bottom',
					'label'    => esc_html__( 'Header Bottom Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 0,
				),
				array(
					'settings' => 'header_fixed',
					'label'    => esc_html__( 'Sticky Header', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'sticky_header_color',
					'label'    => esc_html__( 'Sticky background Color', 'wptixon' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
				
			)//fields
		),//header_setting

		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo & favicon', 'wptixon' ),
			'description'     => esc_html__( 'All Logo & favicon', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'wptixon' ),
						'logotext' => esc_html( 'Logo text', 'wptixon' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'wptixon' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_width',
					'label'    => esc_html__( 'Logo Width', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 77,
				),
				array(
					'settings' => 'logo_height',
					'label'    => esc_html__( 'Logo Height', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Use your Custom logo text', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Starter Pro',
				),				
			)//fields
		),//logo_setting
		
		array(
			'id'              => 'sub_header_banner',
			'title'           => esc_html__( 'Sub Header Banner', 'wptixon' ),
			'description'     => esc_html__( 'sub header banner', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'sub_header_padding_top',
					'label'    => esc_html__( 'Sub-Header Padding Top', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 30,
				),
				array(
					'settings' => 'sub_header_padding_bottom',
					'label'    => esc_html__( 'Sub-Header Padding Bottom', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 30,
				),
				array(
					'settings' => 'sub_header_margin_bottom',
					'label'    => esc_html__( 'Sub-Header Margin Bottom', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'sub_header_banner_img',
					'label'    => esc_html__( 'Sub-Header Background Image', 'wptixon' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_banner_color',
					'label'    => esc_html__( 'Sub-Header Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#f7f9fc',
				),
				array(
					'settings' => 'sub_header_title',
					'label'    => esc_html__( 'Title Settings', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title_enable',
					'label'    => esc_html__( 'Header Title Enable', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'sub_header_title_size',
					'label'    => esc_html__( 'Header Title Font Size', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => '18',
				),
				array(
					'settings' => 'sub_header_title_color',
					'label'    => esc_html__( 'Header Title Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#404a51',
				),
			)//fields
		),//sub_header_banner


		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'wptixon' ),
			'description'     => esc_html__( 'Typography Setting', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'font_title_body',
					'label'    => esc_html__( 'Body Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Raleway',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'body_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'body_font_height',
					'label'    => esc_html__( 'Body Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'body_font_weight',
					'label'    => esc_html__( 'Body Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'body_font_color',
					'label'    => esc_html__( 'Body Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#191919',
				),
				array(
					'settings' => 'font_title_menu',
					'label'    => esc_html__( 'Menu Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Menu font
				array(
					'settings' => 'menu_google_font',
					'label'    => esc_html__( 'Select Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'menu_font_height',
					'label'    => esc_html__( 'Menu Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '30',
				),
				array(
					'settings' => 'menu_font_weight',
					'label'    => esc_html__( 'Menu Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'menu_font_color',
					'label'    => esc_html__( 'Menu Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#808080',
				),

				array(
					'settings' => 'font_title_h1',
					'label'    => esc_html__( 'Heading 1 Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_height',
					'label'    => esc_html__( 'Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_weight',
					'label'    => esc_html__( 'Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'h1_font_color',
					'label'    => esc_html__( 'Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h2',
					'label'    => esc_html__( 'Heading 2 Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_height',
					'label'    => esc_html__( 'Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_weight',
					'label'    => esc_html__( 'Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'h2_font_color',
					'label'    => esc_html__( 'Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h3',
					'label'    => esc_html__( 'Heading 3 Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h3_font_height',
					'label'    => esc_html__( 'Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'h3_font_weight',
					'label'    => esc_html__( 'Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'h3_font_color',
					'label'    => esc_html__( 'Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h4',
					'label'    => esc_html__( 'Heading 4 Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '18',
				),
				array(
					'settings' => 'h4_font_height',
					'label'    => esc_html__( 'Heading4 Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h4_font_weight',
					'label'    => esc_html__( 'Heading4 Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'h4_font_color',
					'label'    => esc_html__( 'Heading4 Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				array(
					'settings' => 'font_title_h5',
					'label'    => esc_html__( 'Heading 5 Font Options', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'wptixon' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'wptixon' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'h5_font_height',
					'label'    => esc_html__( 'Heading5 Font Line Height', 'wptixon' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'h5_font_weight',
					'label'    => esc_html__( 'Heading5 Font Weight', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'wptixon' ),
						'100' => esc_html( '100', 'wptixon' ),
						'200' => esc_html( '200', 'wptixon' ),
						'300' => esc_html( '300', 'wptixon' ),
						'400' => esc_html( '400', 'wptixon' ),
						'500' => esc_html( '500', 'wptixon' ),
						'600' => esc_html( '600', 'wptixon' ),
						'700' => esc_html( '700', 'wptixon' ),
						'800' => esc_html( '800', 'wptixon' ),
						'900' => esc_html( '900', 'wptixon' ),
					)
				),
				array(
					'settings' => 'h5_font_color',
					'label'    => esc_html__( 'Heading5 Font Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

			)//fields
		),//typo_setting


		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'wptixon' ),
			'description'     => esc_html__( 'Layout & Styling', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'boxfull_en',
					'label'    => esc_html__( 'Select BoxWidth of FullWidth', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'boxwidth',
					'choices'  => array(
						'boxwidth' => esc_html__( 'BoxWidth', 'wptixon' ),
						'fullwidth' => esc_html__( 'FullWidth', 'wptixon' ),
					)
				),
				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#e9eaed',
				),
				array(
					'settings' => 'body_bg_img',
					'label'    => esc_html__( 'Body Background Image', 'wptixon' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'body_bg_attachment',
					'label'    => esc_html__( 'Body Background Attachment', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fixed',
					'choices'  => array(
						'scroll' => esc_html__( 'Scroll', 'wptixon' ),
						'fixed' => esc_html__( 'Fixed', 'wptixon' ),
						'inherit' => esc_html__( 'Inherit', 'wptixon' ),
					)
				),
				array(
					'settings' => 'body_bg_repeat',
					'label'    => esc_html__( 'Body Background Repeat', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'no-repeat',
					'choices'  => array(
						'repeat' => esc_html__( 'Repeat', 'wptixon' ),
						'repeat-x' => esc_html__( 'Repeat Horizontally', 'wptixon' ),
						'repeat-y' => esc_html__( 'Repeat Vertically', 'wptixon' ),
						'no-repeat' => esc_html__( 'No Repeat', 'wptixon' ),
					)
				),
				array(
					'settings' => 'body_bg_size',
					'label'    => esc_html__( 'Body Background Size', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'cover',
					'choices'  => array(
						'cover' => esc_html__( 'Cover', 'wptixon' ),
						'contain' => esc_html__( 'Contain', 'wptixon' ),
					)
				),
				array(
					'settings' => 'body_bg_position',
					'label'    => esc_html__( 'Body Background Position', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'left top',
					'choices'  => array(
						'left top' => esc_html__('left top', 'wptixon'),
						'left center' => esc_html__('left center', 'wptixon'),
						'left bottom' => esc_html__('left bottom', 'wptixon'),
						'right top' => esc_html__('right top', 'wptixon'),
						'right center' => esc_html__('right center', 'wptixon'),
						'right bottom' => esc_html__('right bottom', 'wptixon'),
						'center top' => esc_html__('center top', 'wptixon'),
						'center center' => esc_html__('center center', 'wptixon'),
						'center bottom' => esc_html__('center bottom', 'wptixon'),
					)
				),
				array(
					'settings' => 'preset',
					'label'    => esc_html__( 'Preset Color', 'wptixon' ),
					'type'     => 'radio_image',
					'priority' => 10,
					'transport'=> 'postMessage',
					'default'  => '#0072bc',
					'choices'  => array(
						'#0072bc' => get_template_directory_uri().'/lib/customizer/assets/presets/1.png',
						'#00a651' => get_template_directory_uri().'/lib/customizer/assets/presets/2.png',
						'#ed1c24' => get_template_directory_uri().'/lib/customizer/assets/presets/3.png',
						'#a67c52' => get_template_directory_uri().'/lib/customizer/assets/presets/4.png',
					)
				),
				array(
					'settings' => 'custom_preset_en',
					'label'    => esc_html__( 'Set Custom Color', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#005fb2',
				),

				array(
					'settings' => 'bottom_color',
					'label'    => esc_html__( 'Bottom background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),

				array(
					'settings' => 'bottom_text_color',
					'label'    => esc_html__( 'Footer Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),

				array(
					'settings' => 'footer_color',
					'label'    => esc_html__( 'Footer background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#333333',
				),

				array(
					'settings' => 'footer_text_color',
					'label'    => esc_html__( 'Footer Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),


				# button color section(new)
				array(
					'settings' => 'button_color_title',
					'label'    => esc_html__( 'Button Color Settings', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				
				array(
					'settings' => 'button_bg_color',
					'label'    => esc_html__( 'Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),

				array(
					'settings' => 'button_hover_bg_color',
					'label'    => esc_html__( 'Hover Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#005fb2',
				),
				array(
					'settings' => 'button_text_color',
					'label'    => esc_html__( 'Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				array(
					'settings' => 'button_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_radius',
					'label'    => esc_html__( 'Border Radius', 'wptixon' ),
					'type'     => 'range',
					'priority' => 10,
					'default'  => '50',
				),
				# end button color section.

				# navbar color section start.
				array(
					'settings' => 'menu_color_title',
					'label'    => esc_html__( 'Menu Color Settings', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'navbar_text_color',
					'label'    => esc_html__( 'Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				array(
					'settings' => 'navbar_bracket_color',
					'label'    => esc_html__( 'Bracket Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),

				array(
					'settings' => 'navbar_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),
				array(
					'settings' => 'navbar_hover_bracket_color',
					'label'    => esc_html__( 'Hover Bracket Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),

				array(
					'settings' => 'navbar_active_text_color',
					'label'    => esc_html__( 'Active Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),
				array(
					'settings' => 'navbar_active_bracket_color',
					'label'    => esc_html__( 'Active Bracket Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#0072bc',
				),

				array(
					'settings' => 'sub_menu_color_title',
					'label'    => esc_html__( 'Sub-Menu Color Settings', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_menu_bg',
					'label'    => esc_html__( 'Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#262626',
				),
				array(
					'settings' => 'sub_menu_text_color',
					'label'    => esc_html__( 'Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#9d9d9d',
				),
				array(
					'settings' => 'sub_menu_bg_hover',
					'label'    => esc_html__( 'Hover Background Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#262626',
				),
				array(
					'settings' => 'sub_menu_text_color_hover',
					'label'    => esc_html__( 'Hover Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'mega_menu_color_title',
					'label'    => esc_html__( 'Mega Menu Color Settings', 'wptixon' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'mega_menu_title',
					'label'    => esc_html__( 'Title Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'mega_menu_border',
					'label'    => esc_html__( 'Border Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#3d3d3d',
				),
				#End of the navbar color section


			)//fields
		),//Layout & Styling

		array(
			'id'              => 'social_media_settings',
			'title'           => esc_html__( 'Social Media', 'wptixon' ),
			'description'     => esc_html__( 'Social Media', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'wp_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_google_plus',
					'label'    => esc_html__( 'Add Goole Plus URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_behance',
					'label'    => esc_html__( 'Add Behance URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_flickr',
					'label'    => esc_html__( 'Add Flickr URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_vk',
					'label'    => esc_html__( 'Add Vk URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_skype',
					'label'    => esc_html__( 'Add Skype URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//social_media

		array(
			'id'              => 'coming_soon',
			'title'           => esc_html__( 'Coming Soon', 'wptixon' ),
			'description'     => esc_html__( 'Coming Soon', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'comingsoon_en',
					'label'    => esc_html__( 'Enable Coming Soon', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'comingsoonbg',
					'label'    => esc_html__( 'Upload Coming Soon Site Image', 'wptixon' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoonlogo',
					'label'    => esc_html__( 'Upload Coming Soon Page logo', 'wptixon' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoontitle',
					'label'    => esc_html__( 'Add Coming Soon Title', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),

				array(
					'settings' => 'comingsoon_date',
					'label'    => esc_html__( 'Coming Soon date', 'wptixon' ),
					'type'     => 'date',
					'priority' => 10,
					'default'  => '2019-08-09',
				),
				array(
					'settings' => 'newsletter',
					'label'    => esc_html__( 'Add mailchimp Form Shortcode Here', 'wptixon' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_google_plus',
					'label'    => esc_html__( 'Add Google Plus URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//coming_soon
		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'wptixon' ),
			'description'     => esc_html__( '404 page background and text settings', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'errorlogo',
					'label'    => esc_html__( 'Upload 404 Page logo Image', 'wptixon' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Page Not Found - Lost Maybe?.', 'wptixon')
				),
				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'wptixon' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'wptixon')
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( '404 Button Text', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Go Back Home', 'wptixon')
				),
			)
		),
		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'wptixon' ),
			'description'     => esc_html__( 'Blog Setting', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'blog_column',
					'label'    => esc_html__( 'Select Blog Column', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '12',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'wptixon' ),
						'6' => esc_html( 'Column 2', 'wptixon' ),
						'4' => esc_html( 'Column 3', 'wptixon' ),
						'3' => esc_html( 'Column 4', 'wptixon' ),
					)
				),
				array(
					'settings' => 'blog_date',
					'label'    => esc_html__( 'Enable Blog Date', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_author',
					'label'    => esc_html__( 'Enable Blog Author', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_category',
					'label'    => esc_html__( 'Enable Blog Category', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),				
				array(
					'settings' => 'blog_hit',
					'label'    => esc_html__( 'Enable Blog Hit Count', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment',
					'label'    => esc_html__( 'Enable Comment', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_post_text_limit',
					'label'    => esc_html__( 'Post character Limit', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '280',
				),
				array(
					'settings' => 'blog_continue_en',
					'label'    => esc_html__( 'Enable Blog Readmore', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_continue',
					'label'    => esc_html__( 'Continue Reading', 'wptixon' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Read More',
				),
			)//fields
		),//blog_setting
		array(
			'id'              => 'bottom_setting',
			'title'           => esc_html__( 'Bottom Setting', 'wptixon' ),
			'description'     => esc_html__( 'Bottom Setting', 'wptixon' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'bottom_column',
					'label'    => esc_html__( 'Select Bottom Column', 'wptixon' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '4',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'wptixon' ),
						'6' => esc_html( 'Column 2', 'wptixon' ),
						'4' => esc_html( 'Column 3', 'wptixon' ),
						'3' => esc_html( 'Column 4', 'wptixon' ),
					)
				),
				array(
					'settings' => 'bottom_padding_top',
					'label'    => esc_html__( 'Bottom Top Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 90,
				),
				array(
					'settings' => 'bottom_padding_bottom',
					'label'    => esc_html__( 'Bottom Bottom Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 90,
				),
			)//fields
		),//footer_setting
		array(
			'id'              => 'footer_setting',
			'title'           => esc_html__( 'Footer Setting', 'wptixon' ),
			'description'     => esc_html__( 'Footer Setting', 'wptixon' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'footer_padding_top',
					'label'    => esc_html__( 'Footer Top Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'footer_padding_bottom',
					'label'    => esc_html__( 'Footer Bottom Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 80,
				),				
				array(
					'settings' => 'copyright_en',
					'label'    => esc_html__( 'Enable Copyright Text', 'wptixon' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_text_color',
					'label'    => esc_html__( 'Copyright Text Color', 'wptixon' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'copyright_padding_top',
					'label'    => esc_html__( 'Copyright Top Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 40,
				),	
				array(
					'settings' => 'copyright_padding_bottom',
					'label'    => esc_html__( 'Copyright Bottom Padding', 'wptixon' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 40,
				),					
				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Copyright Text', 'wptixon' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__( '© 2016 Starter Pro. All Rights Reserved.', 'wptixon' ),
				),
			)//fields
		),//footer_setting
		
	),
);//wptixon_panel_options


$framework = new THM_Customize( $panel_to_section );

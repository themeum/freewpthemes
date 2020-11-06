<?php

$panel_to_section = array(
	'id'           => 'winkel_panel_options',
	'title'        => esc_html( 'Winkel Options', 'winkel' ),
	'description'  => esc_html__( 'Winkel Theme Options', 'winkel' ),
	'priority'     => 10,
	'sections'     => array(

		array(
			'id'              => 'header_setting',
			'title'           => esc_html__( 'Header Settings', 'winkel' ),
			'description'     => esc_html__( 'Header Settings', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'head_style',
					'label'    => esc_html__( 'Select Header Style', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'transparent',
					'choices'  => array(
						'transparent' 	=> esc_html( 'Transparent Header', 'winkel' ),
						'solid' 		=> esc_html( 'Solid Header', 'winkel' ),
					)
				),
				array(
					'settings' => 'header_color',
					'label'    => esc_html__( 'Header background Color', 'winkel' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#222538',
				),
				array(
					'settings' => 'header_padding_top',
					'label'    => esc_html__( 'Header Top Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 0,
				),
				array(
					'settings' => 'header_padding_bottom',
					'label'    => esc_html__( 'Header Bottom Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 0,
				),
				array(
					'settings' => 'header_margin_bottom',
					'label'    => esc_html__( 'Header Bottom Margin', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 0,
				),
				array(
					'settings' => 'header_fixed',
					'label'    => esc_html__( 'Sticky Header', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'sticky_header_color',
					'label'    => esc_html__( 'Sticky background Color', 'winkel' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#222538',
				),
				array(
					'settings' => 'header_transparent',
					'label'    => esc_html__( 'Header Transparent', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				
			)//fields
		),//header_setting


		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo', 'winkel' ),
			'description'     => esc_html__( 'All Logo', 'winkel' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'winkel' ),
						'logotext' => esc_html( 'Logo text', 'winkel' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_width',
					'label'    => esc_html__( 'Logo Width', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 97,
				),
				array(
					'settings' => 'logo_height',
					'label'    => esc_html__( 'Logo Height', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Custom Logo Text', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'winkel',
				),		
			)//fields
		),//logo_setting
		
		array(
			'id'              => 'sub_header_banner',
			'title'           => esc_html__( 'Sub Header Banner', 'winkel' ),
			'description'     => esc_html__( 'sub header banner', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'sub_header_padding_top',
					'label'    => esc_html__( 'Sub-Header Padding Top', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 225,
				),
				array(
					'settings' => 'sub_header_padding_bottom',
					'label'    => esc_html__( 'Sub-Header Padding Bottom', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 150,
				),
				array(
					'settings' => 'sub_header_margin_bottom',
					'label'    => esc_html__( 'Sub-Header Margin Bottom', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 60,
				),
				array(
					'settings' => 'sub_header_banner_img',
					'label'    => esc_html__( 'Sub-Header Background Image', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title',
					'label'    => esc_html__( 'Title Settings', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title_size',
					'label'    => esc_html__( 'Header Title Font Size', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => '72',
				),
				array(
					'settings' => 'sub_header_title_color',
					'label'    => esc_html__( 'Header Title Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
			)//fields
		),//sub_header_banner


		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'winkel' ),
			'description'     => esc_html__( 'Typography Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'font_title_body',
					'label'    => esc_html__( 'Body Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Poppins',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'body_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'body_font_height',
					'label'    => esc_html__( 'Body Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'body_font_weight',
					'label'    => esc_html__( 'Body Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
							'' => esc_html( 'Select', 'winkel' ),
							'100' => esc_html( '100', 'winkel' ),
							'200' => esc_html( '200', 'winkel' ),
							'300' => esc_html( '300', 'winkel' ),
							'400' => esc_html( '400', 'winkel' ),
							'500' => esc_html( '500', 'winkel' ),
							'600' => esc_html( '600', 'winkel' ),
							'700' => esc_html( '700', 'winkel' ),
							'800' => esc_html( '800', 'winkel' ),
							'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'body_font_color',
					'label'    => esc_html__( 'Body Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#333333',
				),
				array(
					'settings' => 'font_title_menu',
					'label'    => esc_html__( 'Menu Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				# Menu font
				array(
					'settings' 						=> 'menu_google_font',
					'label'    						=> esc_html__( 'Select Google Font', 'winkel' ),
					'type'     						=> 'select',
					'default'  						=> 'Poppins',
					'choices'  						=> get_google_fonts(),
					'google_font' 					=> true,
					'google_font_weight' 			=> 'menu_font_weight',
					'google_font_weight_default' 	=> '500'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'menu_font_height',
					'label'    => esc_html__( 'Menu Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '54',
				),
				array(
					'settings' => 'menu_font_weight',
					'label'    => esc_html__( 'Menu Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '500',
					'choices'  => array(
								'' => esc_html( 'Select', 'winkel' ),
								'100' => esc_html( '100', 'winkel' ),
								'200' => esc_html( '200', 'winkel' ),
								'300' => esc_html( '300', 'winkel' ),
								'400' => esc_html( '400', 'winkel' ),
								'500' => esc_html( '500', 'winkel' ),
								'600' => esc_html( '600', 'winkel' ),
								'700' => esc_html( '700', 'winkel' ),
								'800' => esc_html( '800', 'winkel' ),
								'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'menu_font_color',
					'label'    => esc_html__( 'Menu Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h1',
					'label'    => esc_html__( 'Heading 1 Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Poppins',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_height',
					'label'    => esc_html__( 'Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '48',
				),
				array(
					'settings' => 'h1_font_weight',
					'label'    => esc_html__( 'Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'h1_font_color',
					'label'    => esc_html__( 'Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h2',
					'label'    => esc_html__( 'Heading 2 Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Poppins',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_height',
					'label'    => esc_html__( 'Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_weight',
					'label'    => esc_html__( 'Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'h2_font_color',
					'label'    => esc_html__( 'Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h3',
					'label'    => esc_html__( 'Heading 3 Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Poppins',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h3_font_height',
					'label'    => esc_html__( 'Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'h3_font_weight',
					'label'    => esc_html__( 'Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'h3_font_color',
					'label'    => esc_html__( 'Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h4',
					'label'    => esc_html__( 'Heading 4 Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Roboto',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '18',
				),
				array(
					'settings' => 'h4_font_height',
					'label'    => esc_html__( 'Heading4 Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h4_font_weight',
					'label'    => esc_html__( 'Heading4 Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'h4_font_color',
					'label'    => esc_html__( 'Heading4 Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

				array(
					'settings' => 'font_title_h5',
					'label'    => esc_html__( 'Heading 5 Font Options', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'winkel' ),
					'type'     => 'select',
					'default'  => 'Roboto',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '600'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'h5_font_height',
					'label'    => esc_html__( 'Heading5 Font Line Height', 'winkel' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'h5_font_weight',
					'label'    => esc_html__( 'Heading5 Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'h5_font_color',
					'label'    => esc_html__( 'Heading5 Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),

			)//fields
		),//typo_setting

		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'winkel' ),
			'description'     => esc_html__( 'Layout & Styling', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'boxfull_en',
					'label'    => esc_html__( 'Select BoxWidth of FullWidth', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fullwidth',
					'choices'  => array(
						'boxwidth' => esc_html__( 'BoxWidth', 'winkel' ),
						'fullwidth' => esc_html__( 'FullWidth', 'winkel' ),
					)
				),

				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'body_bg_img',
					'label'    => esc_html__( 'Body Background Image', 'winkel' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'body_bg_attachment',
					'label'    => esc_html__( 'Body Background Attachment', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fixed',
					'choices'  => array(
						'scroll' => esc_html__( 'Scroll', 'winkel' ),
						'fixed' => esc_html__( 'Fixed', 'winkel' ),
						'inherit' => esc_html__( 'Inherit', 'winkel' ),
					)
				),
				array(
					'settings' => 'body_bg_repeat',
					'label'    => esc_html__( 'Body Background Repeat', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'no-repeat',
					'choices'  => array(
						'repeat' => esc_html__( 'Repeat', 'winkel' ),
						'repeat-x' => esc_html__( 'Repeat Horizontally', 'winkel' ),
						'repeat-y' => esc_html__( 'Repeat Vertically', 'winkel' ),
						'no-repeat' => esc_html__( 'No Repeat', 'winkel' ),
					)
				),
				array(
					'settings' => 'body_bg_size',
					'label'    => esc_html__( 'Body Background Size', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'cover',
					'choices'  => array(
						'cover' => esc_html__( 'Cover', 'winkel' ),
						'contain' => esc_html__( 'Contain', 'winkel' ),
					)
				),
				array(
					'settings' => 'body_bg_position',
					'label'    => esc_html__( 'Body Background Position', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'left top',
					'choices'  => array(
						'left top' => esc_html__('left top', 'winkel'),
						'left center' => esc_html__('left center', 'winkel'),
						'left bottom' => esc_html__('left bottom', 'winkel'),
						'right top' => esc_html__('right top', 'winkel'),
						'right center' => esc_html__('right center', 'winkel'),
						'right bottom' => esc_html__('right bottom', 'winkel'),
						'center top' => esc_html__('center top', 'winkel'),
						'center center' => esc_html__('center center', 'winkel'),
						'center bottom' => esc_html__('center bottom', 'winkel'),
					)
				),
				array(
					'settings' => 'custom_preset_en',
					'label'    => esc_html__( 'Set Custom Color', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),
			

				# button color section(new)
				array(
					'settings' => 'button_color_title',
					'label'    => esc_html__( 'Button Color Settings', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				
				array(
					'settings' => 'button_bg_color',
					'label'    => esc_html__( 'Background Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),

				array(
					'settings' => 'button_hover_bg_color',
					'label'    => esc_html__( 'Hover Background Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#e83333',
				),
				array(
					'settings' => 'button_text_color',
					'label'    => esc_html__( 'Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_radius',
					'label'    => esc_html__( 'Border Radius', 'winkel' ),
					'type'     => 'range',
					'priority' => 10,
					'default'  => '4',
				),
				# end button color section.

				# navbar color section start.
				array(
					'settings' => 'menu_color_title',
					'label'    => esc_html__( 'Menu Color Settings', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'navbar_text_color',
					'label'    => esc_html__( 'Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),

				array(
					'settings' => 'navbar_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),

				array(
					'settings' => 'navbar_active_text_color',
					'label'    => esc_html__( 'Active Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),

				array(
					'settings' => 'sub_menu_color_title',
					'label'    => esc_html__( 'Sub-Menu Color Settings', 'winkel' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_menu_bg',
					'label'    => esc_html__( 'Background Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'sub_menu_text_color',
					'label'    => esc_html__( 'Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#191919',
				),
				array(
					'settings' => 'sub_menu_text_color_hover',
					'label'    => esc_html__( 'Hover Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),
				#End of the navbar color section


			)//fields
		),//Layout & Styling


		array(
			'id'              => 'offcanavs_category_settings',
			'title'           => esc_html__( 'Off Winkel Category', 'winkel' ),
			'description'     => esc_html__( 'Off Winkel Category', 'winkel' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'offcanavs_enable',
					'label'    => esc_html__( 'Enable Off Winkel category', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'category_count',
					'label'    => esc_html__( 'Number of category', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 8,
				),	
				array(
					'settings' => 'cat_orderby',
					'label'    => esc_html__( 'Order By', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'name',
					'choices'  => array(
						'name' => esc_html( 'name', 'winkel' ),
						'id' => esc_html( 'ID', 'winkel' ),
						'slug' => esc_html( 'Slug', 'winkel' ),
					)
				),				
				array(
					'settings' => 'cat_order',
					'label'    => esc_html__( 'Order', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'ASC',
					'choices'  => array(
						'ASC' => esc_html( 'ASC', 'winkel' ),
						'DESC' => esc_html( 'DESC', 'winkel' ),
					)
				),
				array(
					'settings' => 'offcanvas_bg',
					'label'    => esc_html__( 'Upload offcanvas background', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
				),
			)//fields
		),//offcanvas category

		array(
			'id'              => 'coming_soon',
			'title'           => esc_html__( 'Coming Soon', 'winkel' ),
			'description'     => esc_html__( 'Coming Soon', 'winkel' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'comingsoon_en',
					'label'    => esc_html__( 'Enable Coming Soon', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),

				array(
					'settings' => 'comming_soon_bg',
					'label'    => esc_html__( 'Upload Background Image', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
				),

				array(
					'settings' => 'comming_soon_logo',
					'label'    => esc_html__( 'Upload Logo', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),

				array(
					'settings' => 'comingsoontitle',
					'label'    => esc_html__( 'Add Coming Soon Title', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__( 'We are working in our new website, stay tuned!', 'winkel' ),
				),
				array(
					'settings' => 'subscribe_btn',
					'label'    => esc_html__( 'Subscribe Button Name', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__( 'Subscribe Now', 'winkel' ),
				),

				array(
					'settings' => 'comingsoon_date',
					'label'    => esc_html__( 'Coming Soon date', 'winkel' ),
					'type'     => 'date',
					'priority' => 10,
					'default'  => '2020-08-09',
				),
				array(
					'settings' => 'newsletter',
					'label'    => esc_html__( 'Add mailchimp Form Shortcode Here', 'winkel' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//coming_soon
		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'winkel' ),
			'description'     => esc_html__( '404 page background and text settings', 'winkel' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'err_bg',
					'label'    => esc_html__( 'Upload Banner', 'winkel' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/404.png',
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('The page doesn’t exist.', 'winkel')
				),
				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'winkel' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => ''
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( '404 Button Text', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Go Back', 'winkel')
				),
			)
		),






		array(
			'id'              => 'shop_setting',
			'title'           => esc_html__( 'Shop Setting', 'winkel' ),
			'description'     => esc_html__( 'Shop Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'shop_column',
					'label'    => esc_html__( 'Select Shop Column', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '4',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'winkel' ),
						'6' => esc_html( 'Column 2', 'winkel' ),
						'4' => esc_html( 'Column 3', 'winkel' ),
						'3' => esc_html( 'Column 4', 'winkel' ),
					)
				),
			)//fields
		),//blog_setting

















		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'winkel' ),
			'description'     => esc_html__( 'Blog Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'blog_column',
					'label'    => esc_html__( 'Select Blog Column', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '4',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'winkel' ),
						'6' => esc_html( 'Column 2', 'winkel' ),
						'4' => esc_html( 'Column 3', 'winkel' ),
						'3' => esc_html( 'Column 4', 'winkel' ),
					)
				),
				array(
					'settings' => 'blog_date',
					'label'    => esc_html__( 'Enable Blog Date', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_author',
					'label'    => esc_html__( 'Enable Blog Author', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'blog_category',
					'label'    => esc_html__( 'Enable Blog Category', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_tags',
					'label'    => esc_html__( 'Enable Tags', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),				
				array(
					'settings' => 'blog_hit',
					'label'    => esc_html__( 'Enable Blog Hit Count', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'blog_intro_text_en',
					'label'    => esc_html__( 'Enable Intro Text', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_continue_en',
					'label'    => esc_html__( 'Enable Blog Readmore', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment',
					'label'    => esc_html__( 'Enable Comment', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'blog_post_text_limit',
					'label'    => esc_html__( 'Post character Limit', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '220',
				),
				array(
					'settings' => 'blog_continue',
					'label'    => esc_html__( 'Continue Reading', 'winkel' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Read More',
				),
			)//fields
		),//blog_setting



		array(
			'id'              => 'blog_single_setting',
			'title'           => esc_html__( 'Blog Single Page Setting', 'winkel' ),
			'description'     => esc_html__( 'Blog Single Page Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(	
				array(
					'settings' => 'blog_dates_single',
					'label'    => esc_html__( 'Enable Blog Date', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_authors_single',
					'label'    => esc_html__( 'Enable Blog Author', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_categorys_single',
					'label'    => esc_html__( 'Enable Blog Category', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blogs_tags_single',
					'label'    => esc_html__( 'Enable Tags', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),				
				array(
					'settings' => 'blog_hits_single',
					'label'    => esc_html__( 'Enable Blog Hit Count', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comments_single',
					'label'    => esc_html__( 'Enable Comment', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),	
				array(
					'settings' => 'blog_social_shares',
					'label'    => esc_html__( 'Enable Blog Social Share', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),			
			) #fields
		), 
		#blog_single_page_setting


		array(
			'id'              => 'bottom_setting',
			'title'           => esc_html__( 'Bottom Setting', 'winkel' ),
			'description'     => esc_html__( 'Bottom Setting', 'winkel' ),
			'priority'        => 10,
			'fields'          => array(
				array(
					'settings' => 'bottom_en',
					'label'    => esc_html__( 'Enable Bottom Area', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'bottom_column',
					'label'    => esc_html__( 'Select Bottom Column', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '3',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'winkel' ),
						'6' => esc_html( 'Column 2', 'winkel' ),
						'4' => esc_html( 'Column 3', 'winkel' ),
						'3' => esc_html( 'Column 4', 'winkel' ),
						'2' => esc_html( 'Column 6', 'winkel' ),
					)
				),
				array(
					'settings' => 'bottom_color',
					'label'    => esc_html__( 'Bottom background Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#19171a',
				),
				array(
					'settings' => 'bottom_text_color',
					'label'    => esc_html__( 'Bottom Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),	
				array(
					'settings' => 'bottom_link_color',
					'label'    => esc_html__( 'Bottom Link Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#9b9b9c',
				),				
				array(
					'settings' => 'bottom_hover_color',
					'label'    => esc_html__( 'Bottom link hover color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),
				array(
					'settings' => 'bottom_padding_top',
					'label'    => esc_html__( 'Bottom Top Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 68,
				),	
				array(
					'settings' => 'bottom_padding_bottom',
					'label'    => esc_html__( 'Bottom Padding Bottom', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 38,
				),					
			)//fields
		), //bottom_setting	

		array(
			'id'              => 'footer_setting',
			'title'           => esc_html__( 'Footer Setting', 'winkel' ),
			'description'     => esc_html__( 'Footer Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'footer_en',
					'label'    => esc_html__( 'Disable Copyright Area', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_en',
					'label'    => esc_html__( 'Disable copyright text', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'footer_bottom_menu',
					'label'    => esc_html__( 'Disable Footer Menu', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Copyright Text', 'winkel' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__( '© 2017 Winkel. All Rights Reserved.', 'winkel' ),
				),
				array(
					'settings' => 'copyright_text_color',
					'label'    => esc_html__( 'Footer Text Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#666666',
				),				
				array(
					'settings' => 'copyright_link_color',
					'label'    => esc_html__( 'Footer Link Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#7d91aa',
				),				
				array(
					'settings' => 'copyright_hover_color',
					'label'    => esc_html__( 'Footer link hover color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),
				array(
					'settings' => 'copyright_bg_color',
					'label'    => esc_html__( 'Footer background color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),
				array(
					'settings' => 'copyright_padding_top',
					'label'    => esc_html__( 'Footer Top Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 48,
				),	
				array(
					'settings' => 'copyright_padding_bottom',
					'label'    => esc_html__( 'Footer Bottom Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 48,
				),					
			)//fields
		),//footer_setting

		array(
			'id'              => 'footer_menu_setting',
			'title'           => esc_html__( 'Footer Menu Setting', 'winkel' ),
			'description'     => esc_html__( 'Footer Menu Setting', 'winkel' ),
			'priority'        => 10,
			'fields'         => array(
				array(
					'settings' => 'bottom_footer_menu',
					'label'    => esc_html__( 'Disable Footer Menu', 'winkel' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'footer_menu_font_size',
					'label'    => esc_html__( 'Footer Menu Font Size', 'winkel' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'footer_menu_font_weight',
					'label'    => esc_html__( 'Footer Menu Font Weight', 'winkel' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '600',
					'choices'  => array(
						'' => esc_html( 'Select', 'winkel' ),
						'100' => esc_html( '100', 'winkel' ),
						'200' => esc_html( '200', 'winkel' ),
						'300' => esc_html( '300', 'winkel' ),
						'400' => esc_html( '400', 'winkel' ),
						'500' => esc_html( '500', 'winkel' ),
						'600' => esc_html( '600', 'winkel' ),
						'700' => esc_html( '700', 'winkel' ),
						'800' => esc_html( '800', 'winkel' ),
						'900' => esc_html( '900', 'winkel' ),
					)
				),
				array(
					'settings' => 'footer_menu_bg_color',
					'label'    => esc_html__( 'Footer Menu BG Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#19171A',
				),
				array(
					'settings' => 'footer_menu_font_color',
					'label'    => esc_html__( 'Footer Menu Font Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'footer_menu_hover_color',
					'label'    => esc_html__( 'Footer Menu Hover Color', 'winkel' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fd5238',
				),			
				array(
					'settings' => 'footer_menu_padding_top',
					'label'    => esc_html__( 'Footer Top Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 25,
				),	
				array(
					'settings' => 'footer_menu_padding_bottom',
					'label'    => esc_html__( 'Footer Bottom Padding', 'winkel' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 25,
				),					
			)//fields
		),//footer_setting

		array(
			'id'              => 'google_map_setting',
			'title'           => esc_html__( 'Google Map Setting', 'winkel' ),
			'priority'        => 11,
			'fields'         => array(
					array(
						'settings' => 'google_map_api',
						'label'    => esc_html__( 'Google Map API Key', 'winkel' ),
						'type'     => 'text',
						'priority' => 10,
						'default'  => '',
					),
				)
		)// Google Map API Key
		
	),
);//winkel_panel_options


$framework = new THM_Customize( $panel_to_section );

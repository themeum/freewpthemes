<?php

$panel_to_section = array(
	'id'           => 'starterpro_panel_options',
	'title'        => esc_html( 'Starter Pro Options', 'starterpro' ),
	'description'  => esc_html__( 'Starter Pro Theme Options', 'starterpro' ),
	'priority'     => 10,
	'sections'     => array(

		array(
			'id'              => 'header_setting',
			'title'           => esc_html__( 'Header Settings', 'starterpro' ),
			'description'     => esc_html__( 'Header Settings', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'head_style',
					'label'    => esc_html__( 'Select Header Style', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'solid',
					'choices'  => array(
						'transparent' => esc_html( 'Transparent Header', 'starterpro' ),
						'solid' => esc_html( 'Solid Header', 'starterpro' ),
					)
				),
				array(
					'settings' => 'header_color',
					'label'    => esc_html__( 'Header background Color', 'starterpro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'header_border_color',
					'label'    => esc_html__( 'Header border bottom color', 'starterpro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => 'rgba(255, 255, 255, 0)',
				),
				array(
					'settings' => 'header_padding_top',
					'label'    => esc_html__( 'Header Top Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 15,
				),
				array(
					'settings' => 'header_padding_bottom',
					'label'    => esc_html__( 'Header Bottom Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 15,
				),
				array(
					'settings' => 'header_fixed',
					'label'    => esc_html__( 'Sticky Header', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'sticky_header_color',
					'label'    => esc_html__( 'Sticky background Color', 'starterpro' ),
					'type'     => 'rgba',
					'priority' => 10,
					'default'  => '#fff',
				),
				
			)//fields
		),//header_setting

		array(
			'id'              => 'logo_setting',
			'title'           => esc_html__( 'All Logo & favicon', 'starterpro' ),
			'description'     => esc_html__( 'All Logo & favicon', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'logo_style',
					'label'    => esc_html__( 'Select Header Style', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'logoimg',
					'choices'  => array(
						'logoimg' => esc_html( 'Logo image', 'starterpro' ),
						'logotext' => esc_html( 'Logo text', 'starterpro' ),
					)
				),
				array(
					'settings' => 'logo',
					'label'    => esc_html__( 'Upload Logo', 'starterpro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'logo_width',
					'label'    => esc_html__( 'Logo Width', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_height',
					'label'    => esc_html__( 'Logo Height', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
				),
				array(
					'settings' => 'logo_text',
					'label'    => esc_html__( 'Use your Custom logo text', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Starter Pro',
				),				
			)//fields
		),//logo_setting
		
		array(
			'id'              => 'sub_header_banner',
			'title'           => esc_html__( 'Sub Header Banner', 'starterpro' ),
			'description'     => esc_html__( 'sub header banner', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'sub_header_padding_top',
					'label'    => esc_html__( 'Sub-Header Padding Top', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'sub_header_padding_bottom',
					'label'    => esc_html__( 'Sub-Header Padding Bottom', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'sub_header_margin_bottom',
					'label'    => esc_html__( 'Sub-Header Margin Bottom', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'sub_header_banner_img',
					'label'    => esc_html__( 'Sub-Header Background Image', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_banner_color',
					'label'    => esc_html__( 'Sub-Header Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#333',
				),
				array(
					'settings' => 'sub_header_title',
					'label'    => esc_html__( 'Title Settings', 'starterpro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_header_title_enable',
					'label'    => esc_html__( 'Header Title Enable', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'sub_header_title_size',
					'label'    => esc_html__( 'Header Title Font Size', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => '72',
				),
				array(
					'settings' => 'sub_header_title_color',
					'label'    => esc_html__( 'Header Title Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
			)//fields
		),//sub_header_banner


		array(
			'id'              => 'typo_setting',
			'title'           => esc_html__( 'Typography Setting', 'starterpro' ),
			'description'     => esc_html__( 'Typography Setting', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				//body font
				array(
					'settings' => 'body_google_font',
					'label'    => esc_html__( 'Select Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Raleway',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'body_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'body_font_size',
					'label'    => esc_html__( 'Body Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'body_font_height',
					'label'    => esc_html__( 'Body Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'body_font_weight',
					'label'    => esc_html__( 'Body Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'body_font_color',
					'label'    => esc_html__( 'Body Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#191919',
				),

				//Menu font
				array(
					'settings' => 'menu_google_font',
					'label'    => esc_html__( 'Select Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '400'
				),
				array(
					'settings' => 'menu_font_size',
					'label'    => esc_html__( 'Menu Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'menu_font_height',
					'label'    => esc_html__( 'Menu Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '30',
				),
				array(
					'settings' => 'menu_font_weight',
					'label'    => esc_html__( 'Menu Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '400',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'menu_font_color',
					'label'    => esc_html__( 'Menu Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#808080',
				),


				//Heading 1
				array(
					'settings' => 'h1_google_font',
					'label'    => esc_html__( 'Heading1 Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h1_font_size',
					'label'    => esc_html__( 'Heading1 Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_height',
					'label'    => esc_html__( 'Heading1 Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '42',
				),
				array(
					'settings' => 'h1_font_weight',
					'label'    => esc_html__( 'Heading1 Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'h1_font_color',
					'label'    => esc_html__( 'Heading1 Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				//Heading 2
				array(
					'settings' => 'h2_google_font',
					'label'    => esc_html__( 'Heading2 Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h2_font_size',
					'label'    => esc_html__( 'Heading2 Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_height',
					'label'    => esc_html__( 'Heading2 Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '36',
				),
				array(
					'settings' => 'h2_font_weight',
					'label'    => esc_html__( 'Heading2 Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'h2_font_color',
					'label'    => esc_html__( 'Heading2 Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				//Heading 3
				array(
					'settings' => 'h3_google_font',
					'label'    => esc_html__( 'Heading3 Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h3_font_size',
					'label'    => esc_html__( 'Heading3 Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h3_font_height',
					'label'    => esc_html__( 'Heading3 Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '28',
				),
				array(
					'settings' => 'h3_font_weight',
					'label'    => esc_html__( 'Heading3 Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'h3_font_color',
					'label'    => esc_html__( 'Heading3 Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				//Heading 4
				array(
					'settings' => 'h4_google_font',
					'label'    => esc_html__( 'Heading4 Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h4_font_size',
					'label'    => esc_html__( 'Heading4 Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '18',
				),
				array(
					'settings' => 'h4_font_height',
					'label'    => esc_html__( 'Heading4 Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '26',
				),
				array(
					'settings' => 'h4_font_weight',
					'label'    => esc_html__( 'Heading4 Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'h4_font_color',
					'label'    => esc_html__( 'Heading4 Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

				//Heading 5
				array(
					'settings' => 'h5_google_font',
					'label'    => esc_html__( 'Heading5 Google Font', 'starterpro' ),
					'type'     => 'select',
					'default'  => 'Lato',
					'choices'  => get_google_fonts(),
					'google_font' => true,
					'google_font_weight' => 'menu_font_weight',
					'google_font_weight_default' => '700'
				),
				array(
					'settings' => 'h5_font_size',
					'label'    => esc_html__( 'Heading5 Font Size', 'starterpro' ),
					'type'     => 'number',
					'default'  => '14',
				),
				array(
					'settings' => 'h5_font_height',
					'label'    => esc_html__( 'Heading5 Font Line Height', 'starterpro' ),
					'type'     => 'number',
					'default'  => '24',
				),
				array(
					'settings' => 'h5_font_weight',
					'label'    => esc_html__( 'Heading5 Font Weight', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '700',
					'choices'  => array(
						'' => esc_html( 'Select', 'starterpro' ),
						'100' => esc_html( '100', 'starterpro' ),
						'200' => esc_html( '200', 'starterpro' ),
						'300' => esc_html( '300', 'starterpro' ),
						'400' => esc_html( '400', 'starterpro' ),
						'500' => esc_html( '500', 'starterpro' ),
						'600' => esc_html( '600', 'starterpro' ),
						'700' => esc_html( '700', 'starterpro' ),
						'800' => esc_html( '800', 'starterpro' ),
						'900' => esc_html( '900', 'starterpro' ),
					)
				),
				array(
					'settings' => 'h5_font_color',
					'label'    => esc_html__( 'Heading5 Font Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000000',
				),

			)//fields
		),//typo_setting


		array(
			'id'              => 'layout_styling',
			'title'           => esc_html__( 'Layout & Styling', 'starterpro' ),
			'description'     => esc_html__( 'Layout & Styling', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'body_bg_color',
					'label'    => esc_html__( 'Body Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'body_bg_img',
					'label'    => esc_html__( 'Body Background Image', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'body_bg_attachment',
					'label'    => esc_html__( 'Body Background Attachment', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'fixed',
					'choices'  => array(
						'scroll' => esc_html__( 'Scroll', 'starterpro' ),
						'fixed' => esc_html__( 'Fixed', 'starterpro' ),
						'inherit' => esc_html__( 'Inherit', 'starterpro' ),
					)
				),
				array(
					'settings' => 'body_bg_repeat',
					'label'    => esc_html__( 'Body Background Repeat', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'no-repeat',
					'choices'  => array(
						'repeat' => esc_html__( 'Repeat', 'starterpro' ),
						'repeat-x' => esc_html__( 'Repeat Horizontally', 'starterpro' ),
						'repeat-y' => esc_html__( 'Repeat Vertically', 'starterpro' ),
						'no-repeat' => esc_html__( 'No Repeat', 'starterpro' ),
					)
				),
				array(
					'settings' => 'body_bg_size',
					'label'    => esc_html__( 'Body Background Size', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'cover',
					'choices'  => array(
						'cover' => esc_html__( 'Cover', 'starterpro' ),
						'contain' => esc_html__( 'Contain', 'starterpro' ),
					)
				),
				array(
					'settings' => 'body_bg_position',
					'label'    => esc_html__( 'Body Background Position', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => 'left top',
					'choices'  => array(
						'left top' => esc_html__('left top', 'starterpro'),
						'left center' => esc_html__('left center', 'starterpro'),
						'left bottom' => esc_html__('left bottom', 'starterpro'),
						'right top' => esc_html__('right top', 'starterpro'),
						'right center' => esc_html__('right center', 'starterpro'),
						'right bottom' => esc_html__('right bottom', 'starterpro'),
						'center top' => esc_html__('center top', 'starterpro'),
						'center center' => esc_html__('center center', 'starterpro'),
						'center bottom' => esc_html__('center bottom', 'starterpro'),
					)
				),
				array(
					'settings' => 'preset',
					'label'    => esc_html__( 'Preset Color', 'starterpro' ),
					'type'     => 'radio_image',
					'priority' => 10,
					'transport'=> 'postMessage',
					'default'  => '#00aeef',
					'choices'  => array(
						'#00aeef' => get_template_directory_uri().'/lib/customizer/assets/presets/1.png',
						'#f7941d' => get_template_directory_uri().'/lib/customizer/assets/presets/2.png',
						'#88cb2c' => get_template_directory_uri().'/lib/customizer/assets/presets/3.png',
						'#8177db' => get_template_directory_uri().'/lib/customizer/assets/presets/4.png',
						'#22c5be' => get_template_directory_uri().'/lib/customizer/assets/presets/5.png',
						'#e2b278' => get_template_directory_uri().'/lib/customizer/assets/presets/6.png',
					)
				),
				array(
					'settings' => 'custom_preset_en',
					'label'    => esc_html__( 'Set Custom Color', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'major_color',
					'label'    => esc_html__( 'Major Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00aeef',
				),
				array(
					'settings' => 'hover_color',
					'label'    => esc_html__( 'Hover Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00a2e8',
				),

				array(
					'settings' => 'footer_color',
					'label'    => esc_html__( 'Footer background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),

				array(
					'settings' => 'footer_text_color',
					'label'    => esc_html__( 'Footer Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#202134',
				),


				# button color section(new)
				array(
					'settings' => 'button_color_title',
					'label'    => esc_html__( 'Button Color Settings', 'starterpro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				
				array(
					'settings' => 'button_bg_color',
					'label'    => esc_html__( 'Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00aeef',
				),

				array(
					'settings' => 'button_hover_bg_color',
					'label'    => esc_html__( 'Hover Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#00a2e8',
				),
				array(
					'settings' => 'button_text_color',
					'label'    => esc_html__( 'Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'button_radius',
					'label'    => esc_html__( 'Border Radius', 'starterpro' ),
					'type'     => 'range',
					'priority' => 10,
					'default'  => '4',
				),
				# end button color section.

				# navbar color section start.
				array(
					'settings' => 'menu_color_title',
					'label'    => esc_html__( 'Menu Color Settings', 'starterpro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'navbar_text_color',
					'label'    => esc_html__( 'Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#808080',
				),

				/*array(
					'settings' => 'navbar_hover_text_color',
					'label'    => esc_html__( 'Hover Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '',
				),*/
				array(
					'settings' => 'navbar_bracket_color',
					'label'    => esc_html__( 'Bracket Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#808080',
				),
				array(
					'settings' => 'sub_menu_color_title',
					'label'    => esc_html__( 'Sub-Menu Color Settings', 'starterpro' ),
					'type'     => 'title',
					'priority' => 10,
				),
				array(
					'settings' => 'sub_menu_bg',
					'label'    => esc_html__( 'Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fff',
				),
				array(
					'settings' => 'sub_menu_text_color',
					'label'    => esc_html__( 'Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				array(
					'settings' => 'sub_menu_border',
					'label'    => esc_html__( 'Border Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#eef0f2',
				),
				array(
					'settings' => 'sub_menu_bg_hover',
					'label'    => esc_html__( 'Hover Background Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#fbfbfc',
				),
				array(
					'settings' => 'sub_menu_text_color_hover',
					'label'    => esc_html__( 'Hover Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#000',
				),
				#End of the navbar color section


			)//fields
		),//Layout & Styling

		array(
			'id'              => 'social_media_settings',
			'title'           => esc_html__( 'Social Media', 'starterpro' ),
			'description'     => esc_html__( 'Social Media', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'wp_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_google_plus',
					'label'    => esc_html__( 'Add Goole Plus URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '#',
				),
				array(
					'settings' => 'wp_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_behance',
					'label'    => esc_html__( 'Add Behance URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_flickr',
					'label'    => esc_html__( 'Add Flickr URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_vk',
					'label'    => esc_html__( 'Add Vk URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'wp_skype',
					'label'    => esc_html__( 'Add Skype URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//social_media

		array(
			'id'              => 'coming_soon',
			'title'           => esc_html__( 'Coming Soon', 'starterpro' ),
			'description'     => esc_html__( 'Coming Soon', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(

				array(
					'settings' => 'comingsoon_en',
					'label'    => esc_html__( 'Enable Coming Soon', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),
				array(
					'settings' => 'comingsoonbg',
					'label'    => esc_html__( 'Upload Coming Soon Page Background', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoonlogo',
					'label'    => esc_html__( 'Upload Coming Soon Page logo', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),

				array(
					'settings' => 'comingsoon_date',
					'label'    => esc_html__( 'Coming Soon date', 'starterpro' ),
					'type'     => 'date',
					'priority' => 10,
					'default'  => '2019-08-09',
				),
				array(
					'settings' => 'newsletter',
					'label'    => esc_html__( 'Add mailchimp Form Shortcode Here', 'starterpro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_facebook',
					'label'    => esc_html__( 'Add Facebook URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_twitter',
					'label'    => esc_html__( 'Add Twitter URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_google_plus',
					'label'    => esc_html__( 'Add Google Plus URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_pinterest',
					'label'    => esc_html__( 'Add Pinterest URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_youtube',
					'label'    => esc_html__( 'Add Youtube URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_linkedin',
					'label'    => esc_html__( 'Add Linkedin URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_dribbble',
					'label'    => esc_html__( 'Add Dribbble URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
				array(
					'settings' => 'comingsoon_instagram',
					'label'    => esc_html__( 'Add Instagram URL', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '',
				),
			)//fields
		),//coming_soon
		array(
			'id'              => '404_settings',
			'title'           => esc_html__( '404 Page', 'starterpro' ),
			'description'     => esc_html__( '404 page background and text settings', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'errorbg',
					'label'    => esc_html__( 'Upload 404 Page Background Image', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => 'errorlogo',
					'label'    => esc_html__( 'Upload 404 Page logo Image', 'starterpro' ),
					'type'     => 'image',
					'priority' => 10,
				),
				array(
					'settings' => '404_title',
					'label'    => esc_html__( '404 Page Title', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Page Not Found - Lost Maybe?.', 'starterpro')
				),
				array(
					'settings' => '404_description',
					'label'    => esc_html__( '404 Page Description', 'starterpro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__('The page you are looking for was moved, removed, renamed or might never existed..', 'starterpro')
				),
				array(
					'settings' => '404_btn_text',
					'label'    => esc_html__( '404 Button Text', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => esc_html__('Go Back Home', 'starterpro')
				),
			)
		),
		array(
			'id'              => 'blog_setting',
			'title'           => esc_html__( 'Blog Setting', 'starterpro' ),
			'description'     => esc_html__( 'Blog Setting', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'blog_column',
					'label'    => esc_html__( 'Select Blog Column', 'starterpro' ),
					'type'     => 'select',
					'priority' => 10,
					'default'  => '12',
					'choices'  => array(
						'12' => esc_html( 'Column 1', 'starterpro' ),
						'6' => esc_html( 'Column 2', 'starterpro' ),
						'4' => esc_html( 'Column 3', 'starterpro' ),
						'3' => esc_html( 'Column 4', 'starterpro' ),
					)
				),
				array(
					'settings' => 'blog_date',
					'label'    => esc_html__( 'Enable Blog Date', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_author',
					'label'    => esc_html__( 'Enable Blog Author', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_category',
					'label'    => esc_html__( 'Enable Blog Category', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => false,
				),				
				array(
					'settings' => 'blog_hit',
					'label'    => esc_html__( 'Enable Blog Hit Count', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_comment',
					'label'    => esc_html__( 'Enable Comment', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_single_comment_en',
					'label'    => esc_html__( 'Enable Single post comment', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_tags',
					'label'    => esc_html__( 'Enable single post tags', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'post_nav_en',
					'label'    => esc_html__( 'Enable Post navigation', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_intro_en',
					'label'    => esc_html__( 'Enable post content', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_social_share',
					'label'    => esc_html__( 'Enable Social Share', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_post_text_limit',
					'label'    => esc_html__( 'Post character Limit', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => '280',
				),
				array(
					'settings' => 'blog_continue_en',
					'label'    => esc_html__( 'Enable Blog Readmore', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'blog_continue',
					'label'    => esc_html__( 'Continue Reading', 'starterpro' ),
					'type'     => 'text',
					'priority' => 10,
					'default'  => 'Read More',
				),
			)//fields
		),//blog_setting

		array(
			'id'              => 'footer_setting',
			'title'           => esc_html__( 'Footer Setting', 'starterpro' ),
			'description'     => esc_html__( 'Footer Setting', 'starterpro' ),
			'priority'        => 10,
			'fields'         => array(

				array(
					'settings' => 'footer_logo',
					'label'    => esc_html__( 'Upload Footer Logo', 'starterpro' ),
					'type'     => 'upload',
					'priority' => 10,
					'default' => get_template_directory_uri().'/images/logo.png',
				),
				array(
					'settings' => 'footer_padding_top',
					'label'    => esc_html__( 'Footer Top Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 100,
				),
				array(
					'settings' => 'footer_padding_bottom',
					'label'    => esc_html__( 'Footer Bottom Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 80,
				),				
				array(
					'settings' => 'footer_share',
					'label'    => esc_html__( 'Enable Footer Share', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_en',
					'label'    => esc_html__( 'Enable Copyright Text', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'backtop',
					'label'    => esc_html__( 'Enable Back Top Button', 'starterpro' ),
					'type'     => 'switch',
					'priority' => 10,
					'default'  => true,
				),
				array(
					'settings' => 'copyright_text_color',
					'label'    => esc_html__( 'Copyright Text Color', 'starterpro' ),
					'type'     => 'color',
					'priority' => 10,
					'default'  => '#ffffff',
				),
				array(
					'settings' => 'copyright_padding_top',
					'label'    => esc_html__( 'Copyright Top Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 40,
				),	
				array(
					'settings' => 'copyright_padding_bottom',
					'label'    => esc_html__( 'Copyright Bottom Padding', 'starterpro' ),
					'type'     => 'number',
					'priority' => 10,
					'default'  => 40,
				),					
				array(
					'settings' => 'copyright_text',
					'label'    => esc_html__( 'Copyright Text', 'starterpro' ),
					'type'     => 'textarea',
					'priority' => 10,
					'default'  => esc_html__( '© 2016 Starter Pro. All Rights Reserved.', 'starterpro' ),
				),
			)//fields
		),//footer_setting
		array(
			'id'              => 'google_map_setting',
			'title'           => esc_html__( 'Google Map', 'starterpro' ),
			'description'     => esc_html__( 'Google Map', 'starterpro' ),
			'priority'        => 10,
			// 'active_callback' => 'is_front_page',
			'fields'         => array(
				array(
					'settings' => 'google_map_api_key',
					'label'    => esc_html__( 'Google Map Api Key', 'starterpro' ),
					'subtitle'  => __('You will need to generate a Google API key to use this feature. Please visit: https://developers.google.com/fonts/docs/developer_api#Auth', 'starterpro'),
					'type'     => 'text',
					'priority' => 10,
					
				),				
			)//fields
		),//logo_setting
	),
);//starterpro_panel_options


$framework = new THM_Customize( $panel_to_section );

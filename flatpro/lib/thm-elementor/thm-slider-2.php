<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Slider extends Widget_Base {
	public function get_name() {
		return 'thm-slider';
	}

	public function get_title() {
		return __( 'Themeum Slider', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {

		$animation_ = [
				'bounce'        => 'bounce',
				'bounceIn'      => 'bounceIn',
				'bounceInDown'  => 'bounceInDown',
				'bounceInLeft'  => 'bounceInLeft',
				'bounceInRight' => 'bounceInRight',
				'bounceInUp'    => 'bounceInUp',
				'fadeIn'        => 'fadeIn',
				'fadeInDown'    => 'fadeInDown',
				'fadeInDownBig' => 'fadeInDownBig',
				'fadeInLeft'    => 'fadeInLeft',
				'fadeInLeftBig' => 'fadeInLeftBig',
				'fadeInRight'   => 'fadeInRight',
				'fadeInRightBig'=> 'fadeInRightBig',
				'fadeInUp'      => 'fadeInUp',
				'fadeInUpBig'   => 'fadeInUpBig',
				'slideInUp'     => 'slideInUp',
				'slideInDown'   => 'slideInDown',
				'slideInLeft'   => 'slideInLeft',
				'slideInRight'  => 'slideInRight',
				'zoomInDown'    => 'zoomInDown',
				'zoomInLeft'    => 'zoomInLeft',
				'zoomInRight'   => 'zoomInRight',
				'zoomInUp'      => 'zoomInUp'
			];
		$speed_ = [
				'1.25s' 	=> '1.25s',
				'.25s' 		=> '.25s',
				'.50s' 		=> '.50s',
				'.75s' 		=> '.75s',
				'1s' 		=> '1s',
				'1.25s' 	=> '1.25s',
				'1.50s' 	=> '1.50s',
				'1.75s' 	=> '1.75s',
				'2s' 		=> '2s'
			];
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Themeum Slider', 'flatpro' ),
			]
		);


		$this->add_control(
			'slider_list',
			[
				'label' 		=> __( 'Slider Items', 'flatpro' ),
				'type' 			=> Controls_Manager::REPEATER,
				'show_label'  	=> true,
				'default' 		=> [
					[
						'text' => __( 'Slider #1', 'flatpro' ),
						'icon' => 'fa fa-check',
					],	
				],
				'fields' 		=> [
					
					[	
						'name' 			=> 'slider_type',
						'label' 		=> __( 'Slider Type', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'center_text',
						'options' 		=> [
								'center_text' 	=> __( 'Center Content', 'flatpro' ),
								'center_media' 	=> __( 'Center Media', 'flatpro' ),
								'right_media' 	=> __( 'Right Media', 'flatpro' ),
								'left_media' 	=> __( 'Left Media', 'flatpro' ),
							],
					],
					[
						'name' 			=> 'slider_media',
						'label' 		=> __( 'Media Type', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'video_type',
						'options' 		=> [
								'video_type' 	=> __( 'video Type', 'flatpro' ),
								'image_type' 	=> __( 'Image Type', 'flatpro' ),
							],
					],
					[
						'name' 			=> 'slider_video',
						'label' 		=> __( 'Video URL', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
						'placeholder' 	=> __( 'Youtube/Vimeo URL', 'flatpro' ),
						'default' 		=> '',
						'condition' 	=> [
							'slider_media' 	=> [ 'video_type' ],
						],
					],
				    [
				    	'name' 			=> 'slider_image',
				        'label'         => __( 'Team Image', 'flatpro' ),
				        'type'          => Controls_Manager::MEDIA,
				        'label_block'   => true,
				        'default'       => [
				                'url' => Utils::get_placeholder_image_src(),
				            ],
				        'condition' 	=> [
							'slider_media' 	=> [ 'image_type' ],
						],
				    ],
				    [
						'name' 			=> 'media_animation',
						'label' 		=> __( 'Media Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'media_speed',
						'label' 		=> __( 'Media Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
						'name' 			=> 'slider_title',
						'label' 		=> __( 'Title', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
						'placeholder' 	=> __( 'Title', 'flatpro' ),
						'default' 		=> '',
					],
					[
						'name' 			=> 'title_animation',
						'label' 		=> __( 'Title Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'title_speed',
						'label' 		=> __( 'Title Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
						'name' 			=> 'slider_subtitle',
						'label' 		=> __( 'Sub Title', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
						'placeholder' 	=> __( 'Sub Title', 'flatpro' ),
						'default' 		=> '',
					],
					[
						'name' 			=> 'subtitle_animation',
						'label' 		=> __( 'Sub Title Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'subtitle_speed',
						'label' 		=> __( 'Sub Title Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
						'name' 			=> 'slider_content',
						'label' 		=> __( 'Sub Slider Content', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'label_block' 	=> true,
						'placeholder' 	=> __( '', 'flatpro' ),
						'default' 		=> '',
					],
					[
						'name' 			=> 'content_animation',
						'label' 		=> __( 'Content Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'content_speed',
						'label' 		=> __( 'Content Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
						'name' 			=> 'slider_button_1',
						'label' 		=> __( 'Button Text 1', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
						'placeholder' 	=> __( 'Button Text', 'flatpro' ),
						'default' 		=> '',
					],
					[
						'name' 			=> 'slider_button_link_1',
						'label' 		=> __( 'Button Link 1', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'placeholder' 	=> 'http://your-link.com',
						'default' 		=> '#'
					],
					[
						'name' 			=> 'button1_animation',
						'label' 		=> __( 'Button 1 Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'button1_speed',
						'label' 		=> __( 'Button 1 Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
						'name' 			=> 'slider_button_2',
						'label' 		=> __( 'Button Text 2', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
						'placeholder' 	=> __( 'Button Text', 'flatpro' ),
						'default' 		=> '',
					],
					[
						'name' 			=> 'slider_button_link_2',
						'label' 		=> __( 'Button Link 1', 'flatpro' ),
						'type' 			=> Controls_Manager::TEXT,
						'placeholder' 	=> 'http://your-link.com',
						'default' 		=> '#'
					],
					[
						'name' 			=> 'button2_animation',
						'label' 		=> __( 'Button 2 Animation', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'fadeInDown',
						'options' 		=> $animation_
					],
					[
						'name' 			=> 'button2_speed',
						'label' 		=> __( 'Button 2 Speed', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> '1.25s',
						'options' 		=> $speed_
					],
					[
				    	'name' 			=> 'background_image',
				        'label'         => __( 'Background Image', 'flatpro' ),
				        'type'          => Controls_Manager::MEDIA,
				        'label_block'   => true,
				        'default'       => [
				                'url' => Utils::get_placeholder_image_src(),
				            ],
				    ],
					
					[	
						'name' 			=> 'align',
						'label' 		=> __( 'Slider Type', 'flatpro' ),
						'type' 			=> Controls_Manager::SELECT,
						'default' 		=> 'left',
						'options' 		=> [
								'left' 		=> __( 'Align Left', 'flatpro' ),
								'right' 	=> __( 'Align Right', 'flatpro' ),
								'center' 	=> __( 'Align Center', 'flatpro' ),
							],
					],
					[
						'name'		=> 'gradient_color_a',
						'label' 	=> __( 'Gradient Color A', 'flatpro' ),
						'type'		=> Controls_Manager::COLOR,
						'default' 	=> '#ffffff',
					],
					[
						'name'		=> 'gradient_color_b',
						'label' 	=> __( 'Gradient Color B', 'flatpro' ),
						'type'		=> Controls_Manager::COLOR,
						'default' 	=> '#ffffff',
					],

	
					
				],
			]
		);
        $this->end_controls_section();



        # Global Section Start
        $this->start_controls_section(
			'section_style_global',
			[
				'label' 	=> __( 'Global Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'control_option',
			[
				'label' 		=> __( 'Control Option', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> '',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
			]
		);
		$this->add_control(
			'autoplay_option',
			[
				'label' 		=> __( 'Autoplay Option', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
			]
		);
		$this->add_responsive_control(
			'total_padding',
			[
				'label' 		=> __( 'Total Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-single-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
            'slide_height',
            [
                'label'         => __( 'Slide Height', 'flatpro' ),
                'type'          => Controls_Manager::NUMBER,
                'label_block'   => true,
                'default'       => 700,
               'selectors' 	=> [ '{{WRAPPER}} .slider-single-wrapper' => 'height: {{VALUE}}px;' ]
            ]
        );
		$this->end_controls_section();
		# Global Section End


        # Title Section Start
        $this->start_controls_section(
			'section_style',
			[
				'label' 	=> __( 'Title Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> __( 'Title Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} .slider-title',
			]
		);
		$this->end_controls_section();
		# Title Section End


		# Subtitle Section Start
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' 	=> __( 'Sub Title Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' 		=> __( 'Sub Title Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_control(
			'subtitle_color',
			[
				'label' 	=> __( 'Sub Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} .slider-subtitle',
			]
		);
		$this->end_controls_section();
		# Subtitle Section End


		# Content Section Start
		$this->start_controls_section(
			'section_content_style',
			[
				'label' 	=> __( 'Content Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' 		=> __( 'Content Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} .slider-content',
			]
		);
		$this->end_controls_section();
		# Content Section End




		# Button 1 Start
		$this->start_controls_section(
			'section_button_1_style',
			[
				'label' 	=> __( 'Button 1 Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'button_1_color',
			[
				'label' 	=> __( 'Button 1 Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1' => 'color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_1_hover_color',
			[
				'label' 	=> __( 'Button 1 Hover Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_1_background_color',
			[
				'label' 	=> __( 'Background Color A', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1' => 'background-color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_1_background_gradient_color',
			[
				'label' 	=> __( 'Background Color B', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1' => 'background-image:linear-gradient(180deg, {{button_1_background_color.VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_control(
			'button_1_background_hover_color',
			[
				'label' 	=> __( 'Background Hover A Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_1_background_gradient_hover_color',
			[
				'label' 	=> __( 'Background Hover B Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-1:hover' => 'background-image:linear-gradient(180deg, {{button_1_background_hover_color.VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_1_typography',
				'label' 	=> __( 'Button 1 Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} .slider-button-1',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_1_border',
				'label' 		=> __( 'Border', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .slider-button-1',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_1_hover_border',
				'label' 		=> __( 'Border Hover', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .slider-button-1:hover',
			]
		);
		$this->add_control(
			'button_1_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} a.slider-button-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_1_shadow',
				'selector' 		=> '{{WRAPPER}} .slider-button-1',
			]
		);
		$this->add_control(
			'button_1_padding',
			[
				'label' 		=> __( 'Button 1 Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-button-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
            'button_1_margin',
            [
                'label' 		=> __( 'Button Margin', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .slider-button-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
		$this->end_controls_section();
		# Button 1 End





		# Button 2 Start
		$this->start_controls_section(
			'section_button_2_style',
			[
				'label' 	=> __( 'Button 2 Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'button_2_color',
			[
				'label' 	=> __( 'Button 2 Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2' => 'color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_2_hover_color',
			[
				'label' 	=> __( 'Button 2 Hover Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_2_background_color',
			[
				'label' 	=> __( 'Background Color A', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2' => 'background-color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_2_background_gradient_color',
			[
				'label' 	=> __( 'Background Color B', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2' => 'background-image:linear-gradient(180deg, {{button_1_background_color.VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_control(
			'button_2_background_hover_color',
			[
				'label' 	=> __( 'Background Hover A Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		 $this->add_control(
			'button_2_background_gradient_hover_color',
			[
				'label' 	=> __( 'Background Hover B Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .slider-button-2:hover' => 'background-image:linear-gradient(180deg, {{button_1_background_hover_color.VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_2_typography',
				'label' 	=> __( 'Button 2 Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} .slider-button-2',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_2_border',
				'label' 		=> __( 'Border', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .slider-button-2',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_2_hover_border',
				'label' 		=> __( 'Border Hover', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .slider-button-2:hover',
			]
		);
		$this->add_control(
			'button_2_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} a.slider-button-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_2_shadow',
				'selector' 		=> '{{WRAPPER}} .slider-button-2',
			]
		);
		$this->add_control(
			'button_2_padding',
			[
				'label' 		=> __( 'Button 2 Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-button-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
            'button_2_margin',
            [
                'label' 		=> __( 'Button Margin', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .slider-button-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
		$this->end_controls_section();
		# Button 2 End

	}

	public function get_script_depends() {
	 	return [ 'jquery-slick' ];
	}

	protected function render( ) {
		$settings = $this->get_settings(); ?>
		<div class="slider_content_wrapper novisible" data-control="<?php echo $settings['control_option']; ?>" data-autoplay="<?php echo $settings['autoplay_option']; ?>">

			<?php foreach ( $settings['slider_list'] as $item ) : ?>	
				
				<?php 
				$bg = 'style="'; 
				$align = '';
				if( $item['background_image']['url'] ){
					$bg .= ' background-image: url('.$item["background_image"]["url"].') ';
				}
				if( $item['gradient_color_a'] && $item['gradient_color_b'] ){
					if( $item['background_image']['url'] ){
						$bg .= ', linear-gradient( '.$item["gradient_color_a"].' , '.$item["gradient_color_b"].' );';
					}else{
						$bg .= 'background-image: linear-gradient( '.$item["gradient_color_a"].' 0%, '.$item["gradient_color_b"].' 100%);';
					}
				}else{
					if( $item['gradient_color_a'] ){
						$bg .= 'background-color: '.$item["gradient_color_a"].';';
					}else{
						$bg .= ';';
					}
				}
				$bg .= '"';


				if( $item['align'] ){ $align = 'text-'.$item["align"]; }
				?>
				<div class="slider-single-wrapper" <?php echo $bg; ?>>
				<div class="container">
				<div class="row">
					


					
					<?php if( $item['slider_type'] == 'center_text' ): ?>
					
						<div class="col-12 center_text <?php echo $align; ?>">
							<?php if( $item['slider_media'] == 'video_type' ): ?>
								<?php if($item['slider_video']): ?>
									<div class="slider-media animated" data-animation="<?php echo $item['media_animation']; ?>" data-speed="<?php echo $item['media_speed']; ?>">
										<?php if (strpos( $item['slider_video'], 'vimeo') !== false) { ?>
										    <a class="popup-vimeo slide-popup-media" href="<?php echo $item['slider_video']; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
										<?php } else { ?>
											<a class="popup-youtube slide-popup-media" href="<?php echo $item['slider_video']; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
										<?php } ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
							<?php if( $item['slider_subtitle'] ): ?><div class="slider-subtitle animated" data-animation="<?php echo $item['subtitle_animation']; ?>" data-speed="<?php echo $item['subtitle_speed']; ?>"><?php echo $item['slider_subtitle']; ?></div><?php endif; ?>
							<?php if( $item['slider_title'] ): ?><div class="slider-title animated" data-animation="<?php echo $item['title_animation']; ?>" data-speed="<?php echo $item['title_speed']; ?>"><?php echo $item['slider_title']; ?></div><?php endif; ?>
							<?php if( $item['slider_content'] ): ?><div class="slider-content animated" data-animation="<?php echo $item['content_animation']; ?>" data-speed="<?php echo $item['content_speed']; ?>"><?php echo $item['slider_content']; ?></div><?php endif; ?>
							<?php if( $item['slider_button_1'] || $item['slider_button_2'] ): ?>
								<div class="slider-button">
									<?php if( $item['slider_button_1'] ): ?><a class="d-inline-block slider-button-1 animated" data-animation="<?php echo $item['button1_animation']; ?>" data-speed="<?php echo $item['button1_speed']; ?>" href="<?php echo $item['slider_button_link_1']; ?>"><?php echo $item['slider_button_1']; ?></a><?php endif; ?>
									<?php if( $item['slider_button_2'] ): ?><a class="d-inline-block slider-button-2 animated" data-animation="<?php echo $item['button2_animation']; ?>" data-speed="<?php echo $item['button2_speed']; ?>" href="<?php echo $item['slider_button_link_2']; ?>"><?php echo $item['slider_button_2']; ?></a><?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>



					<?php if( $item['slider_type'] == 'center_media' ): ?>
						<div class="col-4 center_media <?php echo $align; ?>">
							<?php if( $item['slider_subtitle'] ): ?><div class="slider-subtitle animated" data-animation="<?php echo $item['subtitle_animation']; ?>" data-speed="<?php echo $item['subtitle_speed']; ?>"><?php echo $item['slider_subtitle']; ?></div><?php endif; ?>
							<?php if( $item['slider_title'] ): ?><div class="slider-title animated" data-animation="<?php echo $item['title_animation']; ?>" data-speed="<?php echo $item['title_speed']; ?>"><?php echo $item['slider_title']; ?></div><?php endif; ?>
						</div>
						<div class="col-4 text-center <?php echo $align; ?>">
						<?php if( $item['slider_media'] ): ?>
							
							<?php if( $item['slider_media'] == 'video_type' ): ?>
								<?php if (strpos( $item['slider_video'], 'vimeo') !== false) { ?>
									<a class="popup-vimeo slide-popup-media slider-media animated" data-animation="<?php echo $item['media_animation']; ?>" data-speed="<?php echo $item['media_speed']; ?>" href="<?php echo $item['slider_video']; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
								<?php } else { ?>
									<a class="popup-youtube slide-popup-media slider-media animated" data-animation="<?php echo $item['media_animation']; ?>" data-speed="<?php echo $item['media_speed']; ?>" href="<?php echo $item['slider_video']; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
								<?php } ?>
							<?php endif; ?>
						<?php endif; ?>
						</div>
						<div class="col-4 <?php echo $align; ?>">
							<?php if( $item['slider_content'] ): ?><div class="slider-content animated" data-animation="<?php echo $item['content_animation']; ?>" data-speed="<?php echo $item['content_speed']; ?>"><?php echo $item['slider_content']; ?></div><?php endif; ?>
						</div>
						<?php if( $item['slider_button_1'] || $item['slider_button_2'] ): ?>
							<div class="slider-button btn-media-slider text-center col-12">
								<?php if( $item['slider_button_1'] ): ?><a class="d-inline-block slider-button-1 animated" data-animation="<?php echo $item['button1_animation']; ?>" data-speed="<?php echo $item['button1_speed']; ?>" href="<?php echo $item['slider_button_link_1']; ?>"><?php echo $item['slider_button_1']; ?></a><?php endif; ?>
								<?php if( $item['slider_button_2'] ): ?><a class="d-inline-block slider-button-2 animated" data-animation="<?php echo $item['button2_animation']; ?>" data-speed="<?php echo $item['button2_speed']; ?>" href="<?php echo $item['slider_button_link_2']; ?>"><?php echo $item['slider_button_2']; ?></a><?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>



					<?php if( $item['slider_type'] == 'right_media' ): ?>
						<div class="col-sm-12 col-md-12 col-lg-6 right_media <?php echo $align; ?>">
							<?php if( $item['slider_subtitle'] ): ?><div class="slider-subtitle animated" data-animation="<?php echo $item['subtitle_animation']; ?>" data-speed="<?php echo $item['subtitle_speed']; ?>"><?php echo $item['slider_subtitle']; ?></div><?php endif; ?>
							<?php if( $item['slider_title'] ): ?><div class="slider-title animated" data-animation="<?php echo $item['title_animation']; ?>" data-speed="<?php echo $item['title_speed']; ?>"><?php echo $item['slider_title']; ?></div><?php endif; ?>
							<?php if( $item['slider_content'] ): ?><div class="slider-content animated" data-animation="<?php echo $item['content_animation']; ?>" data-speed="<?php echo $item['content_speed']; ?>"><?php echo $item['slider_content']; ?></div><?php endif; ?>
							<?php if( $item['slider_button_1'] || $item['slider_button_2'] ): ?>
								<div class="slider-button">
									<?php if( $item['slider_button_1'] ): ?><a class="d-inline-block slider-button-1 animated" data-animation="<?php echo $item['button1_animation']; ?>" data-speed="<?php echo $item['button1_speed']; ?>" href="<?php echo $item['slider_button_link_1']; ?>"><?php echo $item['slider_button_1']; ?></a><?php endif; ?>
									<?php if( $item['slider_button_2'] ): ?><a class="d-inline-block slider-button-2 animated" data-animation="<?php echo $item['button2_animation']; ?>" data-speed="<?php echo $item['button2_speed']; ?>" href="<?php echo $item['slider_button_link_2']; ?>"><?php echo $item['slider_button_2']; ?></a><?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6 slide-video-right <?php echo $align; ?>">
							<div class="slider-media animated" data-animation="<?php echo $item['media_animation']; ?>" data-speed="<?php echo $item['media_speed']; ?>">
								<?php if( $item['slider_media'] ): ?>
									<?php if( $item['slider_media'] == 'video_type' ): ?>
										<?php if( $item['slider_video'] ): ?>
											<div class="embed-responsive embed-responsive-16by9"><?php echo wp_oembed_get( $item['slider_video'], array('width'=>600) ); ?></div>
										<?php endif; ?>
									<?php endif; ?>
									<?php if( $item['slider_media'] == 'image_type' ): ?>
										<?php if( $item['slider_image'] ): ?>
											<img src="<?php echo $item['slider_image']['url']; ?>" class="img-fluid">
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>



					<?php if( $item['slider_type'] == 'left_media' ): ?>
						<div class="col-sm-12 col-md-12 col-lg-6 slide-video-left <?php echo $align; ?>">
							<div class="slider-media animated" data-animation="<?php echo $item['media_animation']; ?>" data-speed="<?php echo $item['media_speed']; ?>">
								<?php if( $item['slider_media'] ): ?>
									<?php if( $item['slider_media'] == 'video_type' ): ?>
										<?php if( $item['slider_video'] ): ?>
											<div class="embed-responsive embed-responsive-16by9"><?php echo wp_oembed_get( $item['slider_video'] , array('width'=>600) ); ?></div>
										<?php endif; ?>
									<?php endif; ?>
									<?php if( $item['slider_media'] == 'image_type' ): ?>
										<?php if( $item['slider_image'] ): ?>
											<img src="<?php echo $item['slider_image']['url']; ?>" class="img-fluid">
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6 <?php echo $align; ?>">
							<?php if( $item['slider_subtitle'] ): ?><div class="slider-subtitle animated" data-animation="<?php echo $item['subtitle_animation']; ?>" data-speed="<?php echo $item['subtitle_speed']; ?>"><?php echo $item['slider_subtitle']; ?></div><?php endif; ?>
							<?php if( $item['slider_title'] ): ?><div class="slider-title animated" data-animation="<?php echo $item['title_animation']; ?>" data-speed="<?php echo $item['title_speed']; ?>"><?php echo $item['slider_title']; ?></div><?php endif; ?>
							<?php if( $item['slider_content'] ): ?><div class="slider-content animated" data-animation="<?php echo $item['content_animation']; ?>" data-speed="<?php echo $item['content_speed']; ?>"><?php echo $item['slider_content']; ?></div><?php endif; ?>
							<?php if( $item['slider_button_1'] || $item['slider_button_2'] ): ?>
								<div class="slider-button">
									<?php if( $item['slider_button_1'] ): ?><a class="d-inline-block slider-button-1 animated" data-animation="<?php echo $item['button1_animation']; ?>" data-speed="<?php echo $item['button1_speed']; ?>" href="<?php echo $item['slider_button_link_1']; ?>"><?php echo $item['slider_button_1']; ?></a><?php endif; ?>
									<?php if( $item['slider_button_2'] ): ?><a class="d-inline-block slider-button-2 animated" data-animation="<?php echo $item['button2_animation']; ?>" data-speed="<?php echo $item['button2_speed']; ?>" href="<?php echo $item['slider_button_link_2']; ?>"><?php echo $item['slider_button_2']; ?></a><?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					
				</div>
				</div>
				</div>
			<?php endforeach; ?>

		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){'use strict';
				$('.slider_content_wrapper').css( 'visibility','visible' );
			});
		</script>
	<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Slider() );


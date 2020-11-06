<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Feature_Box extends Widget_Base {

	public function get_name() {
		return 'feature-box';
	}

	public function get_title() {
		return __( 'Themeum Feature Box', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		
		
		
		# Main Option Start
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Feature Box', 'winkel' ),
			]
		);
		$this->add_control(
			'view',
			[
				'label' 		=> __( 'View', 'winkel' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
						'default' 		=> __( 'Default', 'winkel' ),
						'stacked' 		=> __( 'Stacked', 'winkel' ),
						'framed' 		=> __( 'Framed', 'winkel' ),
						'title_icon' 	=> __( 'Title With Icon', 'winkel' ),
						],
				'default' 		=> 'default',
				'prefix_class' 	=> 'elementor-view-',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Choose Icon', 'winkel' ),
				'type' 			=> Controls_Manager::ICON,
				'default' 		=> 'fa fa-star',
			]
		);
		$this->add_control(
			'shape',
			[
				'label' 		=> __( 'Shape', 'winkel' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
							'circle' 	=> __( 'Circle', 'winkel' ),
							'square' 	=> __( 'Square', 'winkel' ),
							],
				'default' 		=> 'circle',
				'condition' 	=> [
							'view!' 	=> 'default',
						],
				'prefix_class' 	=> 'elementor-shape-',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' 		=> __( 'Title & Description', 'winkel' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'This is the heading', 'winkel' ),
				'placeholder' 	=> __( 'Your Title', 'winkel' ),
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'description_text',
			[
				'label' 		=> '',
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'winkel' ),
				'placeholder' 	=> __( 'Your Description', 'winkel' ),
				'title'			=> __( 'Input icon text here', 'winkel' ),
				'rows' 			=> 10,
				'separator' 	=> 'none',
				'show_label' 	=> false,
			]
		);
		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link to', 'winkel' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'http://your-link.com', 'winkel' ),
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' 	=> __( 'Title HTML Tag', 'winkel' ),
				'type' 		=> Controls_Manager::SELECT,
				'options'	=> [
							'h1' 	=> __( 'H1', 'winkel' ),
							'h2' 	=> __( 'H2', 'winkel' ),
							'h3' 	=> __( 'H3', 'winkel' ),
							'h4' 	=> __( 'H4', 'winkel' ),
							'h5' 	=> __( 'H5', 'winkel' ),
							'h6' 	=> __( 'H6', 'winkel' ),
							'div' 	=> __( 'div', 'winkel' ),
							'span' 	=> __( 'span', 'winkel' ),
							'p' 	=> __( 'p', 'winkel' ),
						],
				'default' 	=> 'h3',
			]
		);
		$this->end_controls_section();
		# Main Option End




		# Style Icon Start
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' 	=> __( 'Icon', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'primary_color',
			[
				'label' 	=> __( 'Primary Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
							'type' 		=> Scheme_Color::get_type(),
							'value' 	=> Scheme_Color::COLOR_1,
						],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon,{{WRAPPER}}.elementor-view-title_icon .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}; transition: all 0.1s;',
				],
			]
		);
		$this->add_control(
			'secondary_color',
			[
				'label' 		=> __( 'Secondary Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
									'view!' => 'default',
								],
				'selectors' 	=> [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_space',
			[
				'label' 		=> __( 'Spacing', 'winkel' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
							'size' => 15,
						],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' 	=> 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' 	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'winkel' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'icon_padding',
            [
                'label' 		=> __( 'Icon Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'winkel' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'borders_width',
			[
				'label' => __( 'Border Width', 'winkel' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'winkel' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);
		$this->end_controls_section();
		# Style Icon End




		# Style Icon Hover Start
		$this->start_controls_section(
			'section_hover',
			[
				'label' => __( 'Icon Hover', 'winkel' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-view-framed .elementor-icon, 
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-view-default .elementor-icon,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' 	=> __( 'Animation', 'winkel' ),
				'type' 		=> Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_section();
		# Style Icon Hover End





		# Style Content Start
		$this->start_controls_section(
			'section_style_content',
			[
				'label' 	=> __( 'Content', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' 	=> __( 'Alignment', 'winkel' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 	=> [
						'title' 	=> __( 'Left', 'winkel' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' => [
						'title' 	=> __( 'Center', 'winkel' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' => [
						'title' 	=> __( 'Right', 'winkel' ),
						'icon' 		=> 'fa fa-align-right',
					],
					'justify' => [
						'title' 	=> __( 'Justified', 'winkel' ),
						'icon' 		=> 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_vertical_alignment',
			[
				'label' 		=> __( 'Vertical Alignment', 'winkel' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' => [
					'top' 		=> __( 'Top', 'winkel' ),
					'middle' 	=> __( 'Middle', 'winkel' ),
					'bottom' 	=> __( 'Bottom', 'winkel' ),
				],
				'default' 		=> 'top',
				'prefix_class' 	=> 'elementor-vertical-align-',
			]
		);
		$this->add_control(
			'heading_title',
			[
				'label' 		=> __( 'Title', 'winkel' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'winkel' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);
		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' 		=> __( 'Spacing', 'winkel' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' 		=> __( 'Title Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-title:hover,
					{{WRAPPER}} .elementor-icon-box-title a:hover,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-title,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-title a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .elementor-icon-box-title',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'heading_description',
			[
				'label' 		=> __( 'Description', 'winkel' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __( 'Description Margin', 'winkel' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_control(
			'description_hover_color',
			[
				'label' 		=> __( 'Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-description:hover,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'selector' 		=> '{{WRAPPER}} .elementor-icon-box-description',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->end_controls_section();
		# Style Content End





		# Style Body Start
		$this->start_controls_section(
			'section_body_content',
			[
				'label' 		=> __( 'Total Body', 'winkel' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'total_padding',
            [
                'label' 		=> __( 'Total Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'total_hover_color',
			[
				'label' 		=> __( 'Total Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-widget-container:hover .elementor-icon,
					{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-description,
					{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-title a,
					{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' 		=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_control(
			'total_bg_color',
			[
				'label' 		=> __( 'Total BG Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#ffffff',
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'background-color: {{VALUE}};',
				],
				'scheme' 		=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_control(
			'total_bg_color_hover',
			[
				'label' 		=> __( 'Total BG Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover' => 'background-color: {{VALUE}};',
				],
				'scheme' 		=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[	
				'name' 			=> 'border',
				'label' 		=> __( 'Border', 'winkel' ),
				'selector' 		=> '{{WRAPPER}} .elementor-icon-box-wrapper',
			]
		);
		$this->add_control(
            'total_border',
            [
                'label' 		=> __( 'Border Width', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'total_border_hover_color',
			[
				'label' 		=> __( 'Border Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover' => 'border-color: {{VALUE}};',
				],
				'scheme' 		=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_3,
				],
			]
		);
		$this->add_control(
			'body_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'winkel' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		# Style Body End




	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'i', 'class', $settings['icon'] );

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );
		?>
		<div class="elementor-icon-box-wrapper">
			<div class="elementor-icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
					<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				</<?php echo $icon_tag; ?>>
				<?php if(  $settings['view'] == 'title_icon' ){ ?>
					<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
						<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
					</<?php echo $settings['title_size']; ?>>
				 <?php } ?>
			</div>
			<div class="elementor-icon-box-content">
				<?php if(  $settings['view'] != 'title_icon' ){ ?>
					<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
						<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
					</<?php echo $settings['title_size']; ?>>
				<?php } ?>
				<p class="elementor-icon-box-description"><?php echo $settings['description_text']; ?></p>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<# var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
				iconTag = link ? 'a' : 'span'; #>
		<div class="elementor-icon-box-wrapper">
			<div class="elementor-icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
					<i class="{{ settings.icon }}"></i>
				</{{{ iconTag }}}>
			</div>
			<div class="elementor-icon-box-content">
				<{{{ settings.title_size }}} class="elementor-icon-box-title">
					<{{{ iconTag + ' ' + link }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<p class="elementor-icon-box-description">{{{ settings.description_text }}}</p>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Feature_Box() );
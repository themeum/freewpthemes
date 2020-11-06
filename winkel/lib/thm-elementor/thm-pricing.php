<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Pricing_table extends Widget_Base {

	public function get_name() {
		return 'pricing-table';
	}

	public function get_title() {
		return __( 'Themeum Pricing Table', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {



		# Main Option Start
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Pricing Table', 'winkel' ),
			]
		);
		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Layout', 'winkel' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'layout_1' 		=> __( 'Layout 1', 'winkel' ),
					'layout_2' 		=> __( 'Layout 2', 'winkel' ),
				],
				'default'		=> 'layout_1',
				'prefix_class' 	=> 'elementor-view-',
			]
		);
		$this->add_control(
			'price',
			[
				'label' 		=> __( 'Price', 'winkel' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder' 	=> __( '$25', 'winkel' ),
			]
		);
		$this->add_control(
			'duration',
			[
				'label' 		=> __( 'Duration', 'winkel' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder' 	=> __( '1 Month', 'winkel' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' 		=> __( 'Title', 'winkel' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Title of the Pricing Table', 'winkel' ),
				'placeholder' 	=> __( 'Title', 'winkel' ),
			]
		);
		$this->add_control(
			'description',
			[
				'label' 		=> 'Content',
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> '',
				'placeholder' 	=> __( 'Your Description', 'winkel' ),
				'rows' 			=> 10,
				'separator' 	=> 'none',
				'show_label' 	=> false,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'winkel' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Click Here', 'winkel' ),
				'placeholder' 	=> __( 'Title', 'winkel' ),
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'position',
			[
				'label' 	=> __( 'Icon Position', 'winkel' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'default' 	=> 'center',
				'options' 	=> [
					'left' => [
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
				],
				'toggle' 			=> false,
				'selectors' => [
					'{{WRAPPER}} .inner-pricing-table' => 'text-align: {{VALUE}};'
				],
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
		$this->end_controls_section();
		# Main Option End






		# Global Style Option Start
		$this->start_controls_section(
			'section_global_style',
			[
				'label' 	=> __( 'Global Style', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' 	=> __( 'Background Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'background_hover_color',
			[
				'label' 	=> __( 'Background Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_bg_color',
			[
				'label' 	=> __( 'Feature Background Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
            'background_padding',
            [
                'label' 		=> __( 'Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'background_border_radius',
			[
				'label' => __( 'Border Radius', 'winkel' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'background_all_hover',
			[
				'label' 		=> __( 'Section Hover Color', 'winkel' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'label_on' 		=> __( 'Yes', 'winkel' ),
				'label_off' 	=> __( 'No', 'winkel' ),
				'selectors' 	=> [
					'{{WRAPPER}} .pricing-table:hover .pricing-table-title,
					{{WRAPPER}} .pricing-table-content:hover .pricing-table-title' => 'width: 100%;',
				],
				
			]
		);
		$this->add_control(
			'all_title_hover',
			[
				'label' 	=> __( 'Title Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table:hover .pricing-table-title' => 'color: {{VALUE}};'
				],
				'condition' => [
					'background_all_hover' => 'yes',
				],
			]
		);
		$this->add_control(
			'all_description_hover',
			[
				'label' 	=> __( 'Description Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table:hover .pricing-table-content' => 'color: {{VALUE}};'
				],
				'condition' => [
					'background_all_hover' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		# Global Style Option End






		# Title Style Option Start
		$this->start_controls_section(
			'section_style_title',
			[
				'label' 	=> __( 'Title Style', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Title Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'hover_color',
			[
				'label' 	=> __( 'Title Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-title:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pricing-table-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_responsive_control(
            'title_padding',
            [
                'label' 		=> __( 'Title Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .pricing-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		# Title Style Option End




		# Price Style Option Start
		$this->start_controls_section(
			'section_style_price',
			[
				'label' 	=> __( 'Price Style', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' 	=> __( 'Price Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price .price-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'price_hover_color',
			[
				'label' 	=> __( 'Price Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price .price-title:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .pricing-table-price .price-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_responsive_control(
            'price_padding',
            [
                'label' 		=> __( 'Price Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .pricing-table-price .price-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		# Price Style Option End






		# Duration Style Option Start
		$this->start_controls_section(
			'section_style_duration',
			[
				'label' 	=> __( 'Duration Style', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'duration_color',
			[
				'label' 	=> __( 'Duration Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price .price-duration' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'duration_hover_color',
			[
				'label' 	=> __( 'Duration Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price .price-duration:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'duration_typography',
				'selector' => '{{WRAPPER}} .pricing-table-price .price-duration',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_responsive_control(
            'duration_padding',
            [
                'label' 		=> __( 'Duration Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .pricing-table-price .price-duration' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		# Price Style Option End






		# Content Style Option Start
		$this->start_controls_section(
			'section_style_content',
			[
				'label' 	=> __( 'Content Style', 'winkel' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_1,
				],
				'default' 	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-content' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_hover_color',
			[
				'label' 	=> __( 'Content Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-content:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .pricing-table-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_responsive_control(
            'content_padding',
            [
                'label' 		=> __( 'Content Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .pricing-table-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		# Title Style Option End





		# Button Option Start
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button Style', 'winkel' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __( 'Typography', 'winkel' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.pricing-btn',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'winkel' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'background_colors',
			[
				'label' => __( 'Background Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'winkel' ),
			]
		);
		$this->add_control(
			'hover_colors',
			[
				'label' => __( 'Text Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'winkel' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Animation', 'winkel' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'winkel' ),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .pricing-btn',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'winkel' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .pricing-btn',
			]
		);
		$this->add_control(
			'text_padding',
			[
				'label' => __( 'Text Padding', 'winkel' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		# Button Option End







	}

	protected function render() {
		
		$settings = $this->get_settings();
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}
		$link_attributes = $this->get_render_attribute_string( 'link' );
		
		?>





		<div class="pricing-table">
			

			<?php if(  $settings['layout'] == 'layout_1' ){ ?>
				<div class="inner-pricing-table">
					<?php if(  $settings['title'] ){ ?><h3 class="pricing-table-title"><?php echo $settings['title']; ?></h3><?php } ?>
					<span class="pricing-table-price">
						<?php if(  $settings['price'] ){ ?><div class="price-title"><?php echo $settings['price']; ?></div><?php } ?>
						<?php if(  $settings['duration'] ){ ?><div class="price-duration"><?php echo $settings['duration']; ?></div><?php } ?>
					</span>
					<?php if(  $settings['description'] ){ ?><div class="pricing-table-content"><?php echo $settings['description']; ?></div><?php } ?>
					<?php if(  $settings['button_text'] ){ ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?> class="btn pricing-btn"><?php echo $settings['button_text']; ?></a><?php } ?>
				</div>
			<?php } ?>


			<?php if(  $settings['layout'] == 'layout_2' ){ ?>
				<div class="inner-pricing-table layout2">
					<?php if(  $settings['title'] ){ ?><h3 class="pricing-table-title"><?php echo $settings['title']; ?></h3><?php } ?>
					<span class="pricing-table-price">
						<?php if(  $settings['price'] ){ ?><div class="price-title"><?php echo $settings['price']; ?></div><?php } ?>
						<?php if(  $settings['duration'] ){ ?><div class="price-duration"><?php echo $settings['duration']; ?></div><?php } ?>
					</span>
					<?php if(  $settings['description'] ){ ?><div class="pricing-table-content"><?php echo $settings['description']; ?></div><?php } ?>
					<?php if(  $settings['button_text'] ){ ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?> class="btn pricing-btn"><?php echo $settings['button_text']; ?></a><?php } ?>
				</div>
			<?php } ?>


		</div>

		<?php
	}

	
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Pricing_table() );
<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Button extends Widget_Base {

	public function get_name() {
		return 'themeum-button';
	}

	public function get_title() {
		return __( 'Themeum Button', 'flatpro' );
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'flatpro' ),
			'sm' => __( 'Small', 'flatpro' ),
			'md' => __( 'Medium', 'flatpro' ),
			'lg' => __( 'Large', 'flatpro' ),
			'xl' => __( 'Extra Large', 'flatpro' ),
		];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __( 'Button', 'flatpro' ),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' 		=> __( 'Type', 'flatpro' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> __( 'Default', 'flatpro' ),
					'info' 		=> __( 'Info', 'flatpro' ),
					'success' 	=> __( 'Success', 'flatpro' ),
					'warning' 	=> __( 'Warning', 'flatpro' ),
					'danger' 	=> __( 'Danger', 'flatpro' ),
				],
				'prefix_class' 	=> 'elementor-button-',
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __( 'Text', 'flatpro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Click me', 'flatpro' ),
				'placeholder' 	=> __( 'Click me', 'flatpro' ),
				'dynamic' 		=> [],
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'flatpro' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> 'http://your-link.com',
				'default' 		=> [ 'url' => '#' ],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __( 'Alignment', 'flatpro' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    	=> [
						'title' => __( 'Left', 'flatpro' ),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'flatpro' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'flatpro' ),
						'icon' 	=> 'fa fa-align-right',
					],
					'justify' 	=> [
						'title' => __( 'Justified', 'flatpro' ),
						'icon' 	=> 'fa fa-align-justify',
					],
				],
				'prefix_class' 	=> 'elementor%s-align-',
				'default' 		=> '',
			]
		);

		$this->add_control(
			'size',
			[
				'label' 		=> __( 'Size', 'flatpro' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'sm',
				'options' 		=> self::get_button_sizes(),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'flatpro' ),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 	=> __( 'Icon Position', 'flatpro' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'left',
				'options' 	=> [
					'left' 	=> __( 'Before', 'flatpro' ),
					'right' => __( 'After', 'flatpro' ),
				],
				'condition' => [ 'icon!' => '' ],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' 	=> __( 'Icon Spacing', 'flatpro' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'max' => 50,
					],
				],
				'condition' => [ 'icon!' => '' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' 	=> __( 'View', 'flatpro' ),
				'type' 		=> Controls_Manager::HIDDEN,
				'default' 	=> 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 	=> __( 'Button', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'label' 	=> __( 'Typography', 'flatpro' ),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 	=> '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' 	=> __( 'Normal', 'flatpro' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 	=> __( 'Text Color', 'flatpro' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [ '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'button_color_type',
			[
				'label' 		=> __( 'Type', 'flatpro' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'solid',
				'options' 		=> [
					'solid' 	=> __( 'Solid Color', 'flatpro' ),
					'gradient' 	=> __( 'Gradient Color', 'flatpro' ),
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' 	=> __( 'Background Color', 'flatpro' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 	=> Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [ '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'background_color_b',
			[
				'label' 	=> __( 'Background Color', 'flatpro' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 	=> Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [ '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-image:linear-gradient(180deg, {{background_color.VALUE}} 0%, {{VALUE}} 100%);',],
				'condition' => [ 'button_color_type' => [ 'gradient' ] ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' 		=> __( 'Hover', 'flatpro' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' 		=> __( 'Text Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [ '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'button_color_type_hover',
			[
				'label' 		=> __( 'Type', 'flatpro' ),
				'type' 			=> Controls_Manager::SELECT,
				'default'		=> 'solid',
				'options' 		=> [
					'solid' 	=> __( 'Solid Color', 'flatpro' ),
					'gradient' 	=> __( 'Gradient Color', 'flatpro' ),
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> __( 'Background Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [ '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'background_color_b_hover',
			[
				'label' 		=> __( 'Background Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
					'type' 		=> Scheme_Color::get_type(),
					'value' 	=> Scheme_Color::COLOR_4,
				],
				'selectors' 	=> [ '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-image:linear-gradient(180deg, {{button_background_hover_color.VALUE}} 0%, {{VALUE}} 100%);' ],
				'condition' 	=> [ 'button_color_type_hover' => [ 'gradient' ] ],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [ 'border_border!' => '' ],
				'selectors' 	=> [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' 		=> __( 'Animation', 'flatpro' ),
				'type' 			=> Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __( 'Border', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .elementor-button',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .elementor-button',
			]
		);
		$this->add_control(
			'text_padding',
			[
				'label' 		=> __( 'Text Padding', 'flatpro' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text() ?>
			</a>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-{{ settings.size }} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}">
				<span class="elementor-button-content-wrapper">
					<# if ( settings.icon ) { #>
					<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
						<i class="{{ settings.icon }}"></i>
					</span>
					<# } #>
					<span class="elementor-button-text">{{{ settings.text }}}</span>
				</span>
			</a>
		</div>
		<?php
	}

	protected function render_text() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align'] );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-button-icon' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>
			</span>
			<?php endif; ?>
			<span class="elementor-button-text"><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Button() );

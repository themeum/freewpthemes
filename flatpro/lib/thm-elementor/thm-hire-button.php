<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

function flatpro_hire_contact_form(){
	$contact_forms = array();
    $contact_forms = get_all_posts('wpcf7_contact_form');
    $contact_forms['Select'] = 'Select'; 
    return $contact_forms;
}

class Widget_Themeum_Hire_Button extends Widget_Base {

	public function get_name() {
		return 'themeum-hire-button';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	public function get_title() {
		return __( 'Themeum Hire Button', 'flatpro' );
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
			'section_hire_button',
			[
				'label' => __( 'Hire Button', 'flatpro' ),
			]
		);

		$this->add_control(
			'contact_button',
			[
				'label' 		=> __( 'Contact Form', 'flatpro' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options'		=> flatpro_hire_contact_form(),
				'prefix_class' 	=> 'elementor-button-',
			]
		);

		$this->add_control(
			'hire_button_name',
			[
				'label' 		=> __( 'Button Name', 'flatpro' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Hire me', 'flatpro' ),
				'placeholder' 	=> __( 'Hire Me', 'flatpro' ),
				'dynamic' 		=> [],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' 		=> __( 'Alignment', 'flatpro' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    		=> [
						'title' 	=> __( 'Left', 'flatpro' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' 		=> [
						'title' 	=> __( 'Center', 'flatpro' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' 		=> [
						'title' 	=> __( 'Right', 'flatpro' ),
						'icon' 		=> 'fa fa-align-right',
					],
					'justify' 		=> [
						'title' 	=> __( 'Justified', 'flatpro' ),
						'icon' 		=> 'fa fa-align-justify',
					],
				],
				'prefix_class' 		=> 'elementor%s-align-',
				'default' 			=> '',
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
			'view',
			[
				'label' 		=> __( 'View', 'flatpro' ),
				'type' 			=> Controls_Manager::HIDDEN,
				'default' 		=> 'traditional',
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
				'selector' 	=> '{{WRAPPER}} .contactform_hire_button .hire-btn, {{WRAPPER}} .elementor-button',
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
				'label' 			=> __( 'Text Color', 'flatpro' ),
				'type' 				=> Controls_Manager::COLOR,
				'default' 			=> '',
				'selectors' 		=> [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' 			=> __( 'Background Color', 'flatpro' ),
				'type' 				=> Controls_Manager::COLOR,
				'scheme' 			=> [
										'type' 		=> Scheme_Color::get_type(),
										'value' 	=> Scheme_Color::COLOR_4,
									],
				'selectors' 		=> [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .contactform_hire_button .hire-btn' => 'background-color: {{VALUE}};',
				],
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
				'selectors' 	=> [
									'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
								],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> __( 'Background Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
									'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
								],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'flatpro' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
									'border_border!' => '',
								],
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
				'label' 			=> __( 'Border Radius', 'flatpro' ),
				'type' 				=> Controls_Manager::DIMENSIONS,
				'size_units' 		=> [ 'px', '%' ],
				'selectors' 		=> [
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
				'label' 			=> __( 'Text Padding', 'flatpro' ),
				'type' 				=> Controls_Manager::DIMENSIONS,
				'size_units' 		=> [ 'px', 'em', '%' ],
				'selectors' 		=> [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 		=> 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$contact_buttons = $settings['contact_button'];
		$btn_name = $settings['hire_button_name'];

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button' ); ?>
		
		<div class="contactform_hire_button">	
			<a class="hire-btn btn-contact elementor-button elementor-size-<?php echo $settings['size']; ?>" data-toggle="modal" data-target="#myModal" href="#"><?php echo $btn_name; ?></a>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title"><?php _e( 'Hire for your next project','flatpro' ); ?></h4>
		                    <?php if ($contact_buttons) { echo do_shortcode( '[contact-form-7 id="'.$contact_buttons.'"]' ); } ?>
		                </div> <!-- modal-header -->
		            </div> <!-- modal-content -->
		        </div> <!-- modal-dialog -->
		    </div> <!-- modal -->
		</div> <!-- contactform_hire_button -->

	<?php }

	protected function _content_template() { ?>
		<#
			var button_name = settings.hire_button_name;	
			button_name = '<a class="hire-btn btn-contact elementor-button elementor-size-' + settings.size + '" data-toggle="modal" data-target="#myModal" href="#">' + button_name + '</a>';	
			var button_html = '<div class="contactform_hire_button">' + button_name + '</div>';
			print( button_html );
		#>
	<?php
	}
	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Hire_Button() );
<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Title extends Widget_Base {
	public function get_name() {
		return 'thm-title';
	}

	public function get_title() {
		return __( 'Themeum Title', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-menu wts-eae-pe';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
            'section_title',
            [
                'label' 		=> __( 'Title Element', 'flatpro' )
            ]
        );

        $this->add_control(
            'title_txt',
            [
                'label' 		=> __( 'Title', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter title', 'flatpro' ),
                'default' 		=> __( 'This is heading', 'flatpro' ),
            ]
        );
        $this->add_control(
            'subtitle_content',
            [
                'label' 		=> __( 'Sub Title Content', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Sub Title', 'flatpro' ),
                'default' 		=> __( 'Write your sub title content of this section.', 'flatpro' ),
            ]
        );         
        $this->add_control(
            'title_link',
            [
                'label' 		=> __( 'Link', 'flatpro' ),
                'type'			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'default' 		=> '',
            ]
        );

        $this->add_responsive_control(
			'align',
			[
				'label' 	=> __( 'Alignment', 'flatpro' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
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
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
            'total_id',
            [
                'label' 		=> __( 'Add ID', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'default' 		=> '',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __( 'Title', 'flatpro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_border',
			[
				'label' 		=> __( 'Background Border', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
				'selectors' 	=> [
					'{{WRAPPER}} h2.bordered:before' => 'width: 100%;',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label'			=> __( 'Background Color', 'flatpro' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} h2.bordered span' => 'background: {{VALUE}};' ],
				'condition' 	=> [ 'title_border' => 'yes' ],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'image_border',
                'label' 		=> __( 'Background Border', 'flatpro' ),
                'selector' 		=> '{{WRAPPER}} h2.bordered:before',
                'condition' 	=> [ 'title_border' => 'yes' ],
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label'			=> __( 'Text Color', 'flatpro' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
            'text_padding',
            [
                'label' 		=> __( 'Title Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label' 		=> __( 'Title Margin', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .thm-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 		=> '{{WRAPPER}} .thm-heading-title',
			]
		);

		$this->end_controls_section();
		# Title Section end 1


		# Sub Title Section 2
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' 		=> __( 'Sub Title', 'flatpro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'			=> __( 'Subtitle Color', 'flatpro' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [ '{{WRAPPER}} .sub-title-content' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
            'sub_text_padding',
            [
                'label' 		=> __( 'Sub Title Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .sub-title-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography2',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 		=> '{{WRAPPER}} .sub-title-content',
			]
		);
		$this->end_controls_section();
		# Subtitle part 2 end




		# Total Style Section 2
		$this->start_controls_section(
			'section_total_style',
			[
				'label' 		=> __( 'Total Style', 'flatpro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __( 'Border', 'flatpro' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .flatpro-title-content-wrapper',
				'separator' 	=> 'before',
			]
		);
		$this->add_responsive_control(
            'total_padding',
            [
                'label' 		=> __( 'Total Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .flatpro-title-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
		$this->add_responsive_control(
            'total_margin',
            [
                'label' 		=> __( 'Total Margin', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .flatpro-title-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
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
					'{{WRAPPER}} .flatpro-title-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		# Subtitle part 2 end
	}

	protected function render( ) {
		$id_ = '';
		$settings = $this->get_settings();
		$lin = $settings['title_link'];
		if( $settings['total_id'] ){ $id_ = ' id="'.$settings["total_id"].'"'; }
		?>

		<div class="flatpro-title-content-wrapper" <?php echo $id_; ?> >

			<?php if (! empty(  $lin ) ) { ?>
				<?php if( $settings['title_border'] == 'yes' ): ?>
					<h2 class="thm-heading-title bordered"><a href="<?php echo $lin;?>"><span><?php echo $settings['title_txt']; ?></span></a></h2>
				<?php else: ?>
					<h2 class="thm-heading-title"><a href="<?php echo $lin;?>"><?php echo $settings['title_txt']; ?></a></h2>
				<?php endif; ?>
			<?php } else { ?>
				<?php if( $settings['title_border'] == 'yes' ): ?>
					<h2 class="thm-heading-title bordered"><span><?php echo $settings['title_txt']; ?></span></h2>
				<?php else: ?>
					<h2 class="thm-heading-title"><?php echo $settings['title_txt']; ?></h2>
				<?php endif; ?>
				<?php if( $settings['subtitle_content'] ){ ?><p class="sub-title-content"><?php echo $settings['subtitle_content']; ?></p><?php } ?>
			<?php } ?>

		</div>

		<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Title() );
<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Title extends Widget_Base {
	public function get_name() {
		return 'thm-title';
	}

	public function get_title() {
		return __( 'Themeum Title', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
            'section_title',
            [
                'label' 		=> __( 'Title Element', 'winkel' )
            ]
        );

        $this->add_control(
            'title_txt',
            [
                'label' 		=> __( 'Title', 'winkel' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter title', 'winkel' ),
                'default' 		=> __( 'This is heading', 'winkel' ),
            ]
        );   
		$this->add_control(
		    'title_headline',
		    [
		        'label'     => __( 'Select title element', 'winkel' ),
		        'type'      => Controls_Manager::SELECT,
		        'default'   => 'h3',
		        'options'   => [
		                'h1'  	=> 'H1',
						'h2'  	=> 'H2',
						'h3'  	=> 'H3',
						'h4'  	=> 'H4',
						'h5'  	=> 'H5',
						'h6'  	=> 'H6',
						'div'  	=> 'div',
						'p'  	=> 'P'
		            ],
		    ]
		);
        $this->add_control(
			'title_link',
			[
				'label' 		=> __( 'Add link', 'winkel' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'http://your-link.com', 'winkel' ),
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __( 'Title', 'winkel' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'			=> __( 'Text Color', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' 	=> [ '{{WRAPPER}} .thm-title-border' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label'			=> __( 'Ttitle Background Color', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_2,
				],
				'default'   => '#fff',
				'selectors' 	=> [
					'{{WRAPPER}} .thm-title-border' => 'background-color: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			'title_bg_border',
			[
				'label'			=> __( 'Title Border Background', 'winkel' ),
				'type'			=> Controls_Manager::COLOR,
				'scheme'		=> [
				    'type'		=> Scheme_Color::get_type(),
				    'value' 	=> Scheme_Color::COLOR_2,
				],
				'default'   => '#E6E6E6',
				'selectors' 	=> [
					'{{WRAPPER}} .winkel-title-wrapper::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
            'text_padding',
            [
                'label' 		=> __( 'Title Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .thm-title-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label' 		=> __( 'Title Margin', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [ '{{WRAPPER}} .winkel-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 		=> '{{WRAPPER}} .thm-title-border',
			]
		);
        $this->add_responsive_control(
            'title_align',
            [
                'label'     => __( 'Alignment', 'winkel' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title' => __( 'Left', 'winkel' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'winkel' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'winkel' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title' => __( 'Justified', 'winkel' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'center',
                'selectors' => ['{{WRAPPER}} .winkel-title-wrapper' => 'text-align: {{VALUE}};' ],
            ]
        );
		$this->end_controls_section();
		# Title Section end 1

	}

	protected function render( ) {
		$settings 		 = $this->get_settings();
		$titlelink 		 = $settings['title_link'];
		$title_headline  = $settings['title_headline'];
		$title_txt       = $settings['title_txt'];
		$data_title = '';	

	    if ( !empty( $title_txt ) ) {
	        if ( $titlelink['url'] ) {
	            $data_title = '<'.esc_attr($title_headline).' class="thm-title-border"><a href="'.esc_url($titlelink["url"]).'">';
	                $data_title .= wp_kses_post($title_txt);
	            $data_title .= '</a></'.esc_attr($title_headline).'>';
	        } else {
	            $data_title .= '<'.esc_attr($title_headline).' class="thm-title-border">';
	                $data_title .= wp_kses_post($title_txt);
	            $data_title .= '</'.esc_attr($title_headline).'>';
	        }  
	    } 
		?>
		<div class="winkel-title-wrapper">

			<?php echo $data_title;?>
		</div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Title() );
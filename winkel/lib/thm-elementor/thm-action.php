<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Action extends Widget_Base {
	public function get_name() {
		return 'thm-action';
	}

	public function get_title() {
		return __( 'Themeum Action', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title Element', 'winkel' )
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
						'span'  => 'Span',
						'p'  	=> 'P'
		            ],
		    ]
		);

        $this->add_control(
           	'title_text',
            [
                'label' 		=> __( 'Add title text', 'winkel' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter title text', 'winkel' ),
                'default' 		=> __( 'Combo Offer', 'winkel' ),
            ]
        );

		$this->add_control(
		    'subtitle_headline',
		    [
		        'label'     => __( 'Select sub title element', 'winkel' ),
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
						'span'  => 'Span',
						'p'  	=> 'P'
		            ],
		    ]
		);

        $this->add_control(
           	'text_subtitle',
            [
                'label' 		=> __( 'Add sub title text', 'winkel' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Designation', 'winkel' ),
                'default' 		=> __( 'Women Dress', 'winkel' ),
            ]
        );

        $this->add_control(
            'short_desc',
            [
                'label' 		=> __( 'Description', 'winkel' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Description', 'winkel' ),
                'default' 		=> __( 'Buy one gift one free', 'winkel' ),
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
		
		$this->add_control(
		    'bg_image',
		    [
		        'label'         => __( 'Background image', 'winkel' ),
		        'type'          => Controls_Manager::MEDIA,
		        'label_block'   => true,
		        'default'       => [
		                'url' => Utils::get_placeholder_image_src(),
		            ],
		    ]
		);
        $this->end_controls_section();


		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'Title Style', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'		=> __( 'Title Color', 'winkel' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .thm-action-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'title_padding',
            [
                'label' 		=> __( 'Title Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .thm-action-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .thm-action-title',
			]
		);

		$this->end_controls_section();
		# Name Section end 1


		$this->start_controls_section(
			'section_designation_style',
			[
				'label' 	=> __( 'Sub title style', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'		=> __( 'Sub title Color', 'winkel' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .thm-action-subtitle a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_hover_color',
			[
				'label'		=> __( 'Sub title Hover Color', 'winkel' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .thm-action-subtitle a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
            'subtitle_padding',
            [
                'label' 		=> __( 'Designation Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .thm-action-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .thm-action-subtitle',
			]
		);
		$this->end_controls_section();
		# Designation Section end 2


		$this->start_controls_section(
			'section_description_style',
			[
				'label' 	=> __( 'Description Style', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'		=> __( 'Description Color', 'winkel' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .thm-action-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'description_padding',
            [
                'label' 		=> __( 'Designation Padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .thm-action-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'description_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .thm-action-desc',
			]
		);
		$this->end_controls_section();
		# Designation Section end 3

		$this->start_controls_section(
			'section_wrapper_style',
			[
				'label' 	=> __( 'Action wrapper Style', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'wrap_padding',
            [
                'label' 		=> __( 'Action wrapper padding', 'winkel' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .themeum-action-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->end_controls_section();
		# wrap Section end

	}

	protected function render( ) {
		$settings 		= $this->get_settings();
		
		$title_headline 		= $settings['title_headline'];
		$title_text 			= $settings['title_text'];
		$titlelink 				= $settings['title_link'];
		$subtitle_headline 		= $settings['subtitle_headline'];
		$subtitle 				= $settings['text_subtitle'];
		$desc 					= $settings['short_desc'];
		$image 					= $settings['bg_image'];



		//Default Value

		$data_title = $data_subtitle = $data_img = '';

		if( empty( $title_headline ) ) {
	        $title_headline = 'h3';
	    }

	    // team image
	    if ( $image['url'] ) {
	        $img_link = $image['url'];
	        $data_img = 'style=" background-image:url('. esc_url($img_link) .');background-size:cover;background-position: center center; "';
	    }

	    //title
	    if ( !empty( $title_text ) ) {
            $data_title .= '<'.esc_attr($title_headline).' class="thm-action-title">';
                $data_title .= wp_kses_post($title_text);
            $data_title .= '</'.esc_attr($title_headline).'>'; 
	    } 	    

	    if ( !empty( $subtitle ) ) {
	        if ( $titlelink['url'] ) {
	            $data_subtitle = '<'.esc_attr($subtitle_headline).' class="thm-action-subtitle"><a href="'.esc_url($titlelink["url"]).'">';
	                $data_subtitle .= wp_kses_post($subtitle);
	            $data_subtitle .= '</a></'.esc_attr($subtitle_headline).'>';
	        } else {
	            $data_subtitle .= '<'.esc_attr($subtitle_headline).' class="thm-action-subtitle">';
	                $data_subtitle .= wp_kses_post($subtitle);
	            $data_subtitle .= '</'.esc_attr($subtitle_headline).'>';
	        }  
	    }   

	?>
		<div class="shortcode-themeum-action-wrap">
			<div class="themeum-action-wrap" <?php echo $data_img;?>>
				<div class="themeum-action-box">
					<?php 
					echo $data_title;
					echo $data_subtitle;
					?>
					<?php if( $desc ){ ?>
						<p class="thm-action-desc"><?php echo $desc; ?></p>
					<?php } ?>
			    </div>
		    </div>
	    </div>

	<?php }
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Action() );

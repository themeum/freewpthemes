<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Team extends Widget_Base {
	public function get_name() {
		return 'thm-team';
	}

	public function get_title() {
		return __( 'Themeum Team', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-time-line wts-eae-pe';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title Element', 'flatpro' )
            ]
        );

		$this->add_control(
		    'team_layout',
		    [
		        'label'     => __( 'Layout', 'flatpro' ),
		        'type'      => Controls_Manager::SELECT,
		        'default'   => '1',
		        'options'   => [
		                '1'  	=> 'Layout 1',
						'2'  	=> 'Layout 2',
						'3'  	=> 'Layout 3',
						'4'  	=> 'Layout 4',
		            ],
		    ]
		);

		$this->add_control(
		    'team_text_align',
		    [
		        'label'     => __( 'Alignment', 'flatpro' ),
		        'type'      => Controls_Manager::SELECT,
		        'default'   => 'center',
		        'options'   => [
		                'left'  	=> 'Left',
						'right'  	=> 'Right',
						'center'  	=> 'Center',
		            ],
		    ]
		);

		$this->add_control(
		    'team_headline',
		    [
		        'label'     => __( 'Select the Elements', 'flatpro' ),
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
           	'team_title',
            [
                'label' 		=> __( 'Name', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Name', 'flatpro' ),
                'default' 		=> __( 'Jon Deo', 'flatpro' ),
            ]
        );

        $this->add_control(
			'team_link',
			[
				'label' 		=> __( 'Title Link', 'flatpro' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'http://your-link.com', 'flatpro' ),
			]
		);

        $this->add_control(
           	'team_subtitle',
            [
                'label' 		=> __( 'Designation', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXT,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Designation', 'flatpro' ),
                'default' 		=> __( 'Developer', 'flatpro' ),
            ]
        );
        $this->add_control(
            'team_desc',
            [
                'label' 		=> __( 'Description', 'flatpro' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'label_block' 	=> true,
                'placeholder' 	=> __( 'Enter Description', 'flatpro' ),
                'default' 		=> __( 'Write your description content of this section.', 'flatpro' ),
            ]
        );         

		
		$this->add_control(
		    'team_image',
		    [
		        'label'         => __( 'Team Image', 'flatpro' ),
		        'type'          => Controls_Manager::MEDIA,
		        'label_block'   => true,
		        'default'       => [
		                'url' => Utils::get_placeholder_image_src(),
		            ],
		    ]
		);

		$this->add_control(
			'team_social',
			[
				'label' => __( 'Show Social', 'flatpro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __( 'Show', 'flatpro' ),
				'label_off' => __( 'Hide', 'flatpro' ),
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'team_facebook-square',
			[
				'label' => __( 'Facebook URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_twitter-square',
			[
				'label' => __( 'Twitter URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_google-plus',
			[
				'label' => __( 'Google Plus URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_linkedin-square',
			[
				'label' => __( 'Linkedin URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_pinterest',
			[
				'label' => __( 'Pinterest URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_flickr',
			[
				'label' => __( 'Flickr URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_instagram',
			[
				'label' => __( 'Instagram URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_dribbble',
			[
				'label' => __( 'Dribbble URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_reddit',
			[
				'label' => __( 'Reddit URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_email',
			[
				'label' => __( 'Email URL', 'flatpro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'flatpro' ),
				'condition' => [
					'team_social' => 'yes',
				],
			]
		);

		$this->add_control(
			'stayle_1_color',
			[
				'label'		=> __( 'Basic Background Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .themeum-team-wrap-1 .themeum-team-wrap' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'team_layout' => '1',
				],
			]
		);

		$this->add_control(
			'stayle_2_color',
			[
				'label'		=> __( 'Basic Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content2' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'team_layout' => '2',
				],
			]
		);

		$this->add_control(
			'stayle_4_color',
			[
				'label'		=> __( 'Basic Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content4' => 'background: {{VALUE}};',
				],
				'condition' => [
					'team_layout' => '4',
				],
			]
		);
        $this->end_controls_section();


		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'Name Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'		=> __( 'Name Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label'		=> __( 'Name Hover Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'name_padding',
            [
                'label' 		=> __( 'Name Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .team-content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .team-content-title',
			]
		);

		$this->end_controls_section();
		# Name Section end 1


		$this->start_controls_section(
			'section_designation_style',
			[
				'label' 	=> __( 'Designation Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'designation_color',
			[
				'label'		=> __( 'Designation Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'designation_padding',
            [
                'label' 		=> __( 'Designation Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .team-content-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'designation_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .team-content-subtitle',
			]
		);
		$this->end_controls_section();
		# Designation Section end 2


		$this->start_controls_section(
			'section_description_style',
			[
				'label' 	=> __( 'Description Style', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'		=> __( 'Description Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .team-content-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'description_padding',
            [
                'label' 		=> __( 'Designation Padding', 'flatpro' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .team-content-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'description_typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .team-content-desc',
			]
		);
		$this->end_controls_section();
		# Designation Section end 3


	}

	protected function render( ) {
		$settings 		= $this->get_settings();
		
		$headline 		= $settings['team_headline'];
		$layout 		= $settings['team_layout'];
		$title 			= $settings['team_title'];
		$button_link 	= $settings['team_link'];
		$subtitle 		= $settings['team_subtitle'];
		$desc 			= $settings['team_desc'];
		$text_align 	= $settings['team_text_align'];
		$image 			= $settings['team_image'];



		//Default Value
		$align 			= 'left';
		$data_img = $data_title = $data_subtitle = $data_desc = $data_socials = '';

		if( empty( $headline ) ) {
	        $headline = 'h3';
	    }

	    if( $text_align ){
	        if( $text_align == 'left' ){ $align = 'text-left'; }
	        if( $text_align == 'right' ){ $align = 'text-right'; }
	        if( $text_align == 'center' ){ $align = 'text-center'; }
	    } else {
	        $align = 'text-left';
	    }

	    // team image
	    if ( $image['url'] ) {
	        $img_link = $image['url'];
	        $data_img = '<div class="team-content-image">';
	            $data_img .= '<img class="img-fluid" src="'. esc_url($img_link) .'" alt="">';
	        $data_img .= '</div>';
	    }

	    //title
	    if ( !empty( $title ) ) {
	        if ( $button_link['url'] ) {
	            $data_title = '<'.esc_attr($headline).' class="team-content-title"><a href="'.esc_url($button_link["url"]).'">';
	                $data_title .= wp_kses_post($title);
	            $data_title .= '</a></'.esc_attr($headline).'>';
	        } else {
	            $data_title .= '<'.esc_attr($headline).' class="team-content-title">';
	                $data_title .= wp_kses_post($title);
	            $data_title .= '</'.esc_attr($headline).'>';
	        }  
	    }   

	    //subtitle  
	    if ( !empty( $subtitle ) ) {
	        $data_subtitle = '<div class="team-content-subtitle">';
	            $data_subtitle .= wp_kses_post($subtitle);
	        $data_subtitle .= '</div>';
	    }

	    //Description
	    if ( !empty( $desc ) ) {
	        $data_desc .= '<div class="team-content-desc">';
	            $data_desc .= wp_kses_post($desc);
	        $data_desc .= '</div>';
	    }

	    //social share
	    $social_list = array( 'team_facebook-square', 'team_twitter-square', 'team_google-plus', 'team_linkedin-square', 'team_pinterest', 'team_flickr', 'team_instagram', 'team_dribbble', 'team_reddit', 'team_email' );

	    // print_r( $settings['team_facebook'] );

	    foreach( $social_list as $acc ){
	        if( !empty( $settings[$acc]['url']) && $settings[$acc]['url'] != '__empty__' ){
	            $icon = str_replace( array('team_', 'email') , array( '', 'envelope-o') , $acc);
	            $data_socials .= '<a href="' . $settings[$acc]['url'] . '" target="_blank"><i class="fa fa-' . $icon . '"></i></a>';
	        }
	    }

	    if( !empty( $data_socials) ){
	        $data_socials = '<div class="team-content-socials">' . $data_socials . '</div>';
	    }
	?>
		<div class="themeum-team-wrap-<?php echo $layout; ?>">
		    <div class="themeum-team-wrap">
		        <div class="item themeum_team">
		            <?php
		            	switch ( $layout ) {
			                case '2':
			                    $output = '<div class="'.$align.'">';
			                        $output .= $data_img;
			                        $output .= '<div class="team-content2">';
			                            $output .= $data_title;
			                            $output .= $data_subtitle;
			                            $output .= $data_desc;
			                            $output .= $data_socials;
			                        $output .= '</div>'; 
			                    $output .= '</div>'; 
			                    echo $output;
			                break;

			                case '3':
			                     $output = '<div class="'.$align.'">';
			                        $output .= '<div class="team-overlay">';
			                            $output .= $data_img;
			                        $output .= '</div>';
			                        $output .= $data_title;
			                        $output .= $data_subtitle;
			                        $output .= $data_desc;
			                            $output .= $data_socials;
			                    $output .= '</div>';
			                    echo $output;
			                break;

			                case '4':
			                    $output = '<div class="'.$align.'">';
			                        $output .= '<div class="team-overlay">';
			                            $output .= $data_img;
			                            $output .= $data_socials;
			                        $output .= '</div>';
			                        $output .= '<div class="team-content4">';
			                            $output .= $data_title;
			                            $output .= $data_subtitle;
			                            $output .= $data_desc;
			                        $output .= '</div>';
			                    $output .= '</div>';
			                    echo $output;
			                break;

			                default:
			                    $output = '<div class="'.$align.'">';
			                        $output .= $data_img;
			                        $output .= '<div class="team-content3">';
			                            $output .= $data_title;
			                            $output .= $data_subtitle;
			                            $output .= $data_desc;
			                            $output .= $data_socials;
			                        $output .= '</div>'; 
			                    $output .= '</div>'; 
			                    echo $output;
			                break;            
			            }
		            ?>
		        </div>
		    </div>
	    </div>

	<?php }
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Team() );
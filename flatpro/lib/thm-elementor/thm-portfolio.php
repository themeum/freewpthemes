<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Themeum_Portfolio extends Widget_Base {
	public function get_name() {
		return 'thm-portfolio';
	}

	public function get_title() {
		return __( 'Portfolio', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-inner-section wts-eae-pe';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_title',
			[
				'label' 	=> __( 'Portfolio Settings', 'flatpro' ),
			]
		);
		$this->add_control(
            'portfolio_layout',
            [
                'label'     => __( 'Order', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'layout_1',
                'options'   => [
                        'layout_1' 		=> __( 'Layout 1', 'flatpro' ),
                        'layout_2' 		=> __( 'Layout 2', 'flatpro' ),
                        'layout_3' 		=> __( 'Layout 3', 'flatpro' ),
                    ],
            ]
        );
		$this->add_control(
			'portfolio_number',
			[
		    'label'         => __( 'Number of Portfolio', 'flatpro' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => __( '6', 'flatpro' ),
		  	]
		);
		$this->add_control(
            'portfolio_column',
            [
                'label'     => __( 'Number of Column', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                        '6' 	=> __( 'Two Column', 'flatpro' ),
                        '4' 	=> __( 'Three Column', 'flatpro' ),
                        '3' 	=> __( 'Four Column', 'flatpro' ),
                    ],
            ]
        );
        $this->add_control(
            'portfolio_order_by',
            [
                'label'     => __( 'Order', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC' 		=> __( 'Descending', 'flatpro' ),
                        'ASC' 		=> __( 'Ascending', 'flatpro' ),
                    ],
            ]
        );
        $this->add_control(
			'portfolio_show_filter',
			[
				'label' 		=> __( 'Show Filter', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
				'selectors' 	=> [
					'{{WRAPPER}} h2.bordered:before' => 'width: 100%;',
				],
			]
		);
        $this->add_control(
			'portfolio_show_title',
			[
				'label' 		=> __( 'Show Title', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
			]
		);
		$this->add_control(
			'portfolio_show_category',
			[
				'label' 		=> __( 'Show Category', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
			]
		);
        $this->add_control(
			'post_pagination',
			[
				'label' 		=> __( 'Show Pagination', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
			]
		);
		$this->add_control(
			'main_title_color',
			[
				'label'		=> __( 'Post Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item-content-in .portfolio-title a' => 'color: {{VALUE}};',
				],
				'default' 	=> '#293340',
				'condition' => [
					'portfolio_layout' => ['layout_1','layout_2']
				],
			]
		);
		$this->add_control(
			'main_sub_title_color',
			[
				'label'		=> __( 'Post Category Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item-content-in .portfolio-category' => 'color: {{VALUE}};',
				],
				'default' 	=> '#6D7784',
				'condition' => [
					'portfolio_layout' => ['layout_1','layout_2']
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'Portfolio', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
		    'spacing',
		    [
		        'label' => __( 'Width', 'flatpro' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 1,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 100,
		                'step' => 1,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-items' => 'padding: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'sub_text_bg',
			[
				'label'		=> __( 'Sub Text Background Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item-content' => 'background-color: {{VALUE}};',
				],
				'default' 	=> '#0065e0',
			]
		);
		$this->add_responsive_control(
			'filter_align',
			[
				'label' 	=> __( 'Filter Alignment', 'flatpro' ),
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
					'{{WRAPPER}} .portfolioFilter' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' 	=> __( 'Content Alignment', 'flatpro' ),
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
					'{{WRAPPER}} .portfolio-item-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'		=> __( 'Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-title a,{{WRAPPER}} .overlay-cont2' => 'color: {{VALUE}};',
				],
				'default' 	=> '#293340',
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label'		=> __( 'Title Hover Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-title a:hover,{{WRAPPER}} .overlay-cont2:hover' => 'color: {{VALUE}};',
				],
				'default' 	=> '#293340',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label'		=> __( 'Sub Title Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-category' => 'color: {{VALUE}};',
				],
				'default' 	=> '#6D7784',
			]
		);
		$this->add_control(
			'sub_title_hover_color',
			[
				'label'		=> __( 'Sub Title Hover Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-category:hover' => 'color: {{VALUE}};',
				],
				'default' 	=> '#6D7784',
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label'		=> __( 'Background Color', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'default' 	=> '#ffffff',
			]
		);
		$this->add_control(
			'title_bg_color_stop',
			[
				'label'		=> __( 'Background Color Stop', 'flatpro' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
				    'type'	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .layout_3 .portfolio-item-content-in,{{WRAPPER}} .overlay-cont2,{{WRAPPER}} .portfolio-items:hover .caption-full-width,{{WRAPPER}} .portfolio-items:hover .portfolio-layout2' => '    background-image: linear-gradient(190deg, {{title_bg_color.VALUE}} 0%, {{title_bg_color_stop.VALUE}} 100%);;',
				],
				'default' 	=> '#ffffff',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .portfolio-title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography_2',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .portfolio-category',
			]
		);
		$this->end_controls_section();

	}

	protected function render( ) {
		$settings = $this->get_settings();
        $page_numb 			= max( 1, get_query_var('paged') );
        
		$args = array(
			'post_type'		 	=> 'portfolio',
			'posts_per_page'	=> $settings['portfolio_number'],
			'order'				=> $settings['portfolio_order_by']
		);
		if( $page_numb ){
			$args['paged'] = $page_numb;
		}

		$data = new \WP_Query( $args );
		global $post;
		?>

		<div class="filterable-portfolio <?php echo $settings['portfolio_layout']; ?>">
		

			<?php
			// filter of portfolio
			if ( $settings['portfolio_show_filter'] == 'yes' ) {
				$filters = get_terms('portfolio-cat');
				if ( $filters && !is_wp_error( $filters ) ) { ?>
					<div class="portfolioFilter">
						<a class="current" href="#" data-filter="*"><?php esc_html_e('Show All','flatpro'); ?></a>
					<?php foreach ( $filters as $filter ){ ?>
						<a href="#" data-filter=".<?php echo esc_attr($filter->slug); ?>"><?php echo esc_html($filter->name); ?></a>
					<?php } ?>
					</div>
				<?php }
			} ?>  


			<div class="container">
			<div class="row portfolioContainer">
			
			<?php
			if ( $data->have_posts() ) :
		        while ( $data->have_posts() ) : $data->the_post();

				$external_link	= esc_attr(get_post_meta( get_the_ID(),'external_link',true));
				# Filter List Item
				$terms	  = get_the_terms(  get_the_ID(), 'portfolio-cat' );
				$term_name  = '';
				if (is_array( $terms )) {
					foreach ( $terms as $term ) {
						$term_name .= ' '.$term->slug;
					}
				}
				# category list
				$terms2 = get_the_terms(  get_the_ID(), 'portfolio-cat' );
				$term_name2 = '';
				if (is_array( $terms2 )){
					foreach ( $terms2 as $term2 )
					{
						$term_name2 .= $term2->slug.', ';
					}
				}
				$term_name2 = substr($term_name2, 0, -2);
				?>

	
				<div class="portfolio-items col-<?php echo $settings['portfolio_column'];?> <?php echo $term_name; ?>">
					<div class="portfolio-single-items">

						<div class="portfolio-thumb">
							<?php if(has_post_thumbnail( get_the_ID())) {
								$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'flatpro-portfo'); ?>
								<img class="img-responsive" src="<?php echo esc_url($thumb[0]); ?>"  alt="">
							<?php } else { ?>
								<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>'/images/recipes.jpg" alt="<?php _e('image','flatpro'); ?>">
							<?php } ?>
							<?php if( $settings['portfolio_layout'] == 'layout_1' ){ ?>
								<div class="caption-full-width">
									<div class="overlay-cont">
										<?php if ( $settings['portfolio_show_title'] == 'yes' ) { ?>
											<a class="overlay-btn" href="<?php the_permalink(  get_the_ID() ); ?>"><?php _e( 'View Case Study','flatpro'); ?></a>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>

						<?php if( $settings['portfolio_layout'] == 'layout_1' ){ ?>
							<div class="portfolio-item-content">
								<div class="portfolio-item-content-in">
									<div>
										<?php if ( $settings['portfolio_show_title'] == 'yes' ) { ?>
											<h3 class="portfolio-title"><a href="<?php the_permalink(  get_the_ID() ); ?>"><?php echo get_the_title( get_the_ID()) ?></a></h3>
										<?php } ?>
										<?php if ( $settings['portfolio_show_category'] == 'yes' ) {
											if($term_name != '') { ?>
											   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
											<?php }
										} ?>
									</div>
								</div>
							</div>

						<?php } ?>



						<?php if( $settings['portfolio_layout'] == 'layout_2' ){ ?>
							<div class="portfolio-layout2">
								<?php if(has_post_thumbnail( get_the_ID() )) { 
									$photo = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full' ); ?>
                                    <a class="plus-icon cloud-zooms" href="<?php echo esc_url($photo[0]); ?>"><i class="fa fa-eye"></i></a>  
                                <?php } ?>
								<div class="overlay-cont2">		
									<a href="<?php echo get_permalink(); ?>" class="plus-icon"><i class="sl-eye"></i></a>
									<?php if ( $settings['portfolio_show_title'] == 'yes' ) { ?>
										<h3 class="portfolio-title"><a href="<?php the_permalink(  get_the_ID() ); ?>"><?php echo get_the_title( get_the_ID()) ?></a></h3>
									<?php } ?>
									<?php if ( $settings['portfolio_show_category'] == 'yes' ) {
										if($term_name != '') { ?>
										   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
										<?php }
									} ?>	
								</div>
							</div>
						<?php } ?>

						
						<?php if( $settings['portfolio_layout'] == 'layout_3' ){ ?>
							<div class="portfolio-item-content">
							   <div class="portfolio-item-content-in">
							      <div>
							        <?php if ( $settings['portfolio_show_category'] == 'yes' ) {
										if($term_name != '') { ?>
										   	<span class="portfolio-category"><?php echo $term_name2; ?></span>
										<?php }
									} ?>
									<?php if ( $settings['portfolio_show_title'] == 'yes' ) { ?>
							        	<h3 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							        <?php } ?>
							        <a class="overlay-btn" href="<?php the_permalink(  get_the_ID() ); ?>"><?php _e( 'View Case Study','flatpro'); ?></a>
							      </div>
							   </div>
							</div>
						<?php } ?>



					</div>
				</div>
			<?php endwhile; ?>
				<div class="col-md-12">	
					<?php 
					if( $settings['post_pagination'] == 'yes' ){ 
							$max_page = $data->max_num_pages; 
							echo flatpro_pagination( $page_numb, $max_page );  
						} 
					?>
				</div>
			</div>
		</div>



</div>

<?php wp_reset_postdata(); endif; ?>
<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Themeum_Portfolio() );
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

class Themeum_Widget_Posts_Grid extends Widget_Base {

	public function get_name() {
		return 'flatpro-posts-grid';
	}

	public function get_title() {
		return __( 'Themeum Posts Grid', 'flatpro' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
            'woo_product',
            [
                'label' 	=> __( 'Post Element', 'flatpro' )
            ]
        );
		$this->add_control(
		  'post_number',
		  [
		    'label'         => __( 'Number of Posts', 'flatpro' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => __( '9', 'flatpro' ),

		  ]
		);
		$this->add_control(
            'post_column',
            [
                'label'     => __( 'Number of Column', 'flatpro' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                        '12' 	=> __( 'One Column', 'flatpro' ),
                        '6' 	=> __( 'Two Column', 'flatpro' ),
                        '4' 	=> __( 'Three Column', 'flatpro' ),
                        '3' 	=> __( 'Four Column', 'flatpro' ),
                    ],
            ]
        );
        $this->add_control(
          'post_cat',
          [
             'label'    => __( 'Product Category', 'flatpro' ),
             'type'     => Controls_Manager::SELECT,
             'options'  => flatpro_all_category_list( 'category' ),
             'multiple' => true,
             'default'  => 'allpost'
          ]
        );
        $this->add_control(
            'post_order_by',
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
		  'textlimit',
		  [
		    'label'         => __( 'Text Limit Of Content', 'flatpro' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => 280,
		  ]
		); 
        $this->add_control(
			'post_pagination',
			[
				'label' 		=> __( 'Post Pagination', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'No',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
				'selectors' 	=> [
					'{{WRAPPER}} iframe' => 'pointer-events: none;',
				],
			]
		);
		$this->add_control(
			'post_share',
			[
				'label' 		=> __( 'Post Share', 'flatpro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'No',
				'label_on' 		=> __( 'Yes', 'flatpro' ),
				'label_off' 	=> __( 'No', 'flatpro' ),
				'selectors' 	=> [
					'{{WRAPPER}} iframe' => 'pointer-events: none;',
				],
			]
		);

        $this->end_controls_section();


        # Title Section
		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'Title', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'flatpro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-post-item-col .flatpro-index-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Title Color', 'flatpro' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_1,
					],
				'selectors' => [
					'{{WRAPPER}} .flatpro-post .content-item-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .flatpro-post .content-item-title a',
			]
		);
		$this->end_controls_section();
		# Title Section End

		#Pagination Section
		$this->start_controls_section(
			'section_pagination_style',
			[
				'label' 	=> __( 'Pagination', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'post_align',
            [
                'label'     => __( 'Alignment', 'flatpro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'      => [
                        'title' => __( 'Left', 'flatpro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'flatpro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'flatpro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title' => __( 'Justified', 'flatpro' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .themeum-pagination' => 'text-align: {{VALUE}}; display: inline-block; width: 100%;',
                ],
            ]
        );
        $this->end_controls_section();

		#Subtitle Section
		$this->start_controls_section(
			'section_price_style',
			[
				'label' 	=> __( 'Subtitle', 'flatpro' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'flatpro' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_2,
					],
				'selectors' => [
					'{{WRAPPER}} .flatpro-post .entry-summary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography2',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} .flatpro-post .entry-summary',
			]
		);
	} # function _register_controls end

	protected function render( ) {

		$settings 			= $this->get_settings();
		$post_number 		= $settings['post_number'];
		$post_column 		= $settings['post_column'];
		$post_cat 			= $settings['post_cat'];
		$post_order_by 		= $settings['post_order_by'];
		$post_pagination 	= $settings['post_pagination'];
		$post_share 		= $settings['post_share'];
		$textlimit			= $settings['textlimit'];
		$page_numb 			= max( 1, get_query_var('paged') );


		//Query Build
		$arg = array(
				'post_type'   =>  'post',
				'post_status' => 'publish',
			);
		if( $post_order_by ){
			$arg['order'] = $post_order_by;
		}
		if( $page_numb ){
			$arg['paged'] = $page_numb;
		}
		if( $post_number ){
			$arg['posts_per_page'] = $post_number;
		}
		if( $post_cat ){
			if( $post_cat != 'allpost' ){
				$cat_data = array();
				$cat_data['relation'] = 'AND';
				$cat_data[] = array(
						'taxonomy' 	=> 'category',
			          	'field' 	=> 'slug',
			          	'terms' 	=> $post_cat
					);
				$arg['tax_query'] = $cat_data;
			}
		}

		$data = new \WP_Query( $arg );
	?>
		

		<div class="row">
			<?php if ( $data->have_posts() ) : ?>
		        <?php while ( $data->have_posts() ) : $data->the_post();
		        $permalink 	= get_permalink();
				$title 		= get_the_title();
				$media_url 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "flatpro-large" );
				$media_url  = ( isset( $media_url[0] ) ) ? $media_url[0] : '';
		        ?>	
				<div class="blog-post-item-col col-<?php echo $post_column; ?>">
				    <article class="flatpro-post flatpro-single-post flatpro-index-post">
				    	<?php if ( has_post_thumbnail() ){ ?>
					        <div class="blog-details-img">
					            <a href="<?php echo esc_url($permalink); ?>">
					            	<?php the_post_thumbnail('flatpro-large', array('class' => 'img-fluid')); ?>
					            </a>
					        </div>
				        <?php } ?>
				        <div class="flatpro-blog-title clearfix">
				            <h2 class="content-item-title">
				                <a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a>
				            </h2>
				            <ul class="blog-post-meta clearfix">
				                <li>
				                    <div class="blog-date-wrapper">
				                        <i class="fa fa-calendar"></i> <a href="<?php echo esc_url($permalink); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><?php echo get_the_date(); ?></time></a>
				                    </div>
				                </li>
				                <li class="meta-author">
				                    <?php esc_html_e('by', 'flatpro') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
				                </li>
				                <li class="meta-category">
				                    <?php printf(esc_html__('in %s', 'flatpro'), get_the_category_list(', ')); ?>
				                </li>
				            </ul>
				            <div class="entry-blog">
				                <div class="entry-summary clearfix">
				                    <?php echo flatpro_excerpt_max_charlength( $textlimit ); ?>
				                    <p class="wrap-btn-style"><a class="btn btn-style" href="<?php echo esc_url($permalink); ?>"><?php _e( 'Read More','flatpro' ); ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
									
									<?php if( $post_share == 'yes' ){ ?>
										<div class="social-share-wrap">
											<ul>
												<li>
													<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $title ?>" data-description="<?php echo $title ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-facebook"></a>
												</li>
												<li>
													<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $title ?>" class="prettySocial fa fa-twitter"></a>
												</li>
												<li>
													<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $title ?>" class="prettySocial fa fa-google-plus"></a>
												</li>
												<li>
													<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $title ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-pinterest"></a>		
												</li>
												<li>
													<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $title; ?>" data-description="<?php echo $title ?>" data-via="<?php echo get_theme_mod( 'wp_linkedin_user' ); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-linkedin"></a>
												</li>
											</ul>
										</div>
									<?php } ?>
				            </div>
				        </div>
				    </article>
				</div>
		        <?php endwhile; ?>
		        <div class="col-12">
			        <?php
				        if( $post_pagination == 'yes' ){
				        	$max_page = $data->max_num_pages;
				        	echo flatpro_pagination( $page_numb, $max_page ); 
				        }
			        ?>
		        </div>
		        <?php wp_reset_query(); ?>
		    <?php endif; ?>
		</div>


	<?php }
	protected function _content_template() { }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themeum_Widget_Posts_Grid() );
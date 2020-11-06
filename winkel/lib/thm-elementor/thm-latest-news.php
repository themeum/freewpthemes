<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

class Themeum_Widget_Latest_News extends Widget_Base {

	public function get_name() {
		return 'winkel-latest-news';
	}

	public function get_title() {
		return __( 'Themeum Latest News', 'winkel' );
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
                'label' 	=> __( 'Post Element', 'winkel' )
            ]
        );

		$this->add_control(
		  'post_number',
		  [
		    'label'         => __( 'Number of Posts', 'winkel' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => __( '9', 'winkel' ),

		  ]
		);
		$this->add_control(
            'post_column',
            [
                'label'     => __( 'Number of Column', 'winkel' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                        '12' 	=> __( 'One Column', 'winkel' ),
                        '6' 	=> __( 'Two Column', 'winkel' ),
                        '4' 	=> __( 'Three Column', 'winkel' ),
                        '3' 	=> __( 'Four Column', 'winkel' ),
                    ],
            ]
        );
        $this->add_control(
          'post_cat',
          [
             'label'    => __( 'Product Category', 'winkel' ),
             'type'     => Controls_Manager::SELECT,
             'options'  => winkel_all_category_list( 'category' ),
             'multiple' => true,
             'default'  => 'allpost'
          ]
        );
        
        $this->add_control(
            'post_order_by',
            [
                'label'     => __( 'Order', 'winkel' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC' 		=> __( 'Descending', 'winkel' ),
                        'ASC' 		=> __( 'Ascending', 'winkel' ),
                    ],
            ]
        );

        $this->end_controls_section();


        # Title Section
		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> __( 'Title', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Title Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_1,
					],
				'selectors' => [
					'{{WRAPPER}} .post-box .inner a h6' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' 	=> __( 'Title Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_1,
					],
				'selectors' => [
					'{{WRAPPER}} .post-box .inner a h6:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .post-box .inner a h6',
			]
		);
		$this->end_controls_section();
		# Title Section End


		#Subtitle Section
		$this->start_controls_section(
			'section_price_style',
			[
				'label' 	=> __( 'Intro Text', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_2,
					],
				'selectors' => [
					'{{WRAPPER}} .post-box .inner' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography2',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} .post-box .inner',
			]
		);
	} # function _register_controls end

	protected function render( ) {

		$settings 			= $this->get_settings();
		$post_number 		= $settings['post_number'];
		$post_column 		= $settings['post_column'];
		$post_cat 			= $settings['post_cat'];
		$post_order_by 		= $settings['post_order_by'];
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
					$media_url 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "winkel-large" );
					$media_url  = ( isset( $media_url[0] ) ) ? $media_url[0] : '';
		        ?>	
				<div class="post-box col-<?php echo $post_column; ?>">
					<div class="inner">

						<?php if ( has_post_thumbnail() ){ ?>
					        <div class="post-img">
					            <a href="<?php echo esc_url($permalink); ?>">
					            	<?php the_post_thumbnail('winkel-large', array('class' => 'img-fluid')); ?>
					            </a>
					        </div>
				        <?php } ?>

				        <div class="post-meta">
				         	<?php $the_date = get_the_date(); ?>
			                <a href="<?php echo esc_url($permalink); ?>" class="date"><span><?php echo date_i18n("d", strtotime($the_date)); ?></span> <?php echo date_i18n("F", strtotime($the_date)) ?></a>
			                
			            </div>

			            <div class="post-content">
			                <a href="<?php echo esc_url($permalink); ?>"><h6><?php the_title(); ?></h6></a>
			            </div>
				    </div>
				</div>
		        <?php endwhile; ?>
		        <?php wp_reset_query(); ?>
		    <?php endif; ?>
		</div>


	<?php }
	protected function _content_template() { }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themeum_Widget_Latest_News() );





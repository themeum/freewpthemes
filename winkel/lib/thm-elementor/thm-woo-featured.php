<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

class Themeum_Widget_Woo_Featured_Products extends Widget_Base {

	public function get_name() {
		return 'winkel-featured-product';
	}

	public function get_title() {
		return __( 'Featured Products', 'winkel' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'themeum-elementor' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
            'woo_product',
            [
                'label' 	=> __( 'Featured Product', 'winkel' )
            ]
        );
		$this->add_control(
		  'woo_number',
		  [
		    'label'         => __( 'Number of Products', 'winkel' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => __( '8', 'winkel' ),

		  ]
		); 
		$this->add_control(
            'woo_column',
            [
                'label'     => __( 'Number of Column', 'winkel' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => [
                        '12' 	=> __( 'One Column', 'winkel' ),
                        '6' 	=> __( 'Two Column', 'winkel' ),
                        '4' 	=> __( 'Three Column', 'winkel' ),
                        '3' 	=> __( 'Four Column', 'winkel' ),
                    ],
            ]
        );
        $this->add_control(
            'woo_order_by',
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
				'label' 	=> __( 'Text Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_1,
					],
				'selectors' => [
					'{{WRAPPER}} .themeum-woo-product-details .product-content a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' 	=> __( 'Text Hover Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_1,
					],
				'default'   => '#2076F7',
				'selectors' => [
					'{{WRAPPER}} .themeum-woo-product-details .product-content a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .themeum-woo-product-details .product-content h4',
			]
		);
		$this->end_controls_section();
		# Title Section End

		#Pagination Section
		$this->start_controls_section(
			'section_pagination_style',
			[
				'label' 	=> __( 'Pagination', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'text_align',
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
                'selectors' => [
                    '{{WRAPPER}} .themeum-pagination' => 'text-align: {{VALUE}}; display: inline-block; width: 100%;',
                ],
            ]
        );
        $this->end_controls_section();

		#Price Section
		$this->start_controls_section(
			'section_price_style',
			[
				'label' 	=> __( 'Price', 'winkel' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_title_color',
			[
				'label' 	=> __( 'Price Text Color', 'winkel' ),
				'type' 		=> Controls_Manager::COLOR,
				'scheme' 	=> [
				    	'type' => Scheme_Color::get_type(),
				    	'value' => Scheme_Color::COLOR_2,
					],
				'selectors' => [
					'{{WRAPPER}} .themeum-woo-product-details .product-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography2',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} .themeum-woo-product-details .product-price',
			]
		);
	} # function _register_controls end

	protected function render( ) {

		if( function_exists('WC') ){
			$settings 			= $this->get_settings();
			$woo_number 		= $settings['woo_number'];
			$woo_column 		= $settings['woo_column'];
			$woo_order_by 		= $settings['woo_order_by'];
	
			//Query Build
			$meta_query  = WC()->query->get_meta_query();
			$tax_query   = WC()->query->get_tax_query();
			  $tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
			$arg = array(
				'post_type'   =>  'product',
				'post_status' => 'publish',
				'meta_query'          => $meta_query,
				'tax_query'           => $tax_query,
				'posts_per_page'      => $woo_number,
				'order'               => $woo_order_by,
			);
	
			$data = new \WP_Query( $arg );
	
		?>
			
			<div class="row">
				<?php if ( $data->have_posts() ) : ?>
					<?php while ( $data->have_posts() ) : $data->the_post(); 
						$product = new \WC_Product(get_the_ID());
						$price_html = $product->get_price_html();
						$price = get_post_meta( get_the_ID(), '_regular_price', true);
						$sale = get_post_meta( get_the_ID(), '_sale_price', true);
						//$cats = get_the_term_list( get_the_ID(), 'product_cat' );
						
						// Ansistor Found
						$product_cat_id = '';
						$terms = get_the_terms( get_the_ID(), 'product_cat' );
						if( $terms ){
							foreach ($terms as $term) {
								$product_cat_id = $term->term_id;
								break;
							}
							$cats = get_ancestors( $product_cat_id, 'product_cat', 'taxonomy' );
							if(isset($cats[0])){ 
								$cats = array_reverse($cats);
								$product_cat_id = $cats[0]; 
							}
						}
						
						?>
						<div class="col-md-6 col-lg-<?php echo $woo_column; ?> product-item">
							<div class="inner">
								<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
								
								<?php if( $product_cat_id ): ?>
									<span class="category"><?php _e('For','winkel'); ?> 
										<a href="<?php echo get_category_link( $product_cat_id ); ?>"><?php echo get_cat_name($product_cat_id); ?></a>
									</span>
								<?php endif; ?>
	
								<div class="product-img">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?></a>
								</div>	
								<div class="price-box">
									<span class="product-price"><?php echo $price_html; ?></span>
								</div>
								<div class="hover-content">
								<a href="#" class="add-to-wishlist love" data-productid="<?php echo esc_attr( $product->get_id() ); ?>"><i class="winkel winkel-heart"></i></a>
									<a rel="nofollow" href="?add-to-cart=<?php echo $data->post->ID ?>" data-quantity="1" data-product_id="<?php echo $data->post->ID ?>" data-product_sku="" class="love product_type_simple add_to_cart_button ajax_add_to_cart"><i class="winkel winkel-shopping-cart2"></i></a>
									<?php woocommerce_widget_shopping_cart_button_view_cart();?>
									<a href="<?php the_permalink(); ?>" class="love"><i class="winkel winkel-link"></i></a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		<?php
		}
 	}
	protected function _content_template() { }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themeum_Widget_Woo_Featured_Products() );
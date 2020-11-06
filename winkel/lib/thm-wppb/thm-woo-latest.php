<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class Winkel_Woo_Latest{

	public function get_name(){
		return 'winkel_woo_latest';
	}
	public function get_title(){
		return 'Latest Product';
	}
	public function get_icon() {
		return 'wppb-font-shopping-cart2';
	}
	public function get_category_name(){
        return 'Winkel Addon';
    }

	// headline Settings Fields
	public function get_settings() {

		$settings = array(

			'woo_number' => array(
			    'type' => 'text',
			    'title' => __('Number of Products','winkel'),
			    'std' => '8',
			),
			'woo_column' => array(
				'type' => 'select',
				'responsive' => true,
				'title' => __('Post Column','winkel'),
				'placeholder' => __('Number of Column','winkel'),
				'values' => array(
                    '12' =>  __( 'One Column', 'winkel' ),
                    '6' =>  __( 'Two Column', 'winkel' ),
                    '4' =>  __( 'Three Column', 'winkel' ),
                    '3' =>  __( 'Four Column', 'winkel' )
                ),
                'std' => '3'
			),
			'woo_order_by' => array(
			    'type' 	 => 'select',
			    'title'  => __('Select title element','winkel'),
			    'values' => array(
			        	'DESC' 		=> __( 'Descending', 'winkel' ),
                        'ASC' 		=> __( 'Ascending', 'winkel' ),
			    ),
			    'std' => 'DESC',
			),
			'title_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Color',
			    'std' => '#333',
			    'selector' => '{{SELECTOR}} h4.thm-feature-title a{ color: {{data.title_color}}; }'
			),
			'title_hover_color'=> array(
				'tab' => 'style',
			    'type' => 'color',
			    'title' => 'Title Hover Color',
			    'std' => '#fd5238',
			    'selector' => '{{SELECTOR}} h4.thm-feature-title a:hover{ color: {{data.title_hover_color}}; }'
			),
			'title_typography' => array(
				'tab' => 'style',
				'type' => 'typography',
				'title' => __('Title Typography','winkel'),
				'std' => array(
					'fontFamily' 	=> 'Poppins', // Google Font name
					'fontSize' 		=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'lineHeight' 	=> [ 'md'=>'20px', 'sm'=>'18px', 'xs'=>'16px' ], // 0 to 400
					'fontWeight' 	=> '200', //100 to 900
					'textTransform' => '', // none inherit capitalize lowercase uppercase
					'fontStyle' 	=> '', //normal, italic, oblique
					'letterSpacing' => [ 'md'=>'0px', 'sm'=>'0px', 'xs'=>'0px' ],  // 0 to 20
					),
				'selector' => '{{SELECTOR}} .themeum-woo-product-details .product-content h4'
			),
			

		);

		return $settings;
	}
	
	// Headline Render HTML
	public function render($data = null){
	
		if( function_exists('WC') ){
			$settings 			= $data['settings'];
			$woo_number 		= isset($settings['woo_number']) ? $settings["woo_number"] : '';
			$woo_column 		= isset($settings['woo_column']) ? $settings["woo_column"] : '';
			$woo_order_by 		= isset($settings['woo_order_by']) ? $settings["woo_order_by"] : '';

			ob_start();

			//Query Build
			$arg = array(
			'post_type'   =>  'product',
			'post_status' => 'publish',
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
		            <div class="col-md-6 col-lg-<?php echo $woo_column['md']; ?> product-item">
						<div class="inner">
							<h4 class="thm-feature-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
							
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
		$output = ob_get_contents();
        ob_end_clean(); 
       wp_reset_postdata();
        return $output;
		}
	}
 
}
<?php
/**
* The template for displaying product content in the single-product.php template
*
* Override this template by copying it to yourtheme/woocommerce/content-single-product.php
*
* @author 		WooThemes
* @package 		WooCommerce/Templates
* @version     	3.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}
global $post, $product;
?>

<?php do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		if(!function_exists('get_the_password_form')){
			echo wp_kses(get_the_password_form());
		}
		return;
	}

	$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	if ( ! $short_description ) {
		return;
	}
?>


<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-6">
			<div class="relative">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
		</div>
		
		<div class="col-md-6 mythos-tab-full-section">
			<!-- Product Rating -->
			<?php echo wp_kses_post(get_star_rating()); ?>

			<!-- Product stock -->
			<p class="product-stock">
				<?php 
					$product = wc_get_product(get_the_ID());
					echo (!empty($product->get_stock_quantity())) ? '<i class="far fa-check-circle"></i>'. esc_attr('In Stock', 'mythos-pro') .'' : '<i class="far fa-times-circle-o" aria-hidden="true"></i>'.esc_attr('Out of Stock', 'mythos-pro').'';
				?>
			</p>

			<!-- Add to cart option -->
			<div class="mythos-add-to-cart">
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
			</div>

			<?php 
			$wootabs = apply_filters( 'woocommerce_product_tabs', array() );
			$i=0;
			$j=0;

			if ( ! empty( $wootabs ) ) { ?>
				<div class="woocommerce-tabs">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active">
							<a href="#tab_description" role="tab" data-toggle="tab"> <?php echo esc_html__('Descriptions', 'mythos-pro') ?></a>
						</li>
						<?php foreach ( $wootabs as $key => $tabssss ) { ?>
							<li class="<?php echo ($i===0) ? : ''; ?>">
								<a href="#tab-<?php echo esc_attr($key) ?>" role="tab" data-toggle="tab"><?php echo wp_kses_post(apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tabssss['title'], $key )) ?></a>
							</li>
							<?php $i++; ?>
						<?php } ?>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade active in show" id="tab_description">
							<?php echo wp_kses_post($short_description); ?>
						</div>

						<?php foreach ( $wootabs as $key => $tabssss ) { ?>
							<div class="tab-pane fade <?php echo ($j===0) ? : ''; ?>" id="tab-<?php echo esc_attr($key) ?>">
								<?php call_user_func( $tabssss['callback'], $key, $tabssss ) ?>
							</div>
						<?php $j++; } ?>
					</div>
				</div>
			<?php } ?>


			<!-- Section Social Share -->
			<div class="mythos-product-cat-section">
				<div class="sku-section">
					<?php $product_sku = get_post_meta( $post->ID, '_sku', true ); ?>	
					<div class="product_sku"><?php echo esc_attr('SKU: ', 'mythos-pro'). esc_attr($product_sku); ?></div>
					<div class="product-cat"><?php echo esc_attr('Category: ', 'mythos-pro'). wp_kses_post(wc_get_product_category_list($product->get_id())); ?></div>
					<div class="product-tag"><?php echo esc_attr('Tag: ', 'mythos-pro'). wp_kses_post(wc_get_product_tag_list( $product->get_id(), ', ', ' ',' ' )); ?></div>
				</div>
 				
 				<!-- Social Share -->
				<?php
					$permalink 	= get_permalink(get_the_ID());
					$titleget 	= get_the_title();
					$media_url 	= '';
					if( has_post_thumbnail( get_the_ID() ) ){
					    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
					    $media_url = $thumb_src[0];
					}
				?>
				<div class="social-share-wrap mythos-post-share-social">
					<div class="share-icon">
						<span class="icon-big"><?php esc_html_e('Social Share: ', 'mythos-pro'); ?></span>
						<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo esc_html($titleget); ?>" data-description="<?php echo esc_html($titleget); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fab fa-facebook-f"></a>
						<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" class="prettySocial fab fa-twitter"></a>
						<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" class="prettySocial fab fa-google"></a>
						<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fab fa-pinterest"></a>		
						<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo esc_html($titleget); ?>" data-description="<?php echo esc_html($titleget); ?>" data-via="<?php echo esc_html(get_theme_mod( 'wp_linkedin_user' )); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fab fa-linkedin-in"></a>
					</div>
				</div>
			</div>
			<!-- End social media -->

		</div>
	</div>
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php do_action( 'woocommerce_after_single_product_summary' ); ?>

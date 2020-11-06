<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}

global $product, $post;
# Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$args = array( 'taxonomy' => 'product_cat',);
$terms = wp_get_post_terms($post->ID,'product_cat', $args);


?>

<li <?php post_class(); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="product-thumbnail-outer">
		<div class="product-thumbnail-outer-inner">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			<div class="addtocart-btn"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
		</div>
		<div class="product-content-wrapper">
			<a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_shop_loop_item_title' ); ?></a>
			<?php 
				global $post;
	    		$product_sku = get_post_meta( $post->ID, '_sku', true ); ?>

			<p><?php echo $product_sku; ?></p>

			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		</div>
	</div>
</li>

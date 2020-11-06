<?php
/**
* The template for displaying product content within loops
* @see     https://docs.woocommerce.com/document/template-structure/
* @author  WooThemes
* @package WooCommerce/Templates
* @version 3.4.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}
global $product;
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$col = get_theme_mod( 'shop_column', 4 );
$layout = 'product-item col-xs-12 col-sm-6  col-md-6 col-lg-'.$col.'';
?>
<li <?php post_class($layout); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="inner">
		<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
		<div class="product-img"><a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?></a></div>
		<div class="product-content-wrapper"><?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?></div>
		<div class="hover-content">
            <a href="#" class="add-to-wishlist love" data-productid="<?php echo esc_attr( $product->get_id() ); ?>"><i class="winkel winkel-heart"></i></a>
			<?php //do_action( 'woocommerce_after_shop_loop_item' );  ?>
			<a rel="nofollow" href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="" class="love product_type_simple add_to_cart_button ajax_add_to_cart"><i class="winkel winkel-shopping-cart2"></i></a>
			<?php woocommerce_widget_shopping_cart_button_view_cart();?>
	        <a href="<?php the_permalink(); ?>" class="love"><i class="winkel winkel-link"></i></a>
        </div>
	</div>
</li>













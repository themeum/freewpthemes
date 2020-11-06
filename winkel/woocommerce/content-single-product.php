<?php 

/**
* The template for displaying product content in the single-product.php template
* @see 	    	https://docs.woocommerce.com/document/template-structure/
* @author 		WooThemes
* @package 		WooCommerce/Templates
* @version      3.4.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_single_product' );
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-6">
			<div class="thm-single-thumb">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
		</div>

		<div class="col-md-6">
			<div class="inner thm-single-desc">
				<?php winkel_breadcrumbs(); ?>
				<?php 
					$_stock = get_post_meta($post->ID, '_stock', true);
					if ($_stock != 0) {
						echo '<span class="stock-in-stock">'.__("IN STOCK","winkel").'</span>';
					}else{
						echo '<span class="stock-in-out">'.__("OUT OF STOCK","winkel").'</span>';
					}
				?>
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
				<?php get_template_part('lib/product-social')?>
			</div>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>



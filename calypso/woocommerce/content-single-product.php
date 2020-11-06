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

?>

<?php
	do_action( 'woocommerce_before_single_product' );
	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
?>


<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		
		<div class="col-md-6 calypso-tab-full-section">
			<h2 class="thm-product-title"><?php echo the_title(); ?></h2>
			<?php 
				global $post;
	    		$product_sku = get_post_meta( $post->ID, '_sku', true ); ?>

			<span class="product_sku"><?php echo $product_sku; ?></span>



			<?php 

			$tabs = apply_filters( 'woocommerce_product_tabs', array() );
			$i=0;
			$j=0;

			if ( ! empty( $tabs ) ) { ?>
			<div class="woocommerce-tabs">
				<ul class="nav nav-tabs" role="tablist">

					<li class="active"><a href="#tab-info" role="tab" data-toggle="tab"> <?php echo esc_html__('Info', 'calypso') ?> </a></li>

					<?php foreach ( $tabs as $key => $tab ) { ?>
						<li class="<?php echo ($i===0) ? : ''; ?>">
							<a href="#tab-<?php echo $key ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
						</li>
						<?php $i++; ?>
					<?php } ?>
				</ul>

				<div class="tab-content">

					<div class="tab-pane fade active in show" id="tab-info">
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
					</div>

					<?php foreach ( $tabs as $key => $tab ) { ?>
					<div class="tab-pane fade <?php echo ($j===0) ? : ''; ?>" id="tab-<?php echo $key ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>
					<?php $j++; } ?>
				</div>
			</div>
			<?php } ?>
		</div>

		<div class="col-md-6">
			<div class="relative">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
		</div>

	</div>
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php do_action( 'woocommerce_after_single_product_summary' ); ?>

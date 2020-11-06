<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

global $product;

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

        <div class="row">
            <div class="col-12">
                <div class="thm-product-accordion">

					<?php 
					$i = 1;
					foreach ( $tabs as $key => $tab ) :?>
						<?php if( $i == 1 ) { ?>
						<div class="single-item active">
						<?php } else { ?>
						<div class="single-item">
						<?php } ?>
							<h3 class="accordion-title"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></h3>
							<a href="#" class="accordion-icon"><span></span></a>
	                        <div class="accordion-content">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
	                        </div>
						</div>
					<?php 
					$i++;
					endforeach; ?>
                </div>
            </div>
        </div>

<?php endif; ?>
<?php 
$array = array();
$ads_img1 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_img1', true ));
$ads_url1 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_url1', true ));
$ads_img2 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_img2', true ));
$ads_url2 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_url2', true ));
$ads_img3 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_img3', true ));
$ads_url3 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_url3', true ));
$ads_img4 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_img4', true ));
$ads_url4 = esc_attr(get_post_meta( $product->get_id() , 'themeum_ads_url4', true ));
if(!empty($ads_img1)){
    $ads_img1 = wp_get_attachment_image_src( $ads_img1 , 'blog-full');
    $ads_img1 = $ads_img1[0];
}
if(!empty($ads_img2)){
    $ads_img2 = wp_get_attachment_image_src( $ads_img2 , 'blog-full');
    $ads_img2 = $ads_img2[0];
}
if(!empty($ads_img3)){
    $ads_img3 = wp_get_attachment_image_src( $ads_img3 , 'blog-full');
    $ads_img3 = $ads_img3[0];
}
if(!empty($ads_img4)){
    $ads_img4 = wp_get_attachment_image_src( $ads_img4 , 'blog-full');
    $ads_img4 = $ads_img4[0];
}
?>
<?php if( $ads_img1 || $ads_img2 || $ads_img3 || $ads_img4 ) { ?>
	<div class="row">
		<?php if( $ads_img1 ) { ?>
		<div class="col-sm-6 product-ads">
			<?php if($ads_url1) { ?>
				<a href="<?php echo esc_url($ads_url1);?>"> <img src="<?php echo esc_url($ads_img1);?>" alt="img"></a>
			<?php } else { ?>
				<img src="<?php echo esc_url($ads_img1);?>" alt="img">
			<?php } ?>
		</div>
		<?php } ?>		
		<?php if( $ads_img2 ) { ?>
		<div class="col-sm-6 product-ads">
			<?php if($ads_url2) { ?>
				<a href="<?php echo esc_url($ads_url2);?>"> <img src="<?php echo esc_url($ads_img2);?>" alt="img"></a>
			<?php } else { ?>
				<img src="<?php echo esc_url($ads_img2);?>" alt="img">
			<?php } ?>
		</div>
		<?php } ?>		
		<?php if( $ads_img3 ) { ?>
		<div class="col-sm-6 product-ads">
			<?php if($ads_url3) { ?>
				<a href="<?php echo esc_url($ads_url3);?>"> <img src="<?php echo esc_url($ads_img3);?>" alt="img"></a>
			<?php } else { ?>
				<img src="<?php echo esc_url($ads_img3);?>" alt="img">
			<?php } ?>
		</div>
		<?php } ?>		
		<?php if( $ads_img4 ) { ?>
		<div class="col-sm-6 product-ads">
			<?php if($ads_url4) { ?>
				<a href="<?php echo esc_url($ads_url4);?>"> <img src="<?php echo esc_url($ads_img4);?>" alt="img"></a>
			<?php } else { ?>
				<img src="<?php echo esc_url($ads_img4);?>" alt="img">
			<?php } ?>
		</div>
		<?php } ?>
	</div>
<?php } ?>


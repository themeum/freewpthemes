<?php
/**
* Single Product Thumbnails
*
* This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
*
* @see 	    https://docs.woocommerce.com/document/template-structure/
* @author 	WooThemes
* @package 	WooCommerce/Templates
* @version  5.0.2
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

global $product;
$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) { ?>
	<div class="thumbnails">
		<?php
			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$image_title     = get_post_field( 'post_excerpt', $attachment_id );

				$attributes = array(
					'title'                   => $image_title,
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a itemprop="image" class="woocommerce-main-image cloud-zoom" href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
		 		$html .= '</a></div>';

				echo wp_kses_post(apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ));
			} 
		?>
	</div>
<?php }

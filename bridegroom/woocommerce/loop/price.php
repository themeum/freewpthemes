<?php
/**
* Loop Price
*
* This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see 	    https://docs.woocommerce.com/document/template-structure/
* @author 	WooThemes
* @package 	WooCommerce/Templates
* @version  1.6.4
*/

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

global $product;

?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
	<div class="rating-custom">
		<?php  $rating = get_post_meta( get_the_ID(), '_wc_average_rating', true ); ?>
		<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'bridegroom' ), $rating ) ?>">
				<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'bridegroom' ); ?></span>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

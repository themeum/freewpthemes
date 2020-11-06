<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}

global $product;

if ( $product->is_on_sale() ){
    if ( ! $product->is_in_stock() ) return;   

    if ( $product->is_type( 'variable' ) ) { 

        $available_variations = $product->get_available_variations();

        foreach ($available_variations as $value) {
            $variation_id = $value['variation_id']; 
            $variation_price = get_variation_price_by_id(get_the_ID(), $variation_id);
            $regular_price = $variation_price->display_regular_price;
            $sale_price = $variation_price->display_price;
            if (empty($regular_price)){ # Variable product 
                $available_variations = $product->get_available_variations();
                $variation_id=$available_variations[0]['variation_id'];
                $variation= new WC_Product_Variation( $variation_id );
                $regular_price = $variation ->regular_price;
                $sale_price = $variation ->sale_price;
            }
            $sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
            if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :
            echo wp_kses_post(apply_filters( 'woocommerce_sale_flash', '<span class="onsale price-'.$sale.'">-' . $sale . '%</span>', $post, $product ));
            endif;
        }
 

    }else{ 
        $sale_price = get_post_meta( get_the_ID(), '_price', true);
        $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
        $sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
        if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :
        echo wp_kses_post(apply_filters( 'woocommerce_sale_flash', '<span class="onsale">-' . $sale . '%</span>', $post, $product ));
        endif;
    }

}


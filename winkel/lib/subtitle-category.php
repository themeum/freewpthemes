<?php 
function catsubtitle(){
    if( function_exists('get_woocommerce_term_meta') ){
        $products_cats = get_terms( 'product_cat', array('hide_empty' => true) );
        foreach( $products_cats as $prod_cat ) {
            $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'full' );
            $subitle = get_option('product_cat_subtitle_custom_order_'.$prod_cat->term_taxonomy_id);
            $imgbanner = $shop_catalog_img[0];
        }
        wp_reset_query();
    }
}

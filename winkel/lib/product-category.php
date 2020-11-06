<?php
$category_count = get_theme_mod( 'category_count', '8' );
$cat_orderby = get_theme_mod( 'cat_orderby', 'name' );
$cat_order = get_theme_mod( 'cat_order', 'ASC' );

$products_cats = get_terms( 'product_cat', array(
    'orderby'    => $cat_orderby,
    'order'      => $cat_order,
    'number'     => $category_count,
    'hide_empty' => true
));
?>
<ul class="thm-iconic-category">
    <?php 
    if( function_exists('get_woocommerce_term_meta') ){
    foreach( $products_cats as $prod_cat ) :
        $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
        $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'thumbnail' );
        $ico = get_option('product_cat_custom_order_'.$prod_cat->term_taxonomy_id);
        $subitle = get_option('product_cat_subtitle_custom_order_'.$prod_cat->term_taxonomy_id);
        
        $term_link = get_term_link( $prod_cat, 'product_cat' );?>
        <?php if( $ico != 'Select' ) { ?>
        <li>
            <a href="<?php echo $term_link; ?>"><i class="winkel winkel-<?php echo $ico;?>"></i>
            <span><?php echo $prod_cat->name; ?></span>
            </a>
        </li>
        <?php } ?>

    <?php endforeach; 
    }
    wp_reset_query(); ?>
</ul>
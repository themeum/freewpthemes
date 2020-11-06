<?php
function winkel_cart_shortcode_callback( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
    ), $atts, 'bartag' );
    
    global $woocommerce;

    $shop_url = get_permalink( wc_get_page_id( 'shop' ) );

    $html = '';
    
    $check          = '';
    $details        = 'active';
    if( WC()->session->get( 'wc_notices', array() ) ){
        $check      = 'active';
        $details    = '';
    }
    
    $html .= '<div class="row">';
    $html .= '<div class="col-12">';
    $html .= '<div class="thm-product-accordion style-2">';

        // ------------------------------
        //      CART DETAILS SECTION
        // ------------------------------
        $html .= '<div class="single-item '. $details .'">';
        $html .= '<h3 class="accordion-title">'.__("Cart Details","winkel").'</h3><a href="#" class="accordion-icon">';
        if( $details=='active' ){ $html .= '-'; }else{ $html .= '+'; }
        $html .= '</a>';
        $html .= '<div class="accordion-content">';
        $html .= '<span class="d-none confirm-message" data-title="'.__("Are you sure?","winkel").'" data-desc="'.__("This product will be removed!","winkel").'"  data-btntext="'.__("Yes, delete it!","winkel").'"  data-successtitle="'.__("Deleted!","winkel").'" data-successdesc="'.__("Your product has been removed!","winkel").'" data-currenturl='.get_permalink().' ></span>';
        $html .= '<form action="#" class="thm-cart-form"> <!-- start cart markup -->';

            $html .= '<div class="product-list list-head">';
                $html .= '<ul>';
                    $html .= '<li class="product-remove"></li>';
                    $html .= '<li class="product-thumbnail">'.__("Image","winkel").'</li>';
                    $html .= '<li class="product-name">'.__("Items","winkel").'</li>';
                    $html .= '<li class="product-quantity">'.__("Quantity","winkel").'</li>';
                    $html .= '<li class="product-single-price product-size">'.__("Unit Price","winkel").'</li>';
                    $html .= '<li class="product-subtotal">'.__("Total Price","winkel").'</li>';
                $html .= '</ul>';
            $html .= '</div>';
            
            $items = WC()->cart->get_cart();
            foreach( $items as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                // Ansistor Found
                $product_cat_id = '';
                $terms = get_the_terms( $cart_item["product_id"], 'product_cat' );
                if( $terms ){
                    foreach ($terms as $term) {
                        $product_cat_id = $term->term_id;
                        break;
                    }
                    $cats = get_ancestors( $product_cat_id, 'product_cat', 'taxonomy' );
                    if(isset($cats[0])){
                        $cats = array_reverse($cats);
                        $product_cat_id = $cats[0]; 
                    }
                }
                
                $html .= '<div class="product-list list-body">';
                $html .= '<ul>';
                    
                    $html .= '<li class="product-remove">';
                        $html .= '<a href="'.esc_url( wc_get_cart_remove_url( $cart_item_key ) ).'" class="winkel winkel-multiply"></a>';
                    $html .= ' </li>';

                    $html .= '<li class="product-thumbnail">';
                        $html .= '<a href="'.get_permalink($cart_item["product_id"]).'">';
                            $image = get_the_post_thumbnail_url($cart_item["product_id"],'post-thumbnails');
                            if( $image ){
                                $html .= '<img class="img-fluid" src="'.$image.'" alt="'.get_the_title($cart_item["product_id"]).'">';
                            }
                        $html .= '</a>';
                    $html .= '</li>';

                    $html .= '<li class="product-name">';
                        $html .= '<a href="'.get_permalink($cart_item["product_id"]).'" class="name">'.apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ).'</a>';
                        if( $product_cat_id ){
                            $html .= '<a class="product-category" href="'.get_category_link( $product_cat_id ).'"> '.__("For","winkel").' '.get_cat_name($product_cat_id).'</a>';
                        }
                    $html .= ' </li>';

                    $html .= '<li class="product-quantity">';
                        $html .= '<div class="inner">';
                            $html .= '<a href="#" data-cartid="'.$cart_item_key.'" class="minus winkel-minus-cart">';
                                $html .= '<i class="winkel winkel-substract-1"></i>';
                            $html .= '</a>';
                            $html .= '<input type="text" class="qty" value="'.$cart_item["quantity"].'" placeholder="0">';
                            $html .= '<a href="#" data-cartid="'.$cart_item_key.'" class="plus winkel-plus-cart">';
                                $html .= '<i class="winkel winkel-add"></i>';
                            $html .= '</a>';
                        $html .= '</div>';
                    $html .= '</li>';

                    $html .= '<li class="product-single-price product-size">';
                        $price = get_post_meta($cart_item['product_id'] , '_price', true);
                        $html .= '<span>'.wc_price($price).'</span>';
                    $html .= '</li>';

                    $html .= '<li class="product-subtotal">';
                        $html .= '<span>'.wc_price($cart_item["line_total"]).'</span>';
                    $html .= '</li>';

                $html .= '</ul>';
                $html .= '</div>';
            }
                
            
            $html .= '<div class="cart-total">';
                $html .= '<div class="row">';
                    $html .= '<div class="col-6">';
                        $html .= '<h3>'.__( "Total Price","winkel" ).'</h3>';
                    $html .= '</div>';
                $html .= ' <div class="col-6 text-right">';
                        $html .= '<h3 class="winkel-total-cart">'.WC()->cart->get_cart_total().'</h3>';
                $html .= ' </div>';
                $html .= '</div>';
            $html .= '</div>';


            $html .= '<div class="cart-btns clearfix">';
                $html .= '<a href="'.esc_url($shop_url).'" class="button round-btn winkel-success">'.__( "Continue Shopping","winkel" ).'</a>';
                $html .= '<a href="'.esc_url(home_url( "/" )).'" class="button round-btn winkel-grey">'.__( "Cancel","winkel" ).'</a>';
                $html .= '<a href="#" class="button round-btn pull-right collapse-next winkel-fill-checkout">'.__( "Next Step","winkel" ).'</a>';
            $html .= '</div>';

        $html .= '</form> <!-- end cart markup -->';
        $html .= '</div>';
        $html .= '</div>';

        // ------------------------------
        //      DELEVERY & PAYMENT SECTION
        // ------------------------------
        $html .= '<div class="single-item '. $check .'">';
            $html .= '<h3 class="accordion-title winkel-fill-checkout">'.__( "Delevery & Payment","winkel" ).'</h3><a href="#" class="accordion-icon winkel-fill-checkout">';
            if( $check == 'active' ){ $html .= '-'; } else { $html .= '+'; }
            $html .= '</a>';
            $html .= '<div class="accordion-content thm-delevery-form">';
            
            $html .= '<div class="checkout-shortcode">';
            if ( ! defined( 'WOOCOMMERCE_CHECKOUT' ) ){
                define( 'WOOCOMMERCE_CHECKOUT', true );
            }
            $html .= do_shortcode( '[woocommerce_checkout]' );
            $html .= '</div>';

            $html .= '<div class="cart-btns clearfix">';
                $html .= '<a href="'.esc_url($shop_url).'" class="button round-btn winkel-success">'.__( "Continue Shopping","winkel" ).'</a>';
                $html .= '<a href="#" class="button round-btn winkel-grey collapse-prev">'.__( "Previous Step","winkel" ).'</a>';
            $html .= '</div>';

            $html .= '</div>';
        $html .= '</div>';

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
                                

	return $html;
}
add_shortcode( 'winkel_cart', 'winkel_cart_shortcode_callback' );




// Total Price
add_action( 'wp_ajax_nopriv_totalprice', 'themeum_totalprice' );
add_action( 'wp_ajax_totalprice', 'themeum_totalprice' );
function themeum_totalprice(){
    global $woocommerce;
    echo json_encode( array('loggedin'=>true, 'message'=> WC()->cart->get_cart_total() ) );
    die();
}

// Cart Update
add_action( 'wp_ajax_nopriv_cartupdate', 'themeum_cartupdate' );
add_action( 'wp_ajax_cartupdate', 'themeum_cartupdate' );
function themeum_cartupdate(){
    
    global $woocommerce;
    $single_total               = '';
    $items                      = $woocommerce->cart->get_cart();
    $cart_item_key              = $_POST['cartid'];
    $threeball_product_values   = WC()->cart->get_cart_item( $cart_item_key );
    $threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );
    $passed_validation          = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );
    
    if ( $passed_validation ) {
        WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
    }
    
    $cart_single =  WC()->cart->get_cart_item( $cart_item_key );
    if( $cart_single ){
        $single_total = wc_price($cart_single['line_subtotal']);
    }else{
        $single_total = wc_price('0');
    }

    echo json_encode( array('loggedin'=>true, 'total'=> WC()->cart->get_cart_total(),'single'=> $single_total ) );
    die();
}


// Cart Update
add_action( 'wp_ajax_nopriv_checkoutdata', 'themeum_checkoutdata' );
add_action( 'wp_ajax_checkoutdata', 'themeum_checkoutdata' );
function themeum_checkoutdata(){
    if ( ! defined( 'WOOCOMMERCE_CHECKOUT' ) ){
        define( 'WOOCOMMERCE_CHECKOUT', true );
    }
    $message = do_shortcode( '[woocommerce_checkout]' );
    echo json_encode( array('loggedin'=>true, 'message'=> $message ) );
    die();
}

add_action('after_switch_theme', 'winkel_setup_options');
function winkel_setup_options () {
    if( !get_option( 'winkel_checkout' ) ){
        update_option( 'winkel_checkout', 'yes' );
        $winkel_checkout = array(
            'post_title'    => 'Winkel Checkout',
            'post_content'  => '[winkel_cart]',
            'post_type'     => 'page',
            'post_status'   => 'publish',
        );
        wp_insert_post( $winkel_checkout );
    }
}
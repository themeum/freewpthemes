<?php
    $output = ''; 
    $sub_img = array();
    $subtext = ''; 
    global $post; 

    if(!function_exists('winkel_call_sub_header')){
        function winkel_call_sub_header(){ 

            $banner_img = get_theme_mod( 'sub_header_banner_img', false );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#d6d6d6' );
            if( $banner_img ){
                $output = 'style="background-image:url('.esc_url( $banner_img ).');background-size: cover;background-position: 50% 50%;"';
                return $output;
            }else{
                $output = 'style="background-color:'.esc_attr( $banner_color ).';"';
                return $output;
            }
        }
    }

    if(!function_exists('winkel_product_cat_sub_header')){
        function winkel_product_cat_sub_header(){ 
            if( function_exists('get_woocommerce_term_meta') ){
                $cate = get_queried_object();
                $cateID = $cate->term_id;
                $cat_thumb_id = get_woocommerce_term_meta( $cateID, 'thumbnail_id', true );
                $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'full' );
                $imgbanner = $shop_catalog_img[0]; 
                if( $imgbanner ){
                    $output = 'style="background-image:url('.esc_url( $imgbanner ).');background-size: cover;background-position: 50% 50%;"';
                    return $output;
                }else{
                    $output = 'style="background-color:#252525;"';
                    return $output;
                }   
            }
        }
    }    
    if(!function_exists('winkel_brand_cat_sub_header')){
        function winkel_brand_cat_sub_header(){ 
            $cate = get_queried_object();
            $cateID = $cate->term_id;
            $imgbanner = get_option('product_brand_subtitle_custom_order_'.$cateID);
            if( $imgbanner ){
                $output = 'style="background-image:url('.esc_url( $imgbanner ).');background-size: cover;background-position: 50% 50%;"';
                return $output;
            }else{
                $output = 'style="background-color:#252525;"';
                return $output;
            }
        }
    }
            
    if ( function_exists('is_product_category') && is_product_category() ) {
        $output = winkel_product_cat_sub_header();
    } else {
        if ( is_tax( 'product_brand' ) ) {
            $output = winkel_brand_cat_sub_header();
        } else {
            if( isset($post->post_name) ){            
                if(!empty($post->ID)){
                    if(function_exists('rwmb_meta')){
                        $image_attached = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_images', true ));
                        if( function_exists('is_shop') ) {
                            if( is_shop() ){
                                $shop = get_option( 'woocommerce_shop_page_id' );
                                $image_attached = esc_attr(get_post_meta( $shop , 'themeum_subtitle_images', true ));
                            }else{
                                $image_attached = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_images', true ));
                            }
                        } else {
                            $image_attached = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_images', true ));
                        }
                        if(!empty($image_attached)){
                            $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full'); 
                            $output = 'style="background-image:url('.esc_url($sub_img[0]).');background-size: cover;background-position: 50% 50%;"';
                            if(empty($sub_img[0])){
                                $output = 'style="background-image: linear-gradient(180deg, '.esc_attr(get_post_meta(get_the_ID(),"themeum_subtitle_color",true)).' 0%, #0065e0 100%);"';
                                if( get_post_meta(get_the_ID(),"themeum_subtitle_color",true ) == ''){
                                    $output = winkel_call_sub_header();
                                }
                            }
                        }else{
                            if( get_post_meta(get_the_ID(),"themeum_subtitle_color", true) != "" ){ 
                                $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"themeum_subtitle_color",true)).';"';
                            } else {
                                $output = winkel_call_sub_header();
                            }
                        }
                       $subtext = ''; 
                       if( get_post_meta(get_the_ID(),"themeum_sub_title_text",true) ){
                            $subtext = get_post_meta(get_the_ID(),"themeum_sub_title_text",true);
                       }   
                    }else{
                        $output = winkel_call_sub_header();
                    } 
                }else{
                    $output = winkel_call_sub_header();
                }
            }else{
                $output = winkel_call_sub_header();
            }
        }
    }

?>

<?php $subtext = get_post_meta(get_the_ID(),"themeum_sub_title_text",true); ?>
<div class="subtitle-cover sub-title" <?php print $output;?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-left">
                
                <?php winkel_breadcrumbs(); ?>

                <?php
                    global $wp_query;
                    if ( function_exists('is_product_category') && is_product_category() ) {
                        $cate = get_queried_object();
                        $cateID = $cate->term_id;
                        $subitle = get_option('product_cat_subtitle_custom_order_'.$cateID);
                        echo '<h2 class="page-leading">'.$subitle.'</h2>'; 
                    } else {
                        if(isset($wp_query->queried_object->name)){
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if($wp_query->queried_object->name != ''){
                                    echo '<h2 class="page-leading">'.$wp_query->queried_object->name.'</h2>'; 
                                }
                            }
                        }else{
                            if( is_search() ){
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                    }
                                }

                                if (get_theme_mod( 'header_title_enable', true )) {
                                    $text = '';
                                    $first_char = esc_html__('Search','winkel');
                                    if( isset($_GET['s'])){ $text = $_GET['s']; }
                                }
                            }
                            else if( is_home() ){
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                    }
                                }
                            }
                            else if( is_single()){
                                echo '<h3 class="page-subtitle-cont">'. get_the_title() .'</h3>';
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                    }
                                }
                            }
                            else{
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    if ( $subtext != ""){
                                        echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                    }
                                }
                            }
                        }
                    }

                    ?>
            </div>
        </div>
    </div>
</div><!--/.sub-title-->


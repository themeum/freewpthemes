<?php
    if ( !get_theme_mod( 'enable_sub_header', true ) ) {
        return;
    }
    $output = '';
    $sub_img = array();
    $subtext = '';
    global $post;
    if(!function_exists('gutenwp_call_sub_header')){ 
        function gutenwp_call_sub_header(){
            $banner_img = get_theme_mod( 'sub_header_banner_img', get_theme_mod('comingsoon_logo',get_template_directory_uri().'/images/sub-header-banner.jpg') );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#f0f0f0' );
            if( !empty($banner_img) ){
                $output = 'style="background-image:url('.esc_url( $banner_img ).'); background-size: cover; background-position: 50% 50%;"';
                return $output;
            }else{
                $output = 'style="background-color:'.esc_attr( $banner_color ).';"';
                return $output;
            }
        }
    }

    if( isset($post->post_name) ){
        if(!empty($post->ID)){
            if(function_exists('rwmb_meta')){
                $image_attached = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_images', true ));
                if(!empty($image_attached)){
                    $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full');
                    $output = 'style="background-image:url('.esc_url($sub_img[0]).');background-size: cover;background-position: 50% 50%;"';
                    if(empty($sub_img[0])){
                        $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"themeum_subtitle_color",true)).';"';
                        if( get_post_meta(get_the_ID(),"themeum_subtitle_color",true ) == ''){
                            $output = gutenwp_call_sub_header();
                        }
                    }
                }else{
                    if( get_post_meta( get_the_ID(), "sub_header_bg_color", true) != "" ){
                        $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(), "sub_header_bg_color", true)).';"';
                    }else{
                        $output = gutenwp_call_sub_header();
                    }
                }
               $subtext = '';
            }else{
                $output = gutenwp_call_sub_header();
            }
        }else{
            $output = gutenwp_call_sub_header();
        }
    }else{
        $output = gutenwp_call_sub_header();
    }
?>

<?php if (!is_front_page()) { ?>
    <div class="subtitle-cover sub-title" <?php print $output;?>>
        <div class="container">       
            <div class="row">
                <div class="col-12 text-left">
                        <?php
                        global $wp_query;
                        if(isset($wp_query->queried_object->name)){
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if($wp_query->queried_object->name != ''){
                                    if($wp_query->queried_object->name == 'product' ){
                                        echo '<h2 class="page-leading">'.esc_html__('Shop','gutenwp').'</h2>';
                                    }else{
                                        # Product Category list
                                        $terms = get_query_var('product_cat');
                                        $category = get_term_by( 'slug', $terms, 'product_cat' );
                                        if($category) {
                                            $option_name        = 'product_cat_custom_order_' . $category->term_id;
                                            $product_subtitle   = 'product_cat_subtitle_custom_order_' . $category->term_id;

                                            if ($option_name) {
                                                echo '<span class="gutenwp-icons"><i class="back-'.get_option($option_name).'"></i></span>';
                                            }
                                            echo '<h2 class="page-leading">'.$wp_query->queried_object->name.'</h2>';
                                            if ($product_subtitle) {
                                                echo '<p>'.get_option($product_subtitle).'</p>';
                                            }
                                        }else {
                                            echo '<h2 class="page-leading">'.$wp_query->queried_object->name.'</h2>'; 
                                        }
                                    }
                                }else{
                                    echo '<h2 class="page-leading">'.get_the_title().'</h2>';
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
                                    $first_char = esc_html__('Search','gutenwp');
                                    echo '<h2 class="page-leading">'.$first_char.'</h2>';
                                }
                            }
                            else if( is_home() ){
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                    }
                                }
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    if (get_theme_mod( 'header_title_text', 'Our Blog' )){
                                        echo '<h2 class="page-leading">'. get_theme_mod( 'header_title_text','Our Blog' ).'</h2>';
                                    }
                                }
                            }
                            else if( is_archive() ){
                                the_archive_title('<h2 class="page-leading">', '</h2>');
                            }
                            else if( is_single()){

                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                    }
                                }
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    if (get_post_type() == 'event') {
                                        echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                    } elseif (get_post_type() == 'speaker') {
                                        echo '<h2 class="page-leading">'. esc_html__( 'Speaker Details','gutenwp' ).'</h2>';
                                    } elseif (get_post_type() == 'gallery') {
                                        echo '<h2 class="page-leading">'. esc_html__( 'Gallery','gutenwp' ).'</h2>';
                                    }elseif(get_post_type() == 'product'){

                                        $introtext = get_post_meta( get_the_ID(), 'themeum_introtext', true);
                                        $terms = wp_get_post_terms( $post->ID, 'product_cat' );

                                        if ($terms) {
                                            foreach ( $terms as $term )
                                                $categories[] = $term->slug;
                                                $option_name        = 'product_cat_custom_order_' . $term->term_id;
                                                $product_subtitle   = 'product_cat_subtitle_custom_order_' . $term->term_id;

                                                if ($option_name) {
                                                    echo '<span class="gutenwp-icons"><i class="back-'.get_option($option_name).'"></i></span>';
                                                }
                                                echo '<h2 class="page-leading">'. esc_html__( 'Product Details','gutenwp' ).'</h2>';;
                                                if ($product_subtitle) {
                                                    echo '<p>'.get_option($product_subtitle).'</p>';
                                                }
                                        }

                                    }else {
                                        if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                           echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                        }
                                    }
                                }

                            }
                            else{
                                if (get_theme_mod( 'header_title_enable', true )) {
                                   echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                }
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </div><!--/.sub-title-->
<?php } ?>





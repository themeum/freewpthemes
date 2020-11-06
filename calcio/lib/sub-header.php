<?php 

    if ( !get_theme_mod( 'enable_sub_header', true ) && !is_page() ) {
        return;
    }
    $output = ''; 
    $sub_img = array();
    $subtext = ''; 
    global $post;
    if(!function_exists('calcio_call_sub_header')){
        function calcio_call_sub_header(){
            $banner_img = get_theme_mod( 'sub_header_banner_img', false );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#fff' );
            if( $banner_img ){
                $output = 'style="background-image:url('.esc_url( $banner_img ).');background-size: cover;background-position: 50% 50%;"';
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
                            $output = calcio_call_sub_header();
                        }
                    }
                }else{
                    if( get_post_meta(get_the_ID(),"themeum_subtitle_color",true) != "" ){
                        $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"themeum_subtitle_color",true)).';"';
                    }else{
                        $output = calcio_call_sub_header();
                    }
                }
               $subtext = ''; 
               if( get_post_meta(get_the_ID(),"themeum_sub_title_text",true) ){
                    $subtext = get_post_meta(get_the_ID(),"themeum_sub_title_text",true);
               }   
            }else{
                $output = calcio_call_sub_header();
            } 
        }else{
            $output = calcio_call_sub_header();
        }
    }else{
        $output = calcio_call_sub_header();
    }
?>



<?php if (!is_front_page()) { ?>
<div class="subheader-cover-wrap subtitle-cover sub-title" <?php print $output;?>>
    <div class="container">
        <!-- <div class="row"> -->
            <div class="<?php print get_theme_mod('sub_header_align','text-left');?>">

                <?php calcio_breadcrumbs(); ?>

                    <?php
                            global $wp_query; 

                            if(isset($wp_query->queried_object->name)){
                                if (get_theme_mod( 'sub_header_title_enable', true )) {
                                    if($wp_query->queried_object->name != ''){ 
                                        if ( $subtext != ""){
                                            echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                        }
                                        # product subtitle page
                                        if($wp_query->queried_object->name == 'product' ){
                                            echo '<h2>'.esc_html__('Shop','calcio').'</h2>';
                                        }else{
                                            echo '<h2 class="blog-cat-heading">'.$wp_query->queried_object->name.'</h2>';    
                                        }
                                    }else{
                                        echo '<h2 class="blog-cat-heading">'.get_the_title().'</h2>';
                                        if ( $subtext != "" ){
                                            echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                        }
                                    }
                                }
                            }else{
                                if( is_search() ){
                                    if (get_theme_mod( 'sub_header_title_enable', true )) {
                                        $first_char = esc_html__('Search','calcio');
                                        echo '<h2 class="blog-cat-heading">'.$first_char.'</h2>';
                                    }
                                    if (get_theme_mod( 'subtitle_enable', true )) {
                                        if (get_theme_mod( 'header_subtitle_text', '' )){
                                            echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                        }
                                    }
                                }
                                else if( is_archive() ){
                                    if (get_theme_mod( 'sub_header_title_enable', true )) {
                                        echo '<h2 class="blog-cat-heading">'.get_the_archive_title().'</h2>';
                                    }
                                }
                                else if( is_home() ){
                                    if (get_theme_mod( 'sub_header_title_enable', true )) {
                                        if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                            echo '<h2 class="blog-cat-heading">'. get_theme_mod( 'header_title_text','Latest Blog' ).'</h2>';
                                        }
                                    }
                                    if (get_theme_mod( 'subtitle_enable', true )) {
                                        if (get_theme_mod( 'header_subtitle_text', '' )){
                                            echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                        }
                                    }
                                }
                                else if( is_single()){
                                    if (get_theme_mod( 'sub_header_title_enable', true )) {
                                        if (get_post_type() == 'club') {
                                            echo '<h2 class="blog-cat-heading">'. esc_html__( 'Team','calcio' ).'</h2>';
                                        } elseif (get_post_type() == 'fixture-result') {
                                            echo '<h2 class="blog-cat-heading">'. esc_html__( 'Matches','calcio' ).'</h2>';
                                        } elseif (get_post_type() == 'player') {
                                            echo '<h2 class="blog-cat-heading">'. esc_html__( 'Players','calcio' ).'</h2>';
                                        } elseif (get_post_type() == 'point_table') {
                                            echo '<h2 class="blog-cat-heading">'. esc_html__( 'Point Table','calcio' ).'</h2>';
                                        }elseif(get_post_type() == 'product'){
                                            echo '<h2>'.esc_html__('Product Details','calcio').'</h2>';
                                        } else {
                                            if (get_theme_mod( 'header_title_text', '' )){
                                                echo '<h2 class="blog-cat-heading">'. get_theme_mod( 'header_title_text','' ).'</h2>';
                                            }
                                        }
                                    }                                    
                                    if (get_theme_mod( 'subtitle_enable', true )) {
                                        if(get_post_type() == 'product'){
                                            echo '';
                                        } else {
                                            if (get_theme_mod( 'header_subtitle_text', '' )){
                                                echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                            }
                                        }
                                    }
                                } else {
                                    if (get_theme_mod( 'sub_header_title_enable', true )) {
                                        echo '<h2 class="blog-cat-heading">'.get_the_title().'</h2>';
                                    }
                                    
                                    if (get_theme_mod( 'subtitle_enable', true )) {
                                        if ( $subtext != "" ){
                                            echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                        }
                                    }
                                }
                            }

                    ?>
                <?php
                    if (get_theme_mod( 'subtitle_enable', true )) {

                    }
                ?>
            </div>
        <!-- </div> -->
    </div>
</div><!--/.sub-title-->
<?php } ?>
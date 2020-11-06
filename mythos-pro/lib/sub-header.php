<?php
    $output = ''; 
    $sub_img = array();
    $subtext = ''; 
    global $post;


    if(!function_exists('mythos_call_sub_header')){
        function mythos_call_sub_header(){
            $banner_img = get_theme_mod( 'sub_header_banner_img', get_template_directory_uri().'/images/sub-header.jpg' );
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
    
    if( isset($post->post_name) ){
        if(!empty($post->ID)){
            if(function_exists('rwmb_meta')){
                $image_attached     = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_images', true ));
                $subtitle_bg_color  = esc_attr(get_post_meta( $post->ID , 'themeum_subtitle_bg_color', true ));
                if(!empty($image_attached)){
                    $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full'); 
                    $output = 'style="background-image:url('.esc_url($sub_img[0]).');background-size: cover;background-position: 50% 50%;"';
                    if(empty($sub_img[0])){
                        $output = mythos_call_sub_header();
                    }
                }elseif($subtitle_bg_color){
                    $output = 'style="background:'.$subtitle_bg_color.'"';
                }else{
                    $output = mythos_call_sub_header();
                }
               $subtext = ''; 
               if( get_post_meta(get_the_ID(),"themeum_sub_title_text",true) ){
                    $subtext = get_post_meta(get_the_ID(),"themeum_sub_title_text",true);
               }   
            }else{
                $output = mythos_call_sub_header();
            } 
        }else{
            $output = mythos_call_sub_header();
        }
    }else{
        $output = mythos_call_sub_header();
    }
?>

<div class="subtitle-cover sub-title" <?php print wp_kses_post($output);?>>
    <div class="container mythos">
        <div class="row mythos-row">
            <div class="col-12 text-left wrap">
                <?php
                    global $wp_query;
                    if(isset($wp_query->queried_object->name)){
                        if (get_theme_mod( 'header_title_enable', true )) {
                            if($wp_query->queried_object->name != ''){
                                if($wp_query->queried_object->name == 'product' ){
                                    echo '<h2>'.esc_html__('Shop','mythos-pro').'</h2>';
                                    echo '<h3 class="page-subleading">'.esc_attr('Mythos Shop', 'mythos-pro').'</h3>';
                                }else{
                                    echo '<h2 class="page-leading">'.wp_kses_post($wp_query->queried_object->name).'</h2>'; 
                                    echo '<h3 class="page-subleading">'.esc_attr('Category', 'mythos-pro').'</h3>';
                                }
                            }else{
                                echo '<h2 class="page-leading">'.esc_attr(get_the_title()).'</h2>';
                            }
                        }
                    }else{
                        if( is_search() ){
                            if (get_theme_mod( 'subtitle_enable', true )) {
                                if (get_theme_mod( 'header_subtitle_text', '' )){
                                    echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','' )).'</h3>';
                                }
                            }

                            if (get_theme_mod( 'header_title_enable', true )) {
                                $text = '';
                                $first_char = esc_html__('Search','mythos-pro');
                                if( isset($_GET['s'])){ 
                                    $text = sanitize_text_field(wp_unslash($_GET['s'])); 
                                }
                                echo '<h2 class="page-leading">'.wp_kses_post($first_char).':'.wp_kses_post($text).'</h2>';
                            }
                        }
                        else if( is_home() ){
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if (get_theme_mod( 'header_title_text', 'Blog' )){
                                    echo '<h2 class="page-leading">'. wp_kses_post(get_theme_mod( 'header_title_text','Blog' )).'</h2>';
                                }
                            }
                            if (get_theme_mod( 'subtitle_enable', true )) {
                                if (get_theme_mod( 'header_subtitle_text', 'What We Say' )){
                                    echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','What We Say' )).'</h3>';
                                }
                            }
                        }
                        else if( is_single()){
                            if (get_theme_mod( 'subtitle_enable', true )) {
                                if (get_theme_mod( 'header_subtitle_text', '' )){
                                    echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','' )).'</h3>';
                                }
                            }
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if(get_post_type() == 'product'){
                                    echo '<h2>'.esc_html__('Product Details','mythos-pro').'</h2>';
                                    echo '<h3 class="page-subleading">'. esc_attr('Mythos Shop', 'mythos-pro') .'</h3>';
                                }elseif(get_post_type() == 'portfolio'){
                                    echo '<h2 class="page-leading">'.esc_html('Portfolio', 'mythos-pro').'</h2>';
                                    echo '<h3 class="page-subleading">'.esc_attr(get_the_title()).'</h3>';
                                }
                            }
                        }
                        else{
                            if (get_theme_mod( 'header_title_enable', true )) {
                                echo '<h2 class="page-leading">'.esc_attr(get_the_title()).'</h2>';
                                if ( $subtext != ""){
                                    echo '<h3 class="page-subleading">'. wp_kses_post($subtext) .'</h3>';
                                }
                            }
                        }
                    } 
                ?>
            </div>
        </div>
    </div>
</div><!--/.sub-title-->


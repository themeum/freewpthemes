<?php
    $output = ''; 
    $sub_img = array();
    $subtext = ''; 
    global $post;
    
    if(!function_exists('caritas_call_sub_header')){
        function caritas_call_sub_header(){
            $banner_img = get_theme_mod( 'sub_header_banner_img', get_template_directory_uri() . '/images/subtitle-cover.jpg' );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#222222' );
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
                $image_attached = esc_attr(get_post_meta( $post->ID , 'caritas_subtitle_images', true ));
                if(!empty($image_attached)){
                    $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full'); 
                    $output = 'style="background-image:url('.esc_url($sub_img[0]).');background-size: cover;background-position: 50% 50%;"';
                    if(empty($sub_img[0])){
                        $output = 'style="background-image: linear-gradient(180deg, '.esc_attr(get_post_meta(get_the_ID(),"caritas_subtitle_color",true)).' 0%, #0065e0 100%);"';
                        if( get_post_meta(get_the_ID(),"caritas_subtitle_color",true ) == ''){
                            $output = caritas_call_sub_header();
                        }
                    }
                }else{
                    if( get_post_meta(get_the_ID(),"caritas_subtitle_color", true) != "" ){
                        $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"caritas_subtitle_color",true)).';"';
                        if( get_post_meta(get_the_ID(),"caritas_subtitle_gradient_color", true) != "" ){
                            $output = 'style="background-image: linear-gradient(180deg, '.esc_attr(get_post_meta(get_the_ID(),"caritas_subtitle_color",true)).' 0%, '.get_post_meta(get_the_ID(),"caritas_subtitle_gradient_color", true).' 100%);"';
                        }
                    } else {
                        $output = caritas_call_sub_header();
                    }
                }
               $subtext = ''; 
               if( get_post_meta(get_the_ID(),"caritas_sub_title_text",true) ){
                    $subtext = get_post_meta(get_the_ID(),"caritas_sub_title_text",true);
               }   
            }else{
                $output = caritas_call_sub_header();
            } 
        }else{
            $output = caritas_call_sub_header();
        }
    }else{
        $output = caritas_call_sub_header();
    }
?>

<div class="subtitle-cover sub-title" <?php print $output;?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                    <?php
                    global $wp_query;
                    if(isset($wp_query->queried_object->name)){
                        if (get_theme_mod( 'header_title_enable', true )) {
                            if($wp_query->queried_object->name != ''){
                                if($wp_query->queried_object->name == 'product' ){
                                    echo '<h2>'.esc_html__('Shop','caritas').'</h2>';
                                }else{
                                    echo '<h2 class="page-leading">'.$wp_query->queried_object->name.'</h2>'; 
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
                                $text = '';
                                $first_char = esc_html__('Search','caritas');
                                if( isset($_GET['s'])){ $text = $_GET['s']; }
                                echo '<h2 class="page-leading">'.$first_char.':'.$text.'</h2>';
                            }
                        }
                        else if( is_home() ){
                            if (get_theme_mod( 'subtitle_enable', true )) {
                                if (get_theme_mod( 'header_subtitle_text', '' )){
                                    echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                }
                            }
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if (get_theme_mod( 'header_title_text', 'Blog' )){
                                    echo '<h2 class="page-leading">'. get_theme_mod( 'header_title_text','Blog' ).'</h2>';
                                }
                            }
                        }
                        else if( is_single()){

                            if (get_theme_mod( 'subtitle_enable', true )) {
                                if (get_theme_mod( 'header_subtitle_text', '' )){
                                    echo '<h3 class="page-subleading">'. get_theme_mod( 'header_subtitle_text','' ).'</h3>';
                                }
                            }
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if (get_post_type() == 'event') {
                                    echo '<h2 class="page-leading">'. esc_html__( 'Event Details','caritas' ).'</h2>';
                                } elseif (get_post_type() == 'album') {
                                    echo '<h2 class="page-leading">'. esc_html__( 'Albums','caritas' ).'</h2>';
                                } elseif (get_post_type() == 'gallery') {
                                    echo '<h2 class="page-leading">'. esc_html__( 'Gallery','caritas' ).'</h2>';
                                } elseif (get_post_type() == 'performer') {
                                    echo '<h2 class="page-leading">'. esc_html__( 'Performer','caritas' ).'</h2>';
                                }elseif(get_post_type() == 'product'){
                                    echo '<h2>'.esc_html__('Product Details','caritas').'</h2>';
                                }elseif(get_post_type() == 'cause'){
                                    echo '<h2>'.esc_html__('Cause Details','caritas').'</h2>';
                                    if ( $subtext != "" ){
                                        echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                    } 
                                }else {
                                    if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                        echo '<h2 class="page-leading">'. get_theme_mod( 'header_title_text','Latest Blog' ).'</h2>';
                                    }

                                }
                            }

                        }elseif(is_archive()){
	                        if (get_theme_mod( 'header_title_enable', true )) {
	                            $arc_title = str_replace('Month:', '', get_the_archive_title());
	                            $arc_title = str_replace('Year:', '', $arc_title);
	                            $arc_title = str_replace('Day:', '', $arc_title);
		                        echo '<h2 class="page-leading">'.$arc_title.'</h2>';
		                        if ( $subtext != ""){
			                        echo '<h3 class="page-subleading">'. $subtext .'</h3>';
		                        }
	                        }
                        }
                        else{
                            if (get_theme_mod( 'header_title_enable', true )) {
                                echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                if ( $subtext != ""){
                                    echo '<h3 class="page-subleading">'. $subtext .'</h3>';
                                }
                            }
                        }
                    }

                    echo caritas_breadcrumbs();
                    ?>
            </div>
        </div>
    </div>
</div><!--/.sub-title-->


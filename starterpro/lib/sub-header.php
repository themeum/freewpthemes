<?php 
    $output = ''; 
    $sub_img = array();
    global $post;
    if(!function_exists('starterpro_call_sub_header')){
        function starterpro_call_sub_header(){
            
            $banner_img = get_theme_mod( 'sub_header_banner_img', false );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#333' );

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
                            $output = starterpro_call_sub_header();
                        }
                    }
                }else{
                    if( get_post_meta(get_the_ID(),"themeum_subtitle_color",true) != "" ){
                        $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"themeum_subtitle_color",true)).';"';
                    }else{
                        $output = starterpro_call_sub_header();
                    }
                }
            }else{
                $output = starterpro_call_sub_header();
            } 
        }else{
            $output = starterpro_call_sub_header();
        }
    }else{
        $output = starterpro_call_sub_header();
    }

?>
<?php if (!is_front_page()) { ?>
<?php
    $search_cls = (is_search() && (get_query_var('post_type') == 'hotel' || get_query_var('post_type') == 'package' || get_query_var('post_type') == 'vehicle')) ?  'thm-tk-search-page-header' : '';
?>
<div class="subtitle-cover sub-title <?php echo esc_attr($search_cls); ?>" <?php print $output;?>>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                    <?php

                        if (get_theme_mod( 'sub_header_title_enable', true )) {
  
                            global $wp_query; 

                            if(isset($wp_query->queried_object->name)){
                                if($wp_query->queried_object->name != ''){
                                    echo '<h2 class="page-leading">'.$wp_query->queried_object->name.'</h2>';    
                                }else{
                                    echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                }
                            }else{
                                 
                                if( is_search() ){
                                    $first_char = esc_html__('Search','starterpro');
                                    echo '<h2 class="page-leading">'.$first_char.'</h2>';
                                }

                                else if( is_home() ){
                                        echo '<h2>'.esc_html__('Blog','starterpro').'</h2>';
                                    }

                                    else if( is_single() && get_post_type() == 'project'){
                                   echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                } 
                                else if( is_single()){
                                   echo '<h2 class="page-leading">'.esc_html__('Blog','starterpro').'</h2>';
                                } 

                                else{
                                    echo '<h2 class="page-leading">'.get_the_title().'</h2>';
                                }
                            }
                        }
                    ?>
               
                    <!-- if ( is_single() && get_theme_mod( 'breadcrumb_enable', true )) {
                        starterpro_breadcrumbs();
                    } -->
                
            </div>
        </div>
    </div>
</div><!--/.sub-title-->
<?php } ?>
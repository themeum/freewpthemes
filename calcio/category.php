<?php get_header();
global $themeum_options;
$cat_layout = get_theme_mod( 'category_style','style2' );
?>

<?php
    global $themeum_options;
    $count = $themeum_options['slide-number'];
    $count_post = $themeum_options['post-number'];
    $blog_heading = get_theme_mod( 'blog_heading', '' );
    if (!is_numeric($count)) {
        $count = 6;
    }
    if (!is_numeric($count_post)) {
        $count_post = 6;
    }

    if ( is_active_sidebar( 'left_sidebar' ) && is_active_sidebar( 'right_sidebar' ) ) {
        $col = get_theme_mod( 'blog_column', 6 );
    } elseif ( is_active_sidebar( 'right_sidebar' ) ) {
        $col = get_theme_mod( 'blog_column', 9 );
    } elseif ( is_active_sidebar( 'left_sidebar' ) ) {
        $col = get_theme_mod( 'blog_column', 9 );
    } else {
        $col = get_theme_mod( 'blog_column', 12 );
    }
    
    $style = '';
    if( !isset($cat_layout)){
        $style = esc_attr( $cat_layout);
    }else{
        $style = 'style2';
    }

    $category_id = $wp_query->query_vars['cat'];

    $cat_top_add = get_theme_mod('cat_add_top');
    $cat_bottom_add = get_theme_mod('cat_add_bottom');

    $add_img_top = get_theme_mod( 'cat_add_top_img_box', get_parent_theme_file_uri( 'images/add-single-post.jpg' ) );
    $add_img_bottom = get_theme_mod( 'cat_add_bottom_img_box', get_parent_theme_file_uri( 'images/add-single-post.jpg' ) );
    $cat_top_code = get_theme_mod('cat_add_top_text_box');
    $cat_bottom_code = get_theme_mod('cat_add_bottom_text_box');

    $cat_top_img_link = get_theme_mod('cat_add_top_img_link');
    $cat_bottom_img_link = get_theme_mod('cat_add_bottom_img_link');
?>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if(!empty($cat_top_add)){ ?>
                    <div class="advertisement-block add_top">
                        <?php if( !empty($add_img_top)){?>
                            <a target="_blank" href="<?php echo esc_url($cat_top_img_link); ?>">
                              <img class="enter-logo img-responsive" src="<?php echo esc_url( $add_img_top ); ?>" alt="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>" title="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>">
                            </a>
                        <?php } else{?>
                        <?php print $cat_top_code; ?>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="row">
            <?php get_template_part('lib/sub-header')?>


            <?php
                $args = array(
                    'cat' => $category_id,
                    'meta_key' =>  'themeum_featured',
                    'meta_value' =>  '1',
                    'posts_per_page' => $count
                    );
                $query = new WP_Query( $args );

            ?>

            <?php if( $query->have_posts()) : ?>
            
            <div class="blog-top-slide-wrap category-top-slide">
              
                <div class="blog-feature-slide owl-carousel" data-dotnav="true">
                    <?php

                        $i=0;
                        while ( $query->have_posts() ) :  $query->the_post();

                        $post_type = get_post_format( $post->ID );
                        $video_icon = get_parent_theme_file_uri( 'images/video-icon-big.png' );

                        $image ='';
                        if ( has_post_thumbnail() ) {
                            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'calcio-feature-post' );
                            $image ='style="height:340px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                        }else {
                            $image ='style="height:340px;background: linear-gradient(to bottom, #F15A29, #EC0048);"';
                        }

                        $post_data = '';

                        $post_data .= '<div class="single-feature-slide">';  
                        $post_data .= '<a href="'.get_permalink().'"></a>';
                        $post_data .= '<a href="'.get_permalink().'"><div class="common-post-item-in" '.$image.'></div></a>';
                        $post_data .= '<div class="blog-feature-content">';
                        $post_data .='<div class="overlay"></div>';
                            if($post_type == 'gallery'){
                                $post_data .='<i class="fa fa-picture-o"></i>';
                            }elseif($post_type == 'audio'){
                                $post_data .='<i class="fa fa-volume-up"></i>';
                            }elseif($post_type == 'video'){
                                $post_data .='<span class="icon"><i class="fa fa-video-camera"></i></span>';
                            }elseif($post_type == 'quote'){
                                $post_data .='<i class="fa fa-quote-left"></i>';
                            }elseif($post_type == 'link'){
                                $post_data .='<i class="fa fa-link"></i>';
                            }elseif($post_type == 'image'){
                                $post_data .='<i class="fa fa-file-image-o"></i>';
                            }else{
                                $post_data .='<i class="fa fa-file-text-o"></i>';
                            }
                        $post_data .= '<h4 class="entry-cat">' . get_the_category_list(', ') . '</h4>';
                        $post_data .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. calcio_max_charlength(40, get_the_title()) .'</a></h3>';  
                        $post_data .= '</div>';
                        $post_data .= '</div>';

                        if( $i==0 ){
                            echo '<div class="item active">';
                                print $post_data;
                            echo '</div>';
                        }else{
                            echo '<div class="item">';
                                print $post_data;
                            echo '</div>';
                        }
                        $i++;
                    endwhile;
                    wp_reset_postdata();

                    ?>
                </div>
            </div>

            <?php endif; ?>

            <?php get_template_part('lib/left-sidebar'); ?>
            <div id="content" class="site-content col-sm-<?php echo esc_attr($col);?>" role="main">
            <?php if(!empty($blog_heading)){ ?>
                    <h4 class="calcio-blog-head">
                        <?php echo esc_html($blog_heading, "calcio" );?>
                    </h4>
                <?php } ?>
                <?php

                $paged_num = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array( 
                        'category' => $category_id,
                        'posts_per_page' => $count_post,
                        'paged' => $paged_num,
                        'post_status' => 'publish'
                    );
                $posts = get_posts($args);

                $output = '';
                if ($style == 'style1') {
                        if(count($posts)>0){
                            $output .= '<div class="category-post-main themeum-area">';
                            $j=1;
                            $x=0;
                            $total_post = count($posts);
                            $count = 1;

                            $output .= '<div class="row">'; 

                            foreach ($posts as $key=>$post): setup_postdata($post);

                            $post_type = get_post_format( $post->ID );
                            $video_icon = get_parent_theme_file_uri( 'images/video-icon.png' );
                            $video_icon_big = get_parent_theme_file_uri( 'images/video-icon-big.png' );
                                if($count == 1){
                                    $output .= '<div class="latest-featured-post-small big col-sm-12">';
                                    if ( has_post_thumbnail() ) {
                                        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'calcio-medium' );
                                        $image ='style="height:265px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                                    } else {
                                        $image ='style="height:265px;background: linear-gradient(to bottom, #F15A29, #EC0048);"';
                                    }           
                                 
                                    
                                    $output .= '<div class="themeum-latest-featured-post-item common-post-item">';  
                                    $output .= '<a href="'.get_permalink().'"><div class="common-post-item-in big-post" '.$image.'>';
                                    if($post_type == 'gallery'){
                                        $output .='<div class="icon"><i class="fa fa-picture-o"></i></div>';
                                    }elseif($post_type == 'audio'){
                                        $output .='<div class="icon"><i class="fa fa-volume-up"></i></div>';
                                    }elseif($post_type == 'video'){
                                        $output .='<div class="icon"><i class="fa fa-video-camera"></i></div>';
                                    }elseif($post_type == 'quote'){
                                        $output .='<div class="icon"><i class="fa fa-quote-left"></i></div>';
                                    }elseif($post_type == 'link'){
                                        $output .='<div class="icon"><i class="fa fa-link"></i></div>';
                                    }elseif($post_type == 'image'){
                                        $output .='<div class="icon"><i class="fa fa-file-image-o"></i></div>';
                                    }else{
                                        $output .='<div class="icon"><i class="fa fa-file-text-o"></i></div>';
                                    }
                                    $output .= '</div></a>';
                                    $output .= '<div class="common-post-item-intro">';
                                    $output .= '<h4 class="entry-category">' . get_the_category_list(', ') . '</h4>';
                                    $output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'.calcio_max_charlength(45, get_the_title())  .'</a></h3>';  
                                    $output .= '<p class="entry-summary">'.calcio_max_charlength(200, get_the_content())  .'</p>';  
                                    $output .= '</div>';
                                    $output .= '</div>';
                                    $output .= '</div>';

                                }
                                else
                                {
                                    $output .= '<div class="latest-featured-post-small category-post-small clearfix">';
                                    if ( has_post_thumbnail() ) {
                                        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'calcio-post-small' );
                                        $image ='style="height:90px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                                    } else {
                                        $image ='style="height:90px;background: linear-gradient(to bottom, #F15A29, #EC0048);"';
                                    }           
                                 
                                    
                                    $output .= '<div class="themeum-latest-featured-post-item common-post-item">';  
                                    
                                    $output .= '<a class="category-thumb-small" href="'.get_permalink().'"><div class="common-post-item-in col-xs-3" '.$image.'>';
                                        
                                        if($post_type == 'gallery'){
                                            $output .='<div class="icon"><i class="fa fa-picture-o"></i></div>';
                                        }elseif($post_type == 'audio'){
                                            $output .='<div class="icon"><i class="fa fa-volume-up"></i></div>';
                                        }elseif($post_type == 'video'){
                                            $output .='<div class="icon"><i class="fa fa-video-camera"></i></div>';
                                        }elseif($post_type == 'quote'){
                                            $output .='<div class="icon"><i class="fa fa-quote-left"></i></div>';
                                        }elseif($post_type == 'link'){
                                            $output .='<div class="icon"><i class="fa fa-link"></i></div>';
                                        }elseif($post_type == 'image'){
                                            $output .='<div class="icon"><i class="fa fa-file-image-o"></i></div>';
                                        }else{
                                            $output .='<div class="icon"><i class="fa fa-file-text-o"></i></div>';
                                        }
                                    $output .= '</div></a>';

                                    $output .= '<div class="common-post-item-intro col-xs-9">';
                                    $output .= '<h4 class="entry-category">' . get_the_category_list(', ') . '</h4>';
                                    $output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'.calcio_max_charlength(70, get_the_title())  .'</a></h3>';  
                                    $output .= '</div>';
                                    $output .= '</div>';
                                    $output .= '</div>';

                                }
                                
                                $count ++;

                                endforeach;
                            $output .= '</div>';
                            wp_reset_postdata();   
                            
                            $output .= '</div>';
                        }

                    } elseif ($style == 'style2') {
                        if(count($posts)>0){

                            $output .= '<div class="lates-featured-post">';
                            
                            $j=1;
                            $x=0;
                            $total_post = count($posts);

                            foreach ($posts as $key=>$post): setup_postdata($post);


                                if( $j==1 || $x == 3 ){
                                    $output .= '<div class="row">'; 
                                    $x=0;
                                }

                                $output .= '<div class="latest-featured-post-small col-sm-12">';
                                if ( has_post_thumbnail() ) {
                                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'newedge-small' );
                                    $image ='style="height:200px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                                } else {
                                    $image = '';
                                }          
                               
                                
                                $output .= '<div class="themeum-latest-featured-post-item common-post-item common-post-item-text">';    
                                $output .= '<a href="'.get_permalink().'"><div class="common-post-item-in" '.$image.'></div></a>';

                                $output .= '</div>';
                                $output .= '<div class="common-post-item-intro-text">';
                               
                                $output .= '<h4 class="entry-category">' . get_the_category_list(', ') . '</h4>';
                                $output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';  
                                $output .= '<p class="entry-summary">'.calcio_max_charlength(200, get_the_content())  .'</p>'; 
                                $output .= '</div>';
                                $output .= '</div>';
                                
                                if( $x == 2 || $total_post == $j ){

                                        $output .= '</div>';
                                            
                                        global $themeum_options;
                                        if( $themeum_options['category-ads'] == 1){
                                            if (function_exists('themeum_advertiser')) {
                                                if( $themeum_options['category-slug'] == '' ){
                                                    $output .= '<div class="cat-add">';
                                                    $output .=  themeum_advertiser('themeumall'); 
                                                    $output .= '</div>';
                                                }else{
                                                    $output .= '<div class="cat-add">';
                                                    $output .=  themeum_advertiser( $themeum_options['category-slug'] ); 
                                                    $output .= '</div>';
                                                }
                                            }
                                        }         
                                    }
                                    $x++;
                                    $j++;


                            endforeach;
                            wp_reset_postdata();   
                            
                            $output .= '</div>';
                        }
                    }
                    print $output;
                    wp_reset_postdata();


                    $page_num = 0;
                    $args = array( 
                        'category' => $category_id,
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                        );
                    $totalposts = get_posts($args);

                    if((count($totalposts)!=0) && ($count_post != 0) ){
                        $page_num = ceil( count($totalposts)/$count_post );
                    }else{
                        $page_num = 1;
                    }
                    ?>

            </div> <!-- #content -->

            <?php get_template_part('lib/right-sidebar'); ?>

        </div> <!-- .row -->
        <!--Advertisement Area-->
        <div class="row">
            <div class="col-sm-12">
                <?php if(!empty($cat_bottom_add)){ ?>
                    <div class="advertisement-block add_bottom">
                        <?php if( !empty($add_img_bottom)){?>
                            <a target="_blank" href="<?php echo esc_url($cat_bottom_img_link); ?>">
                              <img class="enter-logo img-responsive" src="<?php echo esc_url( $add_img_bottom ); ?>" alt="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>" title="<?php  esc_attr_e( 'Logo', 'calcio' ); ?>">
                            </a>
                        <?php } else{?>
                        <?php print $cat_bottom_code; ?>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
        </div>
        <!-- Advertisement End-->
    </div> <!-- .contaainer -->
    
</section> 

<?php get_footer(); ?>

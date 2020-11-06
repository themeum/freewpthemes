<?php get_header();
?>

<section id="main" class="category-page">
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-md-9 col-sm-12" role="main">
                
                <?php $category_id = $wp_query->query_vars['cat']; ?>
                <div id="category-post-slide" class="carousel slide category-feature-post" data-ride="carousel">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="carousel-inner" role="listbox">
                                <?php
                                    $args = array(
                                        'cat' => $category_id,
                                        'meta_key' =>  'thm_featured',
                                        'meta_value' =>  '1',
                                        'posts_per_page' => 3
                                    );
                                    $query = new WP_Query( $args );

                                    $i=0;
                                    while ( $query->have_posts() ) :  $query->the_post();

                                    $image ='';
                                    if ( has_post_thumbnail() ) {
                                        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'newskit-img-wrap' );
                                        $image ='style="height:350px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                                    } else {
                                        $image ='style="height:350px;background: #333;"';
                                    }

                                    $post_data = '';

                                    $post_data .= '<div class="newskit-featured-post-item common-post-item">';  
                                    $post_data .= '<div class="feature-post-left-img">';
                                    $post_data .= '<a href="'.get_permalink().'"><div class="common-post-item-in" '.$image.'></div></a>';
                                    $post_data .= themeum_social_share_cat( get_the_ID() );
                                    $post_data .= '</div>';

                                    $post_data .= '<div class="common-post-item-intro">';
                                    $post_data .= '</span>';  
                                    $post_data .= '<span class="entry-time">'.get_the_date('M d, g:ia').'</span>';
                                    $post_data .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. newskit_max_charlength(70,get_the_title()) .'</a></h3>';  
                                    $post_data .= '<p class="entry-content">'. newskit_excerpt_max_charlength(150,get_the_content()).'</p>';
                                    $post_data .= '</div>';//common-post-item-intro
                                    $post_data .= '</div>';//common-post-item

                                    if( $i==0 ){ ?>
                                        <div class="carousel-item item active" data-slide-number="<?php echo $i; ?>">
                                           <?php echo $post_data; ?>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="carousel-item item" data-slide-number="<?php echo $i; ?>">
                                            <?php echo $post_data; ?>
                                        </div>
                                    <?php }
                                    $i++;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ol class="carousel-indicators">
                                <?php
                                   
                                    $i=0;
                                    while ( $query->have_posts() ) :  $query->the_post();
                                        if( $i==0 ){ ?>
                                            <li class="active">
                                                <div class="indicator-item" id="carousel-selector-<?php echo $i;?>" data-target="#category-post-slide" data-slide-to="<?php echo $i; ?>">
                                                    <span class="entry-time"><?php echo get_the_date('M d, g:ia'); ?></span>
                                                    <h5>
                                                        <?php echo newskit_max_charlength(50,get_the_title()); ?>
                                                    </h5>
                                                </div>
                                            </li>
                                       <?php }else{ ?>
                                            <li>
                                                <div class="indicator-item" id="carousel-selector-<?php echo $i;?>" data-target="#category-post-slide" data-slide-to="<?php echo $i; ?>">
                                                    <span class="entry-time"><?php echo get_the_date('M d, g:ia'); ?></span>
                                                    <h5 id="carousel-selector-<?php echo $i;?>" data-target="#category-post-slide" data-slide-to="<?php echo $i; ?>">
                                                    <?php echo newskit_max_charlength(50,get_the_title()); ?>
                                                    </h5>
                                                </div>
                                            </li>
                                        <?php }
                                        $i++;
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </ol>
                        </div>
                    </div>

                </div>

                <!-- Category middile advertisement -->
                <?php
                    $cat_ad_top = get_theme_mod('cat_add_top', true);
                    $cat_middle_img = get_theme_mod( 'cat_add_middle_img_box', true);
                    $cat_middle_img_url = get_theme_mod( 'cat_add_middle_img_link', true);

                 ?>
                <?php if(!empty($cat_ad_top)){?>
                    <div class="cat-middile-ad">
                        <a href="<?php echo $cat_middle_img_url; ?>" target="_blank">
                            <img src="<?php echo $cat_middle_img; ?>" alt="">
                        </a>
                    </div>
                <?php }?>
                <!-- Category middile advertisement -->
                
                <?php

                $args = array( 
                        'category' => $category_id,
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    );
                $posts = get_posts($args);

                $output = '';
                        
                    $output .= '<div id="themeum-area" class="category-common-post">';
                    
                    $output .= '<div class="row">'; 

                    foreach ($posts as $key=>$post): setup_postdata($post);

                        $output .= '<div class="category-post-small col-sm-6 col-md-4">';
                        if ( has_post_thumbnail() ) {
                            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'newedge-small' );
                            $image ='style="height:150px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                        } else {
                            $image ='style="height:0px;background: #333;"';
                        }    
                        
                        $output .= '<div class="category-post-small-item common-post-item">';  
                        $output .= '<a href="'.get_permalink().'"><div class="common-post-item-in" '.$image.'></div></a>';
                        $output .= themeum_social_share_cat( get_the_ID() );
                        $output .= '<div class="common-post-item-intro">';
                        $output .= '<span class="date-time">'.get_the_date('M d, g:ia') .'</span>';
                        $output .= '<h4 class="entry-title"><a href="'.get_permalink().'">'. newskit_max_charlength(40,get_the_title()) .'</a></h4>';  
                        $output .= '</div>';//common-post-item-intro
                        $output .= '</div>';//common-post-item
                        $output .= '</div>'; //latest-featured-post-small  

                        endforeach;
                        wp_reset_postdata();   

                    $output .= '</div>'; //category-post-small 
                    
                    $output .= '</div>'; //row
   
                    echo $output;
                    wp_reset_postdata();

                    ?>

            </div> <!-- #content -->

            <?php get_sidebar(); ?>

        </div> <!-- .row -->

        <!-- Category bottom add Section Start-->
        <?php 
        $cat_ad_bottom = get_theme_mod('cat_add_bottom', true);
        $cat_ad_bottom_left_logo = get_theme_mod('cat_add_bottom_left_logo', get_parent_theme_file_uri( 'images/white-logo.png' ));
        $cat_ad_bottom_left_img = get_theme_mod('cat_add_bottom_left_img', get_parent_theme_file_uri( 'images/ad-bg.jpg' ));
        $cat_ad_head = get_theme_mod('cat_add_bottom_left_text_head', 'Download Newskit App');
        $cat_ad_para = get_theme_mod('cat_add_bottom_left_text_para', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $cat_ad_appstore = get_theme_mod('cat_add_bottom_left_img_link_one', true);
        $cat_ad_playstore = get_theme_mod('cat_add_bottom_left_img_link_two', true);
        $cat_ad_bottom_right_img = get_theme_mod('cat_add_bottom_right_img', get_parent_theme_file_uri( 'images/ad-bg2.jpg' ));
        $cat_ad_bottom_right_img_link = get_theme_mod('cat_add_bottom_right_img_link', true);

        ?>
        <?php if($cat_ad_bottom){ ?>
        <div class="row category-ad-bottom">
            <div class="col-sm-7">
                <div class="cat-add-one" style="background: url(<?php echo $cat_ad_bottom_left_img; ?>);">
                    <div class="logo">
                        <img src="<?php echo $cat_ad_bottom_left_logo; ?>" alt="<?php echo esc_html__( 'Add Logo', 'newskit' ); ?>">
                    </div>
                    <h3><?php echo $cat_ad_head; ?></h3>
                    <p><?php echo $cat_ad_para; ?></p>
                    <div class="store-link">
                        <a href="<?php echo $cat_ad_appstore; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/app-store.png" alt="<?php echo esc_html__( 'Appstore Image', 'newskit' ); ?>">
                        </a>
                        <a href="<?php echo $cat_ad_playstore; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="<?php echo esc_html__( 'Playstore Image', 'newskit' ); ?>">
                        </a>
                    </div>
                </div>
            </div>
            <?php if($cat_ad_bottom_right_img){ ?>
            <div class="col-sm-5">
                <div class="cat-add-two">
                    <a href="<?php echo $cat_ad_bottom_right_img_link; ?>" target="_blank">
                        <img src="<?php echo $cat_ad_bottom_right_img; ?>" alt="<?php echo esc_html__( 'Add Image', 'newskit' ); ?>">
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php }?>
        <!-- Category bottom add Section End-->

    </div> <!-- .contaainer -->
    
</section> 

<?php get_footer(); ?>

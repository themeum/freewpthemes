<?php 
    get_header(); 
    $single_top_add = get_theme_mod('single_add_top');
    $single_bottom_add = get_theme_mod('single_add_bottom');

    $add_img_top = get_theme_mod( 'single_add_top_img_box', get_parent_theme_file_uri( 'images/add-single-post.jpg' ) );
    $add_img_bottom = get_theme_mod( 'single_add_bottom_img_box', get_parent_theme_file_uri( 'images/add-single-post.jpg' ) );
    $single_top_code = get_theme_mod('single_add_top_text_box');
    $single_bottom_code = get_theme_mod('cat_add_bottom_text_box');

    $single_top_img_link = get_theme_mod('single_add_top_img_link');
    $single_bottom_img_link = get_theme_mod('single_add_bottom_img_link');
    $cat_top_img_link = get_theme_mod('cat_add_top_img_link');
?>
<section id="main" class="blog-wrappers-content">
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if(!empty($single_top_add)){ ?>
                    <div class="advertisement-block add_top">
                        <?php if( !empty($add_img_top)){?>
                            <a target="_blank" href="<?php echo esc_url($cat_top_img_link); ?>">
                              <img class="enter-logo img-responsive" src="<?php echo esc_url( $add_img_top ); ?>" alt="<?php esc_attr_e( 'add', 'calcio' ); ?>">
                            </a>
                        <?php } else{?>
                        <?php print $single_top_code; ?>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
        </div>
     
        <?php get_template_part('lib/sub-header')?>
        <div class="row blog-single-area">
            <div id="content" class="site-content col-sm-12 blog-content-wrapper" role="main">
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>
                
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                        <!-- next & previous code -->
  
                        <?php
                            if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }
                            }
                        ?>

                    <?php endwhile; ?>
                    
                <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>

                <div class="clearfix"></div>
            </div> <!-- #content -->
        </div> <!-- .row -->
        <!--Advertisement Area-->
       
        <div class="row">
            <div class="col-sm-12">
                <?php if(!empty($single_bottom_add)){ ?>
                    <div class="advertisement-block add_bottom">
                        <?php if( !empty($add_img_bottom)){?>
                            <a target="_blank" href="<?php echo esc_url($single_bottom_img_link); ?>">
                              <img class="enter-logo img-responsive" src="<?php echo esc_url( $add_img_bottom ); ?>" alt="<?php esc_attr_e( 'Add', 'calcio' ); ?>">
                            </a>
                        <?php } else{?>
                        <?php print $single_bottom_code; ?>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
        </div>
        <!-- Advertisement End-->
        </div> <!-- .container -->
    </section> <!-- #main -->

<?php get_footer();
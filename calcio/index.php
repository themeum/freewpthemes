<?php 
get_header(); 
$blog_heading = get_theme_mod( 'blog_heading', '' );

$style = get_theme_mod( 'blog_style', 6 );
$count=1;

if ( is_active_sidebar( 'left_sidebar' ) && is_active_sidebar( 'right_sidebar' ) ) {
    $col = get_theme_mod( 'blog_column', 6 );
} elseif ( is_active_sidebar( 'right_sidebar' ) ) {
    $col = get_theme_mod( 'blog_column', 9 );
} elseif ( is_active_sidebar( 'left_sidebar' ) ) {
    $col = get_theme_mod( 'blog_column', 9 );
} else {
    $col = get_theme_mod( 'blog_column', 12 );
}
?>

<section id="main" class="site-content-wrap">
    <div class="container">
    <?php get_template_part('lib/sub-header'); ?>
    
        <div class="row content-wrap row-order-wrap">

            <?php 
            if ( is_active_sidebar( 'left_sidebar' ) ) {
                get_template_part('lib/left-sidebar'); 
            } ?>

            <div id="content" class="site-content row-order-1 col-sm-<?php echo esc_attr($col);?>" role="main">
                
                <?php if(!empty($blog_heading)){ ?>
                    <h4 class="calcio-blog-head">
                        <?php echo esc_html($blog_heading, "calcio" );?>
                    </h4>
                <?php } ?>
                
                  <div class="blog-main-content">
                    <?php
                        $index = 1;
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();

                                $count++;
                            if($style == 12) {
                                if ( $index == '1' ) { ?>
                                    <div class="row">
                                <?php }?>
                                    <div class="col-md-12">
                                        <div class="blog-post-item-big">
                                            
                                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                        </div>
                                    </div>
                                <?php  if ( $index == (12/esc_attr($col) )) { ?>
                                    </div><!--/row-->
                                <?php $index = 1;
                                }else{
                                    $index++;
                                }
                            }else{ ?>
                                <div class="col-md-12">
                                    <div class="blog-post-item-big blog-style-two row">
                                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                    </div>
                                </div>
                           <?php } ?>

                            <?php endwhile;
                        else:
                            get_template_part( 'post-format/content', 'none' );
                        endif;
                        if($index !=  1 ){ ?>
                           </div><!--/row-->
                        <?php }
                    ?>
                  </div>
                    <!-- AJax Load More Button -->

                    <!-- AJax Load More Button -->
                    <?php
                    $page_numb = max( 1, get_query_var('paged') );
                    $max_page = $wp_query->max_num_pages;
                    echo calcio_pagination( $page_numb, $max_page );
                    ?>
            </div> <!-- .site-content -->
            <?php 
            if ( is_active_sidebar( 'right_sidebar' ) ) {
                get_template_part('lib/right-sidebar'); 
            } ?>
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

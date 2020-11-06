<?php 
/**
* Template Name: Blog Fullwidth
*/
get_header();
$blog_heading = get_theme_mod( 'blog_heading', '' );
?>

<section id="main" class="site-content-wrap">
    <div class="container">
    
        <div class="row mb-50">
            <?php get_template_part('lib/sub-header'); ?>

            <div id="content" class="site-content col-sm-12" role="main">
                <?php if(!empty($blog_heading)){ ?>
                    <h4 class="calcio-blog-head">
                        <?php echo esc_html($blog_heading, "calcio" );?>
                    </h4>
                <?php } ?>
                  <div class="blog-main-content">
                    <?php
                        $index = 1;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array('post_type' => 'post','paged' => $paged);
                        $thequery = new WP_Query($args);
                        $col = get_theme_mod( 'blog_column', 12 );
                        $style = get_theme_mod( 'blog_style', 6 );
                        $count=1;
                        if ( $thequery->have_posts() ) :
                            while ( $thequery->have_posts() ) : $thequery->the_post();

                                $count++;
                            if($style == 12) {
                                if ( $index == '1' ) { ?>
                                    <div class="row">
                                <?php }?>
                                    <div class="col-md-<?php echo esc_attr($col);?>">
                                        <div class="blog-post-item-big blog-fullwidth">
                                            
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
                        wp_reset_postdata();
                        if($index !=  1 ){ ?>
                           </div><!--/row-->
                        <?php } ?>
                    
                  </div>
                  <?php                                 
                    $page_numb = max( 1, get_query_var('paged') );
                    $max_page = $thequery->max_num_pages;
                    echo calcio_pagination( $page_numb, $max_page ); 
                ?>

            </div> <!-- .site-content -->
            
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

<?php get_header(); 

$sidebarstyle = get_theme_mod('blog_sidebar_style', 'right');
if(get_theme_mod('blog_sidebar', false)){
        $col = '8';
    }else{
        $col = '12';
    }
?>

    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">
            <div class="row">
                <?php if($sidebarstyle == 'left' && get_theme_mod('blog_sidebar', false)){
                    get_sidebar();
                } ?>
                <div id="content" class="site-content col-md-<?php echo $col; ?>" role="main">
                   
                    <div class="row">
                    <?php
                    $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args       = array(
                                    'post_type' => 'post',
                                    'paged'     => $paged
                                );
                    $thequery   = new WP_Query($args); 
                    $index      = 1;
                    $i          = 0;
                    $blog_style = get_theme_mod( 'blog_style', 'layout_one');

                    if ( $thequery->have_posts() ) :
                    while ( $thequery->have_posts() ) : $thequery->the_post(); $i++;
                        if ( $index == '1' ) { ?>
                            <?php } ?>

                            <?php if( $blog_style == 'layout_one' ) {?>
                                <?php if($i == 1 || $i == 2) { ?>
                                <div class="separator-wrapper blog-top-img col-md-6">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                                <?php } else{?>
                                    <div class="separator-wrapper blog-no-img col-md-4">
                                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                    </div>
                                <?php }?>
                            <?php } else{?>
                                <div class="separator-wrapper col-md-4">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php }?>

                            <?php  if ( $index == (12/esc_attr($col) )) { ?>
                            
                        <?php $index = 1;
                        }else{
                            $index++;   
                        }                        
                    endwhile;
                    else:
                    get_template_part( 'post-format/content', 'none' );
                    endif;
                    wp_reset_postdata();

                if($index !=  1 ){ ?>
                    </div>
                    <?php } 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $thequery->max_num_pages;
                        echo rhino_pagination( $page_numb, $max_page ); 
                    ?>
                </div>
                <?php if($sidebarstyle == 'right' && get_theme_mod('blog_sidebar', false)){
                    get_sidebar();
                } ?>
            </div><!-- content -->
            
             
        </div>
  
</section> <!-- #main -->

<?php get_footer();
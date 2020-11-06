<?php 
/**
* Template Name: Blog Right Sidebar 
*/
get_header();

get_template_part('lib/sub-header');

?>

<section id="main" class="generic-padding">
    <?php get_template_part('lib/sub-header')?>
    <div class="container inner-padding">
        <div class="row">
            <div id="content" class="site-content col-md-8" role="main">
                <div class="row">
                    <?php
                    $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args       = array(
                                    'post_type' => 'post',
                                    'paged'     => $paged
                                );
                    $thequery   = new WP_Query($args); 
                    $index      = 1;
                    $col        = get_theme_mod( 'blog_column', 12 );

                    if ( $thequery->have_posts() ) :
                    while ( $thequery->have_posts() ) : $thequery->the_post();
                        if ( $index == '1' ) { ?>
                            
                            <?php } ?>
                            <div class="separator-wrapper col-md-<?php echo esc_attr($col);?>">
                                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                            </div>
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

                    <?php } 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $thequery->max_num_pages;
                        fitgym_pagination( $page_numb, $max_page );
                    ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div><!-- content -->
    </div>
</section> <!-- #main -->

<?php get_footer();
<?php 
/**
* Template Name: Blog Right Sidebar 
*/
get_header();?>

<section id="main" class="generic-padding">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
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
                    if ( $thequery->have_posts() ) :
                        while ( $thequery->have_posts() ) : $thequery->the_post(); ?>
                                <div class="separator-wrapper col-md-6">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                                <?php                        
                        endwhile;
                    else:
                    get_template_part( 'post-format/content', 'none' );
                    endif;
                    wp_reset_postdata();?>

                    <?php 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $thequery->max_num_pages;
                        echo wpestate_pagination( $page_numb, $max_page ); 
                    ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div><!-- content -->
    </div>
</section> <!-- #main -->

<?php get_footer();
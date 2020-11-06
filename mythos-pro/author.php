<?php get_header();?>
<?php get_template_part('lib/sub-header')?>
    <section id="main" class="generic-padding">
        <div class="container">
            <div class="row">
                <div id="content" class="site-content col-md-<?php echo esc_url($col); ?>" role="main">
                    <?php
                        $index = 1;
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); 
                                if ( $index == '1' ) { ?>
                                    <div class="row">
                                <?php } ?>
                                    <div class="separator-wrapper col-md-4">
                                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                    </div>
                                <?php if ( $index == (12/4 )) { ?>
                                    </div><!--/row-->
                                <?php $index = 1;
                                }else{
                                    $index++;   
                                }
                            endwhile;
                        else:
                            get_template_part( 'post-format/content', 'none' );
                        endif;
                        if($index !=  1 ){ ?>
                           </div><!--/row-->
                        <?php }
                    ?>
                   <?php
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $wp_query->max_num_pages;
                        echo wp_kses_post(mythos_pagination( $page_numb, $max_page ));  
                    ?>
                </div> <!-- .site-content -->
                <?php get_sidebar(); ?>
            </div>
        </div> <!-- .container -->
    </section> 
<?php get_footer();
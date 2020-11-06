<?php
/**
* Template Name: Blog Left Sidebar
*/
get_header(); ?>

<section id="main" class="common-padding">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <?php get_sidebar(); ?>
            <div class="col-md-8">
                <div class="blog-default-style">
                    <?php
                        $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args       = array(
                                        'post_type' => 'post',
                                        'paged'     => $paged
                                    );
                        $thequery   = new WP_Query($args);
                        $col        = get_theme_mod( 'blog_column', 6 );

                        if ( $thequery->have_posts() ) :?>
                        <div class="row">
                       <?php while ( $thequery->have_posts() ) : $thequery->the_post();
                        ?>
                        <div class="default-postbox-col col-sm-6 col-md-<?php echo $col;?>">
                        <?php
                            get_template_part( 'post-format/content', get_post_format() );
                        ?>
                        </div>
                        <?php
                        endwhile; ?>
                        </div>
                        <?php else:
                        get_template_part( 'post-format/content', 'none' );
                        endif;
                        wp_reset_postdata();
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $thequery->max_num_pages;
                            echo melody_pagination( $page_numb, $max_page );
                        ?>
                       
                </div><!-- Blog Default Style -->  
            </div><!-- Col-Md-8 -->
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

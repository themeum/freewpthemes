<?php

/**
 * Template Name: Cause
 */
get_header();




?>

    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="main-body-inner">
            <div class="container">
                <div class="row">
                    <?php if($sidebarstyle == 'left' && get_theme_mod('blog_sidebar', true)){
                        get_sidebar();
                    } ?>
                    <div id="content" class=" site-content col-md-12" role="main">
                        <div class="row">
                            <?php


                            $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arg = array(
                                'post_type'   =>  'cause',
                                'post_status' => 'publish',
                                'order' => 'ASC',
                                'posts_per_page' => '6',
                                'paged' => $paged
                            );
                            $data = new \WP_Query( $arg );

                            $post_col        = get_theme_mod( 'blog_column', 6 );

                            if ( $data->have_posts()) {
                                while ( $data->have_posts() ) {
                                    $data->the_post();

                                    ?>
                                    <div class="col-md-4">
                                        <div class="caritas-postbox">
                                            <?php get_template_part( 'post-format/content-cause' ); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                get_template_part( 'post-format/content', 'none' );
                            }
                            wp_reset_postdata();
                            ?>
                        </div> <!-- row -->
                        <?php
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $data->max_num_pages;
                        caritas_pagination( $page_numb, $max_page );
                        ?>
                    </div><!-- content -->
                </div>
            </div>
        </div>
    </section> <!-- #main -->

<?php get_footer();;
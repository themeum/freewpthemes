<?php get_header(); ?>

    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">

            <div class="row">
                <?php

                    if(get_theme_mod('enable_sidebar', false)){
                        $main_col = '8';
                    }else{
                        $main_col = '12';
                    }
                ?>
                <div class="col-md-<?php echo esc_attr($main_col); ?>">
                    <?php if(get_theme_mod('blog_classic', false)){ ?>
                        <div class="row">
                    <?php } else{ ?>
                        <div class="row no-gutters">
                    <?php } ?>
                        <?php
                            $paged  = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args   = array(
                                'post_type' => 'post',
                                'paged'     => $paged
                            );
                            $thequery   = new WP_Query($args);
                            $index      = 1;
                            $col        = get_theme_mod( 'blog_column', 4 );

                            if ( $thequery->have_posts() ) {
                                while ( $thequery->have_posts() ) { $thequery->the_post(); ?>
                                    <div class="col-sm-6 col-md-<?php echo esc_attr($col); ?> default-postbox-col">
                                        <?php get_template_part( 'post-format/content' ); ?>
                                    </div>
                                <?php }
                            }else{
                                get_template_part( 'post-format/content', 'none' );
                            }
                            wp_reset_postdata();
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $thequery->max_num_pages;
                            echo calypso_pagination( $page_numb, $max_page );
                        ?>
                    </div><!-- row (inner) -->
                </div>
                <?php if(get_theme_mod('enable_sidebar', false)) { ?>
                    <?php get_sidebar(); ?>
                <?php } ?>
            </div><!-- row (outer) -->
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

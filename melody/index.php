<?php get_header(); ?>

<section id="main" class="common-padding"> 
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <?php
                if(get_theme_mod('enable_sidebar', true)){
                    $main_col = '9';
                }else{
                    $main_col = '12';
                }
            ?>
            <div class="col-md-<?php echo $main_col; ?>">
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
                       
                </div><!-- row (inner) -->
            </div>
            <?php if(get_theme_mod('enable_sidebar', true)) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
        </div><!-- row (outer) -->
    </div>
</section> <!-- #main -->

<?php get_footer();

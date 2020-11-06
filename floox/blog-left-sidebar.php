<?php
/**
* Template Name: Blog Left Sidebar
*/
get_header(); ?>

    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="container">

            <div class="row">
                <?php
                    $main_col = '8';
                ?>
                <div class="col-md-<?php echo $main_col; ?>">
                    <?php if(get_theme_mod('blog_classic', false)){ ?>
                        <div class="row">
                    <?php } else{ ?>
                        <div class="row no-gutters">
                    <?php } ?>
                        <?php
                            $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args       = array(
                                            'post_type' => 'post',
                                            'paged'     => $paged
                                        );
                            $thequery   = new WP_Query($args);
                            $index      = 1;
                            $col        = get_theme_mod( 'blog_column', 4 );

                            if ( $thequery->have_posts() ) :
                            while ( $thequery->have_posts() ) : $thequery->the_post();
                            ?>
                            <div class="col-sm-6 col-md-<?php echo $col;?> default-postbox-col">
                            <?php
                                if(get_theme_mod('blog_classic', false)){
                                    get_template_part( 'post-format/content', get_post_format() );
                                }else{
                                    get_template_part( 'post-format/style2', get_post_format() );
                                }
                            ?>
                            </div>
                            <?php
                            endwhile;
                            else:
                            get_template_part( 'post-format/content', 'none' );
                            endif;
                            wp_reset_postdata();
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $thequery->max_num_pages;
                            echo floox_pagination( $page_numb, $max_page );
                        ?>
                    </div><!-- row (inner) -->
                </div>
                <?php get_sidebar(); ?>
            </div><!-- row (outer) -->
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

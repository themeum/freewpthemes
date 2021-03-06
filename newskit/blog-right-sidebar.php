<?php
/**
* Template Name: Blog Right Sidebar
*/
get_header(); ?>
    <section id="main" class="common-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if(get_theme_mod('blog_classic', false)){ ?>
                        <div class="blog-classic-style">
                    <?php } else{ ?>
                        <div class="blog-default-style">
                    <?php } ?>
                        <?php
                            $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args       = array(
                                            'post_type' => 'post',
                                            'paged'     => $paged
                                        );
                            $thequery   = new WP_Query($args);
                        
                            if ( $thequery->have_posts() ) :
                                while ( $thequery->have_posts() ) : $thequery->the_post();
                                    ?>
                                    <div class="default-postbox-col">
                                    <?php
                                        if(get_theme_mod('blog_classic', true)){
                                            get_template_part( 'post-format/content', get_post_format() );
                                        }else{
                                            get_template_part( 'post-format/content-layout-two', get_post_format() );
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
                            echo newskit_pagination( $page_numb, $max_page );
                        ?>
                    </div><!-- row (inner) -->
                </div>
                <?php get_sidebar(); ?>
            </div><!-- row (outer) -->
        </div>
    </div> <!-- .container -->
</section> <!-- #main -->

<?php get_footer();

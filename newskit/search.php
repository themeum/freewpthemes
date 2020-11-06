<?php get_header(); ?>

    <section id="main" class="common-padding">
        <div class="container">
            <div class="row">
                <?php
                    if(get_theme_mod('enable_sidebar', false)){
                        $main_col = '9';
                    }else{
                        $main_col = '12';
                    }
                ?>
                <div class="col-md-<?php echo $main_col; ?>">
                    <?php if(get_theme_mod('blog_classic', false)){ ?>
                        <div class="blog-classic-style">
                    <?php } else{ ?>
                        <div class="blog-default-style">
                    <?php } ?>
                        <?php

                            if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                            ?>
                            <div class="default-postbox-col">
                            <?php
                                if(get_theme_mod('blog_classic', false)){
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
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $wp_query->max_num_pages;
                            echo newskit_pagination( $page_numb, $max_page );
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
